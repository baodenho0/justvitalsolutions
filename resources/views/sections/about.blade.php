<section>
    <div class="container">
        <div class="row v-align-children">
            <div class="col-sm-5 col-md-offset-1 mb-xs-24">
                <h2 class="mb64 mb-xs-32">{{ $section->title }}</h2>
                <div class="mb40 mb-xs-24">
                    {!! $section->content !!}
                </div>
                @if($section->button_text)
                <a href="{{ $section->button_url ?? '#' }}" class="btn btn-lg btn-filled">{{ $section->button_text }}</a>
                @endif
            </div>
            <div class="col-sm-5 col-sm-6 col-sm-offset-1 text-center">
                @if($section->image)
                <img alt="{{ $section->title }}" src="{{ asset( $section->image) }}" />
                @endif
            </div>
        </div>
    </div>
</section>
