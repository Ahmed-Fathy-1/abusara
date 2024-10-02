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

    <script src="https://js.stripe.com/v3/"></script>

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


                    <form action="/pay" method="POST">
                        @csrf
                        <button type="submit">Checkout</button>
                    </form>




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

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>

</body>

</html>
