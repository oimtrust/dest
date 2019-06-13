@extends('layouts.global')

@section('title')
Profile
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        My Profile
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
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
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="profile" aria-selected="false">Update Password</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form >
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" disabled value="{{ $profile->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" disabled value="{{ $profile->email }}">
                            </div>

                            <div class="form-group">
                                <label class="">Roles</label>
                                @include('profile._roles-show')
                            </div>


                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" disabled value="{{ $profile->phone }}">
                            </div>

                            <div class="form-group">
                                <label>Avatar</label> <br/>
                                @if ($profile->avatar)
                                <img src="{{ asset('storage/' . $profile->avatar) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                                @else
                                <label class="text-info">No Avatar</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" disabled rows="4">{{ $profile->address }}</textarea>
                            </div>

                            <a href="{{ route('profile.edit', ['id' => $profile->id]) }}"  class="btn btn-gradient-warning mr-2">Edit</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">



                        <form method="POST" action="{{ route('updatePassword', ['id' => $profile->id]) }}">
                            @csrf

                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-gradient-primary" onclick="showOldPassword()" type="button">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('old_password')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-gradient-primary" onclick="showNewPassword()" type="button">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('new_password')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-gradient-primary" onclick="showConfirmPassword()" type="button">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <button type="submit"  class="btn btn-gradient-warning mr-2">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
// Visibility for password
function showOldPassword() {
    var field = document.getElementById("old_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

function showNewPassword() {
    var field = document.getElementById("new_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

function showConfirmPassword() {
    var field = document.getElementById("password_confirmation");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

</script>
@endsection
