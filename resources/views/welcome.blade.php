@extends('layouts.welcomenavbar')
@section('content')
<div class="welcome">
  <div class="authForm">
    <div class="row">
      <div class="col-md-6 login blue-colour text-white">
        <form>
          <h2>Login</h2>
        <br>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter Email Address...">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control" id="password" placeholder="Enter Password...">
        </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember Me</label>
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
      </div>
  
      <div class="col-md-6 register bg-white pink-text">
        <form>
          <h2>Register</h2>
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="name" class="form-control" id="email" placeholder="Enter Name...">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email Address...">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password...">
          </div>
          <button type="submit" class="btn">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection