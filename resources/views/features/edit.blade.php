@extends('layouts.global')

@section('title')
Edit Feature
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
            <li class="breadcrumb-item active" aria-current="page">Edit Feature</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Feature</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('features.update', ['id' => $feature->story->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="epic">Epic</label>
                                <input type="text" class="form-control" disabled id="epic" name="epic" value="{{ $feature->story->epic }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $feature->title }}">
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
                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="4">{{ $feature->note }}</textarea>
                        @error('note')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                    <a href="{{ route('stories.show', ['id' => $feature->story->id]) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
