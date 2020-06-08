<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('/img/favicon.png') }}" type="image/x-icon"/>


    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! cache('translations') !!};
        window._config = {!! json_encode(config('site')) !!};
        window._currency = '$';
    </script>
    @stack('scripts')
</head>

<body class="sb-nav-fixed {{ App::isLocale('ar') ? 'rtl' : '' }}">
    <div id="app">
        @if(Route::current()->getName() !== 'login')
        <x-navbar />
        <div id="layoutSidenav">

            <x-sidenav />

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="my-4">@yield('title')</h1>
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">{{ __('app.title') }} 2020</div>
                            {{-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> --}}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @else
            @yield('content')
        @endif
    </div>
</body>

</html>
