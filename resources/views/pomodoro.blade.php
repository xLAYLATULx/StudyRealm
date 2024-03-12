@extends('layouts.navbar')
@section('title')
<title>Pomodoro</title>
@endsection
@section('content')

<h1>Pomodoro</h1>
<div class="instructions">
    <p>The default Pomodoro is 25 minutes session and 5 minutes break. Click on the timers or cycle fields to adjust the session time that best fit your study!</p>
</div>
<div class="timer bg-white text-center p-3 mt-5 border rounded">
    <div class="col-md-12">
    <div class="row my-3">
        <div class="col-md-5">
            <h3 class="pomodoroTitle">Session</h3>
            <div class="sessionTime mt-3">
                <input type="number" id="sessionHours" min="0" max="1" value="0"><p class="semicolon">:</p><input type="number" id="sessionMinutes" min="0" max="59" value="25"><p class="semicolon">:</p><input type="number" id="sessionSeconds" min="0" max="59" value="0">
            </div>
        </div>
        <div class="col-md-2">
            <h3 class="pomodoroTitle">Cycle</h3>
            <div class="cycleNumber text-center mt-3">
                <input type="number" id="cycle" min="1" max="10" value="1" default="1">
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <h3 class="breakTitle">Break</h3>
            </div>
            <div class="breakTime mt-3">
                <input type="number" id="breakMinutes" min="0" max="30" value="25"><p class="semicolon">:</p><input type="number" id="breakSeconds" min="0" max="59" value="0">
            </div>
        </div>
    </div>
    <div class="row mt-5 my-3">
        <div class="col-md-2">
        </div>
        <div class="col-md-9 ml-5">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-lg" id="start"><i class="fa fa-play"></i></button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-lg" id="pause"><i class="fa fa-pause"></i></button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-lg" id="reset"><i class="fa fa-undo"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>

    </div>
</div>
</div>
@endsection