@extends('layouts.global')

@section('title')
    Detail Issue
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Issue
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $issue->testcase->scenario->feature->story->project->id]) }}">Menus of {{ $issue->testcase->scenario->feature->story->project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('testcases.show', ['project_id' => $issue->testcase->scenario->feature->story->project->id, 'testcase_id' => $issue->testcase->id]) }}">Show Testcase</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Issue</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Issue</h4>

                <form >

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" id="type" class="form-control" value="{{ $issue->type }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" disabled value="{{ $issue->status }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity">Severity</label>
                                <input type="text" id="severity" class="form-control" disabled value="{{ $issue->severity }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="text" id="priority" class="form-control" disabled value="{{ $issue->priority }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                <input type="text" id="assigned_to" class="form-control" disabled value="{{ $issue->assignedUser->name }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" disabled value="{{ $issue->title }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" class="form-control" disabled id="created_at" value="{{ $issue->created_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_by">Created By</label>
                                <input type="text" class="form-control" disabled id="created_by" value="{{ $issue->createdUser->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <input type="text" class="form-control" disabled id="updated_at" value="{{ $issue->updated_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_by">Updated By</label>
                                @if ($issue->updated_by == NULL)
                                <input type="text" class="form-control" disabled value="-">
                                @else
                                <input type="text" class="form-control" disabled id="updated_by" value="{{ $issue->updatedUser->name }}">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" >{!! $issue->description !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Image 1</label>
                        @if ($issue->image1)
                        <img src="{{ asset('storage/' . $issue->image1) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Image 2</label>
                        @if ($issue->image2)
                        <img src="{{ asset('storage/' . $issue->image2) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                    </div>

                    <a href="{{ route('issues.edit', ['issue_id' => $issue->id, 'project_id' => $issue->testcase->scenario->feature->story->project->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                    <a href="{{ route('testcases.show',  ['project_id' => $issue->testcase->scenario->feature->story->project->id, 'testcase_id' => $issue->testcase->id]) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>
ClassicEditor
.create( document.querySelector( '#description' ) , {
    removePlugins: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
    toolbar: [  ]
} )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );

</script>
@endsection
