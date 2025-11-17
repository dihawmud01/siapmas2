@section('title')
    {{ __('Tag') }}
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
                                    <h3 class="card-title">{{ __('Buat Tag') }}</h3>
                                </div>

                                <form role="form" method="POST" action="{{ route('tags.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        @include('admins.tags.form')
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
