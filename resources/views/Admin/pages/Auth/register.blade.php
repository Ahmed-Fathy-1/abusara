<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Test Description Content  Meta Butcher ">
    <meta name="keywords" content="Test Keyword Content  Meta Butcher">
    <meta name="author" content="AiTech">
    <meta name="robots" content="noindex, nofollow">

    <title>Register</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}">
    <link rel="mask-icon" href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}" color="#a01b20">
    <meta name="msapplication-TileColor" content="#a01b20">
    <meta name="theme-color" content="#a01b20">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/dashboard/favicon/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">

</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ asset('assets/dashboard/img/logo.png') }}" alt="img">
                        </div>
                        <a href="#" class="login-logo logo-white">
                            <img src="{{ asset('assets/dashboard/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3></h3>
                        </div>

                        <form method="POST" action="{{ route('postRegister') }}" enctype="multipart/form-data">
                            <!-- THIS IS THE FIELD YOU NEED: -->
                            {{-- <input type='hidden' name='_token' value='{{ csrf_token() }}'> --}}

                            @csrf

                            <div class="form-login">
                                <label>Username</label>
                                <div class="form-addons">
                                    <input type="text" name="name" placeholder="Enter your Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Tenant</label>
                                <div class="form-addons">
                                    <input type="text" name="tenant" placeholder="Enter your tenant">
                                    @error('tenant')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" name="email" placeholder="Enter your email address">
                                    <img src="{{ asset('assets/dashboard/img/icons/mail.svg') }}" alt="img">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password"
                                        placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password Confirm</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password_confirmation"
                                        placeholder="Enter your password confirmation">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Phone Numper</label>
                                <div class="form-addons">
                                    <input type="tel" name="mobile" placeholder="Enter your Phone Numper ">
                                    @error('mobile')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Upload Image</label>
                                <div class="pass-group">
                                    <input type="file" class="pass-input" name="image"
                                        placeholder="Enter your Image">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-login">
                                <button class="btn btn-login" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('assets/dashboard/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/dashboard/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/dashboard/js/feather.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/dashboard/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/dashboard/js/script.js') }}"></script>

</body>

</html>
