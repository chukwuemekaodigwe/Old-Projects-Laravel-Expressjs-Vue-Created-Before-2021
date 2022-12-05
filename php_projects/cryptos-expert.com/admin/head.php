<!DOCTYPE html>
<html class="no-js" lang="en"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Expert Cryptos Ltd - The Investors Haven</title>

        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link rel="icon" href="../static/img/favicon.png" type="image/x-icon">
        <link href="../static/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <link href="../static/css/reset.css" type="text/css" rel="stylesheet" />
        <link href="../static/css/fonts.css" type="text/css" rel="stylesheet" />
        <link href="../static/css/style.css" type="text/css" rel="stylesheet" />
        

        <script src="../static/js/jquery.min.js" type="text/javascript"></script>
        <script src="../static/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../static/js/checkForm.js" type="text/javascript"></script>
        <script src="../static/js/easy-paginate.js" type="text/javascript"></script>
        <script src="../static/js/scripts.js" type="text/javascript"></script>
        <style>


            table.tab {    font-size: 14px;
                           color: #000;
                           width: 100%;
                           border-width: 1px;
                           border-color: #DA0014;
                           border-collapse: collapse;
                           /* font-weight: 600; */
                           font-family: sans-serif;
                           letter-spacing: 1px;}
            table.tab th {
                font-size: 14px;
                background-color: #10668E;
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #10668E;
                text-align: center;
                color: #fff;
                font-family: sans-serif;
                letter-spacing: 0px;
            }
            table.tab tr {}
            table.tab td {    font-size: 14px;
                              border-width: 1px;
                              padding: 8px;
                              border-style: solid;
                              border-color: #B9CAD3;
                              background-color: rgba(37, 49, 55, 0.1);}


            table.blank {font-size: 14px;
                         color: #000;
                         width: 100%;
                         border-width: 1px;
                         border-color: #DA0014;
                         border-collapse: collapse;
                         /* font-weight: 600; */
                         font-family: sans-serif;
                         letter-spacing:.5px;}
            table.blank th {font-size:14px;background-color:#abd28e;border-width: 0px;padding: 8px;border-style: solid;border-color: #9dcc7a;text-align:left;}
            table.blank tr {}
            table.blank td {font-size:14px;border-width: 0px;padding: 8px;border-style: solid;border-color: #9dcc7a;}

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
            <div class="page-content cabinet"><!--PAGE CONTENT-->
                <div class="header cabinet"><!--HEADER-->
                    <div class="container row">
                        <div class="top-area">
                            <div class="logo">
                                <a href="?a=home"><img src="../static/img/header/logo.jpg" alt="LOGO EXPERT CRYPTOS LLC"></a>
                            </div>



                            <div class="lang">
                                <div class="lang-list">
                                    <div class="caption">English</div>

                                </div>
                            </div>
                            <div class="social">
                                <div class="social-list">
                                    <ul>
                                        <li><a href="https://www.facebook.com/" target="_blank"><img src="../static/img/admin/soc-ic1.png"></a></li>
                                        <li><a href="https://vk.com/" target="_blank"><img src="../static/img/admin/soc-ic2.png"></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><img src="../static/img/admin/soc-ic3.png"></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><img src="../static/img/admin/soc-ic4.png"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="support">
                                <div class="support-list">
                                    <ul>
                                        <li><span>Support:</span> <a href="mailto:admin@expert-cryptos.com">admin@expert-cryptos.com</a></li>

                                        <li><span>Phone:</span> <a href="#">+447451217505</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="time"><b id="time_site">01:03</b><span id="date_site">September.4.2018</span></div>
                        </div>
                        <div class="main-menu">
                            <ul>
                                <li><a class="" href="?a=account">Cabinet</a></li>
                                <?php
                                if($_SESSION['user_level'] == 1){
                                	?>
									<li><a href="?a=control&item=withdrawals"> Confirm Withdrawal</a></li>
										<li><a href="?a=control&item=deposits"> Confirm Deposits</a></li>
										<li><a href="?a=control&item=users" title="List of all Investors"> Investors</a></li>
                                        <li><a href="?a=generate"> Genrate Transaction</a></li>	
                                        <li><a href="?a=mails"> Send Mails</a></li>
									<?php
								}else{
							?>
							
                                <li><a href="?a=deposit_list">Deposits</a></li>
                                <li><a href="?a=referals">Referrals</a></li>
                                <li><a href="?a=referallinks">Promo banners</a></li>
                                <?php
                                }
                                ?>
                                
                                <li><a href="?a=edit_account">Settings</a></li>
                                <li><a href="?a=logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="cabinet-info">
                            <div class="block">
                                <div class="box">
                                    <div class="avatar">
                                        <div class="icon">
                                            <i style="background-image: url('../static/img/splash/ava.png')"></i>
                                        </div>
                                        <div class="info">
                                            <b><?php echo $_SESSION['username']; ?></b>
                                            <a href="?a=edit_account">
                                                <i><img src="../static/img/admin/cab-top-ic1.png"></i>
                                                <span>
                                                    <?php
                                                    $email = Users::getUserEmailById($_SESSION['uid']);
                                                    echo $email;
                                                    ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!isset($_SESSION['login_date'])) {

                                $date = getdate();
                                $_SESSION['login_date'] = date('M-d-Y', strtotime('today')) . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                            }
                            ?>
                            <div class="block">
                                <div class="box">
                                    <div class="last">
                                        <div class="info">
                                            <i><img src="../static/img/admin/cab-top-ic4.png"></i>
                                            <p><span>Date of registration:</span><b><?php echo date('M-d-Y H:i:s', strtotime($_SESSION['regDate'])); ?></b></p>
                                        </div>
                                        <div class="info">
                                            <i><img src="../static/img/admin/cab-top-ic4.png"></i>
                                            <p><span>Last visit:</span><b><?php echo $_SESSION['login_date']; ?></b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block">
                                <div class="box">
                                    <div class="ref">
                                        <div class="info">
                                            <i><img src="../static/img/admin/cab-top-ic3.png"></i>
                                            <p><span>Last visit from IP:</span><b><?php echo $_SERVER['REMOTE_ADDR']; ?></b></p>
                                        </div>
                                        <div class="info">
                                            <i><img src="../static/img/admin/cab-top-ic6.png"></i>
                                            <p><span>Referral link:</span>
                                                <a href="#"><?php echo $_SERVER['SERVER_NAME'] . '?ref=' . $_SESSION['username']; ?></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cabinet-link">
                            <div class="block">
                                <a href="?a=withdraw" class="link-in">
                                    <span>Withdraw<br>profit</span>
                                    <i><img src="../static/img/admin/cab-top-big-ic1.png"></i>
                                </a>
                            </div>
                            <div class="block"><div class="sum"><p><span>Balance:</span><b id="balance">$ <?php $bal = Transactions::getUserBalance();
                            echo $bal; ?></b></p></div></div>
                            <div class="block">
                                <a href="?a=deposit" class="link-out">
                                    <span>Make<br>deposit</span>
                                    <i><img src="../static/img/admin/cab-top-big-ic2.png"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!--HEADER END-->
                <div class="main-content"><!--MAIN CONTENT-->
                    <div class="inner-content"><!--INNER CONTENT-->

                        <div id="result" style="min-height: 50px; width: 100%;">

                        </div>
                        