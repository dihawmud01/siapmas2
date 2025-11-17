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

            .header,
            .footer {
                position: fixed;
                right: 0;
                left: 0;
            }

            .header {
                top: -4cm;
                width: 100%;
                text-align: center;
            }

            .footer {
                bottom: -1.5cm;
                width: 40%;
                text-align: left;
            }

            .header img,
            .footer img {
                max-width: 100%;
                height: auto;
            }

            body {
                margin: 0;
                font-size: 11pt;
                line-height: 1.15;
                font-family: 'Arial Narrow', Arial, sans-serif;
                text-align: justify;
            }


            .main-title {
                display: inline-block;
                position: relative;
                font-weight: bold;
                font-size: 11pt;
                text-align: center;
                text-transform: uppercase;
            }

            .main-title::after {
                display: none;
                margin: 5px auto;
                border-top: 2px solid #1e1e1e;
                width: auto;
                content: '';
            }

            .letter-number {
                margin-bottom: 15px;
                font-size: 11pt;
                text-align: center;
            }

            .about {
                text-align: center;
            }

            p {
                margin: 0;
            }

            .secondary-title {
                position: relative;
                align-items: center;
                /*border-bottom: 2px solid #1e1e1e;*/
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
                font-style: italic;
            }

            .attachment-subtitle {
                margin-top: 8px;
            }

            .attachment-content {
                margin-top: 12px;
            }

            .decision {
                font-weight: bold;
                font-size: 11pt;
                text-align: center;
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

            .chairman-signature-img {
                display: block;
                opacity: 0.9;
                margin: -33px auto -28px 0;
                height: auto;
                max-height: 60px;
        }

            .secretary-signature-img {
                display: block;
                opacity: 0.9;
                margin: -53px auto -28px -88px;
                height: 150px;
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
    </head>

    <body>
        <div class="header">
            <img src="{{ asset('assets/images/sp/ipnu/header.png') }}" alt="Header" />
        </div>

        <div style="text-align: center">
            <div class="main-title">SURAT PENGESAHAN PC IPNU</div>
            <div class="letter-number">Nomor: {{ $letter->letter_number }}</div>
        </div>

        <div class="about">Tentang</div>
        <div class="secondary-title" style="padding-bottom: 4px">
            SUSUNAN PENGURUS
            <br />
            PIMPINAN ANAK CABANG
            <br />
            IKATAN PELAJAR NAHDLATUL ULAMA {{ $pac }}
            <br />
            MASA KHIDMAT {{ $letter->start_period . '-' . $letter->end_period }}
        </div>
        <div class="secondary-title" style="margin: 5px auto"></div>

        <div class="content">
            <p class="latin-arabic">Bismillahirrahmanirrahim</p>
            <p>Pimpinan Cabang Ikatan Pelajar Nahdlatul Ulama Kabupaten Banyumas setelah:</p>

            <table class="content-table">
                <tr>
                    <td><p class="section-title">Menimbang</p></td>
                    <td><p>:</p></td>
                    <td class="section-content">
                        <div>
                            <ol>
                                <li>
                                    Ikatan Pelajar Nahdlatul Ulama sebagai organisasi kader yang terus mengalami
                                    peningkatan dan perkembangan baik secara organisatoris maupun program yang
                                    dicanangkan, maka perlu terus dilakukan pembaharuan dan regenerasi pengurus melalui
                                    pergantian pengurus secara periodik;
                                </li>
                                <li>
                                    Dalam upaya menjalankan kepengurusan untuk semua tingkatan maka diperlukan adanya
                                    kesiapan dan kecakapan pengurus dalam rangka mengantisipasi setiap perubahan dan
                                    perkembangan menuju tercapainya misi dan tujuan organisasi;
                                </li>
                                <li>
                                    Bahwa untuk menjalankan kepengurusan PAC IPNU
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }}, maka
                                    perlu menerbitkan Surat Pengesahan ini.
                                </li>
                            </ol>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><p class="section-title">Mengingat</p></td>
                    <td><p>:</p></td>
                    <td class="section-content">
                        <div>
                            <ol>
                                <li>Peraturan Dasar (PD) IPNU BAB I Pasal 1, BAB VII Pasal 12, BAB VIII Pasal 16;</li>
                                <li>Peraturan Rumah Tangga (PRT) IPNU Bab IX Pasal 20, Ayat 4;</li>
                                <li>Peraturan Organisasi IPNU Bab IV Pasal 8.</li>
                            </ol>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><p class="section-title">Memperhatikan</p></td>
                    <td><p>:</p></td>
                    <td class="section-content">
                        <div>
                            <ol>
                                <li>
                                    Konferensi Anak Cabang IPNU
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }}
                                    tanggal {{ $letter->formatted_event_date_without_day }};
                                </li>
                                <li>
                                    Surat Rekomendasi MWC NU
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }} Nomor:
                                    {{ $letter->mwc_letter_number }} tanggal
                                    {{ $letter->formatted_event_date_without_day }};
                                </li>
                                <li>Berita Acara Pemilihan Ketua dan Tim Formatur.</li>
                            </ol>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="decision">M E M U T U S K A N</div>

            <table class="content-table">
                <tr>
                    <td><p class="section-title">Menetapkan</p></td>
                    <td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p></td>
                    <td class="section-content">
                        <div>
                            <ol>
                                <li>
                                    Mengesahkan susunan Pimpinan Anak Cabang Ikatan Pelajar Nahdlatul Ulama
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }}, Masa
                                    Khidmat {{ $letter->start_period . '-' . $letter->end_period }} sebagaimana
                                    terlampir;
                                </li>
                                <li>
                                    Menugaskan kepada semua pengurus Pimpinan Anak Cabang Ikatan Pelajar Nahdlatul Ulama
                                    {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }} untuk
                                    melaksanakan amanat organisasi, sesuai hasil keputusan konferensi dan peraturan yang
                                    ada;
                                </li>
                                <li>
                                    Surat Pengesahan ini berlaku mulai tanggal ditetapkan sampai dengan tanggal
                                    {{ $letter->formatted_expired_date }} dan apabila terdapat kekeliruan di kemudian
                                    hari akan ditinjau kembali.
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
                    <strong>IKATAN PELAJAR NAHDLATUL ULAMA</strong>
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
                                    src="{{ asset('assets/images/sp/signatures/chairman-signature.png') }}"
                                    class="chairman-signature-img"
                                    alt="Tanda Tangan Ketua"
                                />
                            </div>
                            <p><strong>FAHMI ABDURRAHMAN</strong></p>
                        </td>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/secretary-signature.png') }}"
                                    class="secretary-signature-img"
                                    alt="Tanda Tangan Sekretaris"
                                />
                            </div>
                            <p><strong>AKHMAD AINUN NAJIB</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>NIA. 11.20.99.00002</p></td>
                        <td><p>NIA. 11.20.99.00032</p></td>
                    </tr>
                </table>
            </div>

            <p>Ditembuskan kepada</p>
            <ol>
                <li>Yth. Pengurus Cabang NU Kabupaten Banyumas;</li>
                <li>
                    Yth. Pengurus MWC NU {{ str_replace(['Uin', 'Unu'], ['UIN', 'UNU'], ucwords(strtolower($pac))) }};
                </li>
                <li>Arsip</li>
            </ol>
        </div>

        <div class="footer">
            <img src="{{ asset('assets/images/sp/ipnu/footer.jpeg') }}" alt="Footer" />
        </div>

        <div class="attachment">
            <p class="attachment-title">
                Lampiran Surat Pengesahan
                <br />
                Pimpinan Cabang Ikatan Pelajar Nahdlatul Ulama Kabupaten Banyumas
                <br />
                Nomor: {{ $letter->letter_number }}
            </p>
            <div class="secondary-title" style="padding-bottom: 4px">
                SUSUNAN PENGURUS
                <br />
                PIMPINAN ANAK CABANG
                <br/>
                IKATAN PELAJAR NAHDLATUL ULAMA {{ $pac }}
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
                            <br/>
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
                            <br/>
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
                            <br/>
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
                            <br/>
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
                            <br/>
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
                            <br/>
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
                            <br/>
                            <p class="attachment-subtitle"><strong>LEMBAGA-LEMBAGA</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="position"><strong>A. Lembaga Ekonomi dan Kewirausahaan</strong></p>
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
                            <br/>
                            <p class="position"><strong>B. Lembaga Pers dan Penerbitan</strong></p>
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
                    <tr>
                        <td>
                            <br/>
                            <p class="position">
                                <strong>
                                    C. Lembaga Corps Brigade Pembangunan
                                    <br />
                                    DEWAN KOORDINASI ANAK CABANG (DKAC)
                                </strong>
                            </p>
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
                    <strong>IKATAN PELAJAR NAHDLATUL ULAMA</strong>
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
                                    src="{{ asset('assets/images/sp/signatures/chairman-signature.png') }}"
                                    class="chairman-signature-img"
                                    alt="Tanda Tangan Ketua"
                                />
                            </div>
                            <p><strong>FAHMI ABDURRAHMAN</strong></p>
                        </td>
                        <td class="bordered-td">
                            <div class="signature-space">
                                <img
                                    src="{{ asset('assets/images/sp/signatures/secretary-signature.png') }}"
                                    class="secretary-signature-img"
                                    alt="Tanda Tangan Sekretaris"
                                />
                            </div>
                            <p><strong>AKHMAD AINUN NAJIB</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>NIA. 11.20.99.00002</p></td>
                        <td><p>NIA. 11.20.99.00032</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>