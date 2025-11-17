<div class="mb-4 row">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">
        {{ $label }}
    </label>

    <div class="col-md-8">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror"
            rows="{{ $rows }}"
        >{{ $value }}</textarea>

        @error($name)
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
