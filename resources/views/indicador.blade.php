@extends('layouts.app')

@section('content')

<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    @include('partials.menu')


    <!-- Content Start -->
    <div class="content">
        @include('partials.navbar')


        <!-- Sale & Revenue Start -->
        <div class="destock">
            <div class="m-0" id="reportContainer" style="height: 100vh; min-height: 880px; max-height: 1200px;"></div>
        </div>

        <div class="mobil">
            <div class="m-0" id="reportContainerMobil" style="height: 1200px;"></div>
        </div>
        <!-- Sale & Revenue End -->
    </div>
    <!-- Content End -->

</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/powerbi-client@2.19.1/dist/powerbi.min.js"></script>
    <script>
        const models = window['powerbi-client'].models;

        const embedConfig = {
            type: 'report',
            id: '{{ $reportId }}',
            embedUrl: '{{ $embedUrl }}',
            accessToken: '{{ $embedToken }}',
            tokenType: models.TokenType.Embed,
            settings: {
                panes: {
                    filters: { visible: false },
                    pageNavigation: { visible: true }
                }
            }
        };

        const reportContainer = document.getElementById('reportContainer');
        powerbi.embed(reportContainer, embedConfig);
    </script>

    <script>
        const modelsMobil = window['powerbi-client'].models;

        const embedConfigMobil = {
            type: 'report',
            id: '{{ $reportIdMobil }}',
            embedUrl: '{{ $embedUrlMobil }}',
            accessToken: '{{ $embedTokenMobil }}',
            tokenType: models.TokenType.Embed,
            settings: {
                panes: {
                    filters: { visible: false },
                    pageNavigation: { visible: true }
                }
            }
        };

        const reportContainerMobil = document.getElementById('reportContainerMobil');
        powerbi.embed(reportContainerMobil, embedConfigMobil);
    </script>
@endpush

@endsection
