<?php
session_start();
require 'control.php';

$duty = isset($_GET['a']) ? $_GET['a'] : '';
head();

switch ($duty) {
    case 'signup':
        signup();
        break;

    case 'reset':
        pwd_reset();
        break;

    case 'auth':
        auth();
        break;

    default:
        login();
        break;
}

foot();

function head()
{
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Cache-control" content="public">
    <!-- Title Page-->
    <title> Kinex Global - <?php echo isset($_GET['a']) ? ucwords($_GET['a']) : 'Login'; ?></title>

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

    <script src="vendor/jquery-3.2.1.min.js"></script>

    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
    input[type=text],
    input[type=email],
    input[type=password] {
        background-color: #eee;
    }

    input[attr:placeholder] {
        color: black;

    }

    .card-header {
        background-color: darkred !important;
        font-weight: bold !important;
        color: #fff;
    }

    .login-content {
        background-color: darkgray;
    }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container" style="overflow: visible;">

                <?php
}

function foot()
{
    ?>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>


        <!-- Bootstrap JS--
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
        <script src="vendor/slick/slick.min.js">
        </script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>

        <script src="vendor/slick/slick.min.js">
        </script>
        <script src="vendor/wow/wow.min.js"></script>

        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script>

        <!-- Main JS-->
        <script src="js/main.js"></script>


        <?php
if (isset($_SESSION['result'])) {
        $alert = ($_SESSION['result'][0] == 1) ? 'success' : 'danger';
        ?>

        <script type="text/javascript">
        var item = $('.login-form').closest('div');
        item.prepend(
            "<div class='alert alert-<?php echo $alert; ?>'> <?php echo ucwords($_SESSION['result'][1]); ?></div>");
        $('.alert').addClass('show');
        </script>
        <?php
unset($_SESSION['result']);
    }

    ?>


</body>

</html>
<!-- end document-->

<?php
}

function signup()
{
    Misc::setToken();
    $_SESSION['plan'] = isset($_GET['plan']) ? $_GET['plan'] : 1;
    ?>
<style>
::placeholder {
    font-size: 12px;
}

.login-wrap {
    max-width: 1000px;
    margin-bottom: 20px;
}

.page-wrapper {
    overflow: visible;

}


.modal-body {
    background-image: url('images/kenix/');
}
</style>
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="/">
                <img src="../assets/images/kinex.png" alt="Kinex Global" style="height: 100px;">
            </a>
        </div>
        <div class="login-form">

            <div class="row m-t-30">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"> Personal Details</div>
                        <div class="card-body">

                            <form action="?a=auth&i=signup" method="post">

                                <input required type="hidden" name="formToken"
                                    value="<?php echo $_SESSION['pgToken'];?>" />
                                <div class="form-group">

                                    <input required id="cc-pament" name="lname" type="text" class="form-control"
                                        value="" aria-required="true" placeholder="Surname" aria-invalid="false">
                                </div>
                                <div class="form-group">

                                    <input required id="cc-pament" name="fname" type="text" class="form-control"
                                        value="" aria-required="true" placeholder="First Name" aria-invalid="false">
                                </div>
                                <div class="form-group has-success">

                                    <input required id="cc-name" name="bank" type="text"
                                        class="form-control cc-name valid" placeholder="Bank" value="" data-val="true"
                                        data-val-required="Please enter the name of your bank" autocomplete="cc-name"
                                        aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                        data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">

                                    <input required id="cc-number" name="acctno" type="text"
                                        placeholder="Bank Account No" value=""
                                        class="form-control cc-number identified visa" data-val="true"
                                        autocomplete="cc-number">
                                    <span class="help-block" data-valmsg-for="cc-number"
                                        data-valmsg-replace="true"></span>
                                </div>

                                <div class="form-group">

                                    <input required id="cc-number" name="phone" type="text" placeholder="Phone No"
                                        class="form-control cc-number identified visa" value="" data-val="true"
                                        autocomplete="cc-number">
                                    <span class="help-block" data-valmsg-for="cc-number"
                                        data-valmsg-replace="true"></span>
                                </div>

                                <div class="form-group">

                                    <input required id="cc-number" name="email" type="email" placeholder="Email Address"
                                        value="" class="form-control cc-number identified visa" data-val="true"
                                        autocomplete="cc-number">
                                    <span class="help-block" data-valmsg-for="cc-number"
                                        data-valmsg-replace="true"></span>
                                </div>

                                <div class="form-group">

                                    <input required id="cc-pament" name="addr" type="text" class="form-control" value=""
                                        aria-required="true" placeholder="Resident Address" aria-invalid="false">
                                </div>

                                <div class="form-group">

                                    <input required id="cc-pament" name="country" type="text" class="form-control"
                                        value="" aria-required="true" placeholder="Country" aria-invalid="false">
                                </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Account Credentials</strong>

                        </div>
                        <div class="card-body card-block">
                            <div class="form-group">

                                <input required type="text" name="username" id="company"
                                    placeholder="Enter your username" class="form-control">
                            </div>
                            <div class="form-group">

                                <input required type="password" id="vat" name="password" placeholder="Password"
                                    class="form-control">
                            </div>
                            <div class="form-group">

                                <input required type="password" id="street" name="password2"
                                    placeholder="Repeat Password" class="form-control">
                            </div>
                            <div class="bl-title"><span>TERMS & CONDITIONS</span></div>
                            <div class="form-wr">
                                <style>
                                .alert li {
                                    padding: 10px;
                                    list-style-type: square;
                                }
                                </style>
                                <div class="alert alert--info">
                                    <ul>

                                        <li style="color: red; font-style: itlic; font-wight: bold">
                                            You've agrred that the information provided herein are valid, and can be
                                            verified by the company
                                        </li>


                                        <li>
                                            Your must verify your <b>email </b> before you can start investing!
                                        </li>


                                        <li>
                                            For your account to be activated, You must make payment before the 24 hour
                                            countdown
                                        </li>
                                        <li>
                                            Your account will be disabled if you don't recycle after your last payments
                                        </li>

                                        <li>
                                            Ones you upgrade to the next level, you can no longer return to the previous
                                            level
                                        </li>


                                    </ul>

                                </div>

                                <div class="check-item">
                                    <input required type="checkbox" id="terms" name="agree" value="1">
                                    <label for="terms">I have read and agree with the above and other <a href="?p=rules"
                                            target="_blank">Terms and conditions</a>
                                    </label>

                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-danger ">

                                        <span id="payment-button-amount"> Contine</span> <i class="fa fa-sign-in"></i>

                                    </button><br><br>
                                    <p> Already a member? <a href="?a=login" class="btn-link">Login</a> instead</p>
                                </div>

                                </form>
                            </div>


                            <?php
}

function login()
{
    Misc::setToken();
    ?>

                            <style>
                            .login-content {
                                background: black;
                            }
                            </style>
                            <div class="login-wrap">
                                <div class="login-content">
                                    <div class="login-logo">
                                        <a href="/">
                                            <img src="../assets/images/kinex.png" alt="Kinex Global"
                                                style="height: 100px;">
                                        </a>
                                    </div>
                                    <div class="login-form">
                                        <form action="?a=auth&i=login" method="post">
                                            <input required type="hidden" name="formToken"
                                                value="<?php echo $_SESSION['pgToken']; ?>" />
                                            <div class="form-group">


                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input required class="au-input required au-input--full" type="text"
                                                        name="username" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input required class="au-input required au-input--full"
                                                        type="password" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="login-checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember">Remember Me
                                                </label>

                                            </div>
                                            <button class="au-btn au-btn--block btn-danger m-b-20" type="submit">sign
                                                in <i class="fa fa-sign-in"></i></button>
                                            <label>
                                                <a href="?a=reset">Forgotten Password?</a>
                                            </label>
                                            <div class="social-login-content">
                                                <div class="social-button text-right">
                                                    <img src="images/social_icons.png" style="height:30px;" />
                                                </div>

                                            </div>
                                        </form>
                                        <div class="register-link">
                                            <p>
                                                Don't you have account?
                                                <a href="?a=signup">Sign Up Here</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
}

function auth()
{
    
    Misc::stopSignupRefresh();
   // var_dump($_SESSION); die();
    if ($_GET['i'] == 'signup') {

        $name = ucwords($_POST["lname"]) . ' '. ucwords($_POST["fname"]) ;
        $bank = ucwords($_POST["bank"]);
        $acct = $_POST["acctno"];
        $phone = $_POST["phone"];
        $email = strtolower($_POST["email"]);

        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $plan = $_SESSION['plan'];

        if ($password != $password2) {
            $_SESSION['result'] = array('2', 'The password fields must be same, please crosscheck');
            signup();
        } else {
//var_dump($_POST);
            if (!empty($name) && !empty($bank) && !empty($acct) && !empty($phone) && !empty($email) && !empty($username) && !empty($password)) {

                $test = Users::getUidByNicname($username);
                if ($test == null) {

                    $add = Users::createAcct($name, $email, $username, $password, $phone, $plan);
                    if ($add > 0) {
                        $upd = Users::updateUser($name, $email, $phone, $bank, $acct, $add);

                        $_SESSION['result'] = array('1', 'Registration Successsful, Welcome to Kenix Global<br> Please login to continue ');
                        login();
                    } else {
                        $_SESSION['result'] = array('2', 'Unsuccessful, please retry');
                        signup();
                    }
                } else {
                    $_SESSION['result'] = array('2', 'Error: The username is already in use, please use something else');
                    signup();
                }
            } else {
                $_SESSION['result'] = array('2', 'All the fields are compulsory');
                signup();
            }
        }

    } else {
        /// Acct details

        $username = $_POST["username"];
        $password = $_POST["password"];

        $test = Users::authAcct($username, $password);
//var_dump($test); //die();
        if ($test > 0) {
            $_SESSION['result'] = array('1', 'Welcome to Kenix Globals, together we grow ');
            $_SESSION['user'] = $test['user_id'];
            $_SESSION['user_level'] = $test['user_type'];
            $_SESSION['status'] = $test['status'];
            $_SESSION['key'] = CORP . '_Ok';
            echo '<script type="text/javascript"> window.location="index.php";</script>';
        } else {

            login();
            $_SESSION['result'] = array('2', 'Incorrect Credientials, please crosscheck');
        }

    }
}


function pwd_reset()
{
    if (isset($_POST['formToken'])) {
        
        Misc::setToken();
        
        $urname = trim($_POST['username']);
        
        if (!empty($urname)) {
            $check = Users::getUidByNicname($urname);
            var_dump($check);
            if (!empty($check)) {
                
                $email = Users::getUserEmailById($check);
                $genPwd = Misc::izRand(10);
                $upd = Users::updateUserAcct($urname, $genPwd, $check);
                $subj1 = 'Password Reset@' . $_SERVER['SERVER_NAME'];
                $msgs = '';
                $msgs .= '
			This is ' . CORP . '. <br> A password reset was recently received from your account. Please kindly use ' . $genPwd . ' for your password reset.<p> Please endeavour to change your password when you login to your dashoard </p>

			<p> Dated: ' . date('Y-m-d', strtotime('today')) . '<br><br> Yours <br>' . CORP . '</p>
			';
                //var_dump($_POST);
                $send = Misc::sendMail($msgs, $subj1, $email, Users::getUserFullNameByEmail($email));

                $_SESSION['result'] = array('1', 'A new password have been sent to your mail. Kindly login with the new password!');
                login();
            
        }else{
            $_SESSION['result'] = array('2', 'User not found! Please crosscheck');

        }
    }
    }
    ?>



                            <div class="login-wrap">
                                <div class="login-content">
                                    <div class="login-logo">
                                        <a href="/">
                                            <img src="../assets/images/kinex.png" alt="Kinex Global"
                                                style="height: 100px;">
                                        </a>
                                    </div>
                                    <div class="login-form">
                                        <form action="" method="post">
                                            <input required type="hidden" name="formToken"
                                                value="<?php echo $_SESSION['pgToken']; ?>" />

                                            <div class="form-group">
                                                <label>Your Username</label>
                                                <input required class="au-input required au-input--full" type="text"
                                                    name="username" placeholder="Enter account username">
                                            </div>
                                            <button class="au-btn au-btn--block btn-danger m-b-20"
                                                type="submit">submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php
}
?>