@extends('layouts.global')

@section('title')
Edit User
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
            <div class="breadcrumb-item">Edit User</div>
        </div>
        </div>

        <div class="section-body">
        <h2 class="section-title">Edit User</h2>
        <p class="section-lead">
            On this page, you can update user data by inputting all data in the available fields.
        </p>

        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Edit User</h4>
                </div>
                <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-{{ session('type') }} alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                <span>×</span>
                                </button>
                                {{ session('status') }}
                            </div>
                        </div>
                        @endif

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                    <input type="radio" name="status" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'checked' : '' }} class="selectgroup-input @error('status') is-invalid @enderror">
                                    <span class="selectgroup-button">ACTIVE</span>
                                    </label>
                                    <label class="selectgroup-item">
                                    <input type="radio" name="status" value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'checked' : '' }} class="selectgroup-input">
                                    <span class="selectgroup-button">INACTIVE</span>
                                    </label>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" onkeypress="return isNumberKey(event)">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                            <div class="col-sm-12 col-md-7">
                                @if ($user->avatar)
                                    <img alt="image" src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid" width="350">
                                @else
                                    <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="img-fluid" width="350">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="avatar" id="image-upload" class="@error('avatar') is-invalid @enderror">
                                </div>
                            </div>
                            @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 104px;">{{ $user->address }}</textarea>
                            </div>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')

<script>
// Number Input
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$.uploadPreview({
  input_field: "#image-upload",   // Default: .image-upload
  preview_box: "#image-preview",  // Default: .image-preview
  label_field: "#image-label",    // Default: .image-label
  label_default: "Choose File",   // Default: Choose File
  label_selected: "Change File",  // Default: Change File
  no_label: false,                // Default: false
  success_callback: null          // Default: null
});
</script>
@endsection
