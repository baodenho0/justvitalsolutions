<section class="{{ $section->background_color ?? '' }}">
    <div class="container">
        @if($section->title || $section->subtitle)
        <div class="row mb64 mb-xs-32">
            <div class="col-sm-12 text-center">
                @if($section->title)
                <h2>{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                <p class="lead">{{ $section->subtitle }}</p>
                @endif
            </div>
        </div>
        @endif

        <div class="row">
            @foreach($section->features()->active()->ordered()->get() as $feature)
            @php
                $extraData = $feature->extra_data ?? [];
                $animation = $extraData['animation'] ?? '';
                $delay = $extraData['delay'] ?? '0';
                $highlight = $extraData['highlight'] ?? false;
                $detailText = $extraData['detail_text'] ?? '';
            @endphp
            <div class="col-sm-4" @if($animation) data-animation="{{ $animation }}" data-delay="{{ $delay }}" @endif>
                <div class="feature feature-3 mb0 {{ $highlight ? 'boxed boxed-mini bg-primary' : '' }}">
                    <div class="left">
                        <i class="{{ $feature->icon }}"></i>
                    </div>
                    <div class="right">
                        <h5 class="mb8 uppercase bold">{{ $feature->title }}</h5>
                        <p class="fade-1-4">
                            {{ $feature->description }}
                        </p>
                        @if($detailText)
                        <div class="feature-detail mt16">
                            <p class="fade-1-4 small">
                                {{ $detailText }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--end of row-->

        @if($section->button_text)
        <div class="row mt32">
            <div class="col-sm-12 text-center">
                <a href="{{ $section->button_url ?? '#' }}" class="btn btn-lg {{ $section->background_color == 'bg-dark' ? 'btn-white' : 'btn-filled' }}">
                    {{ $section->button_text }}
                </a>
            </div>
        </div>
        @endif
    </div>
    <!--end of container-->
</section>
