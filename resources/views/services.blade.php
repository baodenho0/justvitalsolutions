@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <section class="page-title page-title-2 image-bg overlay parallax">
        <div class="background-image-holder">
            @if($service->banner_image)
                <img alt="Background Image" class="background-image" src="{{ asset($service->banner_image) }}" />
            @else
                <img alt="Background Image" class="background-image" src="{{ asset('img/home10.jpg') }}" />
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">{{ $service->title }}</h2>
                    <p class="lead mb0">{{ $service->subtitle }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li class="active">{{ $service->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    @if($service->intro_text)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <p class="lead">{!! $service->intro_text !!}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Services Section -->
    <section class="bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4 class="uppercase mb80">What We Offer</h4>
                </div>
            </div>
            <div class="row">
                @if(isset($service->service_items) && is_array($service->service_items))
                    @foreach($service->service_items as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="feature feature-3 mb-xs-24 mb64">
                                <div class="left">
                                    <i class="{{ $item['icon'] ?? 'ti-star' }}"></i>
                                </div>
                                <div class="right">
                                    <h5 class="uppercase mb16">{{ $item['title'] ?? 'Service Title' }}</h5>
                                    <p>{!! $item['description'] ?? 'Service description goes here.' !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default services if none are defined -->
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-package"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Packaging Design</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-layers"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">UI Design</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-gallery"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Art Direction</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @if($service->show_cta)
    <section class="image-bg overlay parallax">
        <div class="background-image-holder">
            <img alt="Background" class="background-image" src="{{ asset('img/home6.jpg') }}" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="uppercase mb8">{{ $service->cta_title ?? 'Ready to get started?' }}</h2>
                    <p class="lead mb40">{{ $service->cta_description ?? 'Contact us today to discuss your project.' }}</p>
                    <a class="btn btn-filled btn-lg" href="{{ $service->cta_button_url ?? route('contact') }}">{{ $service->cta_button_text ?? 'Get in Touch' }}</a>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
