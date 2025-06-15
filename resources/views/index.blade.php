<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Posyandu Apel</title>

    <!-- CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('template-login/colorlib-regform-7') }}/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('template-login/colorlib-regform-7') }}/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('template-login/colorlib-regform-7') }}/images/signin-image.jpg" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Login As</h2>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div style="display: flex; justify-content: center; gap: 15px;">
                            <a href="{{ asset('login-kader') }}" class="form-submit" style="text-decoration: none;">Kader</a>
                            <a href="{{ asset('login-bidan') }}" class="form-submit" style="text-decoration: none;">Bidan</a>
                        </div>
                        <a href="{{ asset('register') }}" class="signup-image-link" style="padding-top: 30px">Don't have an account? Sign Up here!</a>
                    </div>               
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('template-login/colorlib-regform-7') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template-login/colorlib-regform-7') }}/js/main.js"></script>
</body>
</html>