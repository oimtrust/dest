@extends('layouts.global')

@section('title')
Edit Issue
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Edit Issue
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $issue->testcase->scenario->feature->story->project->id]) }}">Menus of {{ $issue->testcase->scenario->feature->story->project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('testcases.show', ['project_id' => $issue->testcase->scenario->feature->story->project->id, 'testcase_id' => $issue->testcase->id]) }}">Show Testcase</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Issue</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Edit Issue</h4>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

                <form method="POST" action="{{ route('issues.update', ['issue_id' => $issue->id, 'project_id' => $issue->testcase->scenario->feature->story->project->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="{{ $issue->type }}" selected>{{ $issue->type }}</option>
                                    <option value="Functional">Functional</option>
                                    <option value="Usability">Usability</option>
                                    <option value="Visual">Visual</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('type')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="{{ $issue->status }}" selected>{{ $issue->status }}</option>
                                    <option value="OPEN">OPEN</option>
                                    <option value="CLOSE">CLOSE</option>
                                    <option value="PENDING">PENDING</option>
                                </select>
                                @error('status')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity">Severity</label>
                                <select name="severity" id="severity" class="form-control @error('severity') is-invalid @enderror">
                                    <option value="{{ $issue->severity }}">{{ $issue->severity }}</option>
                                    <option value="Critical">Critical</option>
                                    <option value="Major">Major</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Low">Low</option>
                                </select>
                                @error('severity')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror">
                                    <option value="{{ $issue->priority }}">{{ $issue->priority }}</option>
                                    <option value="Immediate">Immediate</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                                @error('priority')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                                    <option value="{{ $issue->assigned_to }}">{{ $issue->assignedUser->name }}</option>
                                </select>
                                @error('assigned_to')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $issue->title }}">
                                @error('title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $issue->description }}</textarea>
                        @error('description')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image 1</label> <br/>
                        @if ($issue->image1)
                        <img src="{{ asset('storage/' . $issue->image1) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                        <input type="file" name="image1" class="file-upload-default @error('image1') is-invalid @enderror">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('image1')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image 2</label> <br/>
                        @if ($issue->image2)
                        <img src="{{ asset('storage/' . $issue->image2) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                        <input type="file" name="image2" class="file-upload-default @error('image2') is-invalid @enderror">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('image2')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                    <a href="{{ route('testcases.show',  ['project_id' => $issue->testcase->scenario->feature->story->project->id, 'testcase_id' => $issue->testcase->id]) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/file-upload.js') }}"></script>
<script src="{{ asset('plugins/selectjs-4.0.7/js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>
var pathName    = window.location.pathname
var getId       = pathName.split("/")
$('#assigned_to').select2({
    ajax: {
        url:  '/ajaxAssignedTo/' + getId.pop(),
        processResults: function (data) {
            return {
                results: data.map(function (item) {
                    return {
                        id: item.id,
                        text: item.name
                    }
                })
            }
        }
    }
});


ClassicEditor
.create( document.querySelector( '#description' ))
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
</script>
@endsection
