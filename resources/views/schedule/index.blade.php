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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
$(document).ready(function() {
    function getCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    }
    $('#eventStart').val(getCurrentDateTime());
    $('#eventEnd').val(getCurrentDateTime());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var events = @json($events);

    $('#calendar').fullCalendar({
        height: 600,
        timeFormat: 'HH:mm',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: events,
        selectable: true,
        selectHelper: true,
        defaultView: 'agendaDay',
        select: function(start, end, allDays) {
            $('#scheduleModal').modal('toggle');
            var startE = moment(start).format('YYYY-MM-DD HH:mm:ss');
            var endE = (end == null) ? start : moment(end).format('YYYY-MM-DD HH:mm:ss');
            $('#eventStart').val(startE);
            $('#eventEnd').val(endE);
            $('#saveFullBtn').click(function() {
                var title = $("#eventName").val();
                var description = $("#eventDescription").val();
                var startDate = $("#eventStart").val();
                var endDate = $("#eventEnd").val();
                var isGoal = '0';
                var isTask = '0';
                $.ajax({
                    url: '{{ route("schedule.store") }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        title: title,
                        description: description,
                        startDate: startDate,
                        endDate: endDate,
                        isGoal: isGoal,
                        isTask: isTask,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#scheduleModal').modal('hide');
                        $('#calendar').fullCalendar('renderEvent', {
                            'id': response.id,
                            'title': response.title,
                            'description': response.description,
                            'start': response.startDate,
                            'end': response.endDate,
                            'isGoal' : response.isGoal,
                            'isTask' : response.isTask,
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        },
        editable: true,
        eventDrop: function(event, delta, revertFunc) {
            var id = event.id;
            var startDate = event.start.format('YYYY-MM-DD');
            var endDate = (event.end == null) ? startDate : event.end.format('YYYY-MM-DD');
            $.ajax({
                url: '{{ route("schedule.drag", "") }}' + '/' + id,
                type: "PATCH",
                dataType: 'json',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function(response) {
                    swal("Done!", "Event Updated Successfully!", "success");
                },
                error: function(error) {
                    console.log(error)
                }
            });
        },
        
        eventClick: function(event) {
            $('#editEventModal').modal('show');
            var start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
            var end = (event.end == null) ? start : moment(event.end).format('YYYY-MM-DD HH:mm:ss');


            $('#editEventName').val(event.title);
            $('#editEventDescription').val(event.description);
            $('#editEventStart').val(start);
            $('#editEventEnd').val(end);
            

            console.log(start, end);

            $('#updateEventBtn').unbind().click(function() {
                var id = event.id;
                var title = $('#editEventName').val();
                var description = $('#editEventDescription').val();
                var startDate = $('#editEventStart').val();
                var endDate = $('#editEventEnd').val();
                $.ajax({
                    url: '{{ route("schedule.update", "") }}' + '/' + id,
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        title: title,
                        description: description,
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        event.title = title;
                        event.description = description;
                        event.start = startDate;
                        event.end = endDate;
                        $('#calendar').fullCalendar('updateEvent', event);
                        $('#editEventModal').modal('hide');
                        swal("Done!", "Event Updated Successfully!", "success");
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            $('#deleteEventBtn').unbind().click(function() {
                if (confirm("Are you sure you want to delete this event?")) {
                    var id = event.id;
                    $.ajax({
                        url: '{{ route("schedule.destroy", "") }}' + '/' + id,
                        type: "DELETE",
                        dataType: 'json',
                        success: function(response) {
                            $('#calendar').fullCalendar('removeEvents', id);
                            $('#editEventModal').modal('hide');
                            swal("Done!", "Event Deleted!", "success");
                        },
                        error: function(error) {
                            console.log(error)
                            console.log("didn't work")
                        }
                    });
                }
            });
        },
        
    });
    $("#scheduleModal").on('hidden.bs.modal', function() {
        $("#saveFullBtn").unbind();
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
        <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="eventName">Event Name: </label>
                        <input id="eventName" name="eventName" type="text" class="form-control"
                            placeholder="Enter Event Name..." required>
                        <span id="titleError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="eventdescription">Event Description: </label>
                            <textarea type="text" name="eventDescription" id="eventDescription" class="form-control"
                                placeholder="Enter Event Description..." required></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                            <label for="eventStart">Start Time:</label>
                            <input type="datetime-local" name="eventStart" id="eventStart" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="eventEnd">End Time:</label>
                            <input type="datetime-local" name="eventEnd" id="eventEnd" class="form-control" required>
                        </div>
                        </div>
                    </div>
                    <div class="actions d-flex m-3">
                        <button type="submit" class="btn pink-colour-bg" id="saveFullBtn"><i class="fa fa-check"></i>
                            Save</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour"><i
                                class="fa fa-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of Modal Form -->


        <!-- Edit Modal Form -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editEventModalLabel">Edit Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editEventName">Event Name:</label>
                    <input id="editEventName" name="editEventName" type="text" class="form-control"
                        placeholder="Enter Event Name..." required>
                    <span id="editTitleError" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="editEventDescription">Event Description:</label>
                    <textarea type="text" name="editEventDescription" id="editEventDescription" class="form-control"
                        placeholder="Enter Event Description..." required></textarea>
                </div>
                <div class="row">
                    <div class="col">
                    <label for="editEventStart">Start Time:</label>
                    <input type="datetime-local" name="editEventStart" id="editEventStart" class="form-control" required>
                </div>
                <div class="col">
                    <label for="editEventEnd">End Time:</label>
                    <input type="datetime-local" name="editEventEnd" id="editEventEnd" class="form-control" required>
                </div>
                </div>
            </div>
            <div class="actions d-flex m-3">
                <button type="submit" class="btn pink-colour-bg" id="updateEventBtn"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-danger" id="deleteEventBtn"><i class="fa fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-secondary" id="lightBlue-colour" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>


        <!-- End of Edit Modal Form -->

        <div class="container mt-3">

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