@extends('layouts.app')

@section('content')
<section class="page-title page-title-4 image-bg overlay parallax">
    <div class="background-image-holder">
        @if($post->banner_image)
            <img alt="Background Image" class="background-image" src="{{ asset($contact->banner_image) }}" />
        @else
            <img alt="Background Image" class="background-image" src="{{ asset('img/home10.jpg') }}" />
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="uppercase mb0">Blog Post</h3>
            </div>
            <div class="col-md-6 text-right">
                <ol class="breadcrumb breadcrumb-2">
                    <li>
                        <a href="{{ route('landing-page') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="active">{{ $post->title }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="post-snippet mb64">
                    @if($post->featured_image)
                    <img class="mb24" alt="{{ $post->title }}" src="{{ asset('storage/' . $post->featured_image) }}" />
                    @endif
                    <div class="post-title">
                        <span class="label">{{ $post->published_at->format('d M') }}</span>
                        <h4 class="inline-block">{{ $post->title }}</h4>
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
                    @if($post->excerpt)
                    <p class="lead">
                        {{ $post->excerpt }}
                    </p>
                    @endif
                    <div class="post-content">
                        {!! $post->content !!}
                    </div>
                </div>

                <hr>

                <!-- Comments Section -->
                <div class="comments">
                    <h5 class="uppercase mb32">{{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}</h5>

                    @if($post->comments->count() > 0)
                    <ul class="comments-list">
                        @foreach($post->comments as $comment)
                        <li id="comment-{{ $comment->id }}" class="mb40">
                            <div class="avatar">
                                <img alt="Avatar" src="https://www.gravatar.com/avatar/{{ md5($comment->user->email) }}?s=60&d=mp" />
                            </div>
                            <div class="comment">
                                <div class="comment-meta mb8">
                                    <span class="uppercase author">{{ $comment->user->name }}</span>
                                    <span class="comment-date">{{ $comment->created_at->format('F j, Y') }}</span>
                                </div>

                                <div class="comment-content mb16">
                                    <p>{{ $comment->content }}</p>
                                </div>

                                <div class="comment-actions">
                                    @auth
                                    <a class="btn btn-sm btn-filled reply-btn" href="#" data-comment-id="{{ $comment->id }}">Reply</a>
                                    @if(auth()->id() === $comment->user_id)
                                    <a class="btn btn-sm edit-btn" href="#" data-comment-id="{{ $comment->id }}">Edit</a>
                                    <a class="btn btn-sm delete-btn" href="#" data-comment-id="{{ $comment->id }}" data-delete-url="{{ route('blog.comments.destroy', $comment) }}">Delete</a>
                                    <form id="delete-form-{{ $comment->id }}" action="{{ route('blog.comments.destroy', $comment) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                    @endauth
                                </div>

                                <!-- Edit Comment Form (Hidden by default) -->
                                @auth
                                @if(auth()->id() === $comment->user_id)
                                <div class="edit-comment-form mt16" id="edit-comment-{{ $comment->id }}" style="display: none;">
                                    <form action="{{ route('blog.comments.update', $comment) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-with-icon mb8">
                                            <textarea name="content" rows="3" class="form-control" required>{{ $comment->content }}</textarea>
                                        </div>
                                        <div class="form-action">
                                            <button type="submit" class="btn btn-sm btn-filled">Update Comment</button>
                                            <button type="button" class="btn btn-sm cancel-edit" data-comment-id="{{ $comment->id }}">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                @endauth
                            </div>

                            <!-- Reply Form (Hidden by default) -->
                            @auth
                            <div class="reply-form mt16" id="reply-form-{{ $comment->id }}" style="display: none;">
                                <form action="{{ route('blog.comments.store', $post->slug) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="input-with-icon mb8">
                                        <textarea name="content" rows="3" class="form-control" placeholder="Write your reply..." required></textarea>
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="btn btn-sm btn-filled">Submit Reply</button>
                                        <button type="button" class="btn btn-sm cancel-reply" data-comment-id="{{ $comment->id }}">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            @endauth

                            <!-- Replies -->
                            @if($comment->replies->count() > 0)
                            <ul class="mt24">
                                @foreach($comment->replies as $reply)
                                <li id="comment-{{ $reply->id }}" class="mb16">
                                    <div class="avatar">
                                        <img alt="Avatar" src="https://www.gravatar.com/avatar/{{ md5($reply->user->email) }}?s=60&d=mp" />
                                    </div>
                                    <div class="comment">
                                        <div class="comment-meta mb8">
                                            <span class="uppercase author">{{ $reply->user->name }}</span>
                                            <span class="comment-date">{{ $reply->created_at->format('F j, Y') }}</span>
                                        </div>

                                        <div class="comment-content mb8">
                                            <p>{{ $reply->content }}</p>
                                        </div>

                                        <div class="comment-actions">
                                            @auth
                                            <a class="btn btn-sm btn-filled reply-btn" href="#" data-comment-id="{{ $comment->id }}">Reply</a>
                                            @if(auth()->id() === $reply->user_id)
                                            <a class="btn btn-sm edit-btn" href="#" data-comment-id="{{ $reply->id }}">Edit</a>
                                            <a class="btn btn-sm delete-btn" href="#" data-comment-id="{{ $reply->id }}" data-delete-url="{{ route('blog.comments.destroy', $reply) }}">Delete</a>
                                            <form id="delete-form-{{ $reply->id }}" action="{{ route('blog.comments.destroy', $reply) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                            @endauth
                                        </div>

                                        <!-- Edit Reply Form (Hidden by default) -->
                                        @auth
                                        @if(auth()->id() === $reply->user_id)
                                        <div class="edit-comment-form mt16" id="edit-comment-{{ $reply->id }}" style="display: none;">
                                            <form action="{{ route('blog.comments.update', $reply) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-with-icon mb8">
                                                    <textarea name="content" rows="3" class="form-control" required>{{ $reply->content }}</textarea>
                                                </div>
                                                <div class="form-action">
                                                    <button type="submit" class="btn btn-sm btn-filled">Update Comment</button>
                                                    <button type="button" class="btn btn-sm cancel-edit" data-comment-id="{{ $reply->id }}">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        @endauth
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="lead mb32">No comments yet. Be the first to comment!</p>
                    @endif

                    <hr>

                    <!-- Comment Form -->
                    <div class="comment-form mt40 mb40">
                        <h5 class="uppercase mb24">Leave A Comment</h5>
                        @auth
                        <form action="{{ route('blog.comments.store', $post->slug) }}" method="POST">
                            @csrf
                            <div class="input-with-icon mb16">
                                <textarea name="content" rows="4" class="form-control" placeholder="Write your comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-filled">Submit Comment</button>
                        </form>
                        @else
                        <div class="text-center">
                            <p class="lead mb16">Please login to leave a comment.</p>
                            <a href="{{ route('login') }}" class="btn btn-filled">Login Now</a>
                        </div>
                        @endauth
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <hr>
                <h5 class="uppercase">Related Posts</h5>
                <div class="row">
                    @foreach($relatedPosts as $relatedPost)
                    <div class="col-md-4 col-sm-6">
                        <div class="post-snippet mb30">
                            @if($relatedPost->featured_image)
                            <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                <img alt="{{ $relatedPost->title }}" src="{{ asset('storage/' . $relatedPost->featured_image) }}" />
                            </a>
                            @endif
                            <div class="post-title">
                                <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                    <h5>{{ $relatedPost->title }}</h5>
                                </a>
                            </div>
                            <p>
                                {{ Str::limit(strip_tags($relatedPost->excerpt ?? $relatedPost->content), 100) }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Reply functionality
        $(document).on('click', '.reply-btn', function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).show();
        });

        $(document).on('click', '.cancel-reply', function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).hide();
        });

        // Edit functionality
        $(document).on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#edit-comment-' + commentId).show();
        });

        $(document).on('click', '.cancel-edit', function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#edit-comment-' + commentId).hide();
        });

        // Delete functionality
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');

            if (confirm('Are you sure you want to delete this comment?')) {
                $('#delete-form-' + commentId).submit();
            }
        });
    });
</script>
@endpush
