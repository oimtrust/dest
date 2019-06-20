@extends('layouts.global')

@section('title')
Detail User
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Detail User
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail User</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Detail User</h4>

                <form >
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" disabled value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" disabled value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="active" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'checked' : '' }}>
                                    Active
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="inactive" value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'checked' : '' }}>
                                    Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" disabled value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label>Avatar</label> <br/>
                        @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Avatar</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" disabled rows="4">{{ $user->address }}</textarea>
                    </div>

                    <a href="{{ route('users.edit', ['id' => $user->id]) }}"  class="btn btn-gradient-warning mr-2">Edit</a>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
