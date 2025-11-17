<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ __('Data Anggota') }} | PAC | 
        @if($category === 'IPNU') IPNU
        @elseif($category === 'IPPNU') IPPNU
        @endif
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        body {
            font-size: 9pt;
            background: url('{{ asset('assets/images/logokomi.png') }}') no-repeat center center fixed;
            background-size: contain;
            background-blend-mode: lighten;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .container {
            max-width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h3 {
            color: #136f63;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #136f63;
            color: white;
        }

        table tbody tr:hover {
            background-color: #d4edda;
        }

        @media print {
            body {
                zoom: 90%;
            }
            img.watermark {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/images/logokomi.png') }}" class="watermark" 
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.1; width: 50%; display: none;" 
        alt="Background">

    <div class="container mt-4">
        <center>
            <h3>
                @if ($category === 'IPNU')
                    {{ __('Data Anggota IPNU') }} {{ $pac->pac }}
                @elseif ($category === 'IPPNU')
                    {{ __('Data Anggota IPPNU') }} {{ $pac->pac }}
                @endif
            </h3>
        </center>

        <div class="mb-3">
            <h5 class="text-success">{{ __('Total Anggota') }}: {{ $userCounts }}</h5>
            <h6 class="text-muted">{{ __('Dicetak pada') }}: {{ $now }}</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('No.') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Tempat, Tanggal Lahir') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Makesta') }}</th>
                        <th>{{ __('Tingkat Kader') }}</th>
                        <th>{{ __('Kontak') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pac->members as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                            @if ($category === 'IPNU')
                                {{ __('Laki Laki') }}
                            @elseif ($category === 'IPPNU')
                                {{ __('Perempuan')}}
                            @endif
                            </td>
                            <td>{{ $item->place_of_birth }}, {{ $item->date_of_birth }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->makesta_year }}</td>
                            <td>{{ $item->cadre_level }}</td>
                            <td>{{ $item->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.onload = () => {
            document.body.style.zoom = '100%';
            window.print();
        };
    </script>
</body>
</html>