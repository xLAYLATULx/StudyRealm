@extends('layouts.navbar')
@section('title')
    <title>Create Goal</title>
@endsection
@section('content')
    <h6><a href="/goals" class="text-black">Goals</a> > Create Goal</h6>
    <h2>Create Goal</h2>
    <div class="addGoal">
        <div class="row-md-12">
            <div class="form-popup" id="createGoalForm">
                <form action="{{ route('createGoal') }}" method="POST" class="addGoalForm p-4 border border-2 rounded">
                    @csrf
                    <h2 class="text-white">Create Goal</h2>
                    <div class="mb-3">
                        <label for="goalName" class="text-white">Goal Name:</label>
                        <input type="text" name="goalName" id="goalName" class="form-control" placeholder="Enter Goal Name...">
                    </div>
                    <div class="mb-3">
                        <label for="goalDeadline" class="text-white">Deadline:</label>
                        <input type="date" name="goalDeadline" id="goalDeadline" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn text-white" id="blue-colour"><i class="fa fa-check"></i> Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row-md-12 mt-5 pt-5 w-4 errorMessage">
        <div class="mt-5 pt-5">
            <div class="mt-5 pt-5">
                <div class="mt-5 pt-5">
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
</div>
    </div>
    </div>
@endsection
