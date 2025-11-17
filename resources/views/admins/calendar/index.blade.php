@section('title')
    {{ __('Agenda') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">{{ __('Agenda Kegiatan') }}</h2>
            <div class="mb-3">
                <a href="{{ route('admin.calendar.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Tambah Agenda') }}
                </a>
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <td class="text-center">{{ __('No') }}</td>
                        <td class="text-center">{{ __('Nama Kegiatan') }}</td>
                        <td class="text-center">{{ __('Penyelenggara') }}</td>
                        <td class="text-center">{{ __('Waktu') }}</td>
                        <td class="text-center">{{ __('Status') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                    </tr>
                    @foreach ($events as $event)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $event['title'] }}</td>
                            <td>{{ $event['organizer'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($event['date'])->locale('id')->translatedFormat('l, d F Y H:i') }}</td>
                            <td class="text-center">
                                @if ($event->status == false)
                                    <button class="btn btn-danger btn-sm">{{ __('Belum Terlaksana') }}</button>
                                @else
                                    <button class="btn btn-success btn-sm">{{ __('Terlaksana') }}</button>
                                @endif
                            </td>
                            <td class="text-center">
                                <form
                                    action="{{ route('admin.calendar.destroy', ['id' => $event->id]) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <a
                                        href="{{ route('admin.calendar.edit', ['id' => $event->id]) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        {{ __('Update') }}
                                    </a>
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus agenda ini?') }}')"
                                    >
                                        {{ __('Hapus') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
