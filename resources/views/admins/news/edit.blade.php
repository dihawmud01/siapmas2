@section('title')
    {{ __('Postingan') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Berita'))
@section('path', __('Edit'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card info-card sales-card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold fs-5 mb-3">{{ __('Edit Postingan') }}: "{{ $news->title }}"</h5>

                    <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            @include('admins.news.form')
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
            </div>
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
