<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PowerBIController extends Controller
{
    public function principal()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '6dac03a6-701f-474f-a40b-cfd4cf3ce14b';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('home', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function soporte()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = 'ee555cf6-c356-49fb-badb-8edead4833b9';

        $reportIdMobil = '6296e812-c0ac-4a9e-af72-aa12f9233e63';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('soporte', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function especialista()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '23f36372-edc4-4a2b-8033-597379baa880';

        $reportIdMobil = 'b6b71683-a446-4fb5-a892-08e3f166b501';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('especialista', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function localizacion()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = 'f75af920-12ae-40a8-8ecd-203bd4c5d41c';

        $reportIdMobil = '048a6d69-7b16-4f19-851c-3496947d2709';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('localizacion', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function indicador()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '84788d15-7aec-4b6f-a6b5-afb36bda26ae';

        $reportIdMobil = '860f7180-b8a0-444e-8fe3-53f9f4afb22a';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('indicador', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function tickets()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '004e326c-d908-4ad5-9856-c1b54543f886';

        $reportIdMobil = '1f7427cb-9a15-49b5-843f-5e0727ca11bf';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('tickets', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }

    public function kpi()
    {

        $tenantId = env('AZURE_TENANT_ID');
        $clientId = env('AZURE_CLIENT_ID');
        $clientSecret = env('AZURE_CLIENT_SECRET');
        $workspaceId = env('POWER_BI_WORKSPACE_ID');
        $reportId = '2468cf20-763e-405f-9a23-f81988fa5887';

        $reportIdMobil = '9a3435a3-ad52-4be3-bb6f-b2a314d0750e';

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

        $reportResponseMobil = Http::withToken($accessToken)->get("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}");

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
        $embedTokenResponseMobil = Http::withToken($accessToken)->post("https://api.powerbi.com/v1.0/myorg/groups/{$workspaceId}/reports/{$reportIdMobil}/GenerateToken", [
            'accessLevel' => 'View'
        ]);

        if (!$embedTokenResponseMobil->ok() || !isset($embedTokenResponseMobil->json()['token'])) {
            return response()->json([
                'error' => 'Error al generar embed token',
                'details' => $embedTokenResponseMobil->json()
            ], 500);
        }

        $embedTokenMobil = $embedTokenResponseMobil->json()['token'];

        return view('kpi', compact('reportId', 'embedUrl', 'embedToken','reportIdMobil', 'embedUrlMobil', 'embedTokenMobil'));
    }
}
