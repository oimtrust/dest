@extends('layouts.global')

@section('title')
Detial Feature
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Feature
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index', ['id' => $feature->story->project->id]) }}">Menus of {{ $feature->story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.index', ['id' => $feature->story->project->id]) }}">Story of {{ $feature->story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.show', ['id' => $feature->story->id]) }}">Detail Story</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Feature</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Feature</h4>

                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="epic">Epic</label>
                                <input type="text" class="form-control" disabled id="epic" name="epic" value="{{ $feature->story->epic }}">
                                <input type="hidden" value="{{ $feature->story->id }}" name="story_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" disabled id="title" name="title" value="{{ $feature->title }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" class="form-control" disabled id="created_at" name="created_at" value="{{ $feature->created_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_by">Created By</label>
                                <input type="text" class="form-control" disabled id="created_by" name="created_by" value="{{ $feature->createdUser->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <input type="text" class="form-control" disabled id="updated_at" name="updated_at" value="{{ $feature->updated_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_by">Updated By</label>
                                @if ($feature->updated_by == NULL)
                                <input type="text" class="form-control" disabled value="-">
                                @else
                                <input type="text" class="form-control" disabled id="updated_by" name="updated_by" value="{{ $feature->updatedUser->name }}">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" disabled name="note" rows="4">{{ $feature->note }}</textarea>
                    </div>

                    <a href="{{ route('features.edit', ['id' => $feature->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                    <a href="{{ route('stories.show', ['id' => $feature->story->id] ) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
