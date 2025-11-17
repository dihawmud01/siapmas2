<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title">{{ __('Judul') }}</label>
    <input
        type="text"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        id="title"
        placeholder="{{ __('Judul') }}"
        @if(isset($category->title))value="{{ $category->title }}"@endif
    />
    @if ($errors->has('title'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
