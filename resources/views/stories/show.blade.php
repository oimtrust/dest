@extends('layouts.global')

@section('title')
Detail Story
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Story
    </h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('menus.index', ['id' => $story->project->id]) }}">Menus of {{ $story->project->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('stories.index', ['id' => $story->id]) }}">Stories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Story</li>
        </ol>
    </nav>
</div>
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Detail Story</h4>

            <form >
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_id">Project</label>
                            <input type="text" class="form-control" name="project_id" disabled value="{{ $story->project->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="epic">Epic</label>
                            <input type="text" class="form-control" id="epic" name="epic" disabled value="{{ $story->epic }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_by">Created By</label>
                            <input type="text" class="form-control" id="created_by" name="created_by" disabled value="{{ $story->createdUser->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_by">Updated By</label>
                            @if ($story->updated_by == NULL)
                            <input type="text" class="form-control" id="updated_by" disabled value="-">
                            @else
                            <input type="text" class="form-control" id="updated_by" disabled value="{{ $story->updatedUser->name }}">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_at">Created At</label>
                            <input type="text" class="form-control" id="created_at" disabled value="{{ $story->created_at }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="updated_at">Updated At</label>
                            <input type="text" class="form-control" id="updated_at" disabled value="{{ $story->updated_at }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user_story">User Story</label>
                    <textarea class="form-control" id="user_story" name="user_story" disabled rows="4">{{ $story->user_story }}</textarea>
                </div>

                <div class="form-group">
                    <label for="acceptance_criteria">Acceptance Criteria</label>
                    <textarea class="form-control" id="acceptance_criteria" name="acceptance_criteria" disabled rows="4">{{ $story->acceptance_criteria }}</textarea>
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <textarea class="form-control" id="data" name="data" disabled rows="4">{{ $story->data }}</textarea>
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea class="form-control" id="note" name="note" disabled rows="4">{{ $story->note }}</textarea>
                </div>

                <a href="{{  route('stories.edit', ['id' => $story->id]) }}" class="btn btn-gradient-warning mr-2">Edit</a>
                <a href="{{ route('stories.index', ['id' => $story->project->id]) }}" class="btn btn-light">Cancel</a>
            </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Condition List</h4>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('conditions.create', ['id' => $story->id]) }}" class="btn btn-gradient-primary">Create Condition</a>
                    </div>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Pre Condition</th>
                            <th>Post Condition</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($conditions as $index => $condition)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ strip_tags($condition->pre_condition) }}</td>
                                <td>{{ strip_tags($condition->post_condition) }}</td>
                                <td>{{ $condition->status }}</td>
                                <td>{{ $condition->created_at }}</td>
                                <td>
                                    @if ($condition->created_by == NULL)
                                    -
                                    @else
                                    {{ $condition->createdUser->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($condition->updated_by == NULL)
                                    -
                                    @else
                                    {{ $condition->updatedUser->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('conditions.show', ['id' => $condition->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('conditions.edit', ['id' => $condition->id]) }}">
                                        <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ route('conditions.destroy', ['id' => $condition->id]) }}"
                                        onsubmit="return confirm('Are you sure delete this condition permanently?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon btn-delete" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $conditions->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Feature List</h4>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('features.create', ['id' => $story->id]) }}" class="btn btn-gradient-primary">Create Feature</a>
                    </div>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $index => $feature)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->created_at }}</td>
                                <td>
                                    @if ($feature->created_by == NULL)
                                    -
                                    @else
                                    {{ $feature->createdUser->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($feature->updated_by == NULL)
                                    -
                                    @else
                                    {{ $feature->updatedUser->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('features.show', ['id' => $feature->id]) }}">
                                        <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('features.edit', ['id' => $feature->id]) }}">
                                        <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ route('features.destroy', ['id' => $feature->id]) }}"
                                        onsubmit="return confirm('Move this feature to trash?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon btn-delete" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $features->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/ckeditor5-12.1.0/ckeditor.js') }}"></script>
<script>

ClassicEditor
.create( document.querySelector( '#user_story' ), {
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
.create( document.querySelector( '#acceptance_criteria' ), {
    removePlugins: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
    toolbar: [  ]
})
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

ClassicEditor
.create( document.querySelector( '#data' ), {
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
.create( document.querySelector( '#note' ), {
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
