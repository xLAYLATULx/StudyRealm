<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login/Register</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('js/main.js') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="loginPage">
    <div class="row">
      <div class="col-md-5">
      </div>
      <div class="col-md-4 navbar-logo justify-content-center align-items-center">
        <img src="{{ asset('assets/images/theLogo.png') }}" alt="Logo">
        <label><h5 class="blue-colour"><strong>StudyRealm</strong></h5></label>
      </div>
      <div class="col-md-3">
        <div class="error-container mt-3">
          <div class="errorMessage">
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
    
    <div class="login-register">      
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6 logintext-white border rounded-start shadow" id="blue-colour">
              <form action="{{ route('login.post') }}" method="POST" class="p-4">
                @csrf
                <h2>Login</h2>
                <br>
                <div class="mb-3">
                  <label for="email">Email:</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address...">
                </div>
                <div class="mb-3">
                  <label for="password">Password:</label>
                  <input type="password" name="password" class="form-control" id="password"
                    placeholder="Enter Password...">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
                <button type="submit" class="btn pink-colour text-white" id="pink-colour">Login</button>
              </form>
            </div>

            <div class="col-md-6 bg-white pink-text border rounded-end shadow">
              <form action="{{ route('register.post') }}" method="POST" class="p-4">
                @csrf
                <h2>Register</h2>
                <div class="mb-3">
                  <label for="registerName">First Name:</label>
                  <input type="text" name="registerName" class="form-control" id="registerName"
                    placeholder="Enter First Name...">
                </div>
                <div class="mb-3">
                  <label for="registerEmail">Email:</label>
                  <input type="email" name="registerEmail" class="form-control" id="registerEmail"
                    placeholder="Enter Email Address...">
                </div>
                <div class="mb-3">
                  <label for="registerPassword">Password:</label>
                  <input type="password" name="registerPassword" class="form-control" id="registerPassword"
                    placeholder="Enter Password...">
                </div>
                <button type="submit" class="btn text-white" id="blue-colour">Register</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2">
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  window.addEventListener('DOMContentLoaded', function () {
    var errorMessage = document.querySelector('.errorMessage');
    errorMessage.classList.add('show');
    setTimeout(function () {
      errorMessage.classList.remove('show');
    }, 5000);
  });
</script>

</html>