<!doctype html>
<html lang="en">

<head>
    <title>Fashion</title>
    <!-- Start Loader -->
    <style type="text/css">
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
      if it's not present, don't show loader */
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(assets/img/loader/Preloader_3.gif) center no-repeat #fff;
        }
    </style>
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).on("load", function() {
            // Animate loader off screen
            $(".se-pre-con").delay(0).fadeOut("slow");
        });
    </script>
    <!-- End Loader -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/css/form.css') }}">
    @livewireStyles()

</head>

<body>
    <div class="se-pre-con"></div>
    <section class="ftco-section">
        {{ $slot }}
    </section>

    <script src="{{ asset('assets/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/popper.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>
    @livewireScripts()
</body>

</html>
