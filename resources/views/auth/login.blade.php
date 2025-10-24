<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login Page | Alif Smart Wifi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dymI9xQ9m7vQ1u2mM3mXK4m4Vt3eJv6iUo1qH+GgXK8xwqvR2sS1qQ9r2k8J5l9G2q7h4aW3j1f9G6H0Z7Z2JQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="loginform">
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="row login-container bg-white">
                <div class="col-md-6 p-0 d-none d-md-block">
                    <img alt="Network cables with fiber optic background" class="img-fluid h-100 w-100" src="image/login.webp" style="object-fit: cover;" />
                </div>
                <div class="col-md-6 login-form d-flex flex-column justify-content-center">
                    <h2 class="text-center mb-1">Login to your account</h2>
                    <p class="text-center mb-4">Welcome back! Please enter your details.</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="example@mail.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="password-wrapper">
                                <x-text-input id="password" class="form-control password-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                                <button class="password-eye" type="button" id="togglePassword" aria-label="Show password">
                                    <svg id="iconEyeOpen" class="d-none" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                    </svg>
                                    <svg id="iconEyeClosed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M2.3 1.7 1 3l4.3 4.3C3.5 8.5 2.1 10 1 12c0 0 4 7 11 7 2.1 0 3.9-.5 5.4-1.3L21 23l1.3-1.3L2.3 1.7zM12 17c-3.9 0-6.8-2.6-8.4-5 .8-1.2 1.8-2.3 3.1-3.1l1.9 1.9c-.4.7-.6 1.5-.6 2.2 0 2.2 1.8 4 4 4 .8 0 1.5-.2 2.2-.6l1.9 1.9c-1 .5-2.5.7-4.1.7zm1.4-3.8 2.5 2.5c.6-.7 1.1-1.7 1.1-2.7 0-2.2-1.8-4-4-4-1 0-2 .4-2.7 1.1l2.5 2.5c.1-.1.3-.2.6-.2.6 0 1.1.5 1.1 1.1 0 .2-.1.4-.1.5zM12 7c3.9 0 6.8 2.6 8.4 5-.6.9-1.4 1.8-2.3 2.6l1.4 1.4c1.4-1.2 2.5-2.7 3.5-4 0 0-4-7-11-7-1.6 0-3 .3-4.2.8l1.5 1.5C9.9 7.1 10.9 7 12 7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group form-check d-flex justify-content-between">
                            <div>
                                <input id="remember_me" type="checkbox" class="form-check-input rounded" name="remember">
                                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                            </div>
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-2">{{ __('Log in') }}</button>

                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-block mb-2">{{ __('Create account') }}</a>

                        <a href="{{ route('login') }}" class="btn btn-light border btn-block d-flex align-items-center justify-content-center" style="gap: 8px;">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" width="18" height="18" />
                            <span>{{ __('Continue with Google') }}</span>
                        </a>
                    </form>

                    @if (Route::has('register'))
                        <p class="mt-4 text-center">
                            Don't have an account?
                            <a href="{{ route('register') }}">{{ __('Sign up for free!') }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-rXnV6Q8nQ5Jw5i6oT1Qb9WQ7k4l6r1vH8m3+4xgJ4CwQ+2lKkVxwqTg0i8p1bE7pQ8nNwqv1v6u3mGm9iW4kGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        (function() {
            var toggle = document.getElementById('togglePassword');
            if (toggle) {
                toggle.addEventListener('click', function() {
                    var input = document.getElementById('password');
                    if (!input) return;
                    var isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    var openIcon = document.getElementById('iconEyeOpen');
                    var closedIcon = document.getElementById('iconEyeClosed');
                    if (openIcon && closedIcon) {
                        // When password is currently hidden (type=password), show eye-open after click
                        if (isPassword) {
                            openIcon.classList.remove('d-none');
                            closedIcon.classList.add('d-none');
                        } else {
                            openIcon.classList.add('d-none');
                            closedIcon.classList.remove('d-none');
                        }
                    }
                });
            }
        })();
    </script>
</body>

</html>