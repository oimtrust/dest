@extends('layouts.global')

@section('title')
    Detail Issue
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail Issue
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">My Issues</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Issue</li>
        </ol>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bug-outline"></i>
        </span>
        {{ $issue->testcase->scenario->feature->story->project->title }}
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('issues.done', ['id' => $issue->id]) }}" class="btn btn-outline-success mr-2">
                Set Done
            </a>
        </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Issue</h4>

                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" id="type" class="form-control" value="{{ $issue->type }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" disabled value="{{ $issue->status }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity">Severity</label>
                                <input type="text" id="severity" class="form-control" disabled value="{{ $issue->severity }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="text" id="priority" class="form-control" disabled value="{{ $issue->priority }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                <input type="text" id="assigned_to" class="form-control" disabled value="{{ $issue->assignedUser->name }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" disabled value="{{ $issue->title }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"><b>Description</b></label>
                        <div>
                            {!! $issue->description  !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Image 1</b></label>
                        @if ($issue->image1)
                        <img src="{{ asset('storage/' . $issue->image1) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><b>Image 2</b></label>
                        @if ($issue->image2)
                        <img src="{{ asset('storage/' . $issue->image2) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Image</label>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Comments</h4>
                <blockquote class="blockquote blockquote-primary">
                    @foreach ($issue->comments as $item => $comment)
                    <p>{{ $comment->comment }}</p>
                    @if ($comment->attachment)
                        <a href="{{ asset('storage/' . $comment->attachment) }}" target="_blank"><p>{{ $comment->attachment_slug }}</p></a>
                        @else
                        @endif
                    @if (Auth::user()->id == $comment->created_by)
                        <footer class="blockquote-footer text-right">{{ $comment->createdUser->name }}</footer> <br/>
                    @else
                        <footer class="blockquote-footer">{{ $comment->createdUser->name }}</footer><br/>
                    @endif
                    @endforeach
                </blockquote>
                <form method="POST" action="{{ route('comment.store', ['id' => $issue->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="issue_id" value="{{ $issue->id }}">
                    <div class="form-group">
                        <label for="comment">Add Comment</label>
                        <textarea id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror" rows="4"></textarea>
                        @error('comment')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachment" class="file-upload-default @error('attachment') is-invalid @enderror">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" name="attachment_slug" readonly placeholder="Upload Attachment">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('attachment')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/file-upload.js') }}"></script>
@endsection
