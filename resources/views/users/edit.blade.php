@extends('layouts.global')

@section('title')
Edit User
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Edit User
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>
</div>

<div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Edit User</h4>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                        @error('name')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                        @error('email')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status" id="active" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'checked' : '' }}>
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
                            <div class="col-sm-3">
                                @error('status')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" onkeypress="return isNumberKey(event)" value="{{ $user->phone }}">
                        @error('phone')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Avatar</label><br/>
                        <small class="text-muted">Current Avatar : </small><br/>
                        @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="mb-2 rounded" style="width: 200px" alt="image">
                        @else
                        <label class="text-info">No Avatar</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar" class="file-upload-default @error('avatar') is-invalid @enderror">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('avatar')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') @enderror" id="address" name="address" rows="4">{{ $user->address }}</textarea>
                        @error('address')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <button type="submit"  class="btn btn-gradient-primary mr-2">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
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
</script>
<script src="{{ asset('js/file-upload.js') }}"></script>
@endsection
