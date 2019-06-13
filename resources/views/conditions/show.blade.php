@extends('layouts.global')

@section('title')
Detail Condition
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Condition
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('menus.index', ['id' => $condition->story->project->id]) }}">Menus of {{ $condition->story->project->title }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stories.index', ['id' => $condition->story->project->id]) }}">Story of {{ $condition->story->project->title }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stories.show', ['id' => $condition->story->id]) }}">Detail Story</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Condition</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Detail Condition</h4>

                <form>
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
                                <input type="text" class="form-control" disabled id="status" name="status" value="{{ $condition->status }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" class="form-control" disabled id="created_at" name="created_at" value="{{ $condition->created_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_by">Created By</label>
                                <input type="text" class="form-control" disabled id="created_by" name="created_by" value="{{ $condition->createdUser->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <input type="text" class="form-control" disabled id="updated_at" name="updated_at" value="{{ $condition->updated_at }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_by">Updated By</label>
                                @if ($condition->updated_by == NULL)
                                <input type="text" class="form-control" disabled value="-">
                                @else
                                <input type="text" class="form-control" disabled id="updated_by" name="updated_by" value="{{ $condition->updatedUser->name }}">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pre_condition">Pre Condition</label>
                        <textarea class="form-control" id="pre_condition" name="pre_condition">{{ $condition->pre_condition }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="post_condition">Post Condition</label>
                        <textarea class="form-control" id="post_condition" name="post_condition">{{ $condition->post_condition }}</textarea>
                    </div>

                    <a href="{{ route('conditions.edit', ['id' => $condition->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                    <a href="javascript:history.back();" class="btn btn-light">Cancel</a>
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
.create( document.querySelector( '#pre_condition' ), {
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
.create( document.querySelector( '#post_condition' ), {
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
