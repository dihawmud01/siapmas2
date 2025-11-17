<div class="mb-4 row">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">
        {{ $label }}
        @if ($required) <span class="text-danger">*</span> @endif
    </label>

    <div class="col-md-8">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-select @error($name) is-invalid @enderror"
            {{ $required ? 'required' : '' }}
        >
            <option value="" disabled selected>{{ __('-- Pilih --') }}</option>
            @foreach ($options as $value => $optionLabel)
                <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        @error($name)
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
