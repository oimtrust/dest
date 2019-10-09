@extends('layouts.global')

@section('title')
    User Roles
@endsection

@section('content')
<div class="main-content">
    @include('roles._addRoles')
    <section class="section">
        <div class="section-header">
        <h1>User Roles</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">User Roles</div>
        </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">User Roles</h2>
            <p class="section-lead">
                On this page, you can manage the role to users
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Roles</h4>
                        </div>
                        <div class="card-body">
                            <form action="#">

                                <div class="float-right">
                                    <div class="input-group">
                                        <input name="keyword" type="text" class="form-control" placeholder="Search Names...">
                                        <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="clearfix mb-3"></div>
                            <div id="alertTarget"></div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                            #
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $item => $user)
                                        <tr>
                                            <td>
                                                {{ $item + 1 }}
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                <span class="badge badge-success">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($user->id != 1)
                                                <button class="btn btn-icon btn-sm btn-info btn-role" data-toggle="modal" data-target="#create" setid="{{ $user->id }}" data-x="{{ $user->id }}"><i class="fas fa-plus-circle" id="modal{{ $user->id }}"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="float-right">
                                <nav>
                                    {{ $users->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
