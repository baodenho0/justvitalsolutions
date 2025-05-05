<section class="{{ $section->background_color ?? '' }} {{ isset($section->extra_data['pb0']) && $section->extra_data['pb0'] ? 'pb0' : '' }}">
    @if($section->background_image)
    <div class="background-image-holder">
        <img alt="{{ $section->title }}" class="background-image" src="{{ asset($section->background_image) }}" />
    </div>
    @endif
    <div class="container">
        <div class="row mb64 mb-xs-32">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                <h1 class="{{ isset($section->extra_data['large_title']) && $section->extra_data['large_title'] ? 'large' : '' }}">{{ $section->title }}</h1>
                <p class="lead mb48 mb-xs-32 fade-1-4">
                    {{ $section->subtitle }}
                </p>
                @if($section->button_text)
                <a class="btn btn-lg btn-filled" href="{{ $section->button_url ?? '#' }}">{{ $section->button_text }}</a>
                @endif
            </div>
        </div>
        <!--end of row-->
        @if($section->image)
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                <img alt="{{ $section->title }}" src="{{ asset($section->image) }}" />
            </div>
        </div>
        <!--end of row-->
        @endif
    </div>
    <!--end of container-->
</section>
