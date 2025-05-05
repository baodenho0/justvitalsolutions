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
                    <h2 class="uppercase mb8">{{ $aboutUs->title }}</h2>
                    <p class="lead mb0">{{ $aboutUs->subtitle }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <ol class="breadcrumb breadcrumb-2">
                        <li>
                            <a href="{{ route('landing-page') }}">Home</a>
                        </li>
                        <li class="active">{{ $aboutUs->title }}</li>
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
                    <p>{!! $aboutUs->section1_content ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' !!}</p>
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
                                <div class="progress-bar" data-progress="80">
                                    <span class="title">Marketing</span>
                                </div>
                            </div>
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="85">
                                    <span class="title">Strategy</span>
                                </div>
                            </div>
                            <div class="progress progress-1">
                                <div class="progress-bar" data-progress="95">
                                    <span class="title">Development</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    @if(isset($aboutUs->team_members) && is_array($aboutUs->team_members) && count($aboutUs->team_members) > 0)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4 class="uppercase mb80">Meet The Team</h4>
                </div>
            </div>
            <div class="row">
                @foreach($aboutUs->team_members as $member)
                <div class="col-md-3 col-sm-6">
                    <div class="team-member">
                        <div class="image-holder">
                            @if(isset($member['image']))
                                <img alt="Team Member" src="{{ asset($member['image']) }}" />
                            @else
                                <img alt="Team Member" src="{{ asset('img/team1.jpg') }}" />
                            @endif
                        </div>
                        <div class="title">
                            <h5 class="uppercase">{{ $member['name'] ?? 'Team Member' }}</h5>
                            <span>{{ $member['position'] ?? 'Position' }}</span>
                        </div>
                        @if(isset($member['bio']))
                        <div class="text-center">
                            <p>{{ $member['bio'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
