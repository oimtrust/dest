@extends('layouts.global')

@section('title')
Update Condition
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Update Condition
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index', ['id' => $condition->story->project->id]) }}">Menus of {{ $condition->story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.index', ['id' => $condition->story->project->id]) }}">Story of {{ $condition->story->project->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stories.show', ['id' => $condition->story->id]) }}">Detail Story</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Condition</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Update Condition</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('conditions.update', ['id' => $condition->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="epic">Epic</label>
                                <input type="text" class="form-control" disabled id="epic" name="epic" value="{{ $condition->story->epic }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ $condition->status }}">
                                @error('status')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pre_condition">Pre Condition</label>
                        <textarea class="form-control @error('pre_condition') is-invalid @enderror" id="pre_condition" name="pre_condition">{{ $condition->pre_condition }}</textarea>
                        @error('pre_condition')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="post_condition">Post Condition</label>
                        <textarea class="form-control @error('post_condition') is-invalid @enderror" id="post_condition" name="post_condition">{{ $condition->post_condition }}</textarea>
                        @error('post_condition')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                    <a href="{{ route('stories.show', ['id' => $condition->story->id]) }}" class="btn btn-light">Cancel</a>
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
.create( document.querySelector( '#pre_condition' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#post_condition' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
</script>
@endsection
