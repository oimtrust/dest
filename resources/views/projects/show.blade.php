@extends('layouts.global')

@section('title')
Detail Project
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Project
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Project</li>
        </ol>
    </nav>
</div>

<div class="">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Project</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" >Title</label>
                            <input type="text" class="form-control" id="title" name="title" disabled value="{{ $project->title }}">
                            <small class="form-text text-muted">
                                Slug : <code>{{ $project->slug }}</code>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_by">Created By</label>
                            <input type="text" class="form-control" id="created_by" disabled value="{{ $project->createdUser->name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="owner">Owner</label>
                            <input type="text" class="form-control" id="owner" name="owner" disabled value="{{ $project->owner }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_by">Updated By</label>
                            @if ($project->updated_by == NULL)
                            <input type="text" class="form-control" id="updated_by" disabled value="-">
                            @else
                            <input type="text" class="form-control" id="updated_by" disabled value="{{ $project->updatedUser->name }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_at">Created At</label>
                            <input type="text" class="form-control" id="created_at" disabled value="{{ $project->created_at }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_at">Updated At</label>
                            <input type="text" class="form-control" id="updated_at" disabled value="{{ $project->updated_at }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="assigned_to">Assigned To</label>
                    <ol>
                        @foreach ($project->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" disabled id="description" name="description" rows="4">{{ $project->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo</label> <br/>
                    @if ($project->logo)
                    <img src="{{ asset('storage/' . $project->logo) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                    @else
                    <label class="text-info">No Logo</label>
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="publish" {{ $project->status == 'PUBLISH' ? 'checked' : '' }}>
                                Publish
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="draft" {{ $project->status == 'DRAFT' ? 'checked' : '' }}>
                                Draft
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                <a href="{{ route('projects.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
