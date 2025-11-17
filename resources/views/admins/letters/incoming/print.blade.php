<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ "$since - $until" }}</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                text-align: center;
            }

            h1 {
                margin-bottom: 5px;
            }

            h4 {
                margin-top: 0;
                font-weight: normal;
            }

            table {
                width: 100%;
            }

            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
            }

            #filter-section {
                margin: 30px 0;
                text-align: start;
            }
        </style>
    </head>
    <body onload="window.print()">
        @php
            $user = Auth::user();
            $userName = 'PC IPNU IPPNU BANYUMAS';
        
            if ($user->role_id == 3 && $user->pac) {
                $userName = 'PAC IPNU IPPNU' . strtoupper($user->pac->pac);
            }
        @endphp
        
        <h1>{{ $userName }}</h1>
        <hr />

        <h2>Data Surat Masuk</h2>

        @if ($since && $until && $filter)
            <div id="filter-section">
                @if ($filter == 'letter_date')
                    {{ __('Tanggal Surat') }}
                @elseif ($filter == 'received_date')
                    {{ __('Tanggal Diterima') }}
                @else
                    {{ __('Tanggal Dibuat') }}
                @endif
                : {{ "$since - $until" }}
                <br />
                Total: {{ count($incoming) }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>{{ __('No.') }}</th>
                    <th>{{ __('Nomor Surat') }}</th>
                    <th>{{ __('Pengirim') }}</th>
                    <th>{{ __('Penerima') }}</th>
                    <th>{{ __('Tanggal Surat') }}</th>
                    <th>{{ __('Perihal') }}</th>
                    <th>{{ __('Catatan') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incoming as $letter)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $letter->reference_number }}</td>
                        <td>{{ $letter->from }}</td>
                        <td>{{ $letter->to }}</td>
                        <td>{{ $letter->formatted_letter_date }}</td>
                        <td>{{ $letter->description }}</td>
                        <td>{{ $letter->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>