<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PowerBIController extends Controller
{
    public function showReport()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '6dac03a6-701f-474f-a40b-cfd4cf3ce14b';

        $workspaceIdMobil = env('POWER_BI_WORKSPACE_ID');
        $reportIdMobil = 'b43a107e-4e5f-4c5b-a951-0e504485b0af';

        // Obtener el access token
       $tokenResponse = Http::asForm()
        ->post("https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'https://analysis.windows.net/powerbi/api/.default',
        ]);
      

        if (!$tokenResponse->ok() || !isset($tokenResponse->json()['access_token'])) {
            return response()->json([
                'error' => 'Error al obtener access token',
                'details' => $tokenResponse->json()
            ], 500);
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // Obtener detalles del reporte
        $reportResponse = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}");
        

        if (!$reportResponse->ok()) {
            return response()->json([
                'error' => 'Error al obtener reporte Power BI',
                'details' => $reportResponse->json()
            ], 500);
        }

        $report = $reportResponse->json();
        $embedUrl = $report['embedUrl'];

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceIdMobil}/reports/{$reportIdMobil}");

        if (!$reportResponseMobil->ok()) {
            return response()->json([
                'error' => 'Error al obtener reporte Power BI',
                'details' => $reportResponseMobil->json()
            ], 500);
        }

        $reportMobil = $reportResponseMobil->json();
        $embedUrlMobil = $reportMobil['embedUrl'];

        // Generar embed token
        $embedTokenResponse = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportId}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponse->ok() || !isset($embedTokenResponse->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponse->json()
            ], 500);
        }

        $embedToken = $embedTokenResponse->json()['token'];

        // Generar embed token Mobil
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceIdMobil}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('azure', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }
}
