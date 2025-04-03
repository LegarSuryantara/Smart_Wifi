<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Sign Up Page | Alif Smart Wifi</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
  <style>
    .login-container {
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .login-form {
      padding: 40px;
    }
    .btn-block {
      background-color: #4e73df;
      color: white;
      border-radius: 5px;
      padding: 10px;
      margin-top: 20px;
    }
    .btn-block:hover {
      background-color: #3a5bc7;
      color: white;
    }
    .img-fluid {
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="loginform">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
      <div class="row login-container bg-white">
        <div class="col-md-6 login-form">
          <h2 class="text-center">SIGN UP</h2>
          <p class="text-center">Create your own account!</p>
          
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
              <label for="name">Username</label>
              <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus/>
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required/>
              @error('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
              <label for="phone">No. Telepon</label>
              <input class="form-control" id="phone" type="tel" name="phone" value="{{ old('phone') }}" required/>
              <small class="text-muted">Format: 081234567890</small>
              @error('phone')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <!-- Address -->
            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
              @error('address')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" id="password" type="password" name="password" required/>
              @error('password')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required/>
            </div>

            <button class="btn btn-block" type="submit">Sign up</button>
          </form>

          <p class="mt-4 text-center">
            Already have an account??
            <a href="{{ route('login') }}">Log In!</a>
          </p>
        </div>
        
        <div class="col-md-6 p-0 d-none d-md-block">
          <img alt="A cup of coffee on a yellow background" class="img-fluid h-100" src="{{ asset('image/login.png') }}"/>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>