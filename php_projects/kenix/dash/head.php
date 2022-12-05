<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>Kinex Global :Dasboard - <?php echo isset($_GET['pg']) ? $_GET['pg'] : 'WELCOME'; ?></title>
    <meta http-equiv="Cache-control" content="public">
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"
        media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"
        media="all">

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        rel="stylesheet" media="all">

    <!-- Bootstrap CSS--
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css" rel="stylesheet"
        media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/custom.css" rel="stylesheet" media="all">
    <!-- Jquery JS--
    <script src="vendor/jquery-3.2.1.min.js"></script>
-->

    <script src="vendor/jquery-3.2.1.min.js"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <div class="header-button">

                            <button class="hamburger hamburger--slider" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                            <div class="logo">
                                <img src="../assets/images/kinex.png" alt="Kinex Global" style="height: 50px;">
                            </div>
                            <?php
$pending = Pledge::getPendingReturnByReceiver($_SESSION['user']);
if (!empty($pending)) {
    $num = count($pending);
    ?>
                            <div class="noti__item js-item-menu" data-toggle="tooltip" data-placement="bottom" title=""
                                data-original-title="Please confirm your paybacks!"
                                onclick=" return window.location='?pg=receive';"> <i
                                    class="zmdi zmdi-notifications"></i>
                                <span class="quantity"> <?php echo $num; ?></span>

                            </div>
                            <?php
}

if ($_SESSION['user_level'] == ADMIN) {

    $actives = Pledge::getExpiringTransactions();
    $compare = array();
    $a = 0;
    if (!empty($actives)) {

        foreach ($actives as $trans) {
            $test_pledge = Pledge::checkActiveTrans($trans);

            if (empty($test_pledge)) {$compare[] = $trans;}}
        $num2 = !empty($compare) ?
        count($compare) : "";if (!empty($num2)) {?>
                            <div class="noti__item js-item-menu" data-toggle="tooltip" data-placement="bottom" title=""
                                data-original-title="Please <?php echo $num2; ?> client(s) need to be merged manually"
                                onlick="return window.location='?pg=merge';">
                                <i class="zmdi zmdi-email danger"></i>
                                <span class="quantity"><?php echo $num2; ?></span>

                            </div>

                            <?php
}

    }

}
?>

                            <div class="noti-wrap">
                                <div class="noti__item js-item-menu">

                                    <i class="zmdi zmdi-power" onclick="return window.location='?pg=exit';"></i>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid" style="padding: 0px;">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active">
                            <a href="?pg=dash"> <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="?pg=accounts">
                                <i class="fas  fa-bar-chart-o"></i> Transactions History</a>
                        </li>


                        <li>
                            <a href="?pg=receive">
                                <i class="fas fa-briefcase"></i> Pending Profit </a>
                        </li>

                        <?php
if ($_SESSION['user_level'] == ADMIN) {
    if ($_SESSION['user'] == 1) {
        $admin_pause = Repayment::checkAdminPause();
        if (!empty($admin_pause)) {
            ?>
                        <li>
                            <a href="?pg=unpin">
                                <i class="fas fa-credit-card"></i> <?php echo 'Release Payment'; ?></a>

                        </li>

                        <?php
} else {
            ?>

                        <li>
                            <a href="?pg=recycle">
                                <i class="fas fa-credit-card"></i> <?php echo 'Redirect'; ?></a>

                        </li>
                        <?php
}

    } else {
        ?>
                        <li>
                            <a href="?pg=recycle">
                                <i class="fas fa-credit-card"></i> <?php echo 'Recycle'; ?></a>

                        </li>
                        <?php
}

    ?>
                        <li>
                            <a href="?pg=merge">
                                <i class="fas fa-wrench"></i> Merge </a>
                        </li>



                        <li>
                            <a href="?pg=add_fake">
                                <i class="fas fa-wrench"></i> Fake Transactions </a>
                        </li>

                        <li>
                            <a href="?pg=users">
                                <i class="fas fa-group"></i> Clients </a>
                        </li>
                        <?php
}
?>
                        <li>
                            <a href="?pg=profile">
                                <i class="fas fa-user"></i> My Profile </a>
                        </li>

                        <li>
                            <a href="?pg=exit">
                                <i class="zmdi zmdi-power"></i> Logout </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo" style="display: flex;

flex-flow: wrap column;

align-items: center;

padding: 0px;">
                <a href="/">
                    <img src="../assets/images/kinex.png" alt="Kinex Global" style="height: 70px;">
                    <img src="../assets/images/global.jpg" alt="Kinex Global" style="height: 30px; margin-top:2px;">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1" style="margin-top: 50px;">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="?pg=dash"> <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="?pg=accounts">
                                <i class="fas  fa-bar-chart-o"></i> Transactions History</a>
                        </li>


                        <li>
                            <a href="?pg=receive">
                                <i class="fas fa-briefcase"></i> Pending Profit </a>
                        </li>

                        <?php
if ($_SESSION['user_level'] == ADMIN) {
    if ($_SESSION['user'] == 1) {
        $admin_pause = Repayment::checkAdminPause();
        if (!empty($admin_pause)) {
            ?>
                        <li>
                            <a href="?pg=unpin">
                                <i class="fas fa-credit-card"></i> <?php echo 'Release Payment'; ?></a>

                        </li>

                        <?php
} else {
            ?>

                        <li>
                            <a href="?pg=recycle">
                                <i class="fas fa-credit-card"></i> <?php echo 'Redirect'; ?></a>

                        </li>
                        <?php
}

    } else {
        ?>
                        <li>
                            <a href="?pg=recycle">
                                <i class="fas fa-credit-card"></i> <?php echo 'Recycle'; ?></a>

                        </li>
                        <?php
}

    ?>
                        <li>
                            <a href="?pg=merge">
                                <i class="fas fa-wrench"></i> Merge </a>
                        </li>
                        <li>
                            <a href="?pg=add_fake">
                                <i class="fas fa-wrench"></i> Fake Transactions </a>
                        </li>

                        <li>
                            <a href="?pg=users">
                                <i class="fas fa-group"></i> Clients </a>
                        </li>
                        <?php
}
?>
                        <li>
                            <a href="?pg=profile">
                                <i class="fas fa-user"></i> My Profile </a>
                        </li>

                        <li>
                            <a href="?pg=exit">
                                <i class="zmdi zmdi-power"></i> Logout </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">

                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <?php
$pending = Pledge::getPendingReturnByReceiver($_SESSION['user']);
if (!empty($pending)) {
    $num = count($pending);
    ?>

                                    <div class="noti__item js-item-menu" data-toggle="tooltip" data-placement="bottom"
                                        title="" data-original-title="Please confirm your paybacks!"
                                        onclick=" return window.location='?pg=receive';"> <i
                                            class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"> <?php echo $num; ?></span>

                                    </div>
                                    <?php
}
?>


                                    <?php
if ($_SESSION['user_level'] == ADMIN) {

    $actives = Pledge::getExpiringTransactions();
    $compare = array();
    $a = 0;
    if (!empty($actives)) {

        foreach ($actives as $trans) {
            $test_pledge = Pledge::checkActiveTrans($trans);

            if (count($test_pledge) <= 0) {
                $compare[] = $trans;
            }
        }

        $num2 = !empty($compare) ? count($compare) : "";

        if (!empty($num2)) {
            ?>
                                    <div class="noti__item js-item-menu" data-toggle="tooltip" data-placement="bottom"
                                        title=""
                                        data-original-title="Please <?php echo $num2; ?> client(s) need to be merged manually"
                                        onlick="return window.location='?pg=merge';">
                                        <i class="zmdi zmdi-email danger"></i>
                                        <span class="quantity"><?php echo $num2; ?></span>

                                    </div>

                                    <?php
}

    }

}
?>
                                    <div class="noti__item account-item js-item-menu">


                                        <div class="content">
                                            <i class="zmdi zmdi-account"></i> &nbsp;
                                            <a class="js-acc-btn" href="#">
                                                <?php echo ucwords(Users::getNicnameById($_SESSION['user'])); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="?pg=profile">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>

                                                <div class="account-dropdown__footer">
                                                    <a href="?pg=exit">
                                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </header>
            <!-- HEADER DESKTOP-->
            <?php

if (isset($_GET['pg']) && ($_GET['pg'] == 'exit')) {
    //var_dump($_REQUEST); die();
    session_destroy();
    session_unset();
    echo '<script type="text/javascript"> window.location = "../";</script>';
    die();
}

if ($_SESSION['user_level'] != ADMIN) {
    if (isset($_POST['invest'])) {

        Misc::makeInvest($_SESSION['user']);
    }

    
    $pendinPled = Pledge::getPendingPledgeByPledger($_SESSION['user']);
    
    if (!empty($pendinPled)) {
        Misc::generateInvoice($pendinPled);
        //var_dump($pendinPled);
    }

// This checks if the user is active and repaid OR if acct is unactivated
    $last = Transaction::getUserLastTransaction($_SESSION['user']);

    $check_status = Pledge::countUserConfirmedReturns($last);

    if (((!empty($check_status)) && (count($check_status) > 0)) || ($_SESSION['status'] == UN_ACTIVATED)) {
        Misc::invest_req();
    }
}