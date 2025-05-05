<footer class="footer-2 bg-dark text-center-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ route('landing-page') }}">
                    @if(isset($settings['site_logo_light']))
                    <img class="image-xxs" alt="{{ $settings['site_name'] ?? 'Logo' }}" src="{{ asset( $settings['site_logo_light']) }}" />
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
