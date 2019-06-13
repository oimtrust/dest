@extends('layouts.global')

@section('title')
Edit Scenario
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Scenarios
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $scenario->feature->story->project->id]) }}">Menus of {{ $scenario->feature->story->project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('scenarios.index', ['id' => $scenario->feature->story->project->id]) }}">Scenarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Scenario</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Edit Scenario</h4>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('scenarios.update', ['scenario_id' => $scenario->id, 'project_id' => $project->id]) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
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
                            <input type="text" class="form-control @error('action') is-invalid @enderror" id="action" name="action" value="{{ $scenario->action }}">
                            @error('action')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prerequisites">Prerequisites</label>
                    <textarea class="form-control @error('prerequisites') is-invalid @enderror" id="prerequisites" name="prerequisites">{{ $scenario->prerequisites }}</textarea>
                    @error('prerequisites')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="test_step">Test Step</label>
                    <textarea class="form-control @error('test_step') is-invalid @enderror" id="test_step" name="test_step">{{ $scenario->test_step }}</textarea>
                    @error('test_step')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                <a href="{{ route('scenarios.index', ['id' => $scenario->feature->story->project->id]) }}" class="btn btn-light">Cancel</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/selectjs-4.0.7/js/select2.min.js') }}"></script>
<script>
var pathName    = window.location.pathname
var getId       = pathName.split("/")
$('#feature_id').select2({
    ajax: {
        url:  '/ajaxSearchFeature/' + getId.pop(),
        processResults: function (data) {
            return {
                results: data.map(function (item) {
                    console.log(item)
                    return {
                        id: item.id,
                        text: item.title
                    }
                })

            }
        }
    }
});

ClassicEditor
.create( document.querySelector( '#prerequisites' ) )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#test_step' ) )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );
</script>
@endsection
