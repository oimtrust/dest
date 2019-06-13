@extends('layouts.global')

@section('title')
Edit Story
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Edit Story
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $story->project->id]) }}">Menus of {{ $story->project->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('stories.index', ['id' => $story->project->id]) }}">Stories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Story</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Edit Story</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('stories.update', ['id' => $story->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project">Project</label>
                                <input type="text" class="form-control" id="project" name="project" value="{{ $story->project->title }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="epic">Epic</label>
                                <input type="text" class="form-control @error('epic') is-invalid @enderror" id="epic" name="epic" value="{{ $story->epic }}">
                                @error('epic')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_story">User Story</label>
                        <textarea class="form-control @error('user_story') is-invalid @enderror" id="user_story" name="user_story">{{ $story->user_story }}</textarea>
                        @error('user_story')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="acceptance_criteria">Acceptance Criteria</label>
                        <textarea class="form-control @error('acceptance_criteria') is-invalid @enderror" id="acceptance_criteria" name="acceptance_criteria">{{ $story->acceptance_criteria }}</textarea>
                        @error('acceptance_criteria')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="data">Data</label>
                        <textarea class="form-control @error('data') is-invalid @enderror" id="data" name="data">{{ $story->data }}</textarea>
                        @error('data')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note">{{ $story->note }}</textarea>
                        @error('note')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                    <a href="{{ route('stories.index', ['id' => $story->project_id]) }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/file-upload.js') }}"></script>
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>
ClassicEditor
.create( document.querySelector( '#user_story' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#acceptance_criteria' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#data' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#note' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

</script>
@endsection
