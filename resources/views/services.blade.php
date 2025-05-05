@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <section class="page-title page-title-4 image-bg overlay parallax">
        <div class="background-image-holder">
            @if($service->banner_image)
                <img alt="Background Image" class="background-image" src="{{ asset($service->banner_image) }}" />
            @else
                <img alt="Background Image" class="background-image" src="{{ asset('img/cover12.jpg') }}" />
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="uppercase mb0">{{ $service->title ?? 'Services' }}</h3>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="active">{{ $service->title ?? 'Services' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="pb0">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
                    <h3>{{ $service->intro_heading ?? 'A unique, process driven approach to delivering outstanding results for our partners.' }}</h3>
                    @if($service->intro_text)
                        <p class="lead">{!! $service->intro_text !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section>
        <div class="container">
            <div class="row">
                @if(isset($service->service_items) && is_array($service->service_items))
                    @foreach($service->service_items as $index => $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="feature feature-3 mb-xs-24 {{ $index < 4 ? 'mb64' : '' }}">
                                <div class="left">
                                    <i class="{{ $item['icon'] ?? 'ti-star' }} icon-sm"></i>
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
                                <i class="ti-panel icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Expert, Modular Design</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-medall icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Trusted, Elite Author</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-layout icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Ultimate Flexibility</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24 mb64">
                            <div class="left">
                                <i class="ti-comment-alt icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Dedicated Support</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24">
                            <div class="left">
                                <i class="ti-infinite icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Endless Layouts</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature feature-3 mb-xs-24">
                            <div class="left">
                                <i class="ti-dashboard icon-sm"></i>
                            </div>
                            <div class="right">
                                <h5 class="uppercase mb16">Built for Performance</h5>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="image-bg overlay parallax">
        <div class="background-image-holder">
            <img alt="Background Image" class="background-image" src="{{ asset($service->process_bg_image ?? 'img/cover11.jpg') }}" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 class="uppercase mb64 mb-xs-32">{{ $service->process_title ?? 'Our Process' }}</h3>
                </div>
            </div>
            <div class="row">
                @if(isset($service->process_steps) && is_array($service->process_steps))
                    @foreach($service->process_steps as $step)
                        <div class="col-sm-4">
                            <div class="feature feature-1 boxed">
                                <div class="text-center">
                                    <i class="{{ $step['icon'] ?? 'ti-package' }} icon"></i>
                                    <h5 class="uppercase mb16">{{ $step['title'] ?? 'Process Step' }}</h5>
                                </div>
                                <p>{{ $step['description'] ?? 'Step description goes here.' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-sm-4">
                        <div class="feature feature-1 boxed">
                            <div class="text-center">
                                <i class="ti-agenda icon"></i>
                                <h5 class="uppercase mb16">Research & Ideate</h5>
                            </div>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="feature feature-1 boxed">
                            <div class="text-center">
                                <i class="ti-pencil-alt2 icon"></i>
                                <h5 class="uppercase mb16">Design & Iterate</h5>
                            </div>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="feature feature-1 boxed">
                            <div class="text-center">
                                <i class="ti-package icon"></i>
                                <h5 class="uppercase mb16">Ship & Support</h5>
                            </div>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="pt64 pb64">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="mb8">{{ $service->cta_title ?? 'Create something beautiful.' }}</h2>
                    <p class="lead mb40">
                        {{ $service->cta_description ?? 'Variant Page Builder, Over 100 Page Templates - The choice is clear.' }}
                    </p>
                    <a class="btn btn-filled btn-lg mb0" href="{{ $service->cta_button_url ?? route('contact') }}">{{ $service->cta_button_text ?? 'Purchase Foundry' }}</a>
                </div>
            </div>
            <div class="embelish-icons">
                <i class="ti-marker"></i>
                <i class="ti-layout"></i>
                <i class="ti-ruler-alt-2"></i>
                <i class="ti-eye"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
                <i class="ti-marker"></i>
                <i class="ti-layout"></i>
                <i class="ti-ruler-alt-2"></i>
                <i class="ti-eye"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
            </div>
        </div>
    </section>
@endsection
