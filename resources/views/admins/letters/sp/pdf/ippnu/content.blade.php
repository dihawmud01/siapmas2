<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            @page {
                size: 215.91mm 330.22mm;
                margin: 5cm 1.5cm 2cm 1.5cm;
            }

            .header {
                position: fixed;
                top: -4cm;
                right: 0;
                left: 0;
                width: 100%;
                text-align: center;
            }

            .header img {
                max-width: 100%;
                height: auto;
            }

            body {
                margin: 0;
                font-size: 10.5pt;
                line-height: 1.5;
                font-family: 'Times New Roman', serif;
                text-align: justify;
            }

            .main-title {
                display: inline-block;
                position: relative;
                font-weight: bold;
                font-size: 12pt;
                text-align: center;
                text-transform: uppercase;
            }

            .main-title::after {
                display: block;
                margin: 5px auto;
                width: auto;
                content: '';
            }

            .letter-number {
                text-transform: none;
            }

            .for {
                margin-bottom: 15px;
                font-weight: bold;
                font-size: 10.5pt;
                text-align: center;
            }

            p {
                margin: 0;
            }

            .secondary-title {
                position: relative;
                align-items: center;
                font-weight: bold;
                font-size: 11pt;
                text-align: center;
                text-transform: uppercase;
            }

            .section-title {
                font-weight: bold;
            }

            .latin-arabic {
                margin-top: 8px;
                font-style: italic;
            }

            .content-table td {
                vertical-align: top;
                text-align: justify;
            }

            .attachment-title {
                margin-bottom: 12px;
            }

            .attachment-subtitle {
                margin-top: 8px;
            }

            .attachment-content {
                margin-top: 12px;
            }

            .date {
                margin-top: 20px;
            }

            .date-table {
                border-collapse: collapse;
                width: 100%;
            }

            .date-table td {
                vertical-align: top;
                text-align: left;
            }

            .signature {
                text-align: center;
            }

            .signature-table {
                border-collapse: collapse;
                width: 100%;
            }

            .signature-table td {
                position: relative;
                vertical-align: middle;
                width: 50%;
                text-align: center;
            }

            .signature-space {
                display: block;
                min-height: 20px;
            }

            .to {
                font-style: italic;
            }

            .chairman-signature-img {
                display: block;
                opacity: 0.9;
                margin: -53px auto -28px 0;
                height: 100px;
            }

            .secretary-signature-img {
            display: block;
            opacity: 0.9;
            margin: -53px auto -28px -70px;
            height: 95px;
            }


            .bordered-td {
                padding-top: 20px;
                font-weight: bold;
            }

            .bordered-td p {
                display: inline-block;
                position: relative;
                border-bottom: 1px solid #1e1e1e;
            }

            ol {
                margin: 0;
                padding-left: 20px;
            }

            ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }
        </style>
        <title></title>
    </head>

    <body>
        <div class="header">
            <img src="{{ asset('assets/images/sp/ippnu/header.png') }}" alt="Header" />
        </div>

        <div style="text-align: center">
            <div class="main-title">
                SURAT PENGESAHAN
                <br />
                PIMPINAN CABANG IKATAN PELAJAR PUTRI NAHDLATUL ULAMA
                <br />
                KABUPATEN BANYUMAS
                <br />
                <span class="letter-number">Nomor: {{ $letter->letter_number }}</span>
            </div>
        </div>

        <div class="for">Untuk</div>
        <div class="secondary-title">
            PIMPINAN ANAK CABANG
            <br />
            IKATAN PELAJAR PUTRI NAHDLATUL ULAMA
            <br />
            {{ $pac }}
            <br />
            KABUPATEN BANYUMAS
            <br />
            MASA KHIDMAT {{ $letter->start_period . '-' . $letter->end_period }}
        </div>

        <div class="content">
            <p class="latin-arabic">Bismillahirrahmanirrahim</p>
            <p>Pimpinan Cabang Ikatan Pelajar Putri Nahdlatul Ulama Kabupaten Banyumas, setelah:</p>

            <table class="content-table">
                <tr>
                    <td><p class="section-title">Menimbang</p></td>
                    <td><p>:</p></td>
                    <td>
                        <div>
                            Bahwa dalam upaya untuk melancarkan tugas serta mekanisme organisasi maka Pimpinan Cabang
                            IPPNU Kabupaten Banyumas memandang perlu untuk segera memberikan pengesahan kepada Pengurus
                            Pimpinan Anak Cabang Ikatan Pelajar Putri Nahdlatul Ulama Kecamatan Baturraden Masa Khidmat
                            {{ $letter->start_period . '-' . $letter->end_period }}.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><p class="section-title">Mengingat</p></td>
                    <td><p>:</p></td>
                    <td>
                        <div>
                            <ol>
                                <li>Peraturan Dasar (PD) IPPNU BAB VII Pasal 12;</li>
                                <li>Peraturan Rumah Tangga (PRT) IPPNU Bab III Pasal 14 dan Bab VI Pasal 26;</li>
                            </ol>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><p class="section-title">Memperhatikan</p></td>
                    <td><p>:</p></td>
                    <td>
                        <div>
                            <ol>
                                <li>
                                    Surat Rekomendasi Pengesahan dari MWC NU
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }} Nomor:
                                    {{ $letter->mwc_letter_number }}
                                </li>
                            </ol>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><p class="section-title">Menetapkan</p></td>
                    <td><p>:</p></td>
                    <td>
                        <div>
                            <ol>
                                <li>
                                    Mengesahkan Susunan Pengurus Pimpinan Anak Cabang Ikatan Pelajar Putri Nahdlatul
                                    Ulama {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }}
                                    Masa Khidmat {{ $letter->start_period . '-' . $letter->end_period }}. Sebagaimana
                                    terlampir;
                                </li>
                                <li>
                                    Menugaskan kepada semua Pengurus Pimpinan Anak Cabang Ikatan Pelajar Putri Nahdlatul
                                    Ulama {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }}
                                    Masa Khidmat {{ $letter->start_period . '-' . $letter->end_period }} untuk
                                    melaksanakan tugas organisasi secara keseluruhan;
                                </li>
                                <li>
                                    Surat Pengesahan ini berlaku mulai tanggal ditetapkan dan berakhir sampai tanggal
                                    {{ $letter->formatted_expired_date }};
                                </li>
                                <li>
                                    Surat Pengesahan ini akan ditinjau kembali apabila terdapat kekeliruan dikemudian
                                    hari.
                                </li>
                            </ol>
                        </div>
                    </td>
                </tr>
            </table>

            <p class="latin-arabic">Wallahulmuwaffiq ilaa aqwamith-tharieq</p>

            <div class="date">
                <table class="date-table">
                    <tr>
                        <td width="50%"></td>
                        <td width="88px"><p class="col-1">Ditetapkan di</p></td>
                        <td width="8px"><p class="bracket-pair">:</p></td>
                        <td width="128px"><p>Purwokerto</p></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><p class="col-1">Pada tanggal</p></td>
                        <td><p class="bracket-pair">:</p></td>
                        <td class="bordered-td" style="padding: 0">
                            <p style="width: 100%; font-weight: normal; padding: 0">
                                {{ $letter->formatted_generated_hijri_date }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <p style="width: 100%">{{ $letter->formatted_generated_georgia_date }}</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="signature">
                <p>
                    <strong>PIMPINAN CABANG</strong>
                    <br />
                    <strong>IKATAN PELAJAR PUTRI NAHDLATUL ULAMA</strong>
                    <br />
                    <strong>KABUPATEN BANYUMAS</strong>
                </p>
                <table class="signature-table">
                    <tr>
                        <td><p>Ketua,</p></td>
                        <td><p>Sekretaris,</p></td>
                    </tr>
                    <tr>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/chairman-ipp-signature.png') }}"
                                    class="chairman-signature-img"
                                    alt="Tanda Tangan Ketua"
                                />
                            </div>
                            <p><strong>YENI RAHMAWATI</strong></p>
                        </td>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/secretary-ipp-signaturree.png') }}"
                                    class="secretary-signature-img"
                                    alt="Tanda Tangan Sekretaris"
                                />
                            </div>
                            <p><strong>AINUN FAJRIYANI</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>NIA. 33.02.1706.0019</p></td>
                        <td><p>NIA. 33.02.2204.0026</p></td>
                    </tr>
                </table>
            </div>

            <p>Tembusan:</p>
            <ol class="to">
                <li>Yth. MWC NU {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }};</li>
                <li>Arsip</li>
            </ol>
        </div>

        <div class="attachment">
            <p class="attachment-title">
                Lampiran Surat Pengesahan
                <br />
                Pimpinan Cabang Ikatan Pelajar Putri Nahdlatul Ulama Kabupaten Banyumas
                <br />
                Nomor: {{ $letter->letter_number }}
            </p>
            <div class="secondary-title" style="padding-bottom: 4px">
                SUSUNAN PENGURUS
                <br />
                PIMPINAN ANAK CABANG
                <br />
                IKATAN PELAJAR PUTRI NAHDLATUL ULAMA
                <br />
                {{ $pac }}
                <br />
                MASA KHIDMAT {{ $letter->start_period . '-' . $letter->end_period }}
            </div>
            <div class="secondary-title" style="margin-top: 5px; margin-bottom: 10px"></div>
            <div class="attachment-content">
                <table class="content-table">
                    <tr>
                        <td>
                            <p><strong>PELINDUNG</strong></p>
                        </td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->protectors) <= 1)
                                @foreach ($letter->protectors as $protector)
                                    <p>{{ $protector }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->protectors as $protector)
                                        <li><p>{{ $protector }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><strong>PEMBINA</strong></p>
                        </td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->advisors) <= 1)
                                @foreach ($letter->advisors as $advisor)
                                    <p>{{ $advisor }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->advisors as $advisor)
                                        <li><p>{{ $advisor }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="attachment-subtitle"><strong>PENGURUS HARIAN</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>Ketua</strong></p>
                        </td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->chairman }}</p></td>
                    </tr>
                    @foreach ($letter->vice_chairmen as $vice)
                        <tr>
                            <td>
                                <p>
                                    Wakil Ketua{{ count($letter->vice_chairmen) <= 1 ? '' : ' ' . $loop->iteration }}
                                </p>
                            </td>
                            <td><p>:</p></td>
                            <td><p>{{ $vice }}</p></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>
                            <p class="position"><strong>Sekretaris</strong></p>
                        </td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->secretary }}</p></td>
                    </tr>
                    @foreach ($letter->vice_secretaries as $vice)
                        <tr>
                            <td>
                                <p>
                                    Wakil
                                    Sekretaris{{ count($letter->vice_secretaries) <= 1 ? '' : ' ' . $loop->iteration }}
                                </p>
                            </td>
                            <td><p>:</p></td>
                            <td><p>{{ $vice }}</p></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>
                            <p class="position"><strong>Bendahara</strong></p>
                        </td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->treasurer }}</p></td>
                    </tr>
                    @foreach ($letter->vice_treasurers as $vice)
                        <tr>
                            <td>
                                <p>
                                    Wakil
                                    Bendahara{{ count($letter->vice_treasurers) <= 1 ? '' : ' ' . $loop->iteration }}
                                </p>
                            </td>
                            <td><p>:</p></td>
                            <td><p>{{ $vice }}</p></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>
                            <p class="attachment-subtitle"><strong>DEPARTEMEN-DEPARTEMEN</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>A. Departemen Organisasi</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->organization_department_coordinator }}</p></td>
                    </tr>

                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->organization_department_members) <= 1)
                                @foreach ($letter->organization_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->organization_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>B. Departemen Kaderisasi</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->cadre_department_coordinator }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->cadre_department_members) <= 1)
                                @foreach ($letter->cadre_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->cadre_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p class="position"><strong>C. Departemen Dakwah</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->dakwah_department_coordinator }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->dakwah_department_members) <= 1)
                                @foreach ($letter->dakwah_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->dakwah_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>D. Departemen Olahraga, Seni, dan Budaya</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->culture_department_coordinator }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->culture_department_members) <= 1)
                                @foreach ($letter->culture_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->culture_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>E. Departemen Jurnalistik</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        {{-- Datanya sementara masih pake Dept. Kaderisasi, nanti bisa tambahin di DB data Dept. Jurnalistik --}}
                        <td><p>{{ $letter->cadre_department_coordinator }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->cadre_department_members) <= 1)
                                @foreach ($letter->cadre_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->cadre_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>F. Departemen Humas</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Koordinator</p></td>
                        <td><p>:</p></td>
                        {{-- Datanya sementara masih pake Dept. Kaderisasi, nanti bisa tambahin di DB data Dept. Humas --}}
                        <td><p>{{ $letter->cadre_department_coordinator }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->cadre_department_members) <= 1)
                                @foreach ($letter->cadre_department_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->cadre_department_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p class="attachment-subtitle"><strong>LEMBAGA-LEMBAGA</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>A. Lembaga Kewirausahaan</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Direktur</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->economy_institution_director }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->economy_institution_members) <= 1)
                                @foreach ($letter->economy_institution_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->economy_institution_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>B. Lembaga KPP</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Direktur</p></td>
                        <td><p>:</p></td>
                        <td><p>{{ $letter->press_institution_director }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Anggota</p></td>
                        <td><p>:</p></td>
                        <td>
                            @if (count($letter->press_institution_members) <= 1)
                                @foreach ($letter->press_institution_members as $member)
                                    <p>{{ $member }}</p>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($letter->ress_institution_members as $member)
                                        <li><p>{{ $member }}</p></li>
                                    @endforeach
                                </ol>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="date">
                <table class="date-table">
                    <tr>
                        <td width="50%"></td>
                        <td width="88px"><p class="col-1">Ditetapkan di</p></td>
                        <td width="8px"><p class="bracket-pair">:</p></td>
                        <td width="128px"><p>Purwokerto</p></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><p class="col-1">Pada tanggal</p></td>
                        <td><p class="bracket-pair">:</p></td>
                        <td class="bordered-td" style="padding: 0">
                            <p style="width: 100%; font-weight: normal; padding: 0">
                                {{ $letter->formatted_generated_hijri_date }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <p style="width: 100%">{{ $letter->formatted_generated_georgia_date }}</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="signature">
                <p>
                    <strong>PIMPINAN CABANG</strong>
                    <br />
                    <strong>IKATAN PELAJAR PUTRI NAHDLATUL ULAMA</strong>
                    <br />
                    <strong>KABUPATEN BANYUMAS</strong>
                </p>
                <table class="signature-table">
                    <tr>
                        <td><p>Ketua,</p></td>
                        <td><p>Sekretaris,</p></td>
                    </tr>
                    <tr>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/chairman-ipp-signature.png') }}"
                                    class="chairman-signature-img"
                                    alt="Tanda Tangan Ketua"
                                />
                            </div>
                            <p><strong>YENI RAHMAWATI</strong></p>
                        </td>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/secretary-ipp-signaturree.png') }}"
                                    class="secretary-signature-img"
                                    alt="Tanda Tangan Sekretaris"
                                />
                            </div>
                            <p><strong>AINUN FAJRIYANI</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>NIA. 33.02.1706.0019</p></td>
                        <td><p>NIA. 33.02.2204.0026</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>