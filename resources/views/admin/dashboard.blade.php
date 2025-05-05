@extends('adminlte::page')

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
                        <h3>{{ $stats['orders'] ?? 150 }}</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['products'] ?? 53 }}</h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['users'] ?? 44 }}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $stats['categories'] ?? 65 }}</h3>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Sales
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <h5 class="text-muted">Sales Chart Area (Sample)</h5>
                                </div>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <h5 class="text-muted">Sales Chart Donut (Sample)</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks mr-1"></i>
                            To Do List
                        </h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <span class="text">Design a nice theme</span>
                                <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo2" id="todoCheck2">
                                    <label for="todoCheck2"></label>
                                </div>
                                <span class="text">Make the theme responsive</span>
                                <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                </div>
                                <span class="text">Let theme shine like a star</span>
                                <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash-o"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Right col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Map card -->
                <div class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Visitors
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <h5 class="text-white">World Map (Sample)</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Calendar
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="calendar" style="width: 100%">
                            <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
                                <h5 class="text-white">Calendar (Sample)</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {
            // Initialize the dashboard components
            $('[data-toggle="tooltip"]').tooltip();

            // Add event listeners for the todo list
            $('.todo-list').on('click', '.fa-edit', function() {
                alert('Edit functionality would go here');
            });

            $('.todo-list').on('click', '.fa-trash-o', function() {
                $(this).closest('li').fadeOut();
            });

            // Sample notification
            $(document).ready(function() {
                $(document).Toasts('create', {
                    title: 'Welcome',
                    body: 'Welcome to the AdminLTE dashboard!',
                    autohide: true,
                    delay: 3000,
                    class: 'bg-info',
                });
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
