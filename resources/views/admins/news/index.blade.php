@section('title')
    {{ __('Postingan') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right"></ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Daftar Postingan') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('Tambah') }}
                                    </a>
                                </div>
                                @if (count($news))
                                    <div class="table-responsive">
                                        <table class="table-bordered table-hover text-nowrap table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px">#</th>
                                                    <th>{{ __('Judul') }}</th>
                                                    <th>{{ __('Kategori') }}</th>
                                                    <th>{{ __('Penulis') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Aksi') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($news as $index => $post)
                                                <tr>
                                                    <td>{{ $news->firstItem() + $index }}</td>
                                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                                    <td>{{ $post->category->title }}</td>
                                                    <td>{{ $post->user->username }}</td>
                                                    <td>
                                                        @if ($post->active == 1)
                                                            <span class="badge bg-success">
                                                                {{ __('Aktif') }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                {{ __('Nonaktif ') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('news.destroy', ['id' => $post->id]) }}" method="post" class="float-left">
                                                            <a href="{{ route('news.show', ['slug' => $post->slug]) }}" class="btn btn-success btn-sm" target="_blank">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                            <a href="{{ route('news.edit', ['id' => $post->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="bi bi-pen-fill"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus postingan?') }}')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>{{ __('Belum ada postingan...') }}</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                {!! $news->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
