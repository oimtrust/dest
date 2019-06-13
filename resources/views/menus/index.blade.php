@extends('layouts.global')

@section('title')
Dashboard Project
@endsection

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('projects.show', ['id' => $project->id]) }}">{{ $project->title }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenus" aria-controls="navbarmenus" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarmenus">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stories.index', ['id' => $project->id ]) }}">Stories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('scenarios.index', ['id' => $project->id]) }}">Scenarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('testcases.index', ['id' => $project->id]) }}">Testcases</a>
            </li>
        </ul>
    </div>
</nav>

@endsection
