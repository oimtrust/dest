@extends('layouts.global')

@section('title')
Detail Scenario
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Scenario
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $scenario->feature->story->project->id]) }}">Menus of {{ $scenario->feature->story->project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('scenarios.index', ['id' => $scenario->feature->story->project->id]) }}">Scenarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Scenario</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Detail Scenario</h4>

            <form >
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="feature_id">Feature</label>
                            <input type="text" disabled class="form-control" value="{{ $scenario->feature->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Action</label>
                            <input type="text" disabled class="form-control" id="action" name="action" value="{{ $scenario->action }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_by">Created By</label>
                            <input type="text" class="form-control" id="created_by" name="created_by" disabled value="{{ $scenario->createdUser->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_by">Updated By</label>
                            @if ($scenario->updated_by == NULL)
                            <input type="text" class="form-control" id="updated_by" disabled value="-">
                            @else
                            <input type="text" class="form-control" id="updated_by" disabled value="{{ $scenario->updatedUser->name }}">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_at">Created At</label>
                            <input type="text" class="form-control" id="created_at" disabled value="{{ $scenario->created_at }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_at">Updated At</label>
                            <input type="text" class="form-control" id="updated_at" disabled value="{{ $scenario->updated_at }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prerequisites">Prerequisites</label>
                    <textarea class="form-control" id="prerequisites" name="prerequisites">{{ $scenario->prerequisites }}</textarea>
                </div>

                <div class="form-group">
                    <label for="test_step">Test Step</label>
                    <textarea class="form-control" id="test_step" name="test_step">{{ $scenario->test_step }}</textarea>
                </div>

                <a href="{{ route('scenarios.edit', ['project_id' => $project->id, 'scenario_id' => $scenario->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                <a href="{{ route('scenarios.index', ['id' => $scenario->feature->story->project->id]) }}" class="btn btn-light">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>
ClassicEditor
.create( document.querySelector( '#prerequisites' ) , {
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
.create( document.querySelector( '#test_step' ), {
    removePlugins: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
    toolbar: [  ]
}  )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );
</script>
@endsection
