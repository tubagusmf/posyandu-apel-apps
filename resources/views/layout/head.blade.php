<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>
      Dashboard -
      @if(Auth::guard('kader')->check())
        Kader
      @elseif(Auth::guard('bidan')->check())
        Bidan
      @else
        Posyandu
      @endif
    </title>    
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('template-login/colorlib-regform-7') }}/images/posyanduapel.png"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('template-admin') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('template-admin') }}/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('template-admin') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('template-admin') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('template-admin') }}/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('template-admin') }}/assets/css/demo.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  </head>
<body>