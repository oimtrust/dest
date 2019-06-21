<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
            @if(\Auth::user())
            <div class="nav-profile-image">
                @if (Auth::user()->avatar == NULL)
                <img src="{{ asset('images/face.jpg') }}" alt="image">
                @else
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="image">
                @endif
            <span class="login-status online"></span> <!--change to offline or busy as needed-->
            </div>

            <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
            <span class="text-secondary text-small">{{ Auth::user()->email }}</span>
            </div>
            @endif
            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home-outline menu-icon"></i>
        </a>
        </li>
        @if (Auth::user()->roles()->where('slug', 'admin')->first())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                  <span class="menu-title">Users</span>
                  <i class="mdi mdi-account-outline menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#trash" aria-expanded="false" aria-controls="trash">
                    <span class="menu-title">User Privileges</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-key-outline menu-icon"></i>
                </a>
                <div class="collapse" id="trash">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('userrole.index') }}">User Roles</a></li>
                    </ul>
                </div>
            </li>
        @endif

        @if (Auth::user()->roles()->where('slug', '!=', 'developer')->first())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <span class="menu-title">Projects</span>
                    <i class="mdi mdi-briefcase-outline menu-icon"></i>
                </a>
            </li>
        @endif

        @if (Auth::user()->roles()->where('slug', '!=', 'developer')->where('slug', '!=', 'project-manager')->first())
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#myprojects" aria-expanded="false" aria-controls="myprojects">
                    <span class="menu-title">My Projects</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-checkbox-multiple-marked-outline menu-icon"></i>
                </a>
                <div class="collapse" id="myprojects">
                    <ul class="nav flex-column sub-menu">
                        @foreach (getMenu() as $project)
                            <li class="nav-item">
                                <a href="{{ route('menus.index', ['id' => $project->id]) }}" class="nav-link">
                                    {{ $project->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif

        @if (Auth::user()->roles()->where('slug', '!=', 'quality-assurance')->where('slug', '!=', 'project-manager')->first())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('issues.index') }}">
                <span class="menu-title">My Issues</span>
                <i class="mdi mdi-bug-outline menu-icon"></i>
            </a>
        </li>
        @endif

        @if (Auth::user()->roles()->where('slug', 'admin')->first())
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#trash" aria-expanded="false" aria-controls="trash">
                    <span class="menu-title">Trash</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-delete-variant menu-icon"></i>
                </a>
                <div class="collapse" id="trash">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.users') }}">Users</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.projects') }}">Projects</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.stories') }}">Stories</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.features') }}">Features</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.scenarios') }}">Scenarios</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.testcases') }}">Testcases</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('trash.issues') }}">Issues</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>
