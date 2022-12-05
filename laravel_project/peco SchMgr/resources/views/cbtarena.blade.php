@extends('layouts.cbt')

@section('contents')




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
                    {{ dd($questions) }}
                    @endsetion
