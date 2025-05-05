<section class="image-bg parallax pt240 pb180 pt-xs-80 pb-xs-80">
    @if($section->background_image)
    <div class="background-image-holder">
        <img alt="{{ $section->title }}" class="background-image" src="{{ asset( $section->background_image) }}" />
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h1>{!! $section->title !!}</h1>
                <p class="lead mb48 mb-xs-32">
                    {!! $section->subtitle !!}
                </p>
                @if($section->button_text)
                <a href="{{ $section->button_url ?? '#' }}" class="btn btn-lg btn-filled">{{ $section->button_text }}</a>
                @endif
                @if($section->image)
                <a href="{{ $section->button_url ?? '#' }}">
                    <img class="image-xs" alt="{{ $section->title }}" src="{{ asset( $section->image) }}" />
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
