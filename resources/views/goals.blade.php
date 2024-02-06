@extends('layouts.navbar')
@section('title')
<title>Goals</title>
@endsection
@section('content')

<h1>Goals</h1>
<div class="row-md-12">
    <div class="card border">
        <div class="card-body border border-2">
            <div class="row">
                <div class="col-md-6 text-secondary">
                    <input type="checkbox" id="goalCompleted" name="goalCompleted">
                    <label >Mark as Completed</label>
                </div>
                <div class="col-md-6 goaldueDate text-secondary">
                    <p>Due: 12/12/24</p>
                </div>
            </div>
            <h5 class="card-title text-center">Revise CS3SPM Unit 6</h5>
            <div class="row">
                <div class="col-md-6">
                <a href="#" class="btn text-white" id="pink-colour"><i class="fa fa-pencil"></i>  Edit</a>
                </div>
                <div class="col-md-6 delete">
                <a href="#" class="btn text-white" id="pink-colour"><i class="fa fa-trash"></i>  Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="addGoal">
        <a href="#" class="btn text-white mt-5" id="blue-colour"><i class="fa fa-plus"></i>  Add Goal</a>
    </div>
</div>

@endsection