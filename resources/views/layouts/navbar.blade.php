<!DOCTYPE html>
<html lang="en">
<head>
    <title>Goals</title>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .pink-colour{
            background-color: #FF6060;
        }
        /* Set the width of the sidebar */
        .sidebar {
            height: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #314559;
            padding-top: 20px;
            padding-left: 10px;
            display: flex;
            flex-direction: column;
        }

        /* Style the sidebar links */
        .sidebar a {
            padding: 8px 0; /* Adjust vertical padding */
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center; /* Align icon and text vertically */
            margin-bottom: 10px;
        }

        /* Change color on hover */
        .sidebar a:hover {
            color: #f1f1f1;
        }

        /* Make the active link pink */
        .sidebar .active {
border-radius: 5px;
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

        /* Main content */
        .content {
            margin-left: 250px;
            padding: 16px;
        }

        /* Navbar Logo styling */
        .navbar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Adjust logo size */
        .navbar-logo img {
            max-width: 80px; /* Set a maximum width for the logo */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Add some spacing between the logo and the text */
            margin-bottom: 30px;
        }

        /* Navbar Logo text styling */
        .navbar-logo p {
            margin: 0;
            font-size: 24px; /* Adjust the font size as needed */
            color: white;
        }

        /* Adjust icon size */
        #nav-items img {
            max-width: 24px; /* Set a maximum width for the icons */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Add some spacing between the icon and the text */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar col-md-2">
        <div class="navbar-logo">
            <img src="{{ asset('assets/images/StudyRealm Dark Logo.png') }}" alt="Logo">
            <p>StudyRealm</p>
        </div>
        <div class="row-md-9" id="nav-items">
            <a href="{{ url('/goals') }}" class="text-white">
                <img src="{{ asset('assets/images/goal-icon.png') }}" alt="Logo"> Goals
            </a>
            
            <a href="{{ url('/taskmanager') }}" class="text-white">
                <img src="{{ asset('assets/images/task-icon.png') }}" alt="Logo"> Task Manager
            </a>
            <a href="{{ url('/schedule') }}" class="text-white"><img src="{{ asset('assets/images/schedule-icon.png') }}" alt="Logo">Schedule</a>
            <a href="{{ url('/pomodoro') }}" class="text-white"><img src="{{ asset('assets/images/pomodoro-icon.png') }}" alt="Logo">Pomodoro</a>
            <a href="{{ url('/report') }}" class="text-white"><img src="{{ asset('assets/images/report-icon.png') }}" alt="Logo">Reports</a>
        </div>
        <div class="row-md-3 mt-auto" id="nav-items">
            <a href="{{ url('/userprofile') }}" class="text-white"><img src="{{ asset('assets/images/profile-icon.png') }}" alt="Logo">Profile</a>
            <a href="{{ url('/') }}" class="text-white"><img src="{{ asset('assets/images/signout-icon.png') }}" alt="Logo">Sign Out</a>
        </div>
    </div>

    <!-- Page content -->
    <div class="content">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
