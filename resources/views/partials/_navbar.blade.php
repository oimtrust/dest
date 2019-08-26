<!-- Navbar of Stisla -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
            @if (getNotification() != NULL)
            @if (getNotification()->count())
            <i class="far fa-bell"></i>
            @endif
            @endif
        </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @foreach (getNotification() as $notification)
                    @if (getNotification() != NULL)
                    <a href="{{ route('notifications.read', ['issue_id' => $notification->issue_id]) }}" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            @if ($notification->user->avatar == NULL)
                            <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-2.png') }}" class="rounded-circle">
                            @else
                            <img src="{{ asset('storage/' . $notification->user->avatar) }}" alt="image" class="rounded-circle">
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            <b>{{ $notification->createdUser->name }}</b>
                            <p>{{ $notification->comment }}</p>
                            <div class="time">{{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}</div>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>
                <div class="dropdown-footer text-center">
                    @if (getNotification() != NULL)
                    <a href="{{ route('notifications.index') }}">View All <i class="fas fa-chevron-right"></i></a>
                    @endif
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if(\Auth::user())
                @if (Auth::user()->avatar == NULL)
                    <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                @else
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="image" class="rounded-circle mr-1">
                @endif
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.index', ['id' => Auth::user()->id]) }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

