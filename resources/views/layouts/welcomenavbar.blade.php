<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login/Register</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="row">
    <div class="col-md-3 navbar-logo logo">
      <img src="{{ asset('assets/images/Study Realm Light Logo.png') }}" alt="Logo"><label class="fw-bold">StudyRealm</label>
    </div>
  </div>
  @yield('content')
</body>
</html>