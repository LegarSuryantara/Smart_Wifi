<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Login Page | Alif Smart Wifi
  </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
 </head>
 <body>
    <div class="loginform">
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
         <div class="row login-container bg-white">
          <div class="col-md-6 login-form">
           <h2 class="text-center">
            LOGIN
           </h2>
           <p class="text-center">
            Welcome back! Please enter your details.
           </p>
           <form>
            <div class="form-group">
             <label for="username">
              Username
             </label>
             <input class="form-control" id="username" type="text"/>
            </div>
            <div class="form-group">
             <label for="password">
              Password
             </label>
             <input class="form-control" id="password" type="password"/>
            </div>
            <div class="form-group form-check d-flex justify-content-between">
             <div>
              <input class="form-check-input" id="remember" type="checkbox"/>
              <label class="form-check-label" for="remember">
               Remember me
              </label>
             </div>
             <a href="#">
              Forgot password
             </a>
            </div>
            <button class="btn btn-block" type="submit">
             Sign in
            </button>
           </form>
           <p class="mt-4 text-center">
            Don't have an account?
            <a href="#">
             Sign up for free!
            </a>
           </p>
          </div>
          <div class="col-md-6 p-0 d-none d-md-block">
           <img alt="A cup of coffee on a yellow background" class="img-fluid h-100" src="image/login.png"/>
          </div>
         </div>
        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
  </script>
 </body>
</html>
