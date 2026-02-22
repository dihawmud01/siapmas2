@push("script")
    @vite("resources/js/plugins/filepond.js")
@endpush

@if ($layout === "vertical")
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>

        <input
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $type != "file" ? old($name, $value) : "" }}"
            @if ($type == "file")
                accept="{{ $accept }}"
            @endif
            @if ($type == "number")
                min="{{ $min }}"
                max="{{ $max }}"
            @endif
            {{ $required ? "required" : "" }}
        />

        @if ($type == "file")
            <small class="text-muted d-block mt-1">
                {{ __("Maks. 2 MB | Format") }}

                @switch($accept)
                    @case("application/pdf")
                        <span>.pdf</span>

                        @break
                    @case("image/jpeg,image/png")
                        <span>.jpg, .jpeg, .png</span>

                        @break
                    @case("application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                        <span>.docx</span>

                        @break
                @endswitch
            </small>
        @endif

        @error($name)
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@else
    <div class="row mb-4">
        <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-md-8">
            <input
                type="{{ $type }}"
                class="form-control @error($name) is-invalid @enderror"
                name="{{ $name }}"
                id="{{ $name }}"
                placeholder="{{ $placeholder }}"
                value="{{ $type != "file" ? old($name, $value) : "" }}"
                @if ($type == "file")
                    accept="{{ $accept }}"
                @endif
                @if ($type == "number")
                    min="{{ $min }}"
                    max="{{ $max }}"
                @endif
                {{ $required ? "required" : "" }}
            />

            @if ($type == "file")
                <small class="text-muted d-block mt-1">
                    {{ __("Maks. 2 MB | Format") }}

                    @switch($accept)
                        @case("application/pdf")
                            <span>.pdf</span>

                            @break
                        @case("image/jpeg,image/png")
                            <span>.jpg, .jpeg, .png</span>

                            @break
                        @case("application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                            <span>.docx</span>

                            @break
                    @endswitch
                </small>
            @endif

            @error($name)
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endif
