<footer class="footer-2 bg-dark text-center-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ route('landing-page') }}">
                    @if(setting('site_logo_light'))
                    <img class="image-xxs" alt="{{ setting('site_name', 'Logo') }}" src="{{ asset(setting('site_logo_light')) }}" />
                    @else
                    <img class="image-xxs" alt="Logo" src="{{ asset('img/logo-light.png') }}" />
                    @endif
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <span class="fade-half">
                    {{ setting('footer_text', '© ' . date('Y') . ' All Rights Reserved') }}
                </span>
            </div>
            <div class="col-sm-4 text-right text-center-xs">
                <ul class="list-inline social-list">
                    @if(setting('social_facebook'))
                    <li><a href="{{ setting('social_facebook') }}"><i class="ti-facebook"></i></a></li>
                    @endif
                    @if(setting('social_twitter'))
                    <li><a href="{{ setting('social_twitter') }}"><i class="ti-twitter-alt"></i></a></li>
                    @endif
                    @if(setting('social_instagram'))
                    <li><a href="{{ setting('social_instagram') }}"><i class="ti-instagram"></i></a></li>
                    @endif
                    @if(setting('social_linkedin'))
                    <li><a href="{{ setting('social_linkedin') }}"><i class="ti-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>
