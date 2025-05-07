{{-- @extends('layouts.app')

@section('title', 'User Registration')

@section('content')
<div class="registrasi">
  <div class="form">
    <div class="container">
      <div class="container2">
        <div class="title">User Registration</div>
        <div class="description">Fill in the details below to register</div>
      </div>
      <div class="image-container">
        <div class="image"></div>
      </div>
    </div>
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="list">
        <div class="row">
          <div class="input">
            <div class="title2">Full Name</div>
            <input type="text" name="name" class="textfield" placeholder="Enter your full name" required>
          </div>
          <div class="input">
            <div class="title2">Email</div>
            <input type="email" name="email" class="textfield" placeholder="Enter your email address" required>
          </div>
        </div>
        <div class="row">
          <div class="input">
            <div class="title2">Password</div>
            <input type="password" name="password" class="textfield" placeholder="Enter your password" required>
          </div>
          <div class="input">
            <div class="title2">Confirm Password</div>
            <input type="password" name="password_confirmation" class="textfield" placeholder="Re-enter your password" required>
          </div>
        </div>
        <div class="row2">
          <div class="selection">
            <div class="title2">Role</div>
            <div class="chip-group">
              <label class="chip">
                <input type="radio" name="role" value="Customer" required>
                <div class="text2">Customer</div>
              </label>
              <label class="chip">
                <input type="radio" name="role" value="Owner">
                <div class="text2">Owner</div>
              </label>
            </div>
          </div>
        </div>
        <div class="button">
          <button type="reset" class="seconday">
            <div class="title3">Cancel</div>
          </button>
          <button type="submit" class="primary">
            <div class="title4">Register</div>
          </button>
        </div>
      </div>
    </form>
    <img class="vector-200" src="{{ asset('images/vector-2000.svg') }}" />
  </div>

  <div class="section">
    <div class="avatar"></div>
    <div class="container3">
      <div class="title5">Login</div>
      <div class="selection2">
        <div class="label-normal">
          <div class="label-text">New User</div>
        </div>
      </div>
      <div class="description2">Already have Account?</div>
    </div>
    <div class="button2">
      <a href="{{ route('login') }}" class="seconday2">
        <div class="title4">Skip</div>
      </a>
      <a href="{{ route('login') }}" class="primary2">
        <div class="title4">Login Here</div>
      </a>
    </div>
    <img class="vector-2002" src="{{ asset('images/vector-2001.svg') }}" />
  </div>

  <div class="container4">
    <div class="title6">© 2025 Lalok Sumbar. All Rights Reserved</div>
  </div>
</div>
@endsection --}}
