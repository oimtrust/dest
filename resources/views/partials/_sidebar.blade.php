<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Dest</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">Ac</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i> <span> Dashboard</span></a></li>
            @if (Auth::user()->roles()->where('slug', 'admin')->first())
                <li class="menu-header">Users & Privileges</li>
                <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i><span>Users</span></a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Privileges</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        <li><a class="nav-link" href="{{ route('userrole.index') }}">User Roles</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->roles()->where('slug', '!=', 'developer')->first())
                <li class="menu-header">Projects</li>
                <li><a class="nav-link" href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i><span>Projects</span></a></li>
            @endif
            @if (Auth::user()->roles()->where('slug', '!=', 'developer')->where('slug', '!=', 'project-manager')->first())
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i><span>My Projects</span></a>
                    <ul class="dropdown-menu">
                        @foreach (getMenu() as $project)
                        <li><a class="nav-link" href="{{ route('menus.index', ['id' => $project->id]) }}">{{ $project->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if (Auth::user()->roles()->where('slug', '!=', 'quality-assurance')->where('slug', '!=', 'project-manager')->first())
                <li class="menu-header">Tasks</li>
                <li><a class="nav-link" href="{{ route('issues.index') }}"><i class="fas fa-bug"></i><span>My Issues</span></a></li>
            @endif
            @if (Auth::user()->roles()->where('slug', 'admin')->first())
                <li class="menu-header">Trash Bin</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-trash"></i><span>Trash</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('trash.users') }}">Users</a></li>
                        <li><a class="nav-link" href="{{ route('trash.projects') }}">Projects</a></li>
                        <li><a class="nav-link" href="{{ route('trash.stories') }}">Stories</a></li>
                        <li><a class="nav-link" href="{{ route('trash.features') }}">Features</a></li>
                        <li><a class="nav-link" href="{{ route('trash.scenarios') }}">Scenarios</a></li>
                        <li><a class="nav-link" href="{{ route('trash.testcases') }}">Testcases</a></li>
                        <li><a class="nav-link" href="{{ route('trash.issues') }}">Issues</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
</div>

