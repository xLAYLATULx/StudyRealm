@extends('layouts.navbar')
@section('title')
<title>Edit Goal</title>
@endsection
@section('content')
<h6><a href="/goals" class="text-black">Goals </a> > Edit Goal</h6>
    <h2>Edit Goal</h2>
    <div class="addGoal">
        <div class="row-md-12">
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
            </div>
        </form>
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