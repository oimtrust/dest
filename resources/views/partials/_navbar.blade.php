<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img src="{{ asset('images/dest-logos/dest-v1-300x66.png') }}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('images/dest-logos/dest-v1-150x150.png') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field d-none d-md-block">
        <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
            </div>
        </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                @if(\Auth::user())
                <div class="nav-profile-img">
                    @if (Auth::user()->avatar == NULL)
                    <img src="{{ asset('images/face.jpg') }}" alt="image">
                    @else
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="image">
                    @endif
                <span class="availability-status online"></span>
            </div>

            <div class="nav-profile-text">
                <p class="mb-1 text-black" id="clickName">{{ Auth::user()->name }}</p>
            </div>
            </a>

            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('profile.index', ['id' => Auth::user()->id]) }}">
                <i class="mdi mdi-account mr-2 text-success"></i>
                My Profile
                @endif
            </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                {{ __('Signout') }}
            </a>
            <form id="logout-form" action="{{ route("logout") }}" method="POST">
                @csrf
            </form>
            </div>
        </li>
        <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                @if (getNotification() != NULL)
                @if (getNotification()->count())
                <span class="count-symbol bg-danger"></span>
                @endif
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            <h6 class="p-3 mb-0">Notifications</h6>
            @foreach (getNotification() as $notification)
            <div class="dropdown-divider"></div>
            @if (getNotification() != NULL)
                <a class="dropdown-item preview-item" href="{{ route('notifications.read', ['issue_id' => $notification->issue_id]) }}">
                    <div class="preview-thumbnail">
                        @if ($notification->user->avatar == NULL)
                        <img src="{{ asset('images/face.jpg') }}" alt="image" class="profile-pic">
                        @else
                        <img src="{{ asset('storage/' . $notification->user->avatar) }}" alt="image" class="profile-pic">
                        @endif
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h5 class="preview-subject ellipsis mb-1 font-weight-normal"> {{ $notification->createdUser->name }}</h5>
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal"> {{ $notification->comment }}</h6>
                    <p class="text-gray mb-0">
                        {{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}
                    </p>
                    </div>
                </a>

            @endif
            @endforeach
            <div class="dropdown-divider"></div>
            @if (getNotification() != NULL)
            <h6 class="p-3 mb-0 text-center"><a href="{{ route('notifications.index') }}">Show More...</a></h6>
            @endif
            </div>
        </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
