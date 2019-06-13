@extends('layouts.global')

@section('title')
Detail Testcase
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Testcase
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $testcase->scenario->feature->story->project->id]) }}">Menus of {{ $testcase->scenario->feature->story->project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('testcases.index', ['id' => $testcase->scenario->feature->story->project->id]) }}">Testcases</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Testcase</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Testcase</h4>
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="scenario">Scenario</label>
                                <input type="text" id="scenario" disabled class="form-control" value="{{ $testcase->scenario->action }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" disabled class="form-control" id="status"  value="{{ $testcase->status }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_by">Created By</label>
                                <input type="text" class="form-control" id="created_by" name="created_by" disabled value="{{ $testcase->createdUser->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_by">Updated By</label>
                                @if ($testcase->updated_by == NULL)
                                <input type="text" class="form-control" id="updated_by" disabled value="-">
                                @else
                                <input type="text" class="form-control" id="updated_by" disabled value="{{ $testcase->updatedUser->name }}">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" class="form-control" id="created_at" disabled value="{{ $testcase->created_at }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <input type="text" class="form-control" id="updated_at" disabled value="{{ $testcase->updated_at }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="expected_result">Expected Result</label>
                        <textarea class="form-control" id="expected_result" name="expected_result">{{ $testcase->expected_result }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $testcase->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" disabled value="{{ $testcase->url }}">
                    </div>

                    <div class="form-group">
                        <label>Picture</label> <br/>
                        @if ($testcase->picture)
                        <img src="{{ asset('storage/' . $testcase->picture) }}" class="mb-2 rounded" style="width: 400px" alt="image">
                        @else
                        <label class="text-info">No Picture</label>
                        @endif
                    </div>

                    <a href="{{ route('testcases.edit', ['project_id' => $testcase->scenario->feature->story->project->id, 'testcase_id' => $testcase->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                    <a href="{{ route('testcases.index', ['id' => $testcase->scenario->feature->story->project->id]) }}" class="btn btn-light">Cancel</a>
                </div>
                </form>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Issue List</h4>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('issues.create', ['id' => $testcase->id]) }}" class="btn btn-gradient-primary">Create Issue</a>
                    </div>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Severity</th>
                            <th>Priority</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($issues as $index => $issue)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $issue->title }}</td>
                                <td>{{ $issue->type }}</td>
                                <td>{{ $issue->severity }}</td>
                                <td>{{ $issue->priority }}</td>
                                <td>
                                    @if ($issue->assigned_to == NULL)
                                    -
                                    @else
                                    {{ $issue->assignedUser->name }}
                                    @endif
                                </td>
                                <td>{{ $issue->status }}</td>
                                <td>{{ $issue->created_at }}</td>
                                <td>
                                    @if ($issue->created_by == NULL)
                                    -
                                    @else
                                    {{ $issue->createdUser->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('issues.show', ['issue_id' => $issue->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('issues.edit', ['issue_id' => $issue->id, 'project_id' => $issue->testcase->scenario->feature->story->project->id]) }}">
                                        <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ route('issues.destroy', ['id' => $issue->id]) }}"
                                        onsubmit="return confirm('Are you sure move this issue to trash?')">
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

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>
ClassicEditor
.create( document.querySelector( '#expected_result' ) , {
    removePlugins: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
    toolbar: [  ]
} )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#description' ), {
    removePlugins: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
    toolbar: [  ]
}  )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );
</script>
@endsection
