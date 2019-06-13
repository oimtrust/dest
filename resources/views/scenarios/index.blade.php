@extends('layouts.global')

@section('title')
Scenarios
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Scenarios
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $project->id]) }}">Menus of {{ $project->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Scenarios</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('scenarios.index', ['id' => $project->id]) }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Scenarios...">
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

                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('scenarios.create', ['id' => $project->id]) }}" class="btn btn-gradient-primary">Create Scenario</a>
                    </div>
                </div>

                <br/>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Feature</th>
                            <th>Actions</th>
                            <th>Prerequisites</th>
                            <th>Test Step</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($scenarios as $item => $scenario)
                            <tr>
                                <td>{{ $item+1 }}</td>
                                <td>{{ $scenario->feature->title }}</td>
                                <td>{{ $scenario->action }}</td>
                                <td>{{ strip_tags($scenario->prerequisites) }}</td>
                                <td>{{ strip_tags($scenario->test_step) }}</td>
                                <td>
                                    <a href="{{ route('scenarios.show', ['project_id' => $project->id,'scenario_id' => $scenario->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('scenarios.edit', ['project_id' => $project->id, 'scenario_id' => $scenario->id]) }}">
                                        <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ route('scenarios.destroy', ['id' => $scenario->id]) }}"
                                        onsubmit="return confirm('Are you sure move this scenario to trash?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon btn-delete" data-toggle="tooltip" data-placement="top" title="Delete">
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
