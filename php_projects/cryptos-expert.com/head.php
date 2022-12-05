<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Expert Cryptos Ltd - The Investors Haven</title>

    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="icon" href="static/img/favicon.png" type="image/x-icon">

    <link href="static/css/reset.css" type="text/css" rel="stylesheet" />
    <link href="static/css/fonts.css" type="text/css" rel="stylesheet" />
    <link href="static/css/style.css" type="text/css" rel="stylesheet" />

    <script src="static/js/jquery.min.js" type="text/javascript"></script>
    <script src="static/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="static/js/checkForm.js" type="text/javascript"></script>
    <script src="static/js/easy-paginate.js" type="text/javascript"></script>
    <script src="static/js/scripts.js" type="text/javascript"></script>
    <style>
        .splash-media .review {
            position: relative;
            display: inline-block;
            vertical-align: top;
            width: 100% !important;
            float: left;
            padding: 0;
            margin: 0;
        }
        
        .splash-media .video {
            position: relative;
            display: inline-block;
            vertical-align: top;
            width: 570px;
            float: right;
            padding: 0;
            margin: 0;
            display: none !important;
        }
    </style>
</head>

<body onload="">
    <div id="page">
        <div class="page-content gap splash">
            <!--PAGE CONTENT-->
            <?php
            if(!isset($_GET['a']) || $_GET['a'] == 'home'){
				?>
			<div class="header splash">
				<?php
			}else{
				
				?>
				<div class="header inner">
				<?php
			}
            ?>
                <!--HEADER-->
                <div class="container row">
                    <div class="top-area">
                        <div class="logo">
                            <a href="?a=home"><img src="static/img/header/logo.jpg" alt="LOGO EXPERT CRYPTOS LLC" style=""></a>
                        
                        <div class="lang">
                            <div class="title">Language:</div>
                            <div class="lang-list">
                                <div class="caption">English</div>
                                
                            </div>
                        </div>
                        <div class="support">
                            <div class="title">Support:</div>
                            <div class="support-list">
                                <ul>
                                    <li><span>Support:</span> <a href="mailto:admin@expert-cryptos.com">admin@expert-cryptos.com</a></li>

                                    <li><span>Phone:</span> <a href="#">+447451217505</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="login">
                            <ul>
                                <li><a class="log" href="?a=login">Sign In</a></li>
                                <li><a class="reg" href="?a=signup">Sign Up</a></li>

                            </ul>
                        </div>
</div>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li><a href="?a=home">Home</a></li>
                            <li><a href="?a=cust&page=about">About us</a></li>
                            <li><a href="?a=cust&page=investors">investor / affiliate</a></li>

                            <li><a href="?a=news">Last news</a></li>
                            <li><a href="?a=faq">FAQ</a></li>
                            <li><a href="?a=rules">Agreement and rules</a></li>
                            <li><a href="?a=support">Support</a></li>
                        </ul>
                    </div>



<div id="result" style="min-height: 50px; width: 100%; z-index: 100; font: 1.5em; color: gray">
	
	</div>