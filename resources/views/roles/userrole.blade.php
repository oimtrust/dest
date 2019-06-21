@extends('layouts.global')

@section('title')
    User Roles
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        User Roles
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Roles</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Users...">
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-gradient-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Role List</h4>
                {{-- @if (session('status'))
                    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}
                <div id="alertTarget"></div>

                <table class="table table-hover table-responsive-xl">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item => $user)
                        <tr>
                            <td>{{ $item + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                <span class="badge badge-success">{{ $role->name }} <a href="#"><i class="mdi mdi-close text-white"></i></a></span>
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-inverse-success btn-rounded btn-icon btn-role" setid="{{ $user->id }}" data-x="{{ $user->id }}"><i class="mdi mdi-plus"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                {{ $users->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @include('roles._addRoles')
            </div>
        </div>
    </div>
</div>
@endsection
