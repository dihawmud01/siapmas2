@section('title')
    {{ __('Edit Kategori') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="my-3 text-center">{{ __('Edit Kategori News') }}</h4>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Kategori') }} "{{ $category->title }}"</h3>
                                </div>

                                <form
                                    role="form"
                                    method="post"
                                    action="{{ route('categories.update', $category->id) }}"
                                >
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        @include('admins.categories.form')
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
