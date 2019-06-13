@extends('layouts.global')

@section('title')
    Create Testcase
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Create Testcase
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $project->id]) }}">Menus of {{ $project->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('testcases.index', ['id' => $project->id]) }}">Testcases</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Testcase</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Create Testcase</h4>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('testcases.store', ['id' => $project->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="scenario_id">Scenario</label>
                            <select class="form-control @error('scenario_id') is-invalid @enderror" id="scenario_id" name="scenario_id">
                            </select>
                            @error('scenario_id')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            @error('status')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="expected_result">Expected Result</label>
                    <textarea class="form-control @error('expected_result') is-invalid @enderror" id="expected_result" name="expected_result"></textarea>
                    @error('expected_result')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"></textarea>
                    @error('description')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url">
                </div>

                <div class="form-group">
                    <input type="file" name="picture" class="file-upload-default @error('picture') is-invalid @enderror">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                    </div>
                    @error('picture')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                <a href="{{ route('testcases.index', ['id' => $project->id]) }}" class="btn btn-light">Cancel</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/selectjs-4.0.7/js/select2.min.js') }}"></script>
<script src="{{ asset('js/file-upload.js') }}"></script>
<script>
var pathName    = window.location.pathname
var getId       = pathName.split("/")
$('#scenario_id').select2({
    ajax: {
        url:  '/ajaxSearchScenario/' + getId.pop(),
        processResults: function (data) {
            return {
                results: data.map(function (item) {
                    console.log(item)
                    return {
                        id: item.id,
                        text: item.action
                    }
                })

            }
        }
    }
});

ClassicEditor
.create( document.querySelector( '#expected_result' ) )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#description' ) )
.then( editor => {
console.log( editor );
} )
.catch( error => {
console.error( error );
} );
</script>
@endsection
