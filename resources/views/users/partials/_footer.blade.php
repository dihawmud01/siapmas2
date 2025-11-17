<div
    class="modal fade"
    id="staticBackdrop"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    {{ __('Media Pelajar NU Banyumas') }}
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="{{ __('Close') }}"
                ></button>
            </div>
            <div class="modal-body">
                {{ __('Berdasarkan Surat Keputusan Nomor.....') }}
                <br />
                <hr />

                {{
                    __('Tim IT PC IPNU IPPNU Banyumas adalah kelompok kader PC IPNU IPPNU Banyumas yang terdiri dari para
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    profesional berpengalaman, ahli TI, terampil dan berdedikasi dalam bidang teknologi informasi (TI). Kami
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    bertugas menyediakan, mengelola, dan mendukung sistem kaderisasi digital di lingkungan PC IPNU IPPNU
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Banyumas Komisariat.')
                }}
                <br />
                <br />

                {{
                    __('Tim IT PC IPNU IPPNU Banyumas memiliki fokus pada kualitas, keandalan, dan keamanan dalam setiap tugas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    yang kami jalankan. Kami menyadari pentingnya infrastruktur TI yang stabil dan efisien dalam mendukung
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    kegiatan kaderisasi di lingkungan PC IPNU IPPNU Banyumas.')
                }}
                <br />
                <br />

                {{
                    __('Komitmen kami adalah memberikan pelayanan yang ramah dan responsif kepada kader PC IPNU IPPNU Banyumas .
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Kami siap membantu kader dalam menjalani pengalaman kaderisasi digital yang lancar, aman, dan bermanfaat
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    di ruang lingkup PC IPNU IPPNU Banyumas Komisariat.')
                }}
                <br />
                <br />

                {{ __('Tim IT PC IPNU IPPNU Banyumas juga mengutamakan pergerakan dan menyampaikan') }}
                <br />

                <span>#salam_pergerakan</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Tutup') }}</button>
            </div>
        </div>
    </div>
</div>

<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>
                        {{ __('PC IPNU IPPNU') }}
                        <span>{{ __('BANYUMAS') }}</span>
                    </h3>
                    <p class="text-light" style="text-align: justify">
                        {{
__('IPNU (Ikatan Pelajar Nahdlatul Ulama) dan IPPNU (Ikatan Pelajar Putri Nahdlatul Ulama) adalah organisasi pelajar di bawah naungan Nahdlatul Ulama yang berperan dalam pengembangan intelektual, spiritual, dan sosial bagi generasi muda. Berkomitmen mencetak kader yang berakhlakul karimah, berilmu, dan berdaya saing, IPNU-IPPNU aktif dalam berbagai kegiatan pendidikan, dakwah, dan kepemimpinan.
                            ')
                        }}
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>{{ __('Useful Links') }}</h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a class="text-light text-decoration-none" href="{{ route('index') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a class="text-light text-decoration-none" href="{{ route('index') }}#about">
                                {{ __('About us') }}
                            </a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a class="text-light text-decoration-none" href="{{ route('calendar.index') }}">
                                {{ __('Agenda') }}
                            </a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a class="text-light text-decoration-none" href="{{ route('news') }}">{{ __('News') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>{{ __('Hubungi Kami') }}</h4>
                    <p class="text-light">
                        {{ __('Jl. Sultan Agung No. 42 Karangklesem, Purwokerto Selatan (53143)') }}
                        <br />
                        <strong>{{ __('Telepon:') }}</strong>
                        085726202097 (Fahmi)
                        <br />
                        0895360586296 (Yeni)
                        <br />
                        <strong>{{ __('Email:') }}</strong>
                        pelajarnubanyumas@gmail.com
                        <br />
                    </p>

                    <div class="social-links">
                        <a class="text-light" href="https://www.instagram.com/pcipnuippnubms/" class="twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a class="text-light" href="https://www.instagram.com/pcipnuippnubms/" class="facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a class="text-light" href="https://www.instagram.com/pcipnuippnubms/" class="instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a class="text-light" href="https://www.instagram.com/pcipnuippnubms/" class="linkedin">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!--<div class="col-lg-3 col-md-6 footer-newsletter">-->
                <!--    <h4>{{ __('Unduh Sekarang') }}</h4>-->
                <!--    <p class="text-light">-->
                <!--        {{ __('Unduh dan install aplikasi SIAPMAS di Play Store') }}-->
                <!--    </p>-->
                <!--    <a class="text-light" href="https://play.google.com/store/apps">-->
                <!--        <img-->
                <!--            style="width: 280px"-->
                <!--            src="{{ asset('assets/images/Google_Play_2022_logo.svg') }}"-->
                <!--            alt="logo playstore"-->
                <!--        />-->
                <!--    </a>-->
                <!--</div>-->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; {{ __('Copyright') }}
            <strong>{{ __('PC IPNU IPPNU BANYUMAS') }}</strong>
            . {{ __('All Rights Reserved') }}
        </div>
        <div class="credits">
            {{ __('Created by') }}
            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="author text-decoration-none">
                <strong>{{ __('Media Pelajar NU Banyumas') }}</strong>
            </a>
        </div>
    </div>
</footer>
