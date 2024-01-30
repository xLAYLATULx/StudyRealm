<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login/Register</title>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .pink-colour{
            background-color: #FF6060;
        }
        .pink-text{
            color: #FF6060;
        }
        .blue-colour{
            background-color: #314559;
        }
        #login{
            background-color: #314559;
        }
        .navbar-logo img {
            max-width: 80px; /* Set a maximum width for the logo */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Add some spacing between the logo and the text */
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-3 navbar-logo">
             <img src="{{ asset('assets/images/Study Realm Light Logo.png') }}" alt="Logo"><label class="fw-bold">StudyRealm</label>
            </div>
    </div>
<section class="h-100 gradient-form">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-10">
          <div class="card rounded-3 text-white" id="login">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body p-md-5 mx-md-4">
                        <div class="login-title">
                            <h4 class="mt-1 mb-5 pb-1">Login</h4>
                        </div>
                
                        <form>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example11">Email</label>
                                <input type="email" id="form2Example11" class="form-control" placeholder="Enter Email Address" />
                            </div>
                
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example22">Password</label>
                                <input type="password" id="form2Example22" class="form-control" placeholder="Enter Password" />
                            </div>
                
                            <div class="remember-me">
                                <input type="checkbox" class="form-check-input" id="remembermecheckbox">
                                <label class="form-check-label" for="remembermecheckbox">Remember Me</label>
                            </div>
                
                            <div class="text-center mt-auto">
                                <button class="btn mt-5 pink-colour py-2 px-5" type="submit"><a class="text-decoration-none text-white" href="{{ url('/goals') }}">Log In</a></button>
                            </div>
                
                        </form>
                    </div>
                </div>
              <div class="col-md-6 d-flex bg-white">
                <div class="card-body p-md-5 mx-md-4 pink-text">
                        <h4 class="mt-1 mb-5 pb-1">Register</h4>
      
                      
          <form>
            <div class="form-outline mb-4">
              <label class="form-label" for="name">Name</label>
              <input type="name" id="name" class="form-control" placeholder="Enter Your Name" />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" class="form-control" placeholder="Enter Email Address" />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" class="form-control" placeholder="Enter Password" />
            </div>

            <!-- Button fixed at the bottom of the card -->
            <div class="text-center">
              <button class="btn mt-5 blue-colour text-white py-2 px-5" type="button">Register</button>
            </div>
          </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>