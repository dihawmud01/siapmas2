<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <style>
            @page {
                size: A4 portrait;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: 'Times New Roman', serif;
                text-align: center;
            }

            .cover-container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100vh;
                text-align: center;
            }

            .cover-title {
                font-weight: bold;
                font-size: 32pt;
                text-transform: uppercase;
            }

            .cover-subtitle {
                margin-bottom: 30px;
                font-weight: bold;
                font-size: 20pt;
                text-transform: uppercase;
            }

            .logo img {
                width: auto;
                height: 380px;
            }

            .cover-subtitle span,
            .footer span {
                color: #00b050;
            }

            .footer {
                margin-top: 30px;
                font-weight: bold;
                font-size: 18pt;
                text-transform: uppercase;
            }
        </style>
        <title></title>
    </head>
    <body>
        <div class="cover-container">
            <p class="cover-title">SURAT PENGESAHAN</p>
            <p class="cover-subtitle">
                {{ strtoupper($orgLabel) }}
                <br />
                <span>IKATAN PELAJAR PUTRI NAHDLATUL ULAMA</span>
                <br />

                @if ($letter->organization_level->value !== 'PAC')
                    {{ $letter->organization_level->value === 'PR' ? 'RANTING ' : 'KOMISARIAT ' }}{{ strtoupper($subOrgName) }}
                    <br />
                    KECAMATAN {{ strtoupper($pacNameRaw) }}
                @else
                    {{ strtoupper($coverOrgName) }}
                @endif
                <br />
                KABUPATEN BANYUMAS
                <br />
                MASA KHIDMAT {{ $letter->start_period . '-' . $letter->end_period }}
            </p>

            <div class="logo">
                <img src="data:image/png;base64,{{ $logoImg }}" alt="Logo" />
            </div>

            <p class="footer">
                PIMPINAN CABANG
                <br />
                <span>IKATAN PELAJAR PUTRI NAHDLATUL ULAMA</span>
                <br />
                KABUPATEN BANYUMAS
            </p>
        </div>

        <div style="page-break-after: always"></div>

        @include('admins.letters.sp.pdf.ippnu.content')
    </body>
</html>
