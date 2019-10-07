@extends('layouts.global')

@section('title')
Detail User
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
            <div class="breadcrumb-item">Detail User</div>
        </div>
        </div>

        <div class="section-body">
        <h2 class="section-title">Detail User</h2>
        <p class="section-lead">
            On this page, you can view user details.
        </p>

        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Detail User</h4>
                </div>
                <form enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="name" class="form-control" readonly value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" name="email" class="form-control" readonly value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-7">
                                @if ($user->status == 'ACTIVE')
                                <div class="badge badge-success">{{ $user->status }}</div>
                                @else
                                <div class="badge badge-danger">{{ $user->status }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone" class="form-control" readonly value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                            <div class="card-body">
                                @if ($user->avatar)
                                    <img alt="image" src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid" width="350">
                                @else
                                    <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="img-fluid" width="350">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="address" class="form-control" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 104px;" readonly>{{ $user->address }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                            <a href="{{ route('users.index') }}" class="btn btn-light">Back</a>
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
