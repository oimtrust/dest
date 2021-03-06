@extends('layouts.global')

@section('title')
Edit Project
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Edit Project
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Edit Project</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('projects.update', ['id' => $project->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $project->title }}">
                                @error('title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                <select class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to[]" multiple>
                                </select>
                                @error('assigned_to')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control @error('owner') is-invalid @enderror" id="owner" name="owner" value="{{ $project->owner }}">
                        @error('owner')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ $project->description }}</textarea>
                        @error('description')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Logo</label> <br/>
                        @if ($project->logo)
                        <img src="{{ asset('storage/' . $project->logo) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Logo</label>
                        @endif

                        <input type="file" name="logo" class="file-upload-default @error('logo') is-invalid @enderror">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('logo')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="publish" value="PUBLISH" {{ $project->status == 'PUBLISH' ? 'checked' : '' }}>
                                    Publish
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="draft" value="DRAFT" {{ $project->status == 'DRAFT' ? 'checked' : '' }}>
                                    Draft
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/file-upload.js') }}"></script>
<script src="{{ asset('plugins/selectjs-4.0.7/js/select2.min.js') }}"></script>
<script>
$('#assigned_to').select2({
    ajax: {
        url:  '/ajaxSearchUser',
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

var users   = {!! $project->users !!}
users.forEach(function (assigned_to) {
    var option = new Option(assigned_to.name, assigned_to.id, true, true);
    $('#assigned_to').append(option).trigger('change');
});
</script>
@endsection
