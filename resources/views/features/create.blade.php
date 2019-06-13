@extends('layouts.global')

@section('title')
Create Feature
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Create Feature
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index', ['id' => $story->project->id]) }}">Menus of {{ $story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.index', ['id' => $story->project->id]) }}">Story of {{ $story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.show', ['id' => $story->id]) }}">Detail Story</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Feature</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Feature</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('features.store', ['id' => $story->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="epic">Epic</label>
                                <input type="text" class="form-control" disabled id="epic" name="epic" value="{{ $story->epic }}">
                                <input type="hidden" value="{{ $story->id }}" name="story_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                                @error('title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="4"></textarea>
                        @error('note')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                    <a href="{{ route('stories.show', ['id' => $story->id]) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
