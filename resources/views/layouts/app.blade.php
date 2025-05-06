<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ setting('site_name', 'Laravel Admin Project') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ setting('site_description', '') }}">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/flexslider.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/ytplayer.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/theme-startup.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" media="all" />

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400%7CRaleway:100,400,300,500,600,700%7COpen+Sans:400,500,600' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,600,700" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/font-roboto.css') }}" rel="stylesheet" type="text/css">

        <!-- Favicon -->
        @if(setting('site_favicon'))
        <link rel="icon" href="{{ asset(setting('site_favicon')) }}" type="image/x-icon">
        @endif
    </head>
    <body class="btn-rounded scroll-assist">
        @include('layouts.partials.header')

        <div class="main-container">
            @yield('content')

            @include('layouts.partials.footer')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/flickr.js') }}"></script>
        <script src="{{ asset('js/flexslider.min.js') }}"></script>
        <script src="{{ asset('js/lightbox.min.js') }}"></script>
        <script src="{{ asset('js/masonry.min.js') }}"></script>
        <script src="{{ asset('js/twitterfetcher.min.js') }}"></script>
        <script src="{{ asset('js/spectragram.min.js') }}"></script>
        <script src="{{ asset('js/ytplayer.min.js') }}"></script>
        <script src="{{ asset('js/countdown.min.js') }}"></script>
        <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('js/parallax.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/parallax-init.js') }}"></script>

        <!-- Additional Scripts -->
        @stack('scripts')
    </body>
</html>
