<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StudyRealm</title>
    <link rel="icon" href="{{ asset('assets/images/Study Realm Light Logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    var event = @json($events);
   $('#calendar').fullCalendar({
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: event,
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDays) {
        $('#scheduleModal').modal('toggle');
        $('#saveBtn').click(function() {
            var title = $("#eventName").val();
            var startDate = start.format('YYYY-MM-DD');
            var endDate = start.format('YYYY-MM-DD');
            $.ajax({
                url: '{{ route("schedule.store") }}',
                type: "POST",
                dataType: 'json',
                data: {
                    title: title,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function(response) {
                    console.log(response);
                    $('#scheduleModal').modal('hide');
                    $('#calendar').fullCalendar('renderEvent', {
                        'title': response.title,
                        'start': response.startDate,
                        'end': response.endDate
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    },


});
});
   
    </script>
</head>

<body>
    @auth
    <div class="sidebar w-2 h-100 text-white p-2" id="blue-colour">
        <div class="col-md-3 sidebar-logo">
            <img class="mt-3" src="{{ asset('assets/images/theLogo.png') }}" alt="Logo">
            <label>
                <h5 class="fw-bold pt-3 pl-2">StudyRealm</h5>
            </label>
        </div>
        <div class="top-nav-items nav-items">
            <a href="{{ route('goal.index') }}" class="{{ Request::is('goals') ? 'active' : '' }} rounded">
                <i class="fa fa-bullseye"></i><label>Goals</label>
            </a>
            <a href="{{ route('tasks') }}" class="{{ Request::is('tasks') ? 'active' : '' }} rounded">
                <i class="fa fa-check"></i><label>Task Manager</label>
            </a>
            <a href="{{ route('schedule') }}" class="{{ Request::is('schedule') ? 'active' : '' }} rounded">
                <i class="fa fa-calendar"></i><label>Schedule</label>
            </a>
            <a href="{{ route('pomodoro') }}" class="{{ Request::is('pomodoro') ? 'active' : '' }} rounded">
                <i class="fa fa-hourglass-start"></i><label>Pomodoro</label>
            </a>
            <a href="{{ url('/report') }}" class="{{ Request::is('report') ? 'active' : '' }} rounded">
                <i class="fa fa-file-text"></i><label>Reports</label>
            </a>
        </div>
        <div class="bottom-nav-items nav-items">
            <a href="{{ route('profile', ['id' => auth()->user()->id]) }}"
                class="{{ Request::is('profile*') ? 'active' : '' }} rounded">
                <i class="fa fa-user"></i><label>{{auth()->user()->name}}</label>
            </a>
            <a href="{{ route('logout') }}" class="{{ Request::is('logout') ? 'active' : '' }} rounded">
                <i class="fa fa-sign-out"></i><label>Sign Out</label>
            </a>
        </div>
    </div>
    <div class="content">
        <h1>Schedule</h1>
        <!-- Modal Form -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scheduleModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <!-- Modal Form -->
        <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="eventName">Event Name: </label>
                        <input id="eventName" name="eventName" type="text" class="form-control"
                            placeholder="Enter Event Name..." required>
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour"><i
                                class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn pink-colour-bg" id="saveBtn"><i class="fa fa-check"></i>
                            Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of Modal Form -->

        <div class="container mt-5">
            <div id="calendar"></div>
        </div>
    </div>
    </div>
    @else
    <h2>User Not Logged in. Please Login or Register an account.</h2>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
    @endauth
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>