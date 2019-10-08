@extends('layouts.global')

@section('title')
Trashed Users
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Trashed Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Trashed Users</div>
        </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Trashed Users</h2>
            <p class="section-lead">
                You can manage Users data to restore or permanent delete.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Trashed Users</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('trash.users') }}">

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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                            #
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Avatar</th>
                                            <th>Address</th>
                                            <th>Deleted At</th>
                                            <th>Deleted By</th>
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
                                                {{ $user->phone }}
                                            </td>
                                            <td>
                                                @if ($user->avatar)
                                                <figure class="author-box">
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="..." class="rounded-circle author-box-picture">
                                                </figure>
                                                @else
                                                    <figure class="author-box">
                                                        <img src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" alt="..." class="rounded-circle author-box-picture">
                                                    </figure>
                                                @endif
                                            </td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->deleted_at }}</td>
                                            <td>{{ $user->deletedUser->name }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <a href="{{ route('users.restore', ['id' => $user->id]) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-trash-restore"></i></a>
                                                    <form method="POST" action="{{ route('users.delete-permanent', ['id' => $user->id]) }}"
                                                        onsubmit="return confirm('Delete this User permanently?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
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
