<div class="mb-3">
    <label for="title" class="form-label fw-semibold">{{ __('Judul') }}</label>
    <input
        type="text"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        id="title"
        placeholder="Masukkan Judul"
        value="{{ old('title', $news->title ?? '') }}"
    />
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="content" class="form-label fw-semibold">{{ __('Konten') }}</label>
    <!-- Ganti textarea dengan CKEditor -->
    <textarea
        name="content"
        class="form-control @error('content') is-invalid @enderror"
        id="content"
        rows="7"
        placeholder="Tulis konten di sini..."
    >
        {{ old('content', $news->content ?? '') }}
    </textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label fw-semibold">{{ __('Kategori') }}</label>
    <select
        class="@error('category_id') is-invalid @enderror form-select"
        id="category_id"
        name="category_id"
    >
        @foreach ($categories as $key => $value)
            <option value="{{ $key }}" {{ isset($news) && $key == $news->category_id ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">{{ __('Tag') }}</label>
    <div class="row">
        @foreach ($tags as $key => $value)
            <div class="col-md-3">
                <div class="form-check">
                    <input
                        name="tags[]"
                        class="form-check-input"
                        type="checkbox"
                        value="{{ $key }}"
                        id="tag{{ $key }}"
                        {{ isset($news) && in_array($key, $news->tags->pluck('id')->all()) ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="tag{{ $key }}">{{ $value }}</label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">{{ __('Gambar') }}</label>
    <input
        type="file"
        name="img"
        class="form-control @error('img') is-invalid @enderror"
        id="img"
    />
    @error('img')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if (isset($news) && $news->img !== null)
        <div class="mt-3">
            <img
                id="previewImg"
                src="{{ asset('storage/images/' . $news->img) }}"
                class="img-thumbnail"
                height="150"
                width="150"
                alt="Preview Image"
            />
        </div>
    @endif
</div>

@auth
    @if (in_array(auth()->user()->role_id, [1, 2]))
        <div class="mb-3">
            <label class="form-label fw-semibold">{{ __('Aktif: *') }}</label>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="active"
                        id="activeYes"
                        value="1"
                        {{ old('active', isset($news) ? $news->active : '') == 1 ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="activeYes">{{ __('Iya') }}</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="active"
                        id="activeNo"
                        value="0"
                        {{ old('active', $news->active ?? 0) == 0 ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="activeNo">{{ __('Tidak') }}</label>
                </div>
            </div>
        </div>
    @endif
@endauth
