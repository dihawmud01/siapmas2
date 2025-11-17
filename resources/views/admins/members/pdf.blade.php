<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('KTA | PC IPNU IPPNU Banyumas') }}</title>
    <link rel="stylesheet" href="{{ asset('css/kta.css') }}" />
    @vite('resources/js/app.js')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5dc;
            margin: 20px;
        }

        .container {
            max-width: 720px;
            background-color: #a3905f;
            border-radius: 10px;
            padding: 30px;
            color: #222;
            border: 2px solid #333;
        }

        .header,
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .tgl {
            font-size: 14px;
        }

        .header .title {
            text-align: center;
            flex: 1;
        }

        .header .logo img {
            height: 50px;
        }

        h2, h4 {
            margin: 0;
        }

        hr {
            margin: 15px 0;
            border: 0;
            border-top: 1px solid #444;
        }

        .profile {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-top: 10px;
            flex-wrap: wrap; /* agar mobile friendly */
        }
        
        .gambar {
            flex: 0 0 120px;
        }
    
        .gambar img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border: 2px solid #000;
            border-radius: 5px;
        }

        .bio {
            flex:1;
        }
        
        .bio table {
            width: 100%;
            table-layout: collapse;
            font-size: 14px;
        }

        .bio th {
            text-align: left;
            padding: 4px 10px 4px 0;
            vertical-align: top;
            white-space: nowrap;
            width: 140px;
        }

        .bio td {
            padding: 4px 0;
            text-align: left;
            word-break: break-word;        
        }

        .footer p {
            font-size: 14px;
            text-align: center;
            margin: 10px 0 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="tgl">
                <p>{{ __('Dicetak:') }}<br />{{ $now }}</p>
            </div>
            <div class="title">
                <h2>{{ __('PELAJAR NU BANYUMAS') }}</h2>
                <h4>{{ __('Kartu Tanda Anggota') }}</h4>
            </div>
            <div class="logo">
                <img src="{{ asset('assets/images/logokomi.png') }}" alt="logo" />
            </div>
        </div>

        <hr />

        <div class="profile">
    <div class="gambar">
        <img src="{{ asset($users['photo'] != 'default.png' 
            ? 'storage/images/user/photos/' . $users['id'] . '/' . $users['photo'] 
            : 'storage/images/default.png') }}" alt="Foto Profil" />
    </div>

    <div class="bio">
        <table>
            <tbody>
                <tr>
                    <th>{{ __('Nama') }}</th>
                    <td>{{ $users->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Tempat, Tanggal Lahir') }}</th>
                    <td>{{ $users->place_of_birth }}, {{ $users->date_of_birth }}</td>
                </tr>
                <tr>
                    <th>{{ __('PAC') }}</th>
                    <td>{{ optional($users->pac)->pac ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Kaderisasi') }}</th>
                    <td>{{ $users->cadre_level }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


        <hr />

        <div class="footer">
            <p>{{ __('Kartu ini adalah tanda bahwa kader tersebut adalah benar kader PC IPNU IPPNU Banyumas') }}</p>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
