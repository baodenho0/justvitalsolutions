<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $settings['site_title'] ?? 'Laravel Admin Project' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $settings['site_description'] ?? '' }}">

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
        @if(isset($settings['site_favicon']))
        <link rel="icon" href="{{ asset( $settings['site_favicon']) }}" type="image/x-icon">
        @endif
    </head>
    <body class="btn-rounded scroll-assist">
        <div class="nav-container">
            <a id="top"></a>
            <nav class="absolute transparent">
                <div class="nav-bar">
                    <div class="module left">
                        <a href="{{ route('landing-page') }}">
                            @if(isset($settings['site_logo_light']))
                            <img class="logo logo-light" alt="{{ $settings['site_title'] ?? 'Logo' }}" src="{{ asset( $settings['site_logo_light']) }}" />
                            @else
                            <img class="logo logo-light" alt="Logo" src="{{ asset('img/logo-light.png') }}" />
                            @endif

                            @if(isset($settings['site_logo_dark']))
                            <img class="logo logo-dark" alt="{{ $settings['site_title'] ?? 'Logo' }}" src="{{ asset( $settings['site_logo_dark']) }}" />
                            @else
                            <img class="logo logo-dark" alt="Logo" src="{{ asset('img/logo-dark.png') }}" />
                            @endif
                        </a>
                    </div>
                    <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="module-group right">
                        <div class="module left">
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('landing-page') }}">Home</a>
                                </li>
                                @if(isset($settings['menu_items']) && is_array($settings['menu_items']))
                                    @foreach($settings['menu_items'] as $item)
                                    <li>
                                        <a href="{{ $item['url'] ?? '#' }}">{{ $item['text'] ?? 'Menu Item' }}</a>
                                    </li>
                                    @endforeach
                                @endif
                                <li>
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main-container">
            @foreach($sections as $section)
                @include('sections.' . $section->section_type, ['section' => $section])
            @endforeach
            
            <footer class="footer-2 bg-dark text-center-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{ route('landing-page') }}">
                                @if(isset($settings['site_logo_light']))
                                <img class="image-xxs" alt="{{ $settings['site_title'] ?? 'Logo' }}" src="{{ asset( $settings['site_logo_light']) }}" />
                                @else
                                <img class="image-xxs" alt="Logo" src="{{ asset('img/logo-light.png') }}" />
                                @endif
                            </a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <span class="fade-half">
                                {{ $settings['footer_text'] ?? '© ' . date('Y') . ' All Rights Reserved' }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-right text-center-xs">
                            <ul class="list-inline social-list">
                                @if(isset($settings['social_facebook']))
                                <li><a href="{{ $settings['social_facebook'] }}"><i class="ti-facebook"></i></a></li>
                                @endif
                                @if(isset($settings['social_twitter']))
                                <li><a href="{{ $settings['social_twitter'] }}"><i class="ti-twitter-alt"></i></a></li>
                                @endif
                                @if(isset($settings['social_instagram']))
                                <li><a href="{{ $settings['social_instagram'] }}"><i class="ti-instagram"></i></a></li>
                                @endif
                                @if(isset($settings['social_linkedin']))
                                <li><a href="{{ $settings['social_linkedin'] }}"><i class="ti-linkedin"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
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
    </body>
</html>
