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
                                <a href="{{ route('goalDelete', ['id' => $goal->id]) }}" class="btn text-white" id="pink-colour"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No goals found.</p>
        @endisset
        <div class="addGoal">
            <a class="btn text-white mt-5" id="blue-colour" href="{{ route('goalCreate') }}"><i class="fa fa-plus"></i> Create Goal</a>
        </div>
    </div>
@endsection
