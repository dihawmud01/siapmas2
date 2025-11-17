@section('title')
    {{ __('Tag') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Daftar Tag') }}</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">
                                        {{ __('Tambah') }}
                                    </a>
                                    @if (count($tags))
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
                                                    @foreach ($tags as $tag)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $tag->title }}</td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('tags.destroy', $tag->id) }}"
                                                                    method="POST"
                                                                    class="float-left"
                                                                >
                                                                    <a
                                                                        href="{{ route('tags.edit', $tag->id) }}"
                                                                        class="btn btn-warning btn-sm float-left mr-1"
                                                                    >
                                                                        <i class="ri-edit-box-fill"></i>
                                                                    </a>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button
                                                                        type="submit"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('{{ __('Apakah Anda benar-benar ingin menghapus tag?') }}')"
                                                                    >
                                                                        <i class="ri-delete-bin-2-line"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>{{ __('Belum ada tag...') }}</p>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    {!! $tags->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Show alert if error --}}
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menghapus',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#28a745'
        });
    });
</script>
@endif
