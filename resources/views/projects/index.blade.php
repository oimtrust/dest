@extends('layouts.global')

@section('title')
Projects
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Projects
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Projects</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('projects.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="PUBLISH">PUBLISH</option>
                                    <option value="DRAFT">DRAFT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Projects...">
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
                <h4 class="card-title">Project List</h4>
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
                        <a href="{{ route('projects.create') }}" class="btn btn-gradient-primary">Create Project</a>
                    </div>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Logo</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                {{ $project->title }}
                            </td>
                            <td>{{ $project->owner }}</td>
                            <td>
                                @if ($project->status == 'PUBLISH')
                                    <label class="badge badge-success">{{ $project->status }}</label>
                                @else
                                    <label class="badge badge-warning">{{ $project->status }}</label>
                                @endif
                            </td>
                            <td>
                                @if ($project->logo)
                                    <img src="{{ asset('storage/'. $project->logo) }}" alt="image">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                {{ $project->created_at }}
                            </td>
                            <td>
                                {{ $project->createdUser->name }}
                            </td>
                            <td>
                                @if ($project->updated_by == NULL)
                                    -
                                @else
                                {{ $project->updatedUser->name }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('projects.show', ['id' => $project->id]) }}">
                                    <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail"><i class="mdi mdi-eye"></i></button>
                                </a>
                                <a href="{{ route('projects.edit', ['id' => $project->id]) }}">
                                    <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                </a>

                                <form method="POST" action="{{ route('projects.destroy', ['id' => $project->id]) }}"
                                    onsubmit="return confirm('Move {{ $project->title }} to trash?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">

                                    <input type="hidden" name="deleted_by" value="{{ \Auth::user()->id }}">
                                    <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    {{ $projects->appends(Request::all())->links() }}
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
