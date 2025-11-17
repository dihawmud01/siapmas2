@section('title')
    {{ __('Quote') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Quotes') }}</h4>

            <a class="btn btn-primary mx-3 mb-3" href="{{ route('quotes.create') }}">{{ __('Tambah') }}</a>

            <table class="table-striped table-hover table">
                <tr>
                    <td class="text-center">{{ __('No.') }}</td>
                    <td class="text-center">{{ __('Nama') }}</td>
                    <td class="text-start">{{ __('Tokoh/Jabatan') }}</td>
                    <td class="text-center">{{ __('Quotes') }}</td>
                    <td class="text-center">{{ __('Aksi') }}</td>
                </tr>
                @foreach ($quotes as $quote)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $quote->name }}</td>
                        <td>{{ $quote->who }}</td>
                        <td>{{ $quote->quote }}</td>
                        <td class="btn-group text-center">
                            <form action="">
                                <a
                                    href="{{ route('quotes.edit', ['id' => $quote->id]) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Edit') }}
                                </a>
                            </form>
                            <form action="{{ route('quotes.destroy', ['id' => $quote->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm pl-2"
                                    onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus quotes ini?') }}')"
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
@endsection
