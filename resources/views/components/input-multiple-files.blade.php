@push('script')
    @vite('resources/js/plugins/filepond.js')
@endpush

<div class="mb-4 row">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="col-md-8">
        <input
            type="file"
            class="form-control @error($name) is-invalid @enderror"
            name="{{ $name }}[]"
            id="{{ $name }}"
            accept="{{ $accept }}"
            multiple
            {{ $required ? 'required' : '' }}
        />
        <small class="text-muted d-block mt-1">
            {{ __('Maks. 2 MB tiap file | Format ') }}
            @if ($accept == 'application/pdf')
                .pdf
            @else
                .docx, .jpg, .jpeg, atau .png
            @endif
        </small>

        @error($name)
            <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
        @enderror
    </div>
</div>
