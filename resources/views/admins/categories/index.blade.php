@section('title')
    {{ __('Kategori') }}
@endsection

@extends('admins.layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Daftar Kategori') }}</h3>
                        </div>

                        <div class="card-body">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
                                {{ __('Tambah') }}
                            </a>
                            @if (count($categories))
                                <div class="table-responsive">
                                    <table class="table-bordered table-hover text-nowrap table">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>{{ __('Judul') }}</th>
                                            <th>{{ __('Aksi') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>
                                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                                    class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pen-fill"></i>
                                                    </a>

                                                    <form action="{{ route('categories.destroy', $category->id) }}" 
                                                        method="POST" 
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah kamu yakin ingin menghapus kategori?')">
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
                                <p>{{ __('Belum Ada Kategori') }}</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
