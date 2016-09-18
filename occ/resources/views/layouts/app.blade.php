<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>OCC</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-theme/jquery-ui-1.10.0.custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bs-select-css/bootstrap-select.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-theme/custom.css') }}">
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <style>
    body {
      ont-family: Arial, Helvetica, sans-serif;
    }

    .fa-btn {
      margin-right: 6px;
    }

    .nav >li >a {
      padding-top: 60px;
      padding-bottom: 30px;
    }
    .navbar-toggle {
      padding: 15px;
      margin: 25px 15px 25px 0;
    }
  </style>
</head>
<body id="app-layout">
@include('layouts.js')
  <nav class="navbar navbar-default ">
    <div class="container-fluid">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
          <img  src="{{ asset('img/occ_brand.png') }}" alt="Obedience Club of Chattanooga">
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/') }}">Home</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/class_info') }}">Our Classes</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/instructor_bios') }}">Meet Our Instructors</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/faqs') }}">FAQ</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/events') }}">Events</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/contact') }}">Contact Us</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Become a Member</a></li>
          @elseif (Auth::user()->isAdmin())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ "Welcome " . Auth::user()->user_profile->first_name  . " " . Auth::user()->user_profile->last_name}} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li><a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} "><i class="fa fa-btn fa-sign-out"></i>My Profile</a></li>
              <li><a href=" {{ url('/admin') }} "><i class="fa fa-btn fa-sign-out"></i>Admin View</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>
          @elseif (Auth::user()->isInstructor())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ "Welcome " . Auth::user()->user_profile->first_name  . " " . Auth::user()->user_profile->last_name}} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li><a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} "><i class="fa fa-btn fa-sign-out"></i>My Profile</a></li>
              <li><a href=" {{ url('/instructor/roster/'. Auth::user()->id) }} "><i class="fa fa-btn fa-sign-out"></i>My Class Roster(s)</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ "Welcome " . Auth::user()->user_profile->first_name  . " " . Auth::user()->user_profile->last_name}} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li><a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} "><i class="fa fa-btn fa-sign-out"></i>My Profile</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
  @yield('content')
  </div>


</body>
</html>
