@extends('layouts.navbar')
@section('title')
<title>Profile</title>
@endsection
@section('content')
    <div class=" px-5 profile">
        <h1>Profile</h1>
            <table class="table border border-grey border-rounded">
                <thead>
                  <tr>
                    <th scope="col" class="pink-colour text-white">My Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td scope="row">Name</td>
                  </tr>
                  <tr>
                    <td scope="row">Email</td>
                  </tr>
                </tbody>
              </table>

              <div class="border">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col" class="pink-colour text-white">Update Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class=>
                    <td scope="row">New Name <br>
                    <input type="text" name="name" value=""> </td>
                  </tr>
                  <tr>
                    <td scope="row">New Email <br>
                    <input type="email" id="email" name="email" required></td>
                  </tr>
                  <tr>
                    <td scope="row">New Password <br>
                    <input type="password" id="password" name="password" required></td>
                  </tr>
                </tbody>
              </table>
        
                <button type="submit" class="btn pink-colour text-white">Update</button>
              </div>
    </div>


@endsection