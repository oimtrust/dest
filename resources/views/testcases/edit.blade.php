@extends('layouts.global')

@section('title')
    Edit Testcase
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Edit Testcase
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $testcase->scenario->feature->story->project->id]) }}">Menus of {{ $testcase->scenario->feature->story->project->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('testcases.index', ['id' => $testcase->scenario->feature->story->project->id]) }}">Testcases</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Testcase</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Edit Testcase</h4>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('testcases.update', ['testcase_id' => $testcase->id, 'project_id' => $testcase->scenario->feature->story->project->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="scenario_id">Scenario</label>
                            <select class="form-control @error('scenario_id') is-invalid @enderror" id="scenario_id" name="scenario_id">
                                <option value="{{ $testcase->scenario_id }}">{{ $testcase->scenario->action }}</option>
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
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" onchange="showField(this.options[this.selectedIndex].value)">
                                <option value="{{ $testcase->status }}" selected>{{ $testcase->status }}</option>
                                <option value="NONE">NONE</option>
                                <option value="PASS">PASS</option>
                                <option value="FAIL">FAIL</option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="other">
                                <input type="text" name="other_status" class="form-control">
                            </div>
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
                    <textarea class="form-control @error('expected_result') is-invalid @enderror" id="expected_result" name="expected_result">{{ $testcase->expected_result }}</textarea>
                    @error('expected_result')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $testcase->description }}</textarea>
                    @error('description')
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $testcase->url }}">
                </div>

                <div class="form-group">
                    <label>Picture</label><br/>
                    <small class="text-muted">Current Picture : </small><br/>
                    @if ($testcase->picture)
                    <img src="{{ asset('storage/' . $testcase->picture) }}" class="mb-2 rounded" style="width: 400px" alt="image">
                    @else
                    <label class="text-info">No Picture</label>
                    @endif
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

                <button type="submit" class="btn btn-gradient-warning mr-2">Update</button>
                <a href="{{ route('testcases.index', ['id' => $testcase->scenario->feature->story->project->id]) }}" class="btn btn-light">Cancel</a>
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

function showField(name) {
    if (name == 'Other') {
        document.getElementById('other').style.display = 'block';
    } else {
        document.getElementById('other').style.display = 'none';
    }
}

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
