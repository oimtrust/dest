@extends('layouts.global')

@section('title')
Trashed Scenarios
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Trashed Scenarios
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Trashed Scenarios</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('trash.scenarios') }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Actions...">
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
                <h4 class="card-title">Scenario List</h4>
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
                            <th>Action</th>
                            <th>Prerequisites</th>
                            <th>Test Step</th>
                            <th>Feature of Project</th>
                            <th>Deleted At</th>
                            <th>Deleted By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($scenarios as $index => $scenario)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $scenario->action }}</td>
                                    <td>{{ strip_tags($scenario->prerequisites) }}</td>
                                    <td>{{ strip_tags($scenario->test_step) }}</td>
                                    <td>{{ $scenario->feature->title }} of {{ $scenario->feature->story->project->title }}</td>
                                    <td>{{ $scenario->deleted_at }}</td>
                                    <td>{{ $scenario->deletedUser->name }}</td>
                                    <td>
                                        <a href="{{ route('scenarios.restore', ['id' => $scenario->id]) }}">
                                            <button type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Restore"><i class="mdi mdi-backup-restore"></i></button>
                                        </a>
                                        <form method="POST" action="{{ route('scenarios.delete-permanent', ['id' => $scenario->id]) }}"
                                            onsubmit="return confirm('Delete this Scenario permanently?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Permanent">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="20">
                                    {{ $scenarios->links() }}
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
