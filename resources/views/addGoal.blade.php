@extends('layouts.navbar')
@section('title')
<title>Add Goal</title>
@endsection
@section('content')
<h6><a href="/goals" class="text-black">Goals </a> > Add New Goal</h6>
    <h2>Add New Goal</h2>
    <div class="addGoal">
        <form class="p-4">
            <div class="mb-3">
                <label for="goalName">Goal Name: </label>
            <input type="text" name="goalName" id="goalName" placeholder="Enter Goal Name...">
            </div>
            <div class="mb-3">
                <label for="goalDeadline">Deadline: </label>
            <input type="date" name="goalDeadline" id="goalDeadline">
            </div>
            <div class="row">
                <div class="col-md-6">
                <a href="#" class="btn text-white" id="blue-colour"><i class="fa fa-check"></i>  Create</a>
                </div>
                <div class="col-md-6 delete">
                <a href="#" class="btn text-white" id="blue-colour"><i class="fa fa-close"></i>  Cancel</a>
                </div>
            </div>
        </form> 
    </div>
@endsection