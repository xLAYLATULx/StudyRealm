@extends('layouts.navbar')
@section('title')
    <title>Create Task</title>
@endsection
@section('content')
    <h6><a href="/tasks" class="text-black">Tasks</a> > Create Task</h6>
    <h2>Create Task</h2>
    <div class="addGoal">
        <div class="row-md-12">
            <div class="form-popup" id="createTaskForm">
                <form class="createTaskForm p-4 border border-2 rounded">
                    @csrf
                    <h2 class="text-white">Create Task</h2>
                    <div class="mb-3">
                        <label for="taskName" class="text-white">Task Name:</label>
                        <input type="text" name="taskName" id="taskName" class="form-control" placeholder="Enter Task Name...">
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="text-white">Progress:</label>
                        <input type="range" id="progress" name="progress" min="0" max="100" value="50" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="text-white">Priority:</label>
                        <select id="priority" name="priority" class="form-control">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskDeadline" class="text-white">Deadline:</label>
                        <input type="date" name="taskDeadline" id="taskDeadline" class="form-control">
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
