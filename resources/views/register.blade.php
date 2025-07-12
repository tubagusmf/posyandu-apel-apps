<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Posyandu Apel</title>

    <link
      rel="icon"
      href="{{ asset('template-login/colorlib-regform-7') }}/images/posyanduapel.png"
      type="image/x-icon"
    />

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
                        <figure><img src="{{ asset('template-login/colorlib-regform-7') }}/images/posyanduapel.png" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Register As</h2>
                        <div style="display: flex; justify-content: center; gap: 15px;">
                            <a href="{{ asset('register-kader') }}" class="form-submit" style="text-decoration: none;">Kader</a>
                            <a href="{{ asset('register-bidan') }}" class="form-submit" style="text-decoration: none;">Bidan</a>
                        </div>
                        <a href="{{ asset('/') }}" class="signup-image-link" style="padding-top: 30px">Do you have an account? Login here!</a>
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