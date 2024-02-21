<!DOCTYPE html>
<html>
 <head>
    <title>StudyRealm</title>
    <link rel="icon" href="{{ asset('assets/images/Study Realm Light Logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('js/main.js') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
  <style>
    /* Add your CSS styles here */
  </style>
 </head>
 <body>
  <!-- Add the navbar here -->
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
        <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="{{ Request::is('profile*') ? 'active' : '' }} rounded">
            <i class="fa fa-user"></i><label>{{auth()->user()->name}}</label>
        </a>
        <a href="{{ route('logout') }}" class="{{ Request::is('logout') ? 'active' : '' }} rounded">
            <i class="fa fa-sign-out"></i><label>Sign Out</label>
        </a>
    </div>
  </div>
  <div class="content">
  <div class="container">
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
