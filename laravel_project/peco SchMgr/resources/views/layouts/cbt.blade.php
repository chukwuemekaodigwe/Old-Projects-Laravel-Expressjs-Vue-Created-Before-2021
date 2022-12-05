<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'CBT Arena: Pacesetters Educational Center, Onitsha | Best Lesson | Tutorial | Exams [WAEC,JAMB,NECO] runs Center') }}
    </title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="wow/animate.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    
    <style>
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        opacity: 1 !important;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    .dot {
        height: 30px;
        width: 30px;
        margin: 0 2px;
        background-color: #faf8f3;
        border-radius: 5px;
        display: inline-block;
        transition: background-color 0.6s ease;
        color: #000;
        border: 1px solid yellow;
    }

    .slprev,
    .slnext {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        z-index: 1;
        cursor: pointer;
        position: absolute;
        top: 0;
        width: auto;
        padding: 16px;
        top: 50%;
        margin-top: -22px;
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        transition: background-color 0.6s ease;
        border-radius: 0 3px 3px 0;
    }

    .slprev:hover,
    .slnext:hover {
        color: white;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slnext {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    @media only screen and (max-width: 400px) {

        .slprev,
        .slnext,
        .text {
            font-size: 12px;
        }
    }

    .slideractive,
    .dot:hover {
        background-color: #ced4fa;
    }

    .mySlides {
        display: none;
        height: 75%;
        margin: 20px auto !important;
    }

    .mySlides p {
        font: 14px cursive;
        text-align: center;
    }

    .mySlides .form-check {
        font-size: 2em;

        margin: 10px 5px;
        ;
    }

    .form-check-label {
        cursor: pointer;
    }

    .quest_nos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-flow: row wrap;
        height: 20%;
        margin-top 4%;
    }

    .quest_nos a {
        text-decoration: none;
        font-weight: bold;
        padding-top: 5px;
        margin-top: 5px;
    }

    .btn-link a {
        border: 1px solid #392C70;

    }

    .btn-link a:hover {
        background-color: #392C70;
        text-decoration: none !important;
        color: #fff;

    }

    .actions {
        display: none !important;
    }

    @media(max-width: 300px) {
        body {
            min-width: 300px !important;
            overflow: scroll !important;
        }

        .steps ul {
            display: none !important;
        }

        .actions {
            display: block !important;
            margin-top: 200px;
        }

        .quest_nos {
            margin-top: -300px;
        }

    }
    </style>
</head>


@yield('content')


   <!-- container-scroller -->
                    <!-- plugins:js -->
                    <script src="js/vendor.bundle.base.js"></script>
                    <script src="js/vendor.bundle.addons.js"></script>
                    <!-- endinject -->
                    <!-- inject:js -->
                    <script src="wow/wow.min.js"></script>
                    <script src="../../js/hoverable-collapse.js"></script>
                    <script src="../../js/misc.js"></script>
                    <script src="../../js/settings.js"></script>
                    <script src="../../js/todolist.js"></script>
                    <!-- endinject -->
                    <!-- Custom js for this page-->
                    <script src="js/wizard.js"></script>

                    <!-- End custom js for this page-->


                    <script>
                    var slideIndex = 1;
                    showSlides(slideIndex);

                    function plusSlides(n) {
                        showSlides(slideIndex += n);
                    }

                    function currentSlide(n) {
                        showSlides(slideIndex = n);
                    }

                    function showSlides(n) {
                        var i;
                        var slides = $(".current .mySlides");
                        var dots = document.getElementsByClassName("dot");
                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        };
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].classList.remove("slideractive");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].classList.add("slideractive");
                    }
                    </script>

                    <script>
                    new WOW().init();
                    </script>
</body>




</html>
