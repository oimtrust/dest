@extends('layouts.global')

@section('title')
Users
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-button">
            <a href="{{ route('users.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus-circle"></i> Create User</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Users</h2>
            <p class="section-lead">
                You can manage Users data from adding, changing, viewing and deleting.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.index') }}">
                                <div class="float-left">
                                    <div class="form-group">
                                        <select class="form-control selectric" id="status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="INACTIVE">INACTIVE</option>
                                        </select>
                                    </div>
                                </div>

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
                                            <th>Status</th>
                                            <th>Avatar</th>
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
                                                @if ($user->status == 'ACTIVE')
                                                <div class="badge badge-success">{{ $user->status }}</div>
                                                @else
                                                <div class="badge badge-danger">{{ $user->status }}</div>
                                                @endif
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
                                            <td>
                                                <div class="buttons">
                                                    <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-icon btn-sm btn-info"><i class="far fa-eye"></i></a>
                                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-icon btn-sm btn-success"><i class="far fa-edit"></i></a>

                                                    @if ($user->id != 1)
                                                    <form method="POST" action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                        onsubmit="return confirm('Are you sure to move user of {{ $user->name }} to trash?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    @endif
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

@section('scripts')
<script>
// if(jQuery().selectric) {
//     $(".selectric").selectric({
//       disableOnMobile: false,
//       nativeOnMobile: false
//     });
// }
</script>
@endsection
