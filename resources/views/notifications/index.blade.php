@extends('layouts.global')

@section('title')
Notifications List
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Notifications
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Notifications List</h4>
                @foreach (getNotification() as $notification)
                <a href="{{ route('notifications.read', ['issue_id' => $notification->issue_id]) }}">
                    <blockquote class="blockquote">
                        <div class="d-flex">
                            @if ($notification->user->avatar == NULL)
                            <img src="{{ asset('images/face.jpg') }}" alt="image" class="img-sm rounded-circle mr-3">
                            @else
                            <img src="{{ asset('storage/' . $notification->user->avatar) }}" alt="image" class="img-sm rounded-circle mr-4">
                            @endif
                            <div class="mb-0 flex-grow">
                                <h5 class="mr-2 mb-2">{{ $notification->createdUser->name }}</h5>
                                <p class="mb-0 font-weight-light">{{ $notification->comment }}</p>
                            </div>
                        </div>
                    </blockquote>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
