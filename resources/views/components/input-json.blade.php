@if ($layout === 'vertical')
    <div
        class="mb-3"
        x-data="{
            inputs: {{ empty($values) ? json_encode(['']) : json_encode($values) }},
            maxCount: {{ $count }},
        }"
    >
        <label class="form-label fw-semibold">{{ $label }}</label>

        <div class="d-flex flex-column gap-2">
            <template x-for="(input, idx) in inputs" :key="idx">
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control @error($name) is-invalid @enderror sp-input rounded-start"
                        name="{{ $name }}[]"
                        x-model="inputs[idx]"
                        required
                    />
                    <button
                        type="button"
                        class="btn btn-danger rounded-end"
                        @click="inputs.splice(idx, 1)"
                        x-show="idx > 0"
                    >
                        <i class="bi bi-dash"></i>
                    </button>
                </div>
            </template>

            <div>
                <button
                    type="button"
                    class="btn btn-sm btn-success"
                    @click="if (inputs.length < maxCount) inputs.push('')"
                    :disabled="inputs.length >= maxCount"
                >
                    <i class="bi bi-person-plus-fill"></i>
                    {{ __('Tambah') }}
                </button>
            </div>
        </div>
    </div>
@else
    <div
        class="row mb-4"
        x-data="{
            inputs: {{ empty($values) ? json_encode(['']) : json_encode($values) }},
            maxCount: {{ $count }},
        }"
    >
        <div class="col-12 col-md-3">
            <label class="form-label">{{ $label }}</label>
        </div>

        <div class="col-12 col-md-9">
            <template x-for="(input, idx) in inputs" :key="idx">
                <div class="input-group mb-2">
                    <input
                        type="text"
                        class="form-control @error($name) is-invalid @enderror sp-input rounded-start"
                        name="{{ $name }}[]"
                        x-model="inputs[idx]"
                        required
                    />
                    <button
                        type="button"
                        class="btn btn-danger rounded-end"
                        @click="inputs.splice(idx, 1)"
                        x-show="idx > 0"
                    >
                        <i class="bi bi-dash"></i>
                    </button>
                </div>
            </template>

            <button
                type="button"
                class="btn btn-sm btn-success mt-2"
                @click="if (inputs.length < maxCount) inputs.push('')"
                :disabled="inputs.length >= maxCount"
            >
                <i class="bi bi-person-plus-fill"></i>
                {{ __('Tambah') }}
            </button>
        </div>
    </div>
@endif
