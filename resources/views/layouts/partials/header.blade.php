<div class="nav-container">
    <a id="top"></a>
    <nav class="absolute transparent">
        <div class="nav-bar">
            <div class="module left">
                <a href="{{ route('landing-page') }}">
                    @if(setting('site_logo_light'))
                    <img class="logo logo-light" alt="{{ setting('site_name', 'Logo') }}" src="{{ asset(setting('site_logo_light')) }}" />
                    @else
                    <img class="logo logo-light" alt="Logo" src="{{ asset('img/logo-light.png') }}" />
                    @endif

                    @if(setting('site_logo_dark'))
                    <img class="logo logo-dark" alt="{{ setting('site_name', 'Logo') }}" src="{{ asset(setting('site_logo_dark')) }}" />
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
                        @if(setting('menu_items'))
                            @foreach(setting('menu_items') as $item)
                            <li>
                                <a href="{{ $item['url'] ?? '#' }}">{{ $item['text'] ?? 'Menu Item' }}</a>
                            </li>
                            @endforeach
                        @endif

                        @guest
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
