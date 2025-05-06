@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $stats['blogs'] ?? 0 }}</h3>
                        <p>Total Blogs</p>
                        <span class="text-sm">{{ $stats['published_blogs'] ?? 0 }} published</span>
                    </div>
                    <div class="icon">
                        <i class="fas fa-blog"></i>
                    </div>
                    <a href="{{ route('admin.blog.posts.index') ?? '#' }}" class="small-box-footer">Manage blogs <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['comments'] ?? 0 }}</h3>
                        <p>Comments</p>
                        <span class="text-sm">{{ $stats['pending_comments'] ?? 0 }} pending approval</span>
                    </div>
                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <a href="{{ route('admin.blog.comments.index') ?? '#' }}" class="small-box-footer">Manage comments <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['form_submissions'] ?? 0 }}</h3>
                        <p>Form Submissions</p>
                        <span class="text-sm">{{ $stats['unread_submissions'] ?? 0 }} unread</span>
                    </div>
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <a href="{{ route('admin.contact.submissions') ?? '#' }}" class="small-box-footer">View submissions <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $stats['users'] ?? 0 }}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.users.index') ?? '#' }}" class="small-box-footer">Manage users <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Recent Blog Posts -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-blog mr-1"></i>
                            Recent Blog Posts
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentBlogs ?? [] as $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.blog.posts.edit', $blog->id) ?? '#' }}">
                                                {{ Str::limit($blog->title, 40) }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($blog->is_published)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $blog->allComments->count() }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No blog posts found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.blog.posts.index') ?? '#' }}" class="text-sm">View All Blog Posts</a>
                    </div>
                </div>

                <!-- Recent Comments -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-comments mr-1"></i>
                            Recent Comments
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @forelse($recentComments ?? [] as $comment)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ $comment->user->avatar ?? 'https://via.placeholder.com/50' }}" alt="User Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('admin.blog.comments.show', $comment->id) ?? '#' }}" class="product-title">
                                        {{ $comment->user->name ?? 'Anonymous' }}
                                        @if(!$comment->is_approved)
                                            <span class="badge badge-warning float-right">Pending</span>
                                        @endif
                                    </a>
                                    <span class="product-description">
                                        {{ Str::limit($comment->content, 100) }}
                                    </span>
                                    <small class="text-muted">
                                        On: <a href="{{ route('admin.blog.posts.edit', $comment->blog_post_id) ?? '#' }}">{{ Str::limit($comment->post->title ?? 'Unknown Post', 30) }}</a> |
                                        {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </li>
                            @empty
                            <li class="item">
                                <div class="product-info text-center py-3">
                                    No comments found
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.blog.comments.index') ?? '#' }}" class="text-sm">View All Comments</a>
                    </div>
                </div>
            </section>

            <!-- Right col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Recent Form Submissions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-envelope mr-1"></i>
                            Recent Form Submissions
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @forelse($recentSubmissions ?? [] as $submission)
                            <li class="item">
                                <div class="product-info">
                                    <a href="{{ route('admin.contact.submissions.show', $submission->id) ?? '#' }}" class="product-title">
                                        {{ $submission->name }}
                                        @if(!$submission->read)
                                            <span class="badge badge-info float-right">New</span>
                                        @endif
                                    </a>
                                    <span class="product-description">
                                        {{ Str::limit($submission->message, 100) }}
                                    </span>
                                    <small class="text-muted">
                                        {{ $submission->email }} | {{ $submission->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </li>
                            @empty
                            <li class="item">
                                <div class="product-info text-center py-3">
                                    No form submissions found
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.contact.submissions') ?? '#' }}" class="text-sm">View All Submissions</a>
                    </div>
                </div>

                <!-- Blog Statistics -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Blog Statistics
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Published</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $stats['published_blogs'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Drafts</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ ($stats['blogs'] ?? 0) - ($stats['published_blogs'] ?? 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Approved Comments</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ ($stats['comments'] ?? 0) - ($stats['pending_comments'] ?? 0) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Pending Comments</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $stats['pending_comments'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop

@section('page_css')
    <style>
        /* Enhanced dashboard styling */
        .small-box {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box .icon {
            transition: all 0.3s ease;
        }

        .small-box:hover .icon {
            transform: scale(1.1);
        }

        .small-box .inner {
            padding-bottom: 15px;
        }

        .small-box .inner .text-sm {
            display: block;
            margin-top: 5px;
            opacity: 0.8;
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .products-list .item {
            transition: background-color 0.3s ease;
        }

        .products-list .item:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .info-box {
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('page_js')
    <script>
        $(function () {
            // Welcome notification
            $(document).ready(function() {
                $(document).Toasts('create', {
                    title: 'Dashboard Updated',
                    body: 'Welcome to your content management dashboard!',
                    subtitle: 'Blog & Content Statistics',
                    autohide: true,
                    delay: 3000,
                    class: 'bg-info',
                    icon: 'fas fa-blog fa-lg',
                });
            });

            // Add hover effect to dashboard cards
            $('.small-box').hover(
                function() { $(this).addClass('shadow'); },
                function() { $(this).removeClass('shadow'); }
            );

            // Add click effect to dashboard cards
            $('.small-box').on('click', function(e) {
                if (!$(e.target).is('a')) {
                    const link = $(this).find('a.small-box-footer').attr('href');
                    if (link && link !== '#') {
                        window.location.href = link;
                    }
                }
            });

            // Make the dashboard sortable (if AdminLTE supports it)
            if (typeof $.fn.sortable !== 'undefined') {
                $('.connectedSortable').sortable({
                    placeholder: 'sort-highlight',
                    connectWith: '.connectedSortable',
                    handle: '.card-header',
                    forcePlaceholderSize: true,
                    zIndex: 999999
                });
                $('.connectedSortable .card-header').css('cursor', 'move');
            }

            // Add a simple refresh button functionality
            $('.btn-tool').not('[data-card-widget]').on('click', function() {
                const card = $(this).closest('.card');
                card.append('<div class="overlay"><i class="fas fa-sync-alt fa-spin"></i></div>');

                // Simulate loading (in a real app, you'd make an AJAX call here)
                setTimeout(function() {
                    card.find('.overlay').remove();
                }, 1000);
            });
        });
    </script>
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="#">Laravel Admin</a>.</strong> All rights reserved.
@stop
