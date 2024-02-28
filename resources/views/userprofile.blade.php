@extends('layouts.navbar')
@section('title')
<title>Profile</title>
@endsection
@section('content')
<h1>Profile</h1>
<div class="row bg-green profile">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="card p-5 shadow">
      @auth
        <h6><strong>Name: </strong>{{auth()->user()->name}}</h6>
        <h6><strong>Email: </strong>{{auth()->user()->email}}</h6>
      @endauth
      <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" class=" bg-white">
        @csrf
        @method('PUT')
      <table class="table border border-grey rounded mt-3">
        <thead>
          <tr>
            <th scope="col" class="text-white" id="pink-colour">Update Details</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr>
            <td><div class="my-3 mx-2">
              <label for="updateName">New Name:</label>
              <input type="text" name="updateName" class="form-control" id="updateName"
                placeholder="Enter New First Name...">
            </div>
            <div class="my-3 mx-2">
              <label for="newEmail">New Email:</label>
              <input type="email" name="newEmail" class="form-control" id="newEmail"
                placeholder="Enter New Email Address...">
            </div>
            <div class="my-3 mx-2">
              <label for="currentPassword">Current Password:</label>
              <input type="password" name="currentPassword" class="form-control" id="currentPassword"
                placeholder="Enter Current Password...">
            </div>
            <div class="my-3 mx-2">
              <label for="newPassword">New Password:</label>
              <input type="password" name="newPassword" class="form-control" id="newPassword"
                placeholder="Enter New Password...">
            </div>
          <button type="submit" class="btn text-white my-3 mx-2" id="blue-colour">Update</button>
        </td>
          </tr>
        </tbody>
      </table>
        </form>



      </div>
    </div>
  <div class="col-md-1">
    <div class="mt-5 errorMessage">
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


@endsection