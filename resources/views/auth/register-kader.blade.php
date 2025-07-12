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
                        <figure><img src="{{ asset('template-login/colorlib-regform-7') }}/images/posyanduapel.png" alt="sing up image"></figure>
                    </div>
                    <div class="signup-form">
                        <h2 class="form-title">Register Kader</h2>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ asset('register-kader') }}" method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="nik"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="nik" id="nik" placeholder="Nomor NIK Kader" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Nama Lengkap" required/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Ulangi Password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
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