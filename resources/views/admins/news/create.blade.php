@section('title')
    {{ __('Postingan') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Buat Postingan') }}</h3>
                                </div>

                                <form
                                    role="form"
                                    method="POST"
                                    action="{{ route('news.store') }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    <div class="card-body">
                                        @include('admins.news.form')
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

<!-- Menambahkan CKEditor dari CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<!-- Inisialisasi CKEditor untuk textarea dengan id "content" -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
