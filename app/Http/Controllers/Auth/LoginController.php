<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'recaptcha_token' => 'required|captcha', // << VALIDACION RECAPTCHA v3
        ]);

        return $this->traitLogin($request);
    }

    /**
     * Evitamos conflicto con el trait
     */
    protected function traitLogin(Request $request)
    {
        return $this->loginTrait($request);
    }

    /**
     * Alias del método original del trait AuthenticatesUsers
     */
    protected function loginTrait(Request $request)
    {
        return $this->attemptLogin($request)
            ? $this->sendLoginResponse($request)
            : $this->sendFailedLoginResponse($request);
    }

    protected function authenticated()
    {
        $this->precargarReportes();
    }

    private function precargarReportes()
    {
        $this->getPowerBIEmbedDataCached('principal', 
            '6dac03a6-701f-474f-a40b-cfd4cf3ce14b',
            'b43a107e-4e5f-4c5b-a951-0e504485b0af'
        );

        $this->getPowerBIEmbedDataCached('soporte',
            'ee555cf6-c356-49fb-badb-8edead4833b9',
            '6296e812-c0ac-4a9e-af72-aa12f9233e63'
        );

        $this->getPowerBIEmbedDataCached('especialista',
            '23f36372-edc4-4a2b-8033-597379baa880',
            'b6b71683-a446-4fb5-a892-08e3f166b501'
        );

        $this->getPowerBIEmbedDataCached('localizacion',
            'f75af920-12ae-40a8-8ecd-203bd4c5d41c',
            '048a6d69-7b16-4f19-851c-3496947d2709'
        );

        $this->getPowerBIEmbedDataCached('indicador',
            '84788d15-7aec-4b6f-a6b5-afb36bda26ae',
            '860f7180-b8a0-444e-8fe3-53f9f4afb22a'
        );

        $this->getPowerBIEmbedDataCached('tickets',
            '004e326c-d908-4ad5-9856-c1b54543f886',
            '1f7427cb-9a15-49b5-843f-5e0727ca11bf'
        );

        $this->getPowerBIEmbedDataCached('kpi',
            '2468cf20-763e-405f-9a23-f81988fa5887',
            '9a3435a3-ad52-4be3-bb6f-b2a314d0750e'
        );
    }

    private function getPowerBIEmbedDataCached($key, $reportId, $reportIdMobil)
    {
        return Cache::remember($key, now()->addHours(2), function () use ($reportId, $reportIdMobil) {

            $tenantId    = env('AZURE_TENANT_ID');
            $clientId    = env('AZURE_CLIENT_ID');
            $clientSecret = env('AZURE_CLIENT_SECRET');
            $workspaceId = env('POWER_BI_WORKSPACE_ID');

            // TOKEN
            $tokenResponse = Http::asForm()->post(
                "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
                [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $clientId,
                    'client_secret' => $clientSecret,
                    'scope'         => 'https://analysis.windows.net/powerbi/api/.default',
                ]
            );

            $accessToken = $tokenResponse->json()['access_token'];

            // DESKTOP
            $desktop = Http::withToken($accessToken)
                ->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}")
                ->json();

            // MOBILE
            $mobil = Http::withToken($accessToken)
                ->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}")
                ->json();

            // EMBED TOKENS
            $embedToken = Http::withToken($accessToken)
                ->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}/GenerateToken", [
                    'accessLevel' => 'View'
                ])->json()['token'];

            $embedTokenMobil = Http::withToken($accessToken)
                ->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
                    'accessLevel' => 'View'
                ])->json()['token'];

            return [
                'reportId' => $reportId,
                'embedUrl' => $desktop['embedUrl'],
                'embedToken' => $embedToken,

                'reportIdMobil' => $reportIdMobil,
                'embedUrlMobil' => $mobil['embedUrl'],
                'embedTokenMobil' => $embedTokenMobil,
            ];
        });
    }
}
