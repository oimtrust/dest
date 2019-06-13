@extends('layouts.global')

@section('title')
My Issues
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        My Issues
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Issues</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('issues.index') }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-gradient-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Issues List</h4>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Project</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Severity</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($issues as $item => $issue)
                            <tr>
                                <td>{{ $item+1 }}</td>
                                <td>{{ $issue->testcase->scenario->feature->story->project->title }}</td>
                                <td>{{ $issue->title }}</td>
                                <td>{{ strip_tags($issue->description) }}</td>
                                <td>{{ $issue->type }}</td>
                                <td>{{ $issue->severity }}</td>
                                <td>{{ $issue->priority }}</td>
                                <td>{{ $issue->status }}</td>
                                <td>
                                    <a href="{{ route('issues.detail', ['id' => $issue->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="20">
                                    {{ $issues->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
