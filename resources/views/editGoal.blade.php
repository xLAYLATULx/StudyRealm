@extends('layouts.navbar')
@section('title')
<title>Edit Goal</title>
@endsection
@section('content')
<h6><a href="/goals" class="text-black">Goals </a> > Edit Goal</h6>
    <h2>Edit Goal</h2>
    <div class="addGoal">
        <form action="{{ route('editGoal', ['id' => $goal->id])}}" method="POST" class="addGoalForm p-4 border border-2 rounded">
            @csrf
            @method('PUT')
            <h2 class="text-white">Edit Goal</h2>
            <div class="mb-3">
                <label for="newGoalName" class="text-white">Goal New Name: </label>
                <input type="text" name="newGoalName" id="newGoalName" class="form-control" placeholder="Enter Goal New Name...">
            </div>
            <div class="mb-3">
                <label for="newGoalDeadline" class="text-white">New Deadline: </label>
                <input type="date" name="newGoalDeadline" id="newGoalDeadline" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn text-white" id="blue-colour"><i class="fa fa-check"></i> Save</button>
                </div>
                <div class="col-md-6 delete">
                    <a class="btn text-white" id="blue-colour" href="{{ route('goal') }}"><i class="fa fa-close"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection