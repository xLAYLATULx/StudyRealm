@extends('layouts.welcomenavbar')
@section('content')
<div class="welcome">
  <div class="col-md- mt-5 errorMessage">
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
        <form action="{{ route('login.post') }}" method="POST">
        @csrf
          <h2>Login</h2>
        <br>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address...">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password...">
        </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember Me</label>
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
      </div>
  
      <div class="col-md-6 register bg-white pink-text">
        <h3>Don't have an account?</h3>
        <button type="submit" class="btn" onclick="window.location='{{ route('register') }}'">Register</button>
      </div>
    </div>
  </div>
</div>
@endsection