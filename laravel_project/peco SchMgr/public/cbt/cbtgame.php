<?php
if (isset($_POST['quiz'])) {
    var_dump($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Melody Admin</title>
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

<body class="horizontal-menu">
    <div class="container-scroller">
        <nav class="navbar horizontal-layout-navbar fixed-top navbar-expand-lg">
          <!--  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo" href="../../index-2.html"><img src="../../images/logo.svg"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="../../index-2.html"><img src="../../images/logo-mini.svg"
                        alt="logo" /></a>
            </div>-->
            <div class="navbar-menu-wrapper d-flex flex-grow">
                <ul class="navbar-nav navbar-nav-left collapse navbar-collapse" id="horizontal-top-example">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="projects-dropdown"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-alarm-clock fa-3x"></i>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="projects-dropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-laptop-mac mr-2 text-primary"></i>
                                Automation
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-database mr-2 text-primary"></i>
                                Big data
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cellphone-android mr-2 text-primary"></i>
                                Mobile App
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="employees-dropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            Employees
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="employees-dropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-monitor-multiple mr-2 text-primary"></i>
                                Developers
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-scale-balance mr-2 text-primary"></i>
                                Testers
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user mr-2 text-primary"></i>
                                Managers
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="actions-dropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            Events
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-launch mr-2 text-primary"></i>
                                App Launch
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
                                Board Meeting
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile">
                        <a class="nav-link">
                            <div class="nav-profile-text">
                                Jane Robert
                            </div>
                            <div class="nav-profile-img">
                                <img src="../../images/faces/face5.jpg" alt="image" class="img-xs rounded-circle ml-3">
                                <span class="availability-status online"></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item nav-search">
                        <div class="nav-link">
                            <div class="search-field d-none d-md-block">
                                <form class="d-flex align-items-stretch h-100" action="#">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search your projects ...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <i class="fas fa-power-off font-weight-bold icon-sm"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button"
                    data-toggle="collapse" data-target="#horizontal-top-example">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="" id="example-form">
                                        <input type="hidden" name="quiz" value="ee">
                                        <div>
                                            <h3> Question 1</h3>
                                            <section>
                                                <h4 class="card-title">jquery-steps wizard</h4>
                                                <div style="display: block;"
                                                    class="mySlides slideInLeft col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-offset-1 col-10">
                                                    <p>
                                                        What is your name?
                                                    </p>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="optionsRadios" id="optionsRadios1" value="">
                                                                Default
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="optionsRadios" id="optionsRadios2"
                                                                    value="option2" checked="">
                                                                Selected
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="optionsRadios2" id="optionsRadios3"
                                                                    value="option3" disabled="">
                                                                Disabled
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="optionsRadio2" id="optionsRadios4"
                                                                    value="option4" disabled="" checked="">
                                                                Selected and disabled
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display: none;" class="mySlides slideInLeft">
                                                    <div class="numbertext">2 / 4</div>
                                                    <img src="../../images/carousel/banner_1.jpg" alt="image">
                                                    <div class="text">Caption Two</div>
                                                </div>

                                                <div style="display: none;" class="mySlides slideInLeft">
                                                    <div class="numbertext">3 / 4</div>
                                                    <img src="../../images/carousel/banner_2.jpg" alt="image">
                                                    <div class="text">Caption Three</div>
                                                </div>

                                                <div style="display: none;" class="mySlides slideInLeft">
                                                    <div class="numbertext">4 / 4</div>
                                                    <img src="../../images/carousel/banner_9.jpg" alt="image">
                                                    <div class="text">Caption Four</div>
                                                </div>


                                                <a class="slprev" onclick="plusSlides(-1)">❮</a>
                                                <a class="slnext" onclick="plusSlides(1)">❯</a>



                                            </section>
                                            <h3> Question 1</h3>
                                            <section>

                                                <div style="display: block;" class="mySlides fade">
                                                    <div class="numbertext">1 / 4</div>
                                                    <img src="../../images/carousel/banner_12.jpg" alt="image">
                                                    <div class="text">Caption Text</div>
                                                </div>

                                                <div style="display: none;" class="mySlides fade">
                                                    <div class="numbertext">2 / 4</div>
                                                    <img src="../../images/carousel/banner_1.jpg" alt="image">
                                                    <div class="text">Caption Two</div>
                                                </div>

                                                <div style="display: none;" class="mySlides fade">
                                                    <div class="numbertext">3 / 4</div>
                                                    <img src="../../images/carousel/banner_2.jpg" alt="image">
                                                    <div class="text">Caption Three</div>
                                                </div>

                                                <div style="display: none;" class="mySlides fade">
                                                    <div class="numbertext">4 / 4</div>
                                                    <img src="../../images/carousel/banner_9.jpg" alt="image">
                                                    <div class="text">Caption Four</div>
                                                </div>


                                                <a class="slprev" onclick="plusSlides(-1)">❮</a>
                                                <a class="slnext" onclick="plusSlides(1)">❯</a>



                                            </section>

                                        </div>

                                        <!-- partial -->
                                    </form>
                                    <!-- main-panel ends -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12">

                            <div style="text-align:center" class="quest_nos">
                                <a href="javascript:void(0)" class="dot slideractive" onclick="currentSlide(1)"
                                    title="slide 1">1</a>
                                <a href="javascript:void(0)" class="dot" onclick="currentSlide(2)" title="slide 2">2</a>
                                <a href="javascript:void(0)" class="dot" onclick="currentSlide(3)" title="slide 3">3</a>
                                <a href="javascript:void(0)" class="dot" onclick="currentSlide(4)" title="slide 4">4</a>
                            </div>

                        </div>
                        <!-- page-body-wrapper ends -->
                    </div>
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


<!-- Mirrored from www.urbanui.com/melody/template/pages/forms/wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:26 GMT -->

</html>
