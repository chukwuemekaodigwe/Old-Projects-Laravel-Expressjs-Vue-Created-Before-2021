<!--
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="public">
    <title>Kinex Global - <?php echo isset($_GET['a']) ? ucwords($_GET['a']) : '';?></title>
    <link rel="favicon" href="assets/images/favicon.png">
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' id='camera-css' href='assets/css/camera.css' type='text/css' media='all'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<style>
.active-mobi{
    border-radius: 30%;
    background: darkred;
    color: goldenrod;
    padding: 5px 30px 20px 30px;
    

}
</style>
<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse">
        <div class="container" stye="display: flex; flex-flow: row nowrap; justify-content: space-between;">
            <div class="navbar-header" style="">
                <!-- Button for smallest screens -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="?a=home" style="padding:5px;">
                    <img src="assets/images/kinex.png" alt=""></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right mainNav">
                    <li><a href="?a=home">Home</a></li>
                    <li><a href="?a=about">About</a></li>
                    <li><a href="?a=faq">FAQ</a></li>
                    <li><a href="?a=rules">Rules</a></li>

                    <li><a href="?a=contact">Contact</a></li>
                    <li class="active hiden-sm hidden-xs"><a href="dash/user.php">Login <i class="fa fa-sign-in"></i></a></li>
                    
                 <div>
                    <li class="hidden-lg hidden-md m-t-20"><a href="dash/user.php" class="active-mobi">Login <i class="fa fa-sign-in"></i></a></li>
                    </div>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    <!-- /.navbar -->
