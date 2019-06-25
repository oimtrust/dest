@extends('layouts.global')

@section('title')
Trashed Users
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Trashed Users
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Trashed Users</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('trash.users') }}">
                    <div class="row">
                        <div class="col-lg-12">
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
                <h4 class="card-title">User List</h4>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
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
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if ($user->avatar)
                                        <img src="{{ asset('storage/'. $user->avatar) }}" alt="image">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->deleted_at }}</td>
                                    <td>{{ $user->deletedUser->name }}</td>
                                    <td>
                                        <a href="{{ route('users.restore', ['id' => $user->id]) }}">
                                            <button type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Restore"><i class="mdi mdi-backup-restore"></i></button>
                                        </a>
                                        <form method="POST" action="{{ route('users.delete-permanent', ['id' => $user->id]) }}"
                                            onsubmit="return confirm('Delete this User permanently?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Permanent">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
