@extends('layouts.global')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
        </span>
        Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview
            <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
        </ul>
    </nav>
</div>

<div class="row">

    @if (session('status'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
            <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image"/>
            <h4 class="font-weight-normal mb-3">Projects
            <i class="mdi mdi-briefcase-outline mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{ $projects->count() }}</h2>
            <h6 class="card-text">Active Projects : {{ $activeProject->count() }}</h6>
            <h6 class="card-text">Inactive Projects : {{ $inactiveProject->count() }}</h6>
        </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image"/>
                <h4 class="font-weight-normal mb-3">Test Cases
                <i class="mdi mdi-checkbox-multiple-marked-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ $testcases->count() }}</h2>
                <h6 class="card-text">Pass Testcases : {{ $passTestcase->count() }}</h6>
                <h6 class="card-text">Fail Testcases : {{ $failTestcase->count() }}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image"/>
                <h4 class="font-weight-normal mb-3">Issues
                <i class="mdi mdi-bug-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ $issues->count() }}</h2>
                <h6 class="card-text">Finished Issues : {{ $finishedIssue->count() }}</h6>
            </div>
        </div>
    </div>
</div>

<!-- Stisla -->
<div class="main-content">
    <section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                    10
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>News</h4>
                    </div>
                    <div class="card-body">
                    42
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Reports</h4>
                    </div>
                    <div class="card-body">
                    1,201
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Online Users</h4>
                    </div>
                    <div class="card-body">
                    47
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
