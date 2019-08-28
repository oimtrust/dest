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
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                            <span>×</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
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
                            <div class="card">
                                <form method="POST" action="{{ route('updatePassword', ['id' => $profile->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old Password</label>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="input-group">
                                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="showOldPassword()"><i class="far fa-eye"></i></button>
                                                    </div>
                                                    @error('old_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New Password</label>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="input-group">
                                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="showNewPassword()"><i class="far fa-eye"></i></button>
                                                    </div>
                                                    @error('new_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm Password</label>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="input-group">
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="showConfirmPassword()"><i class="far fa-eye"></i></button>
                                                    </div>
                                                    @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary">Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
