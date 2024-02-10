@extends('layouts.navbar')
@section('title')
<title>Profile</title>
@endsection
@section('content')
<div class="row bg-green profile">
  <div class="col-md-8">
    <div class="details">
      <h1>Profile</h1>
      @auth
      <table class="table border border-grey border-rounded">
        <thead>
          <tr>
            <th scope="col" class="pink-colour text-white">My Details</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr>
            <td scope="row">Name: {{auth()->user()->name}}</td>
          </tr>
          <tr>
            <td scope="row">Email: {{auth()->user()->email}}</td>
          </tr>
        </tbody>
      </table>
      @endauth
      <div class="updateDetails border rounded">
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" class="border rounded bg-white">
          @csrf
          @method('PUT')
          <div class="pink-colour pl-2 py-3 text-white ">
            <h6><b>Update Details</b></h6>
          </div>
          <div class="my-3 mx-2">
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
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
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