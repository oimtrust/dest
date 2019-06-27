@extends('layouts.global')

@section('title')
Users
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Users
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filters</h4>
                <form action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Names...">
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
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-gradient-primary">Create User</a>
                    </div>
                </div>
                <br/>
                <table class="table table-hover table-responsive-xl">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Avatar</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if ($user->status == 'ACTIVE')
                                <label class="badge badge-success">{{ $user->status }}</label>
                            @else
                                <label class="badge badge-danger">{{ $user->status }}</label>
                            @endif
                        </td>
                        <td>
                            @if ($user->avatar)
                                <img src="{{ asset('storage/'. $user->avatar) }}" alt="image">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.show', ['id' => $user->id]) }}">
                                <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail"><i class="mdi mdi-eye"></i></button>
                            </a>
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="update{{ $user->id }}">
                                <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit" >
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                            </a>

                            @if ($user->id != 1)
                            <form method="POST" action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                onsubmit="return confirm('Are you sure to move to trash?')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" id="delete{{ $user->id }}" class="btn btn-inverse-danger btn-rounded btn-icon btn-delete" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{ $users->appends(Request::all())->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
