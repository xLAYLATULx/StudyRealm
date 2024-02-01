<!DOCTYPE html>
<html lang="en">
<head>
    @yield('title')
    <link rel="icon" href="{{ asset('assets/images/Study Realm Light Logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('js/main.js') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    @auth
    <div class="container">
        
        <div class="sidebar" id="sidebar">
            <span onclick="toggleNav()" id="toggleButton">&#9776;</span>
            <div class="navbar-logo">
                <img src="{{ asset('assets/images/StudyRealm Dark Logo.png') }}" alt="Logo">
                <p>StudyRealm</p>
            </div>
            <div class="row-md-9" id="nav-items">
                <a href="{{ url('/goals') }}" class="text-white"><img src="{{ asset('assets/images/goal-icon.png') }}" alt="Logo"> <label>Goals</label></a>
                <a href="{{ url('/taskmanager') }}" class="text-white"><img src="{{ asset('assets/images/task-icon.png') }}" alt="Logo"> <label>Task Manager</label></a>
                <a href="{{ url('/schedule') }}" class="text-white"><img src="{{ asset('assets/images/schedule-icon.png') }}" alt="Logo"><label>Schedule</label></a>
                <a href="{{ url('/pomodoro') }}" class="text-white"><img src="{{ asset('assets/images/pomodoro-icon.png') }}" alt="Logo"><label>Pomodoro</label></a>
                <a href="{{ url('/report') }}" class="text-white"><img src="{{ asset('assets/images/report-icon.png') }}" alt="Logo"><label>Reports</label></a>
            </div>
            
            <div class="row-md-3 mt-auto" id="nav-items">
                <a href="{{ url('/userprofile') }}" class="text-white"><img src="{{ asset('assets/images/profile-icon.png') }}" alt="Logo"><label>{{auth()->user()->name}}</label></a>
                <a href="{{ route('logout') }}" class="text-white"><img src="{{ asset('assets/images/signout-icon.png') }}" alt="Logo"><label>Sign Out</label></a>
            </div>
        </div>
    <!-- Page content -->
    <div class="content" >
        @yield('content')
    </div>
    </div>
    @else
    <h2>User Not Logged in. Please Login or Regiser an account.</h2>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a> 
    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
    @endauth
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
