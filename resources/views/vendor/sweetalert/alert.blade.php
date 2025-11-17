@if (config('sweetalert.alwaysLoadJS') === true && config('sweetalert.neverLoadJS') === false )
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
@endif
@if (Session::has('alert.config'))
    @if(config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
    @endif
    <script>
        let swalConfig = {!! Session::pull('alert.config') !!};

        swalConfig.willOpen = () => {
            document.querySelectorAll('.filepond--root').forEach(el => el.style.display = 'none');
        };
        swalConfig.didClose = () => {
            document.querySelectorAll('.filepond--root').forEach(el => el.style.display = '');
        };

        Swal.fire(swalConfig);
    </script>
@endif
