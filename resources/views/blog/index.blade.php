@extends('layouts.app')

@section('content')
<section class="page-title page-title-4 image-bg overlay parallax">
    <div class="background-image-holder">
        <img alt="Background Image" class="background-image" src="{{ asset(setting('blog_banner')) }}" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="uppercase mb0">Blog</h3>
            </div>
            <div class="col-md-6 text-right">
                <ol class="breadcrumb breadcrumb-2">
                    <li>
                        <a href="{{ route('landing-page') }}">Home</a>
                    </li>
                    <li class="active">Blog</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @forelse($posts as $post)
                <div class="post-snippet mb64">
                    @if($post->featured_image)
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <img class="mb24" alt="{{ $post->title }}" src="{{ asset('storage/' . $post->featured_image) }}" />
                    </a>
                    @endif
                    <div class="post-title">
                        <span class="label">{{ $post->published_at->format('d M') }}</span>
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <h4 class="inline-block">{{ $post->title }}</h4>
                        </a>
                    </div>
                    <ul class="post-meta">
                        <li>
                            <i class="ti-user"></i>
                            <span>Written by
                                <a href="#">{{ $post->user->name }}</a>
                            </span>
                        </li>
                        @if($post->categories->count() > 0)
                        <li>
                            <i class="ti-tag"></i>
                            <span>Tagged as
                                @foreach($post->categories as $category)
                                <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </span>
                        </li>
                        @endif
                    </ul>
                    <hr>
                    <p>
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 200) }}
                    </p>
                    <a class="btn btn-sm" href="{{ route('blog.show', $post->slug) }}">Read More</a>
                </div>
                @empty
                <div class="post-snippet mb64">
                    <p>No blog posts found.</p>
                </div>
                @endforelse

                <div class="pagination-container">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
