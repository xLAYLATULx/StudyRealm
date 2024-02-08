@extends('layouts.navbar')
@section('title')
    <title>Goals</title>
@endsection
@section('content')
    <h1>Goals</h1>
    <div class="row-md-12">
        @isset($goals)
            @foreach($goals as $goal)
                <div class="card border bg-transparent mt-2">
                    <div class="card-body border border-2">
                        <div class="row">
                            <div class="col-md-6 text-secondary">
                                <input type="checkbox" id="goalCompleted" name="goalCompleted">
                                <label>Mark as Completed</label>
                            </div>
                            <div class="col-md-6 goaldueDate text-secondary">
                                <p>Due: {{ $goal->deadline }}</p>
                            </div>
                        </div>
                        <h5 class="card-title text-center">{{ $goal->goalName }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('editGoal', ['id' => $goal->id]) }}" class="btn text-white" id="pink-colour"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                            <div class="col-md-6 delete">
                                <a href="#" class="btn text-white" id="pink-colour"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No goals found.</p>
        @endisset
        <div class="addGoal">
            <button class="btn text-white mt-5" id="blue-colour" onclick="openCreateGoalForm()"><i class="fa fa-plus"></i> Create Goal</button>
            <div class="opacity" id="opacity">
                <div class="form-popup" id="createGoalForm">
                    <form action="{{ route('createGoal') }}" method="POST" class="addGoalForm p-4 border border-2 rounded">
                        @csrf
                        <h2 class="text-white">Create Goal</h2>
                        <div class="mb-3">
                            <label for="goalName" class="text-white">Goal Name: </label>
                            <input type="text" name="goalName" id="goalName" class="form-control" placeholder="Enter Goal Name...">
                        </div>
                        <div class="mb-3">
                            <label for="goalDeadline" class="text-white">Deadline: </label>
                            <input type="date" name="goalDeadline" id="goalDeadline" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn text-white" id="blue-colour"><i class="fa fa-check"></i> Create</button>
                            </div>
                            <div class="col-md-6 delete">
                                <button class="btn text-white" id="blue-colour" onclick="closeForm()"><i class="fa fa-close"></i> Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
