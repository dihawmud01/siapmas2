@section('title')
    {{ __('Agenda') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="mb-2 mt-5 text-center">{{ __('Edit Agenda') }}</h4>
            <div class="row">
                <div class="col-lg-8">
                    <form
                        action="{{ route('admin.calendar.update', ['id' => $event->id]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Kegiatan') }}</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="organizer" class="form-label">{{ __('Penyelenggara') }}</label>
                            <select name="organizer" class="form-select" required aria-label="organizer">
                                <option disabled selected>{{ __('-- Pilih --') }}</option>

                                @foreach ($organizers as $organizer)
                                    <option
                                        value="{{ $organizer }}"
                                        {{ $event->organizer == $organizer ? 'selected' : '' }}
                                    >
                                        {{ $organizer }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">{{ __('Waktu') }}</label>
                            <input type="datetime-local" name="date" class="form-control mb-3" id="date" value="{{ old('date', $event->formatted_date) }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="place" class="form-label">{{ __('Tempat') }}</label>
                            <input
                                type="text"
                                name="place"
                                class="form-control mb-3"
                                id="place"
                                required
                                value="{{ $event->place }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('Kategori') }}</label>
                            <select name="category" class="form-select" required aria-label="category">
                                <option disabled selected>{{ __('-- Pilih --') }}</option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category }}"
                                        {{ $event->category == $category ? 'selected' : '' }}
                                    >
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pamphlet" class="form-label">{{ __('Pamflet Kegiatan') }}</label>
                            <input
                                type="file"
                                name="pamphlet"
                                class="form-control mb-3"
                                id="pamhlet"
                                value="{{ $event->pamphlet }}"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="numOfParticipants" class="form-label">
                                {{ __('Jumlah Peserta Kegiatan') }}
                            </label>
                            <input
                                type="number"
                                name="total_participants"
                                class="form-control mb-3"
                                id="totalParticipants"
                                value="{{ $event->total_participants }}"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="target" class="form-label">{{ __('Target Capaian') }}</label>
                            <input
                                type="text"
                                name="target"
                                class="form-control mb-3"
                                id="target"
                                value="{{ $event->target }}"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="evaluation" class="form-label">{{ __('Evaluasi Kegiatan') }}</label>
                            <textarea name="evaluation" class="form-control" id="evaluation" rows="4" required>
        {{ $event->evaluation }}
    </textarea
                            >
                        </div>

                        <label for="status" class="form-label m-3">{{ __('Status Kegiatan') }}</label>
                        <div class="form-check form-switch mb-4">
                            <input
                                class="form-check-input"
                                name="status"
                                value="{{ $event->status }}"
                                type="checkbox"
                                role="switch"
                                id="flexSwitchCheckChecked"
                            />
                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                {{ __('Belum Terlaksana/Terlaksana') }}
                            </label>
                        </div>

                        <div class="mb-3">
                            <a href="{{ route('admin.calendar.index') }}" class="btn btn-warning btn-sm">
                                {{ __('Kembali') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
                <!--<div class="col-lg-4">-->
                <!--    <div class="text-center">-->
                <!--        <img-->
                <!--            class="pt-4"-->
                <!--            src="{{ asset('storage/images/' . $event->img) }}"-->
                <!--            alt="{{ __('Pamflet') }}"-->
                <!--            style="width: 300px; height: 300px; object-fit: contain"-->
                <!--        />-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
@endsection
