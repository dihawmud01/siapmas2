@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('assets/images/logokomi.png') }}" class="logo" alt="{{ __('Logo') }}">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
