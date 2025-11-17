@section('title')
    {{ __('Kontak') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container my-1 pt-4">
        <div class="row pt-4">
            <section id="contact">
                <div class="container" data-aos="fade-up">
                    <div class="section-header">
                        <h3>{{ __('Kotak Aspirasi') }}</h3>
                        <p>{{ __('Kritik saran dan masukan akan sangat berharga bagi kami') }}</p>
                    </div>

                    <div class="form">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        id="name"
                                        placeholder="{{ __('Nama Anda') }}"
                                        required
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        id="email"
                                        placeholder="{{ __('Email Anda') }}"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="subject"
                                    id="subject"
                                    placeholder="{{ __('Subjek') }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <textarea
                                    class="form-control"
                                    name="message"
                                    rows="5"
                                    placeholder="{{ __('Pesan') }}"
                                    required
                                ></textarea>
                            </div>
                            <div class="my-3"></div>
                            <div class="text-center">
                                <button class="btn btn-success text-center" type="submit">
                                    {{ __('Kirim Pesan') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
