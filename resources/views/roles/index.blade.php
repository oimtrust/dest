@extends('layouts.global')

@section('title')
    Roles
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Roles</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Roles</div>
        </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Roles</h2>
            <p class="section-lead">
                Description of roles for users
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Roles</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.index') }}">

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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                            #
                                            </th>
                                            <th>Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($roles as $item => $role)
                                        <tr>
                                            <td>
                                                {{ $item + 1 }}
                                            </td>
                                            <td>
                                                {{ $role->name }}
                                            </td>
                                            <td>
                                                {{ $role->description }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    {{ $roles->links() }}
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
