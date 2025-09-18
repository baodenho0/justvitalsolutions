@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <section class="page-title page-title-2 image-bg overlay parallax">
        <div class="background-image-holder">
            @if($aboutUs->banner_image)
                <img alt="Background Image" class="background-image" src="{{ asset($aboutUs->banner_image) }}" />
            @else
                <img alt="Background Image" class="background-image" src="{{ asset('img/home10.jpg') }}" />
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">{{ $aboutUs->title ?? 'About Us' }}</h2>
                    <p class="lead mb0">{{ $aboutUs->subtitle ?? 'A descriptive subtitle for your page.' }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="active">{{ $aboutUs->title ?? 'About Us' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1 -->
    <section class="pb0">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="uppercase">{{ $aboutUs->section1_title ?? 'Diversity & Difference' }}</h4>
                    <p>{!! $aboutUs->section1_content ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.' !!}</p>
                </div>
                <div class="col-sm-7">
                    <h4 class="uppercase">{{ $aboutUs->section2_title ?? 'Service Spread' }}</h4>
                    <div class="progress-bars">
                        @if(isset($aboutUs->skills) && is_array($aboutUs->skills))
                            @foreach($aboutUs->skills as $skill)
                                <div class="progress progress-1">
                                    <div class="progress-bar" data-progress="{{ $skill['percentage'] ?? 90 }}">
                                        <span class="title">{{ $skill['name'] ?? 'Skill' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="90">
                                    <span class="title">Branding</span>
                                </div>
                            </div>
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="70">
                                    <span class="title">E-Commerce</span>
                                </div>
                            </div>
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="60">
                                    <span class="title">Websites</span>
                                </div>
                            </div>
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="50">
                                    <span class="title">iOS Apps</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section>
        <div class="container">
            <div class="row">
                @if(isset($aboutUs->team_members) && is_array($aboutUs->team_members) && count($aboutUs->team_members) > 0)
                    @foreach($aboutUs->team_members as $member)
                    <div class="col-md-4 col-sm-6">
                        <div class="image-tile outer-title text-center">
                            @if(isset($member['image']))
                                <img alt="{{ $member['name'] ?? 'Team Member' }}" src="{{ asset($member['image']) }}" />
                            @else
                                <img alt="Team Member" src="{{ asset('img/team-1.jpg') }}" />
                            @endif
                            <div class="title mb16">
                                <h5 class="uppercase mb0">{{ $member['name'] ?? 'Team Member' }}</h5>
                                <span>{{ $member['position'] ?? 'Position' }}</span>
                            </div>
                            <p class="mb0">
                                {{ $member['bio'] ?? 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-md-4 col-sm-6">
                        <div class="image-tile outer-title text-center">
                            <img alt="Pic" src="{{ asset('img/team-1.jpg') }}" />
                            <div class="title mb16">
                                <h5 class="uppercase mb0">Sally Marsh</h5>
                                <span>Creative Director</span>
                            </div>
                            <p class="mb0">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="image-tile outer-title text-center">
                            <img alt="Pic" src="{{ asset('img/team-2.jpg') }}" />
                            <div class="title mb16">
                                <h5 class="uppercase mb0">Tim Foley</h5>
                                <span>iOS Developer</span>
                            </div>
                            <p class="mb0">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="image-tile outer-title text-center">
                            <img alt="Pic" src="{{ asset('img/team-3.jpg') }}" />
                            <div class="title mb16">
                                <h5 class="uppercase mb0">Jake Robbins</h5>
                                <span>Brand Director</span>
                            </div>
                            <p class="mb0">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h3 class="mb64 uppercase">People &nbsp;<i class="ti-heart"></i>&nbsp; {{ $aboutUs->company_name ?? 'Foundry' }}</h3>
                    <div class="testimonials text-slider slider-arrow-controls">
                        <ul class="slides">
                            @if(isset($aboutUs->testimonials) && is_array($aboutUs->testimonials) && count($aboutUs->testimonials) > 0)
                                @foreach($aboutUs->testimonials as $testimonial)
                                <li>
                                    <p class="lead">{{ $testimonial['content'] ?? 'Testimonial content goes here.' }}</p>
                                    <div class="quote-author">
                                        @if(isset($testimonial['avatar']) && $testimonial['avatar'])
                                            <img alt="Avatar" src="{{ asset($testimonial['avatar']) }}" />
                                        @else
                                            <img alt="Avatar" src="{{ asset('img/avatar1.png') }}" />
                                        @endif
                                        <h6 class="uppercase">{{ $testimonial['name'] ?? 'Client Name' }}</h6>
                                        <span>{{ $testimonial['position'] ?? 'Client Position' }}</span>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li>
                                    <p class="lead">Just Vital has completely transformed how our clinic monitors patients. The platform is easy to use, and the support team is always ready to help. Our patients are healthier, and our staff works more efficiently.</p>
                                    <div class="quote-author">
                                        <h6 class="uppercase">Anna Thompson</h6>
                                        <span>Clinic Administrator</span>
                                    </div>
                                </li>
                                <li>
                                    <p class="lead">Using Just Vital’s RPM system is incredibly simple. We can quickly track vital signs, spot potential issues early, and provide better care. The setup was smooth, and their team responds promptly to any questions.</p>
                                    <div class="quote-author">
                                        <h6 class="uppercase">Rick Dempsey</h6>
                                        <span>Nurse Practitioner</span>
                                    </div>
                                </li>
                                <li>
                                    <p class="lead">Just Vital makes chronic care management effortless. Everything integrates seamlessly into our workflow, helping us stay on top of patient health and improve outcomes. Truly a reliable solution for any clinic.</p>
                                    <div class="quote-author">
                                        <h6 class="uppercase">Gill Sans</h6>
                                        <span>Physician</span>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
