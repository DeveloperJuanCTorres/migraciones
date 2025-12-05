<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PowerBIController extends Controller
{

    // private function getPowerBIEmbedData($reportId, $reportIdMobil)
    // {
    //     $tenantId = env('AZURE_TENANT_ID');
    //     $clientId = env('AZURE_CLIENT_ID');
    //     $clientSecret = env('AZURE_CLIENT_SECRET');
    //     $workspaceId = env('POWER_BI_WORKSPACE_ID');

    //     // Obtener Access Token
    //     $tokenResponse = Http::asForm()->post("https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token", [
    //         'grant_type'    => 'client_credentials',
    //         'client_id'     => $clientId,
    //         'client_secret' => $clientSecret,
    //         'scope'         => 'https://analysis.windows.net/powerbi/api/.default',
    //     ]);

    //     if (!$tokenResponse->ok()) {
    //         throw new \Exception('Error al obtener access token');
    //     }

    //     $accessToken = $tokenResponse->json()['access_token'];

    //     // Obtener reporte Desktop
    //     $reportResponse = Http::withToken($accessToken)
    //         ->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}");

    //     if (!$reportResponse->ok()) {
    //         throw new \Exception('Error al obtener detalle del reporte');
    //     }

    //     $embedUrl = $reportResponse->json()['embedUrl'];

    //     // Obtener reporte Mobile
    //     $reportResponseMobil = Http::withToken($accessToken)
    //         ->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

    //     if (!$reportResponseMobil->ok()) {
    //         throw new \Exception('Error al obtener detalle del reporte móvil');
    //     }

    //     $embedUrlMobil = $reportResponseMobil->json()['embedUrl'];

    //     // Generar embed tokens
    //     $embedToken = Http::withToken($accessToken)
    //         ->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}/GenerateToken", [
    //             'accessLevel' => 'View'
    //         ])->json()['token'];

    //     $embedTokenMobil = Http::withToken($accessToken)
    //         ->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
    //             'accessLevel' => 'View'
    //         ])->json()['token'];

    //     return compact('reportId', 'embedUrl', 'embedToken', 'reportIdMobil', 'embedUrlMobil', 'embedTokenMobil');
    // }

       
    public function principal()
    {
        // $data = $this->getPowerBIEmbedData(
        //     '6dac03a6-701f-474f-a40b-cfd4cf3ce14b', 
        //     'b43a107e-4e5f-4c5b-a951-0e504485b0af' 
        // );        

        // return view('home', $data);
        $data = Cache::get('principal');
        return view('home', $data);
    }

    public function soporte()
    {
        // $data = $this->getPowerBIEmbedData(
        //     'ee555cf6-c356-49fb-badb-8edead4833b9',
        //     '6296e812-c0ac-4a9e-af72-aa12f9233e63'
        // );
        
        // return view('soporte', $data);

        $data = Cache::get('soporte');
        return view('soporte', $data);
    }

    public function especialista()
    {
        // $data = $this->getPowerBIEmbedData(
        //     '23f36372-edc4-4a2b-8033-597379baa880',
        //     'b6b71683-a446-4fb5-a892-08e3f166b501'
        // );

        // return view('especialista', $data);

        $data = Cache::get('especialista');
        return view('especialista', $data);
    }

    public function localizacion()
    {
        // $data = $this->getPowerBIEmbedData(
        //     'f75af920-12ae-40a8-8ecd-203bd4c5d41c',
        //     '048a6d69-7b16-4f19-851c-3496947d2709'
        // );

        // return view('localizacion', $data);

        $data = Cache::get('localizacion');
        return view('localizacion', $data);
    }

    public function indicador()
    {
        // $data = $this->getPowerBIEmbedData(
        //     '84788d15-7aec-4b6f-a6b5-afb36bda26ae',
        //     '860f7180-b8a0-444e-8fe3-53f9f4afb22a'
        // );

        // return view('indicador', $data);

        $data = Cache::get('indicador');
        return view('indicador', $data);
    }

    public function tickets()
    {
        // $data = $this->getPowerBIEmbedData(
        //     '004e326c-d908-4ad5-9856-c1b54543f886',
        //     '1f7427cb-9a15-49b5-843f-5e0727ca11bf'
        // );

        // return view('tickets', $data);

        $data = Cache::get('tickets');
        return view('tickets', $data);
    }

    public function kpi()
    {
        // $data = $this->getPowerBIEmbedData(
        //     '2468cf20-763e-405f-9a23-f81988fa5887',
        //     '9a3435a3-ad52-4be3-bb6f-b2a314d0750e'
        // );

        // return view('kpi', $data);

        $data = Cache::get('kpi');
        return view('kpi', $data);
    }
}
