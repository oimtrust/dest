@extends('layouts.global')

@section('title')
Profile
@endsection

@section('content')
<div class="main-content">
    <section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>

    <div class="section-body">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">Update Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" value="{{ $profile->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" value="{{ $profile->email }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" value="{{ $profile->phone }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                    <div class="col-sm-12 col-md-7">
                                        @if ($profile->avatar)
                                            <figure class="author-box">
                                                <img src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" alt="..." class="rounded-circle author-box-picture">
                                            </figure>
                                        @else
                                        <input type="text" class="form-control" value="No have avatar" readonly>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 104px;" readonly>{{ $profile->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </section>
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
