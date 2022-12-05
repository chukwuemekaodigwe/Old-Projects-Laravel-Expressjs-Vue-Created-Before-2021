<link rel="stylesheet" href="/css/linearicons.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/magnific-popup.css">
<link rel="stylesheet" href="/css/nice-select.css">
<link rel="stylesheet" href="/css/animate.min.css">
<link rel="stylesheet" href="/css/owl.carousel.css">
<link rel="stylesheet" href="/css/jquery-ui.css">
<link rel="stylesheet" href="/css/main.css">
<style>
input{
    padding: 5px!important;
}
    </style>
</head>

<body>
    <header id="header" id="home">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
                        <a href="tel:+953 012 3654 896"><span class="lnr lnr-phone-handset"></span> <span
                                class="text">+953 012 3654 896</span></a>
                        <a href="mailto:support@ {{ $_SERVER['SERVER_NAME'] }}"><span class="lnr lnr-envelope"></span>
                            <span class="text">support@ {{ $_SERVER['SERVER_NAME'] }}</span>
                        </a>

                        @guest @else
                        <a href="/dash" class="genric-btn primary small"><span class="lnr lnr-lock"></span>
                            <span style="text-transform: uppercase; font-weight: bolder;">Dashboard</span>
                        </a>
                        @endguest
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="/"><img src="img/logo.jpg" alt="WAEC|JAMB|NECO Exam runz{{date('Y', strtotime('today'))}} Pacesetteres, Onitsha" title="WAEC|JAMB|NECO Exam runz{{date('Y', strtotime('today'))}}" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/quiz"> CBT Quiz</a></li>
                        <li><a href="/testimonies">Evidences</a></li>
                        <li><a href="/blogs">Blogs</a>
                        </li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </nav>
                <!-- #nav-menu-container -->
            </div>
        </div>
    </header>
