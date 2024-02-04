<!DOCTYPE html>
<html lang="en">

<head>
    @yield('title')
    <link rel="icon" href="{{ asset('assets/images/Study Realm Light Logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('js/main.js') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @auth
    <div class="sidebar w-2 h-100 blue-colour text-white p-2">
        <div class="col-md-3 sidebar-logo">
            <img src="{{ asset('assets/images/StudyRealm Dark Logo.png') }}" alt="Logo">
            <label>
                <h5 class="fw-bold pt-3 pl-2">StudyRealm</h5>
            </label>
        </div>
        <div class="top-nav-items nav-items">
            <a href="{{ url('/goals') }}" class="{{ Request::is('goals') ? 'active' : '' }} rounded">
                <i class="fa fa-bullseye"></i><label>Goals</label>
            </a>
            <a href="{{ url('/taskmanager') }}" class="{{ Request::is('taskmanager') ? 'active' : '' }} rounded">
                <i class="fa fa-check"></i><label>Task Manager</label>
            </a>
            <a href="{{ url('/schedule') }}" class="{{ Request::is('schedule') ? 'active' : '' }} rounded">
                <i class="fa fa-calendar"></i><label>Schedule</label>
            </a>
            <a href="{{ url('/pomodoro') }}" class="{{ Request::is('pomodoro') ? 'active' : '' }} rounded">
                <i class="fa fa-hourglass-start"></i><label>Pomodoro</label>
            </a>
            <a href="{{ url('/report') }}" class="{{ Request::is('report') ? 'active' : '' }} rounded">
                <i class="fa fa-file-text"></i><label>Reports</label>
            </a>
        </div>
        <div class="bottom-nav-items nav-items">
            <a href="{{ url('/profile') }}" class="{{ Request::is('profile') ? 'active' : '' }} rounded">
                <i class="fa fa-user"></i><label>{{auth()->user()->name}}</label>
            </a>
            <a href="{{ route('logout') }}" class="{{ Request::is('logout') ? 'active' : '' }} rounded">
                <i class="fa fa-sign-out"></i><label>Sign Out</label>
            </a>
        </div>
    </div>
    <!-- Page content -->
    <div class="content">
        @yield('content')
    </div>
    </div>
    @else
    <h2>User Not Logged in. Please Login or Register an account.</h2>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
    @endauth

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>