<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', __('Kalender Penuh'))</title>

        <style>
            html, body {
                overflow: auto;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                font-size: 14px;
                height: auto;
                margin: 0;
                background-color: #f8f9fa;
            }

            #calendar-container {
                max-width: 960px; /* Sesuaikan lebar maksimum sesuai kebutuhan */
                margin: 40px auto;
                padding: 30px; /* Tambah padding sedikit */
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center; /* Pusatkan heading */
            }

            .fc-header-toolbar {
                padding-top: 1.5em;
                padding-left: 1.5em;
                padding-right: 1.5em;
                margin-bottom: 1.5em; /* Tambah margin bawah header */
                display: flex; /* Gunakan flexbox untuk mengatur elemen header */
                justify-content: space-between; /* Distribusikan ruang antara elemen */
                align-items: center; /* Pusatkan vertikal elemen */
            }

            #calendar-container .fc-header-toolbar .fc-toolbar-chunk .fc-toolbar-title {
                font-size: 1.2rem !important; /* Ukuran font untuk judul toolbar (bulan dan tahun) diperkecil */
            }

            .fc-view-harness {
                border: 1px solid #dee2e6;
                border-radius: 4px;
            }

            #desktop-view {
                font-size: 1.75rem;
                color: #333;
                margin-bottom: 20px;
                padding-top: 0 !important;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
        @stack('style')
    </head>
    <body>
        <div id='calendar-container'>
            <h1 class="fw-semibold" id="desktop-view">{{ __('Kalender Kegiatan') }}</h1>
            <div id='calendar'></div>
        </div>

        @stack('script')
        @vite('resources/js/plugins/fullcalendar.js')
    </body>
</html>