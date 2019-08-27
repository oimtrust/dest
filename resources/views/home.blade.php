@extends('layouts.global')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title">
                            Project Statistics
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $activeProject->count() }}</div>
                                <div class="card-stats-item-label">Active</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $inactiveProject->count() }}</div>
                                <div class="card-stats-item-label">Inactive</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Projects</h4>
                        </div>
                        <div class="card-body">
                            {{ $projects->count() }}
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title">
                            Testcase Statistics
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $passTestcase->count() }}</div>
                                <div class="card-stats-item-label">Pass</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $failTestcase->count() }}</div>
                                <div class="card-stats-item-label">Fail</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Testcases</h4>
                        </div>
                        <div class="card-body">
                            {{ $testcases->count() }}
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title">
                            Issue Statistics
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $finishedIssue->count() }}</div>
                                <div class="card-stats-item-label">Finished</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Issues</h4>
                        </div>
                        <div class="card-body">
                            {{ $issues->count() }}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
