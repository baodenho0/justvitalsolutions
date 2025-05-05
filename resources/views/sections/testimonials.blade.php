<section class="image-bg overlay parallax pt180 pb180 pt-xs-80 pb-xs-80">
    @if($section->background_image)
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="{{ asset($section->background_image) }}" />
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6 col-md-push-7 col-sm-push-6">
                <h2>{{ $section->title }}</h2>
                <p class="lead mb48 mb-xs-32">
                    {{ $section->subtitle }}
                </p>

                @if($section->testimonials && $section->testimonials->count() > 0)
                <div class="testimonials text-slider slider-arrow-controls">
                    <ul class="slides">
                        @foreach($section->testimonials()->active()->ordered()->get() as $testimonial)
                        <li>
                            <div class="testimonial">
                                <p class="lead">{{ $testimonial->content }}</p>
                                <div class="quote-author">
                                    <h6 class="uppercase mb0">{{ $testimonial->name }}</h6>
                                    <span>{{ $testimonial->position }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
