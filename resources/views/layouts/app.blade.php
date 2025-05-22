<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Toché.bj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Meta tags -->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, admin dashboard, bootstrap 5 tables, vanilla js datatable, colorlibhq" />

    <!-- Fonts and styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../dist/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous" />

    <!-- Vite assets -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')

        <main class="content">
            @yield('content')
        </main>
    </div>

    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <strong>
            Copyright &copy; 2014-2024&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong> All rights reserved.
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="../../dist/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" crossorigin="anonymous"></script>

    <script>
        // OverlayScrollbars config
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true,
                    },
                });
            }
        });

        // SortableJS init
        document.querySelectorAll('.connectedSortable').forEach(connectedSortable => {
            new Sortable(connectedSortable, { group: 'shared', handle: '.card-header' });
        });
        document.querySelectorAll('.connectedSortable .card-header').forEach(cardHeader => {
            cardHeader.style.cursor = 'move';
        });

        // ApexCharts examples
        const sales_chart_options = {
            series: [
                { name: 'Digital Goods', data: [28,48,40,19,86,27,90] },
                { name: 'Electronics', data: [65,59,80,81,56,55,40] }
            ],
            chart: { height: 300, type: 'area', toolbar: { show: false }},
            legend: { show: false },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth' },
            xaxis: { type: 'datetime', categories: ['2023-01-01','2023-02-01','2023-03-01','2023-04-01','2023-05-01','2023-06-01','2023-07-01'] },
            tooltip: { x: { format: 'MMMM yyyy' } }
        };
        new ApexCharts(document.querySelector('#revenue-chart'), sales_chart_options).render();

        // Sparkline charts
        const sparklineOptions = (data) => ({
            series: [{ data }],
            chart: { type: 'area', height: 50, sparkline: { enabled: true } },
            stroke: { curve: 'straight' },
            fill: { opacity: 0.3 },
            yaxis: { min: 0 },
            colors: ['#DCE6EC']
        });

        new ApexCharts(document.querySelector('#sparkline-1'), sparklineOptions([1000,1200,920,927,931,1027,819,930,1021])).render();
        new ApexCharts(document.querySelector('#sparkline-2'), sparklineOptions([515,519,520,522,652,810,370,627,319,630,921])).render();
        new ApexCharts(document.querySelector('#sparkline-3'), sparklineOptions([15,19,20,22,33,27,31,27,19,30,21])).render();

        // jsVectorMap
        new jsVectorMap({ selector: '#world-map', map: 'world' });
    </script>
</body>
</html>
