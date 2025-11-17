<div>
    @if (count($values))
        <div class="d-flex justify-content-between flex-column flex-sm-row align-items-center mb-4">
            <h4 class="fw-bold text-success mb-0 py-3">
                @foreach ($values as $value)
                    @if ($loop->last)
                        {{ $value }}
                    @else
                        <span class="text-muted fw-light">{{ $value }} /</span>
                    @endif
                @endforeach
            </h4>
            <div class="py-3">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
