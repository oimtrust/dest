@extends('layouts.global')

@section('title')
Testcases
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Testcases
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $project->id]) }}">Menus of {{ $project->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Testcases</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('testcases.index', ['id' => $project->id]) }}">
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
                <h4 class="card-title">Testcase List</h4>

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
                        <a href="{{ route('testcases.create', ['id' => $project->id]) }}" class="btn btn-gradient-primary">Create Testcase</a>
                    </div>
                </div>

                <br/>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Scenario</th>
                            <th>Expected Result</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($testcases as $item => $testcase)
                            <tr>
                                <td>{{ $item+1 }}</td>
                                <td>{{ $testcase->scenario->action }}</td>
                                <td>{{ strip_tags($testcase->expected_result) }}</td>
                                <td>{{ $testcase->status }}</td>
                                <td>
                                    <a href="{{ route('testcases.show', ['project_id' => $project->id,'testcase_id' => $testcase->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('testcases.edit', ['project_id' => $project->id, 'testcase_id' => $testcase->id]) }}">
                                        <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ route('testcases.destroy', ['id' => $testcase->id]) }}"
                                        onsubmit="return confirm('Are you sure move this testcase to trash?')">
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
                                    {{ $testcases->links() }}
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
