<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3 text-center">
                <div class="image-slider slider-paging-controls controls-outside">
                    <ul class="slides">
                        @if(isset($section->extra_data['slider_images']) && is_array($section->extra_data['slider_images']) && count($section->extra_data['slider_images']) > 0)
                            @foreach($section->extra_data['slider_images'] as $image)
                            <li class="mb32">
                                <img alt="App" src="{{ asset($image) }}" />
                            </li>
                            @endforeach
                        @else
                            <li class="mb32">
                                <img alt="App" src="{{ asset($section->image) }}" />
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-6">
                @php
                    $leftFeatures = $section->features()->active()->whereRaw("JSON_EXTRACT(extra_data, '$.position') = 'left'")->orderBy('order')->get();
               @endphp
                @foreach($leftFeatures as $feature)
                <div class="{{ $loop->first ? 'mt80 mt-xs-80' : 'mt80 mt-xs-0' }} text-right text-left-xs">
                    <h5 class="uppercase bold mb16">{{ $feature->title }}</h5>
                    <p class="fade-1-4">
                        {{ $feature->description }}
                    </p>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                @php
                    $rightFeatures = $section->features()->active()->whereRaw("JSON_EXTRACT(extra_data, '$.position') = 'right'")->orderBy('order')->get();
                @endphp
                @foreach($rightFeatures as $feature)
                <div class="mt80 mt-xs-0">
                    <h5 class="uppercase bold mb16">{{ $feature->title }}</h5>
                    <p class="fade-1-4">
                        {{ $feature->description }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
