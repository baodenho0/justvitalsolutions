<section>
    <div class="container">
        <div class="row v-align-children">
            <div class="col-sm-4 col-md-offset-1 mb-xs-24">
                <h2 class="mb64 mb-xs-32">{{ $section->title }}</h2>
                @foreach($section->features()->active()->ordered()->get() as $feature)
                <div class="mb40 mb-xs-24">
                    <h5 class="uppercase bold mb16">{{ $feature->title }}</h5>
                    <p class="fade-1-4">
                        {{ $feature->description }}
                    </p>
                </div>
                @endforeach
            </div>
            <div class="col-sm-5 col-sm-6 col-sm-offset-1 text-center">
                @if($section->image)
                <img alt="{{ $section->title }}" src="{{ asset($section->image) }}" />
                @endif
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
