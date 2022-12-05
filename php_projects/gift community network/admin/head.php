<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/refined-coin.ico">
    <title><?php echo CORP; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!-- Data table-->


    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!---------------  WYSIWYG Editor for mail compose -------------->
    <link rel="stylesheet" href="assets/plugins/CLEditor1_4_3/jquery.cleditor.css" />
    <link rel="stylesheet" href="css/jquery.cleditor-hack.css" />

    <!-----------------------------    SELECT2----------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== --
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo.jpg" alt="LOGO" class="dark-logo" height="65px" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text --
                                <img src="../images/refined-coin.gif" alt="LOGO" class="dark-logo" />-->
                        </span>
                    </a>
                </div> 
                <script>
                $('.navbar-collapse .nav-toggler').click(function(){
                    $('#menu').toogleClass('mini-sidebar');
                });
</script>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a
                                class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down">
                            <!--<form class="app-search p-l-20">
                                    <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                                </form>-->
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <?php $name = explode(' ', Users::getUserFullNameById($_SESSION['pin']));?>
                            <a href="?pg=user" class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
                                href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span
                                    class="round round-warning m-r-5"><?php echo substr($name[0], 0, 1); ?></span>
                                <?php echo ucwords($name[0]);?></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link waves-effect waves-dark" href="?pg=exit"><i
                                    class="fa fa-exit 4x profile-pic m-r-5"
                                    style="color: antique!important; font-weight: bolder;"></i></a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div id="menu" class="">
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav ">
                    <ul id="sidebarnav">
                        <li>
                            <a href="?pg=dash" class="waves-effect"><i class="fa fa-clock-o m-r-10"
                                    aria-hidden="true"></i>Dashboard</a>
                        </li>
                        <?php
                            $ulvl = isset($_SESSION['ulevel']) ? $_SESSION['ulevel'] : "";

                            if ($ulvl == CLIENT) {
                                ?>


                        <li>
                            <a href="?pg=user" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>
                                Profile</a>
                        </li>
                        <?php
} elseif ($ulvl == ADMIN) {
    ?>

                        <li>
                            <a href="?pg=new_client" class="waves-effect"><i class="fa fa-user-plus m-r-10"
                                    aria-hidden="true"></i> New Client</a>
                        </li>

                        
                        <!--                                <li>
                                    <a href="#" class="waves-effect"><i class="fa fa-info-circle m-r-10" aria-hidden="true"></i> Mails  &nbsp;&nbsp; &nbsp;<i class="fa  fa-caret-down m-r-10" aria-hidden="true"></i></a>

                                    <ul>
                                        <li>
                                            <a href="?pg=mail" class="waves-effect"><i class="fa fa-pencil-square-o m-r-10" aria-hidden="true"></i> Compose</a>
                                        </li>

                                        <li>
                                            <a href="?pg=sent" class="waves-effect"><i class="fa fa-book m-r-10" aria-hidden="true"></i> Sent Mails</a>
                                        </li>


                                    </ul>

                                </li>

                                --


                                <li>
                                    <a href="#" class="waves-effect"><i class="fa fa-tags m-r-10" aria-hidden="true"></i> Confirm &nbsp;&nbsp;&nbsp;<i class="fa  fa-caret-down m-r-10" aria-hidden="true"></i></a>
                                    <ul>
                                    --
-->
                        <li>
                            <a href="?pg=approve_new_clients" class="waves-effect"><i class="fa fa-user-plus m-r-10"
                                    aria-hidden="true"></i> Approve New Clients</a>
                        </li><!--
                        <li>
                            <a href="?pg=config&req=1&status=1" class="waves-effect"><i class="fa fa-shopping-cart m-r-10"
                                    aria-hidden="true"></i>Acknowlegde Deposits</a>
                        </li>
-->
                        <li>
                            <a href="?pg=config&req=2&status=1" class="waves-effect"><i class="fa  fa-suitcase m-r-10"
                                    aria-hidden="true"></i> Send Withdrawals</a>
                        </li>
                        <!--
                                    </ul>

                                    
                        </li>
                        <li>
                                    <a href="#" class="waves-effect"><i class="fa fa-tags m-r-10" aria-hidden="true"></i> Transactions History<i class="fa  fa-caret-down m-r-10" aria-hidden="true"></i></a>
                                    <ul>


                        <li>
                            <a href="?pg=config&req=1&status=2" class="waves-effect"><i class="fa fa-table m-r-10"
                                    aria-hidden="true"></i> All Deposits</a>
                        </li>
-->
                        <li>
                            <a href="?pg=confirmed&req=2&status=2" class="waves-effect"><i class="fa fa-table m-r-10"
                                    aria-hidden="true"></i> All Withdrawals</a>
                        </li>

                        <li>
                            <a href="?pg=ref_tree" class="waves-effect"><i class="fa fa-table m-r-10"
                                    aria-hidden="true"></i> Referral Tree</a>
                        </li>
   
                        <li>
                            <a href="?pg=clients" class="waves-effect"><i class="fa  fa-users m-r-10"
                                    aria-hidden="true"></i>List of Clients</a>
                        </li>
                        <!--
                                <li>
                                    <a href="?pg=generate" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i> Generate Transactions</a>
                                </li>
    -->
                        <li>
                            <a href="?pg=user" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>
                                Personal Profile</a>
                        </li>

                        <?php
}
?>
                    </ul>
                    <div class="text-center m-t-30">
                            <a href="?pg=exit" class="btn btn-danger"> Log Out</a>
                        </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- body --->
        <?php
        /*
            if(!isset($_SESSION['bal'])){
				
$bal = Misc::calcUserBal($_SESSION['pin'], 3);
$_SESSION['bal'] = $bal;

}*/
?>

<style>
.dataTables_wrapper .row{
    display: contents;
    margin: 0 auto;
    
}
</style>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->