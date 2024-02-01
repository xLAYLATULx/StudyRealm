@extends('layouts.welcomenavbar')
@section('content')
<div class="welcome">
    <div class="col-md-10 mt-5 errorMessage">
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 login blue-colour text-white">
        <h3>Already have an account?</h3>
        <button type="submit" class="btn" onclick="window.location='{{ route('login') }}'">Login</button>
      </div>
  
      <div class="col-md-6 register bg-white pink-text">
        <form action="{{ route('register.post') }}" method="POST">
        @csrf
          <h2>Register</h2>
          <div class="mb-3">
            <label for="name" class="form-label">First Name:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter First Name...">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address...">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password...">
          </div>
          <button type="submit" class="btn">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
