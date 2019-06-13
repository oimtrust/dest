@extends('layouts.global')

@section('title')
Create Scenario
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Scenarios
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $project->id]) }}">Menus of {{ $project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('scenarios.index', ['id' => $project->id]) }}">Scenarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Scenario</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Create Scenario</h4>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('scenarios.store', ['id' => $project->id]) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="feature_id">Feature</label>
                            <select class="form-control @error('feature_id') is-invalid @enderror" id="feature_id" name="feature_id">
                            </select>
                            @error('feature_id')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Action</label>
                            <input type="text" class="form-control @error('action') is-invalid @enderror" id="action" name="action">
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
                    <textarea class="form-control @error('prerequisites') is-invalid @enderror" id="prerequisites" name="prerequisites"></textarea>
                    @error('prerequisites')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="test_step">Test Step</label>
                    <textarea class="form-control @error('test_step') is-invalid @enderror" id="test_step" name="test_step"></textarea>
                    @error('test_step')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                <a href="{{ route('scenarios.index', ['id' => $project->id]) }}" class="btn btn-light">Cancel</a>
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
