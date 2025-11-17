@section('title')
    {{ __('Profil') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container-fluid px-0 mt-4" style="padding-top: 5rem">
        <header class="pt-3 pb-5 bg-white profile-header">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-start">
                    <img src="{{ asset($user['photo'] != 'default.png' 
                                        ? 'storage/images/user/photos/' . $user['id'] . '/' . $user['photo'] 
                                        : 'storage/images/default.png') }}" 
                         class="rounded-circle mr-4 profile-image-desktop"
                         style="width: 140px; height: 140px; object-fit: cover;">
                    <div class="d-flex flex-column">
                        <h3 class="h4 font-weight-bold">
                            {{ $profile->username }}
                            @if($profile->check == '1')
                                <i class="bi bi-check text-success"></i>
                            @endif
                        </h3>
                        <div class="d-flex align-items-center mb-2">
                            <span class="mr-4"><strong>{{ $postCounts }}</strong> {{ __('Postingan') }}</span>
                        </div>
                        <p>{{ $profile->bio }}</p>
                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('account') }}" class="btn btn-dark sm me-2">{{ __('Edit Profil') }}</a>
                            <!--@auth-->
                            <!--    @if (in_array(auth()->user()->role_id, [1, 2, 3]))-->
                            <!--        <a href="{{ route('uploads') }}" class="btn btn-dark sm me-2">{{ __('Unggahan') }}</a>-->
                            <!--    @endif-->
                            <!--@endauth-->
                            <!--<a href="{{ route('download.kta', ['id' => $profile->id]) }}" class="btn btn-dark sm">{{ __('KTA') }}</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <br>
@endsection
