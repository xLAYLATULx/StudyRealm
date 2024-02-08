@extends('layouts.navbar')
@section('title')
<title>Task Manager</title>
@endsection
@section('content')
<h1>Tasks</h1>
<div class="row">
    <div class="col-md-3">
        <div class="card border border-2">
            <div class="card-header" id="pink-colour">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="text-white fw-bold text-center">CS3SPM</h5>
                    </div>
    
                    <div class="col-md-3">
                        <div class="dropdown">
                            <button class="dropbtn text-white"><i class="fa fa-ellipsis-v"></i></button>
                            <div class="dropdown-content">
                                <a href="#" class="btn"><i class="fa fa-pencil"></i> Edit</a>
                                <a href="#" class="btn"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="card">
                    <div class="card-body border border-2 rounded pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title">Tutorial 8</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-right">
                                <div class="dropdown">
                                    <button class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
                                    <div class="dropdown-content">
                                        <a href="#" class="btn"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#" class="btn"><i class="fa fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li>Progress:</li>
                                <li>Priority</li>
                                <li>Due Date:</li>
                                <li><input type="checkbox" id="taskCompleted" name="taskCompleted">
                                    <label class="text-secondary">Mark as Completed</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="addTask">
                <a href="{{ route('taskCreate') }}" class="btn text-white mx-4 mb-2" id="blue-colour"><i class="fa fa-plus"></i> Add Task</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="addCategory">
            <a href="{{ route('categoryCreate') }}" class="btn text-white mx-4 mb-2" id="blue-colour"><i class="fa fa-plus"></i> Add Category</a>
        </div>
    </div>

</div>

@endsection