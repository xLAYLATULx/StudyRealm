@extends('layouts.navbar')
@section('title')
    <title>Create Category</title>
@endsection
@section('content')
    <h6><a href="/tasks" class="text-black">Task Manager</a> > Create Category</h6>
    <h2>Create Category</h2>
    <div class="addGoal">
        <div class="row-md-12">
            <div class="form-popup" id="createTaskForm">
                <form action="{{ route('createCategory') }}" method="POST" class="createTaskForm p-4 border border-2 rounded">
                    @csrf
                    <h2 class="text-white">Create Category</h2>
                    <div class="mb-3">
                        <label for="categoryName" class="text-white">Category Name:</label>
                        <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Enter Category Name...">
                    </div>
                    <div class="mb-3">
                        <label for="sortBy" class="text-white">Sort By:</label>
                        <select id="sortBy" name="sortBy" class="form-control">
                            <option value="priority">Priority</option>
                            <option value="dueDate">Due Date</option>
                          </select>
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
