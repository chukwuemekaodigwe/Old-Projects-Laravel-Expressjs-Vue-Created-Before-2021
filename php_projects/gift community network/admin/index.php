<?php
session_start();
require 'control.php';
//echo session_cache_expire('2');

Misc::authPage();

$duty = isset($_GET['pg']) ? $_GET['pg'] : "";
if ($duty == "") {
    $duty = isset($_POST['pg']) ? $_POST['pg'] : "";
}

$ulevel = isset($_SESSION['ulevel']) ? $_SESSION['ulevel'] : "";

include 'head.php';
if ($ulevel == CLIENT) {
    switch ($duty) {

        case "dash":
            home();
            break;

        case "credit":
            credit();
            break;

        case "debit":
            debit();
            break;

        case "user":
            user();
            break;

        case "depts":
            depts();
            break;

        case "withdraws":
            withd();
            break;

        case "ref":
            ref();
            break;

        case 'exit':
            logout();
            break;

        default:
            home();
            break;
    }
} elseif ($ulevel == ADMIN) {

    switch ($duty) {
        case "dash":
            home();
            break;

        case "ref_tree":
            reftree();
            break;

        case "clients":
            clients();
            break;
        case 'approve_new_clients':
            approve_new_clients();
            break;

        case "mail":
            email();
            break;

        case "sent":
            mails();
            break;

        case "config":
            config();
            break;

        case "confirmed":
            confirmed_withd();
            break;

        case 'exit':
            logout();
            break;

        case "user":
            user();
            break;

        case 'generate':
            addTransaction();
            break;

        case 'new_deposit':
            new_deposit();
            break;

        case 'with_datatable':

            echo Transactions::getWithdrawalUsingDataTable($_SESSION['from'], $_SESSION['to']);
            /* $data = Transactions::getWithdrawalUsingDataTable($_SESSION['from'], $_SESSION['to']);
            var_dump($data);die();
             */die();
            break;

        case 'new_client':
            new_client();
            break;

        default:
            home();
            break;
    }
} else {
    switch ($duty) {

        case 'auth':
            auth();
            break;

        case 'new_client':
            new_client();
            break;

        case 'login':
            login();
            break;

        default:
            logout();
            break;
    }

}

include 'foot.php';

function home()
{
    ?>


<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <?php
if ($_SESSION['ulevel'] == ADMIN) {

        ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Active Clients</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="fa fa-users fa-2x text-success"></i>
                            <?php echo Users::countActiveClients(); ?>
                        </h2>
                        <span class="text-muted">Total Active Deposits</span>
                    </div>
                    <span class="text-success">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title"> Awaiting Payouts</h2>
                    <div class="text-right">
                        <h2 class="font-light m-b-0 text-center primary medium-font">
                            <?php echo Transactions::getNumberofPayouts() ?></h2>

                    </div>
                    <span class="text-danger"></span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 35%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"> Pending Clients</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="ti-arrow-down text-success"></i>
                            <?php echo Users::countAwaitingClients(); ?>
                        </h2>
                        <span class="text-muted"> Awaiting approval</span>
                    </div>
                    <span class="text-success">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                </div>
            </div>
        </div>
        <!-- Column -->

    </div>
    <!-- Row -->


    <div class="row">
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card"><a href="?pg=new_client">
                    <div class="card-block">
                        <h4 class="card-title">Add New Client</h4>
                        <div class="text-right">
                            <p class="font-light m-b-0">
                                <i class="fa fa-user-plus fa-3x text-danger"></i>

                            </p>

                        </div>
                    </div>
            </div></a>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card"><a href="?pg=config&req=2&status=1">
                    <div class="card-block">
                        <h2 class="card-title"> Make Payout</h2>
                        <div class="text-right">
                            <p class="font-light m-b-0 text-center primary medium-font">
                                <span class="fas fa-hand-holding-usd fa-3x"></span>
                            </p>
                        </div>

                    </div>
            </div></a>
        </div>
        <!-- Column -->

        <div class="col-lg-4">
            <div class="card"><a href="?pg=approve_new_clients">
                    <div class="card-block">
                        <h4 class="card-title"> Approve New Clients</h4>
                        <div class="text-right">
                            <p class="font-light m-b-0">
                                <i class="fa fa-list fa-2x text-danger"></i>

                            </p>

                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Column -->

    </div>
    <!-- Row -->

    <?php
} else {

        $user = array();
        $user = Users::getUserById($_SESSION['pin']);

        $current_client = Transactions::getRefByUser($_SESSION['pin']);

        ?>
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Membership ID</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0"><i class="fa fa-2x fa-graduation-cap text-primary"></i>
                            <?php echo $user['member_id'] ?>
                        </h2>
                        <span class="text-muted"> Give this to your referrals</span </div>
                        <span class="text-primary">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%; height: 6px;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title"> N&otilde; of Downliners</h2>
                    <div class="text-right">
                        <h2 class="font-light m-b-0 text-center success medium-font">
                            <?php echo $current_client['total_downliners']; ?></h2>
                        <span class="text-success h3 text-left"><i class="fa fa-2x fa-tree"></i></span>
                    </div>
                    <span class="text-danger"></span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"> Gifting Stage</h4>
                    <div class="text-right">
                        <h2 class="font-light m-b-0">
                            <i class="fa fa-donate fa-2x text-danger"></i> &nbsp; &nbsp;
                            <?php echo Transactions::getPlanNameById($user['plan']); ?>
                        </h2>
                        <span class="text-muted"> </span>
                    </div>
                    <span class="text-danger">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 40%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                </div>
            </div>
        </div>
        <!-- Column -->

    </div>
    <!-- Row -->

    <?php
}
    ?>
</div>
</div>
</div>
</div>
<!-- Row -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<?php
}

function credit()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        Misc::stopRefresh();
        $amt = $_POST['amt'];
        $plan = $_POST['plans'];

        if (!empty($amt) && !empty($plan)) {

            $status = isset($_POST['fromAcct']) ? CONFIRM : PENDING;
            $plan_detail = array();
            $plan_detail = Transactions::getInvestmentPlanById($plan);
            if (($plan_detail != null) && ($amt >= $plan_detail['min_deposit'])) {

                $btc = Misc::getBTCequv($amt);
                $return = (($plan_detail['profit'] / 100) * $amt) + $amt;

                if (!isset($_POST['fromAcct'])) {

                    $deposit = Transactions::makeDeposit($_SESSION['pin'], $amt, $return, $plan, $btc, $status);
                    $name = 'refined_coin_ref';
                    if (isset($_COOKIE[$name])) {
                        $updRef = Transactions::updRefById($_SESSION['pin'], $_COOKIE['$name'], $deposit);
                    }

                    $btc_addr = '18owzMr1Cgor1yfqa29Pk9Hda8NibHXUoi';
                    Misc::generateInvoice($btc, $amt, $btc_addr, $plan_detail['name'], $_SESSION['pin']);

                } else {

                    if ($amt <= $_SESSION['bal']) {
                        $deposit = Transactions::makeDepositFromAcctByUid($_SESSION['pin'], $plan, $amt, $status, $return, $btc);
                        $_SESSION['result'] = array('1', 'Successfully Done!');
                        unset($_SESSION['bal']);
                        home();
                    } else {
                        $_SESSION['result'] = array('2', 'Sorry, you don\'t have enough credit/balance to invest');
                    }
                }

            } else {
                $_SESSION['result'] = array(2, 'Error: Please select a plan');
            }
        }
    } else {

        ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Invest!</h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">

                    <div class="text-left">

                        <span class="text-muted"> To make a deposit, take the following steps:</span>
                        <ol style="list-style-type: none">
                            <li><i class="fa fa-check-square-o"></i> &nbsp; Select an investment plan</li>
                            <li><i class="fa fa-check-square-o"></i> &nbsp; Enter the amount, <i>and</i></li>
                            <li><i class="fa fa-check-square-o"></i> &nbsp; Checkout!</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <style>
        .pricing-list1 h6 {
            font-size: 1.2em;
            color: gold;
        }

        .pricing-list1 .pricing-header1 p {
            font-size: 14px !important;
            padding-top: 10px;
        }

        .hidden {
            display: none !important;
        }
        </style>
        <?php
$plans = array();
        $plans = Transactions::getInvestmentPlans();
        Misc::setToken();
        ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title "> Step 1 - 3</h4>
                    <br>
                    <form class="form-horizontal form-material" method="post" action="">
                        <input type="hidden" name="pg_lvl" value="1" /><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>" />
                        <div class="form-group">
                            <label class="col-sm-12">Select a Plan</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" id="plans" required="" name="plans">
                                    <option> Select a Plan</option>
                                    <?php
foreach ($plans as $value) {
            ?> <option value="<?php echo $value['plan_id']; ?>" data-min="<?php echo $value['min_deposit']; ?>"
                                        data-max="<?php echo $value['max_deposit']; ?>"
                                        data-profit="<?php echo $value['profit']; ?>"
                                        data-plan="<?php echo $value['plan_id']; ?>">
                                        <?php echo ucfirst($value['name']); ?></option>
                                    <?php
}
        ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Amount</label>
                            <div class="col-md-12">
                                <input type="number" min="10" max="99" id="amt" disabled="" name="amt" required=""
                                    placeholder="Amount in Dollars" class="form-control form-control-line"
                                    title="Select a Plan first">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Expected Profit</label>
                            <div class="col-md-12">
                                <input type="text"
                                    style="color: red!important; font-size: 1.5em!important; text-align: left;"
                                    id="profit" disabled="" placeholder="Your Profit"
                                    class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>

                        <div class="">
                            <label class="col-md-12" style="cursor: pointer!important">

                                <input type="checkbox" name="fromAcct" title="You can invest from your existing balance"
                                    value="On" style="height:auto!important;">
                                Invest From Balance</label>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit" title="CheckOut"> INVEST &nbsp;<i
                                        class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title "> Investment Plans</h4><br />
                    <div class="row">

                        <?php
foreach ($plans as $value) {
            ?>
                        <div class="col-lg-6 pricing-list-botom-margin wow zoomIn" data-wow-duration="3s">
                            <label for="plan<?php echo $value['plan_id']; ?>" class="checkbox-inline"
                                style="cursor:pointer !important;">
                                <!-- Pricing  List1 Start -->
                                <div class="pricing-list1">
                                    <div class="pricing-header1" style="padding-bottom: 0px!important;">
                                        <h5><?php echo $value['name']; ?></h5>
                                        <center style="font-weight: bold;">
                                            <p>Profit &nbsp; <?php echo $value['profit']; ?>%</p>
                                        </center>
                                    </div>

                                    <input type="radio" id="plan<?php echo $value['plan_id']; ?>" name="plan" style="position: absolute; display: block; cursor: pointer; opacity: 0;
                                                   z-index: 55;" data-min="<?php echo $value['min_deposit']; ?>"
                                        data-max="<?php echo $value['max_deposit']; ?>"
                                        data-profit="<?php echo $value['profit']; ?>"
                                        data-plan="<?php echo $value['plan_id']; ?>" />

                                    <center>
                                        <div id="result" class="hidden cash"><i class="fa fa-check-square fa-3x"></i>
                                        </div>
                                    </center>
                                    <div class="price-range">
                                        <div class="row">
                                            <div class="col-md-6 text-left col-sm-6 col-xs-6">
                                                <div class="min-price">
                                                    <h6>Minimum <span class="color-text">$
                                                            <?php echo $value['min_deposit']; ?></span></h6>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right col-sm-6 col-xs-6">
                                                <div class="min-price">
                                                    <h6>Maximum<span class="color-text">$
                                                            <?php echo $value['max_deposit']; ?></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price-range">
                                        <div class="row">

                                            <div class="col-md-12 text-center col-sm-12 col-xs-12">
                                                <div class="min-price">
                                                    <h6>PayOut<br> <span
                                                            class="color-text"><b><?php echo $value['delay'] * 24; ?>hrs</b></span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </label>
                            <!-- Pricing List1 End -->
                        </div>

                        <?php
}
        ?>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- container--->
</div>
<?php
}
}

function logout()
{
    //session_cache_expire();
    session_destroy();
    session_unset();
    echo '<script type="text/javascript"> window.location = "../";</script>';
    //session_cache_limiter();
    //session_get_cookie_params();
}

function debit()
{

    $transTtl = Transactions::getTransTotalByUserId($_SESSION['pin']);
    $refComm = Transactions::getRefererTotalCommissn($_SESSION['pin'], 3);
    $pendWithdTtl = Transactions::getTotalWithdByStatus($_SESSION['pin'], PENDING);

    $ttlBal = ($transTtl + $refComm) - $pendWithdTtl;

    $un_dues = Transactions::getTotalUndueDepositByUid($_SESSION['pin']);

    $bal = $ttlBal - $un_dues;

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        Misc::stopRefresh();
        $amt = $_POST['withd_amt'];
        if (!empty($amt) && $amt <= $ttlBal) {

            $req = Transactions::makeWithdr($_SESSION['pin'], $amt);

            if ($req > 0) {
                $_SESSION['result'] = array('1', 'Withdrawal Order Placement Successful! ');
            } else {
                $_SESSION['result'] = array('2', 'An Error Occurred!');
            }
        } else {
            $_SESSION['result'] = array('2', 'Please fill up the request form');
        }

        if (isset($_POST['btc_addr']) && !empty($_POST['btc_addr'])) {
            $btc = $_POST['btc_addr'];
            $add = Users::addBitcoinAddrByUid($_SESSION['pin'], $btc);
            echo $add;
        }
    }

    $btc = Users::getBitcoinByUid($_SESSION['pin']);

    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Withdraw Your Returns!</h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"> Your Total Balance is</h4>
                    <h1> $ <?php echo number_format($ttlBal, 2); ?></h1>
                    <p> But you are due to withdraw only <b>
                            <?php $bal = $ttlBal - $un_dues;
    echo number_format($bal, 2);?>
                        </b>
                    </p>
                </div>
            </div>
        </div>
        <?php
$dueWithd = Transactions::getUserLastDueInvestment($_SESSION['pin']);
    if ($ttlBal != null) {
        if ($bal != null) {
            Misc::setToken();
            ?>
        <!-- Column -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> Order for Withdrawal</h3>

                    <br>
                    <form class="form-horizontal form-material" method="post" action="?pg=debit">
                        <input type="hidden" name="pg_lvl" value="1" /><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>" />

                        <div class="form-group">
                            <label class="col-md-12"> Amount</label>
                            <div class="col-md-12">
                                <input type="number" min="1" max="<?php echo $bal; ?>" id="amt" name="withd_amt"
                                    required="" placeholder="Amount in Dollars" class="form-control form-control-line">
                            </div>
                        </div>
                        <?php
if ($btc == null) {
                ?>

                        <div class="form-group">
                            <label class="col-md-12"> Bitcoin Address</label>
                            <div class="col-md-12">
                                <input type="text" name="btc_addr" required="" placeholder="Your Bitcoin Address"
                                    class="form-control form-control-line">
                            </div>
                        </div>

                        <?php
}
            ?>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit" title="CheckOut"> Send &nbsp;<i
                                        class="fa fa fa-credit-card"></i></button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <?php

        } else {
            ?>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-block">
                    <h5 class="card-title text-muted"> You are not yet due for withdrawal! Please check back on
                        <?php echo $dueWithd['Due']; ?></h5>

                </div>
            </div>
        </div>
        <?php
}

    } else {
        ?>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-block">
                    <h5 class="card-title text-muted"> You don't have any balance in your account, please invest to
                        enjoy your huge returns</h5>

                </div>
            </div>
        </div>
        <?php
}
    ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> List of Your Pending Withdrawals</h3><br />

                    <div class="table-responsive">
                        <table class=" table stylish-table table-bordered ">
                            <thead>
                                <tr>
                                    <th> S/N&otilde;</th>
                                    <th> Date of Request</th>
                                    <th> Amount</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
$pending = array();
    list($pending, $paging) = Transactions::getWithdByUserIdPerStatus($_SESSION['pin'], PENDING, '?pg=debit&');

    if ($pending != null) {
        $i = 0;
        foreach ($pending as $value) {
            ?>
                                <tr>
                                    <td> <?php echo ++$i; ?></td>
                                    <td> <?php echo $value['reg_date']; ?></td>
                                    <td>$ <?php echo number_format($value['amount'], 2); ?></td>

                                </tr>
                                <?php
}
    }
    ?>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
</div>
</div>
</div>
<?php
}

function user()
{
    $id = (isset($_GET['u'])) ? $_GET['u'] : $_SESSION['pin'];

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //Misc::stopRefresh();
        $pg = isset($_POST['duty']) ? $_POST['duty'] : "";

        switch ($pg) {
            case 'acct':
                $bank = $_POST['bank'];
                $bank_no = $_POST['acct_no'];
                $phone = $_POST['phone'];
                $name = $_POST['name'];

                $upd = Users::updUserAcct($phone, $name, $bank_no, $bank, $id);
                //$upd = Users::updBankDetails($id, $bank_no, $bank);
                $_SESSION['result'] = array('1', 'Update Completed Successfully!');

                break;

            case 'usr_acct':
//var_dump($_POST); die();

                $username = $_POST['username'];
                $pwd = $_POST['pwd'];
                $cpwd = $_POST['cpwd'];
                $admin = $_POST['admin'];

                if (!empty($pwd) && !empty($cpwd) && ($pwd == $cpwd)) {
                    $update = Users::UpdateUserLogins($id, $username, $pwd, $admin);
                    $_SESSION['result'] = array('1', 'Account Details Updated Successfully!');
                } else {
                    $_SESSION['result'] = array('2', 'Please fillup all the fields in the Login credentials form & crosscheck the passwords to be same');
                }

                break;

            default:
                echo '<script type=""> window.location = ".";</script>';
                break;
        }
    }

    Misc::setToken();
    //$btc = Users::getBitcoinByUid($_SESSION['pin']);

    $user1 = Users::getUserById($id);
    //$btc = Users::getBitcoinByUid($id);

    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> User Profile </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> Account Reset for <?php echo ucwords($user1['name']); ?> Account</h3><br />
                    <form class="form-horizontal form-matrial" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="duty" value="acct" /><input
                            type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Referrer's Name</label>
                            <div class="col-md-12">
                                <p><?php echo Users::getUserFullnameById($user1['referer']); ?>
                                </p>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Fullname</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo ucwords($user1['name']); ?>" required=""
                                    placeholder="Name as it appears on your bank account"
                                    class="form-control form-control-line" name="name" maxlength="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12"> Phone N&otilde;</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo ucwords($user1['phone']); ?>"
                                    class="form-control form-control-line" name="phone" maxlength="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Bank</label>
                            <div class="col-md-12">
                                <input type="text" name="bank" placeholder="Bank Name"
                                    class="form-control form-control-line" value="<?php echo $user1['bank']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Account Number</label>
                            <div class="col-md-12">
                                <input type="text" name="acct_no" placeholder="Account N&otilde;"
                                    value="<?php echo $user1['acct_no']; ?>" class="form-control form-control-line">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> Login Credentials</h3><br />
                    <form class="form-horizontal form-matrial" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="duty" value="usr_acct" /><input
                            type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />


                        <div class="form-group">
                            <label class="col-md-12"> Username</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo ($user1['username']); ?>" required=""
                                    placeholder="Define username for login"
                                    class="form-control form-control-line" name="username" maxlength="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12"> Password</label>
                            <div class="col-md-12">
                                <input type="text" value="" required=""
                                    placeholder="Define new password"
                                    class="form-control form-control-line" name="pwd" maxlength="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12"> Repeat Password</label>
                            <div class="col-md-12">
                                <input type="text" value="" required=""
                                    placeholder="Confirm Password"
                                    class="form-control form-control-line" name="cpwd" maxlength="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12"> Make this user an Admin</label>
                            <div class="col-md-12">
                               Yes <input type="radio" value="1" checked
                                    class="checkbox" name="admin">
                                 No   <input type="radio" value="2"
                                    class="checkbox" name="admin">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit"> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
}

function depts()
{
    if (isset($_POST['plan'])) {
        $_SESSION['status'] = $_POST['plan'];
    } else {
        $_SESSION['status'] = isset($_SESSION['status']) ? $_SESSION['status'] : PENDING;
    }

    $depo = array();
    list($depo, $paging) = Transactions::getUserDepositByStatus($_SESSION['pin'], $_SESSION['status'], '?pg=depts&');
    //var_dump($depo);die();
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Deposit History </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <?php
Misc::setToken();
    if ($_SESSION['status'] == CONFIRM) {
        ?>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <form method="post" action="" id="form">
                                <select class="custom-select pull-right" name="plan"
                                    onchange="return $('#form').trigger('submit');"
                                    title="Select another record to view">
                                    <option selected=""> View Toogle</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Confirmed</option>

                                </select>
                            </form>
                        </div>
                    </div>
                    <h4> Active Deposits</h4>

                    <style>
                    .table-responsive {
                        scrollbar-face-color: #f8bdfb !important;
                    }
                    </style>
                    <div class="row">
                        <div class="col-sm-11" style="margin: 0 auto;">

                            <div class="table-responsive">
                                <table class=" table stylish-table table-bordered  table-striped"
                                    id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> S/N&otilde;</th>
                                            <th> Payment Date</th>
                                            <th> Investment Plan</th>
                                            <th> Amount</th>
                                            <th title="Due date for withdrawal"> Due Date</th>
                                            <th> Expected Returns</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
if ($depo != null) {
            $i = 0;
            foreach ($depo as $value) {
                ?>
                                        <tr>
                                            <td> <?php echo ++$i; ?></td>
                                            <td> <?php echo $value['paymt_date']; ?></td>
                                            <td> <?php echo ucwords(Transactions::getPlanNameById($value['plan_id'])); ?>
                                            </td>
                                            <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                            <td> <?php echo $value['due_date']; ?></td>
                                            <td>$ <?php echo number_format($value['exp_return'], 2); ?></td>

                                        </tr>
                                        <?php
}
        }
        ?>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-12 col-xlg-12 col-md-12">

                                <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <form method="post" action="" id="form1">
                        <select class="custom-select pull-right" name="plan"
                            onchange="return $('#form1').trigger('submit');">
                            <option selected=""> View Toogle</option>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>

                        </select>
                    </form>
                    <h6> You may view the pending deposit &rarr;</h6>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
        ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <form method="post" action="" id="form">
                                <select class="custom-select pull-right" name="plan"
                                    onchange="return $('#form').trigger('submit');"
                                    title="Select another record to view">
                                    <option selected=""> View Toogle</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Confirmed</option>

                                </select>
                            </form>
                        </div>
                    </div>
                    <h4> Pending Deposits</h4>

                    <style>
                    .table-responsive {
                        scrollbar-face-color: #f8bdfb !important;
                    }
                    </style>
                    <div class="row">
                        <div class="col-sm-12" style="margin: 0 auto;">

                            <div class="table-responsive">
                                <table class=" table stylish-table table-bordered  table-striped"
                                    id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> S/N&otilde;</th>
                                            <th> Invoice Date</th>
                                            <th> Investment Plan</th>
                                            <th> Amount</th>
                                            <th title="BTC Equiv As From Invoice date"> BTC Amount</th>
                                            <th> Expected Returns</th>
                                            <th> BTC Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
if ($depo != null) {
            $i = 0;
            foreach ($depo as $value) {
                ?>
                                        <tr>
                                            <td> <?php echo ++$i; ?></td>
                                            <td> <?php echo date('Y/m/d', strtotime($value['reg_date'])); ?></td>
                                            <td> <?php echo ucwords(Transactions::getPlanNameById($value['plan_id'])); ?>
                                            </td>
                                            <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                            <td> <?php echo $value['btc_amt']; ?></td>
                                            <td>$ <?php echo number_format($value['exp_return'], 2); ?></td>
                                            <td> 18owzMr1Cgor1yfqa29Pk9Hda8NibHXUoi</td>
                                        </tr>
                                        <?php
}
        }
        ?>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-12 col-xlg-12 col-md-12">

                                <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <form method="post" action="" id="form1">
                        <select class="custom-select pull-right" name="plan"
                            onchange="return $('#form1').trigger('submit');">
                            <option> View Toogle</option>
                            <option value="1" selected="">Pending</option>
                            <option value="2">Confirmed</option>

                        </select>
                    </form>
                    <h6> You may view the Confirmed deposit &rarr;</h6>
                </div>
            </div>
        </div>
    </div>
    <?php
}
    ?>
</div>
<?php
}

function withd()
{

    if (isset($_POST['plan'])) {
        $_SESSION['status'] = $_POST['plan'];
    } else {
        $_SESSION['status'] = isset($_SESSION['status']) ? $_SESSION['status'] : CONFIRM;
    }
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Withdrawal History </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <?php
if ($_SESSION['status'] == PENDING) {
        $header = 'Pending ';
        $datename = 'Request';
        $date = 'reg_date';
    } else {
        $header = '';
        $datename = 'Payment';
        $date = 'paymt_date';
    }
    ?>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">

            <div class="card">
                <div class="card-block">
                    <div class="col-lg-12 col-xlg-12 col-md-12">

                        <form method="post" action="?pg=withdraws" id="form">
                            <select class="custom-select pull-right" name="plan"
                                onchange="return $('#form').trigger('submit');">
                                <option> View Toogle</option>
                                <option value="1">Pending</option>
                                <option value="2">Confirmed</option>

                            </select>
                        </form>
                    </div>
                    <h3 class="card-title"> <?php echo $header; ?> Withdrawals</h3><br />

                    <div class="table-responsive">
                        <table class=" table stylish-table table-bordered  table-striped" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th> S/N&otilde;</th>
                                    <th> Amount</th>
                                    <th> Date of <?php echo $datename; ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
$pending = array();
    list($pending, $paging) = Transactions::getWithdByUserIdPerStatus($_SESSION['pin'], $_SESSION['status'], '?pg=withdraws&');
    if ($pending != null) {
        $i = 0;

        foreach ($pending as $value) {
            ?>
                                <tr>
                                    <td> <?php echo ++$i; ?></td>

                                    <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                    <td> <?php echo $value["$date"]; ?></td>

                                </tr>
                                <?php
}
    }
    ?>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xlg-12 col-md-12">

            <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
        </div>
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <form method="post" action="?pg=withdraws" id="form1">
                        <select class="custom-select pull-right" name="plan"
                            onchange="return $('#form1').trigger('submit');">
                            <option> View Toogle</option>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>

                        </select>
                    </form>
                    <h6> Use this to toogle view &rarr;</h6>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
}

function config()
{
    if (isset($_GET['req'])) {
        $_SESSION['page'] = $_GET['req'];
    } else {
        $_SESSION['page'] = isset($_SESSION['page']) ? $_SESSION['page'] : DEPOSIT;
    }

    if ($_SESSION['page'] == 1) {
        $header = 'Deposits';
    } else {
        $header = 'Withdrawals';
    }

    if (isset($_GET['status'])) {
        $_SESSION['status'] = $_GET['status'];
    } else {
        $_SESSION['status'] = isset($_SESSION['status']) ? $_SESSION['status'] : PENDING;
    }
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> <?php echo $header; ?> </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <style>
    @media['width<700px'] {
        .date {
            width: 100% !important;
        }
    }
    </style>
    <?php
// THIS IS FOR WITHDRAW PAGE
    if (isset($_POST['approval']) && $_POST['approval'] == 1) {
        if (!empty($_POST['approve'])) {
            Misc::stopRefresh();
            /*
            var_dump($_POST);die();

            array(5) { ["approval"]=> string(1) "1" ["formToken"]=> string(16) "dLkUKCxssoM37Twe"
            ["dataTables-example_length"]=> string(2) "10" ["approve"]=> array(1) { [0]=> string(1) "2" }
            ["user_plan"]=> array(1) { [0]=> string(1) "1" } }

             */
            $apprv = array();
            $plan = array();
            $bank = array();
            $acct_no = array();
            $apprv = $_POST['approve'];
            $plan = $_POST['user_plan'];
            $bank = $_POST['user_bank'];
            $acct_no = $_POST['user_acct'];
            $i = 0;
            foreach ($apprv as $value) {
                $plan_detail = Transactions::getInvestmentPlanById($plan[$i]);
                $confirm = Transactions::confirmWithdrawal($value, $plan_detail['amount_withdrawn'], $plan_detail['plan_id'], $acct_no[$i], $bank[$i]);

                $update_user_plan = Users::UpdateUserPlan($value);
                if ($plan_detail['plan_id'] >= 4) {
                    $update_user_status = Users::UpdateUserStatus($value, 0);
                }

                $i += 1;
            }

            if ($confirm > 0) {
                $_SESSION['result'] = array('1', 'Confirmation(s) Successful!');
            }

        }
    }

    $from = time() - (60 * 60 * 24 * 2 * 30);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['from'])) {
        $_SESSION['from'] = date('Y-m-d', strtotime($_POST['from']));
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['to'])) {
        $date1 = strtotime($_POST['to']) + $day1;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    Misc::setToken();
    //var_dump(); echo date('Y-m-d', $date1);
    ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <!--
                        <form method="post" action="?pg=config" id="date_form">
                            <div class="row">

                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                    <div class="form-group">
                                        <label class=""> From: &nbsp;&nbsp;</label>
                                        <input type="date" value="<?php echo $_SESSION['from']; ?>" min="2015-01-01"
                                            name="from" required="" onchange="return $('#date_form').trigger('submit');"
                                            max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                            title="Change this to submit">

                                    </div>
                                </div>

                                <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>--
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                    <div class="form-group" style="float: right;" class="date">
                                        <label class=""> To</label>
                                        <input type="date" min="2015-01-01" value="<?php echo $_SESSION['to']; ?>"
                                            name="to" required=""
                                            max="<?php echo date('Y-m-d', strtotime('today')); ?>">

                                    </div>
                                </div>
                            </div>
                        </form>-->
                        </div>
                    </div>
                    <h3 class="card-title text-center"><?php if ($_SESSION['status'] == CONFIRM) {
        echo 'Confirmed';
    } else {
        echo 'Pending';
    }
    ?> Withdrawals<br>
                        <!--As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To
                    <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?>-->
                    </h3>
                    <style>
                    td {
                        text-align: center;
                    }
                    </style>

                    <div class="row">
                        <div class="col-sm-12" style="margin: 0 auto;">
                            <form action="?pg=config" method="post"><input type="hidden" name="approval"
                                    value="1" /><input type="hidden" name="formToken"
                                    value="<?php echo $_SESSION['pgToken']; ?>" />
                                <div class="table-responsive">
                                    <table class="table stylish-table table-bordered  table-striped"
                                        id="dataTables-exmple">
                                        <thead>
                                            <tr>

                                                <th> S/N&otilde;</th>
                                                <th> Ack</th>


                                                <th> Client Name</th>
                                                <th> Amount</th>
                                                <th> Bank</th>
                                                <th> Account N&otilde;</th>
                                                <th> Gifting Stage</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$plans = Transactions::getInvestmentPlans();

    $i = 0;
    foreach ($plans as $p) {

        ?>

                                            <tr>

                                                <th colspan="7">
                                                    <?php echo ucwords($p['name']); ?>
                                                </th>
                                            </tr>
                                            <?php

        $eligible = Transactions::getDueReceiversByPlan($p['plan_id'], $p['no_of_downliner']);

        foreach ($eligible as $j) {
/*
//set_time_limit(0);

$i = 1;
$all_clients = Users::getUsersByPlan($p['plan_id']);
foreach ($all_clients as $j) {
$curr_ref = Transactions::getRefByUser($j['referer']);
if(!empty($curr_ref)){

$ref_tree =  $curr_ref['ref_tree'].','.$j['referer'];

var_dump($j); echo '<<< >>>'; var_dump($ref_tree); echo '<br>';
$updateRecord = Transactions::miscUpdateReferrals($ref_tree, $j['user_id']);
$count = Transactions::updateMyUpliner($ref_tree);
}else{
echo 'NAN';
}

echo $i++;
}

}
die(); */
            ?>

                                            <tr onclick="mark(<?php echo $j['user_id']; ?>)" style="cursor: pointer;"
                                                id="p<?php echo $j['user_id']; ?>">

                                                <td> <?php echo ++$i; ?></td>
                                                <td><input type="checkbox" name="approve[]"
                                                        id="<?php echo $j['user_id']; ?>"
                                                        class="confirm checkbox form-control"
                                                        value="<?php echo $j['user_id']; ?>" />

                                                    <input type="hidden" name="user_plan[]" class=""
                                                        value="<?php echo $p['plan_id']; ?>" />
                                                </td>

                                                <td> <?php echo ucwords($j['name']); ?></td>
                                                <td> <?php echo number_format($p['amount_withdrawn'], 2); ?> </td>
                                                <td> <?php echo ucwords($j['bank']); ?><input type="hidden"
                                                        name="user_bank[]" class="" value="<?php echo $j['bank']; ?>" />
                                                </td>
                                                <td> <?php echo ucwords($j['acct_no']); ?><input type="hidden"
                                                        name="user_acct[]" class=""
                                                        value="<?php echo $j['acct_no']; ?>" /></td>
                                                <td> <?php echo ucwords($p['name']); ?></td>
                                            </tr>

<?php

        }}
    ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" class="text-Center">
                                                    <input type="submit" value="Save" class="btn btn-primary" /></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<?php
}

function confirmed_withd()
{

    if (isset($_GET['req'])) {
        $_SESSION['page'] = $_GET['req'];
    } else {
        $_SESSION['page'] = isset($_SESSION['page']) ? $_SESSION['page'] : DEPOSIT;
    }

    if ($_SESSION['page'] == 1) {
        $header = 'Deposits';
    } else {
        $header = 'Withdrawals';
    }

    if (isset($_GET['status'])) {
        $_SESSION['status'] = $_GET['status'];
    } else {
        $_SESSION['status'] = isset($_SESSION['status']) ? $_SESSION['status'] : PENDING;
    }
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> <?php echo $header; ?> </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <style>
    @media['width<700px'] {
        .date {
            width: 100% !important;
        }
    }
    </style>
    <?php
$day1 = 60 * 60 * 24;
    $from = time() - (60 * 60 * 24 * 2 * 30);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['from'])) {
        $_SESSION['from'] = date('Y-m-d', strtotime($_POST['from']));
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['to'])) {
        $date1 = strtotime($_POST['to']) + $day1;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    Misc::setToken();
    //var_dump(); echo date('Y-m-d', $date1);
    ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">

                            <form method="post" action="" id="date_form">
                                <div class="row">

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                        <div class="form-group">
                                            <label class=""> From: &nbsp;&nbsp;</label>
                                            <input type="date" value="<?php echo $_SESSION['from']; ?>" min="2015-01-01"
                                                name="from" required=""
                                                onchange="return $('#date_form').trigger('submit');"
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                title="Change this to submit">

                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                        <div class="form-group" style="float: right;" class="date">
                                            <label class=""> To</label>
                                            <input type="date" min="2015-01-01" value="<?php echo $_SESSION['to']; ?>"
                                                name="to" required=""
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h3 class="card-title text-center"><?php if ($_SESSION['status'] == CONFIRM) {
        echo 'Confirmed';
    } else {
        echo 'Pending';
    }
    ?> Withdrawals</h3>

                    <p class="text-center"> As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To
                        <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></p>
                    <style>
                    td {
                        text-align: center;
                    }
                    </style>

                    <div class="row">
                        <div class="col-sm-12" style="margin: 0 auto;">
                            <form action="?pg=config" method="post"><input type="hidden" name="approval"
                                    value="1" /><input type="hidden" name="formToken"
                                    value="<?php echo $_SESSION['pgToken']; ?>" />
                                <div class="table-responsive">
                                    <table class="table stylish-table table-bordered  table-striped"
                                        id="dataTables-exmaple">
                                        <thead>
                                            <tr>
                                                <th></th>

                                                <th> Date sent</th>


                                                <th> Client Name</th>
                                                <th> Amount</th>
                                                <th> Bank</th>
                                                <th> Account N&otilde;</th>
                                                <th> Gifting Stage</th>

                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th></th>

                                                <th> Date sent</th>


                                                <th> Client Name</th>
                                                <th> Amount</th>
                                                <th> Bank</th>
                                                <th> Account N&otilde;</th>
                                                <th> Gifting Stage</th>

                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<?php
}

function clients()
{

    $duty = isset($_GET['req']) ? $_GET['req'] : "";
    if ($duty == '') {
        $duty = isset($_POST['req']) ? $_POST['req'] : "";
    }

    if ($duty == 'edit') {

    }

    $depo = array();
    list($paging, $depo) = Users::getAllUsers('?pg=clients&');
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Clients Profile Page </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <?php

    if ($duty == 'edit') {

        $pid = $_GET['u'];
        if (!empty($pid)) {
            $user = Users::getUserById($pid);
            if (!empty($user)) {

                ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-block">
                    <center class="m-t-30"> <span class="round round-primary"><?php echo substr($user['name'], 0, 1); ?>
                        </span>
                        <h4 class="card-title m-t-10"><?php echo ucwords($user['name']); ?></h4>
                        <h6 class="card-subtitle"><?php echo $user['username']; ?></h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                    <font class="font-medium">254</font>
                                </a></div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="fa  fa-money"></i>
                                    <font class="font-medium">54</font>
                                </a></div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-block">
                    <form class="form-horizontal form-material" method="post" action="?pg=clients&req=upd"><input
                            type="hidden" name="uid" value="<?php echo $user['user_id']; ?>" />
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="First Name (first)" name="cl_name"
                                    class="form-control form-control-line"
                                    value="<?php echo ucwords($user['name']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Username</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Nickname" name="urname"
                                    value="<?php echo $user['username']; ?>" class="form-control form-control-line">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" value="<?php echo $user['email']; ?>"
                                    class="form-control form-control-line" name="email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="pwd" maxlength="32"
                                    value="<?php echo $user['password']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Bitcoin Address</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="btc"
                                    value="<?php echo $user['btc_no']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Security Question</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $user['secret_q']; ?>"
                                    class="form-control form-control-line" name="que">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Answer</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $user['answer']; ?>"
                                    class="form-control form-control-line" name="ans">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12"> Status</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="status">
                                    <option value="1">Active </option>
                                    <option value="2"> Deactivate</option>>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-danger" type="button" onclick="return window.history.back();">
                                    Back</button>
                                <button class="btn btn-primary" type="submit"> Modify</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <?php
} else {
                $_SESSION['result'] = array('2', 'Please select an active account');
            }
        }
    } elseif ($duty == 'upd') {
        /*
        var_dump($_POST); die();

        array(8) { ["uid"]=> string(1) "4" ["cl_name"]=> string(10) "Jacob Sand" ["email"]=> string(27) "digitalplazas.inc@gmail.com" ["pwd"]=> string(10) "contra1964" ["btc"]=> string(0) "" ["que"]=> string(16) "My mother's Name" ["ans"]=> string(2) "Ij" ["status"]=> string(1) "1" }

         */

        $urname = $_POST['urname'];
        $email = $_POST['email'];

        $name = $_POST['cl_name'];
        $pwd = $_POST['pwd'];
        $btc_addr = $_POST['btc'];
        $status = $_POST['status'];
        $user = $_POST['uid'];
        if ($status != 1) {
            $upd_status = Users::changeUserStatus($user);
        }

        $updAcct = Users::updUserAcct($urname, $pwd, $user);
        $upd_btc = Users::addBitcoinAddrByUid($user, $btc_addr);

        $_SESSION['result'] = array(1, 'Client details updated successfully!');
        echo '<script type="text/javascript"> window.location="?pg=clients";</script>';
    } else {

        ?>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Client's Details</h4>

                    <style>
                    .table-responsive {
                        scrollbar-face-color: #f8bdfb !important;
                    }
                    </style>
                    <div class="row">
                        <div class="col-sm-12" style="margin: 0 auto;">

                            <div class="table-responsive">
                                <table class=" table stylish-table table-bordered  table-striped"
                                    id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th> S/N&otilde;</th>

                                            <th> Full Name</th>
                                            <th> Phone No</th>
                                            <th> Account No</th>
                                            <th> Bank</th>
                                            <th> Membership ID</th>
                                            <th> Referrer</th>
                                            <th> Gifting Stage</th>
                                            <th> Options</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th> S/N&otilde;</th>

                                            <th> Full Name</th>
                                            <th> Phone No</th>
                                            <th> Account No</th>
                                            <th> Bank</th>
                                            <th> Membership ID</th>
                                            <th> Referrer</th>
                                            <th> Gifting Stage</th>
                                            <th> Options</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
    ?>
</div>
<?php
}

function email()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //Misc::stopRefresh();
        $subj = $_POST['subj'];
        $msg = $_POST['msg'];
        $addr = array();
        $name = array();

        if (!isset($_POST['all']) && $_POST['addr'] != null) {
            //var_dump($_POST);die();
            $addrs = $_POST['addr'];
            $savedAddr = $addrs;
            $all = 0;
            $addr = explode(';', $addrs);
            if ($addr != null) {
                foreach ($addr as $value) {
                    $name[] = Users::getUserFullNameByEmail($value);
                }
            }
        } else {
            $addr = Users::getAllUserEmail();
            $name = Users::getAllUserFullName();
            $savedAddr = '';
            $all = 1;
        }

        $send = Misc::sendMail($msg, $subj, $addr, $name);

        if ($send) {
            $save = Misc::recordMail($subj, $msg, $savedAddr, $all);
            $_SESSION['result'] = array('1', 'Mail Successfully Sent!');
        } else {

            $_SESSION['result'] = array('2', 'An error occurred!, Mail Not Sent!');
        }

    } // getUserFullNameByEmail($addr)

    Misc::setToken();
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Mails </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Compose Mail</h4>

                    <div>
                        <form class="form-horizontal form-material" method="post" enctype="multipart/form-data"
                            action="?pg=mail"><input type="hidden" name="pg_lvl" value="1" /><input type="hidden"
                                name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                            <div class="form-group">
                                <label class="col-md-12"> Message Title</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="subj" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <label class="col-md-12" style="cursor: pointer!important">


                                        <i>Do you want to send to all?</i> &nbsp;&nbsp;<input type="checkbox" name="all"
                                            title="" value="On" style="height:auto!important;"></label>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-12"> Email Addresses</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line"
                                                placeholder="If you are not sending to all, edit this."
                                                title="Semi-colon separated list of emails" name="addr">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12"> Message Body</label>
                                <div class="col-md-12">
                                    <textarea id="message" class="form-control form-control-line" required=""
                                        name="msg"></textarea>
                                    <div class="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <!--<input class="btn btn-primary" title="max size is 250kb" type="file" accept="image/*" value="Upload Attached Images">  &nbsp;&nbsp;--><button
                                        class="btn btn-primary" type="submit"> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
}

function mails()
{
    $day1 = (60 * 60 * 24);
    $from = time() - (60 * 60 * 24 * 2 * 30);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['from'])) {
        $_SESSION['from'] = date('Y-m-d', strtotime($_POST['from']));
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['to'])) {
        $date1 = strtotime($_POST['to']) + $day1;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    $depo = array();
    list($paging, $depo) = Misc::getAllSentMsgUntilDate($_SESSION['from'], $_SESSION['to'], '?pg=sent&');

    //var_dump(); echo date('Y-m-d', $date1);
    ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Mails </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Sent Mails</h4>


                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <form method="post" action="?pg=sent" id="date_form">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                                        <div class="form-group">
                                                            <label class=""> From: &nbsp;&nbsp;</label>
                                                            <input type="date" value="<?php echo $_SESSION['from']; ?>"
                                                                min="2015-01-01" name="from" required=""
                                                                onchange="return $('#date_form').trigger('submit');"
                                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                                title="Change this to submit">

                                                        </div>
                                                    </div>

                                                    <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>-->
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                                                        <div class="form-group" style="float: right;" class="date">
                                                            <label class=""> To</label>
                                                            <input type="date" min="2015-01-01"
                                                                value="<?php echo $_SESSION['to']; ?>" name="to"
                                                                required=""
                                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <h3 class="card-title text-center"> Sent Mails<br> As From
                                        <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To
                                        <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></h3>
                                    <style>
                                    td {
                                        text-align: center;
                                    }
                                    </style>

                                    <div class="row">
                                        <div class="col-sm-12" style="margin: 0 auto;">

                                            <div class="table-responsive">
                                                <table class="table stylish-table table-bordered  table-striped"
                                                    id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th> S/N&otilde;</th>
                                                            <th> Date Sent</th>
                                                            <th> Message Title</th>
                                                            <!--<th> Body</th>-->

                                                            <th> Recipients</th>
                                                            <th> Options</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
//payment date, delay  ==> for confirmed persons
    if ($depo != null) {
        $i = 0;
        foreach ($depo as $value) {
            ?>
                                                        <tr>
                                                            <td> <?php echo ++$i; ?></td>
                                                            <td> <?php echo $value['reg_date']; ?></td>
                                                            <td> <?php echo $value['title']; ?></td>

                                                            <!--<td><?php echo strip_tags($value['body'], 'p br a img'); ?></td>-->
                                                            <td> <?php if (!empty($value['sent_to_all'])) {$addr = 'To all Clients';} else { $addr = str_replace(';', '<br>', $value['addresses']);}
            echo $addr;?>
                                                            </td>
                                                            <td> <i class="fa fa-mail-forward"></i> &nbsp;&nbsp;&nbsp;
                                                                <i class="fa fa-power-off"></i></td>

                                                            <td>&nbsp;</td>
                                                        </tr>

                                                        <?php
}

    }
    ?>

                                                    </tbody>
                                                    <tfoot></tfoot>
                                                </table>
                                            </div>

                                        </div>


                                        <div class="col-lg-12 col-xlg-12 col-md-12">

                                            <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

}

function ref()
{

    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Affliate Program </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <style>
    .well {
        padding: 20px;
        background: #ececec;
        border-radius: 10px;
    }
    </style>
    <?php
$reflink = Users::getRefLinkByUid($_SESSION['pin']);
    ?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Affiliate / Referral Link</h4><br>
                    <p> You can also earn by becoming our affiliate. You stand to gain 3% of the first deposit of any
                        person who becomes our partner with your affiliate link. Therefore share the link below to start
                        earning huge!</p>
                    <div class="col-sm-12 well">
                        <?php
$reflink = Users::getRefLinkByUid($_SESSION['pin']);
    ?>
                        <h5 class="text-center" style="word-wrap: break-word;">
                            <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '?ref=' . $reflink; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Statistics</h4>
                    <p> Currently, you have <span class="h4">
                            <?php echo Transactions::getActiveRefByUid($_SESSION['pin']); ?></span> active referrals and
                        <span class="h4"> <?php echo Transactions::getPassiveRefByUid($_SESSION['pin']); ?></span>
                        passive referrals</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">

                    <h4> Financial Summary</h4>
                    <p> You've earned $
                        <?php echo number_format(Transactions::getRefererTotalCommissn($_SESSION['pin'], 3), 2); ?>
                        commission from your affliate link</p>
                </div>
            </div>
        </div>
    </div>



</div>

<?php
}

function addTransaction()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        Misc::stopRefresh();
        /*
        var_dump($_POST); die();

        array(5) { ["pg_lvl"]=> string(1) "1" ["formToken"]=> string(16) "ddaWC7IPctZbDwfx" ["urname"]=> string(4) "okey" ["amt"]=> string(5) "77667" ["type"]=> string(1) "1" }

         */

        $username = trim($_POST['urname']);
        $amt = $_POST['amt'];
        $type = $_POST['type'];

        $generate = Transactions::addAdminTrans($username, $amt, $type);

        if ($generate > 0) {
            $_SESSION['result'] = array(1, 'Added Successfully');
        } else {
            $_SESSION['result'] = array(2, 'An error occurred, please try again');
        }

    }

    Misc::setToken();
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Add Transactions </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-6 col-md-6" style="margin: 0 auto !important;">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> Add Credit/Debit <i class="fa fa-plus"></i></h3><br />
                    <form class="form-horizontal form-material" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>" />
                        <div class="form-group">
                            <label class="col-md-12"> Username</label>
                            <div class="col-md-12">
                                <input type="text" required="" placeholder="Provide a username"
                                    class="form-control form-control-line" name="urname" maxlength="25">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Amount</label>
                            <div class="col-md-12">
                                <input type="number" min="1" required="" class="form-control form-control-line"
                                    name="amt" maxlength="32">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12"> Transaction Type</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="type">
                                    <option> Select type</option>
                                    <option value="1">Deposit </option>
                                    <option value="2"> Withdrawal</option>>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-danger" type="reset"> Cancel</button>
                                <button class="btn btn-primary" type="submit"> Add</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Column -->
    </div>
</div>



<?php

}

function new_client()
{

    if (isset($_POST['pg_lvl'])) {

        $name = ucwords($_POST['client_name']);
        $phone = $_POST['client_phone'];
        //$email = $_POST['email'];
        $acct_no = $_POST['acct_no'];
        $bank = $_POST['bank'];
        //$username = $_POST['urname'];
        //$pwd = $_POST['pwd'];
        //$cpwd = $_POST['cpwd'];
        $referer = $_POST['referer'];

        if (!empty($name)) {

            $main_ref = Transactions::assignReferer($referer);
            //var_dump($_POST['referer']); echo '<br>'; var_dump($main_ref);  echo '<br>'; //die();
            $member_id = rand(2350, 9999);
            if (isset($_SESSION['ulevel']) && $_SESSION['ulevel'] == 1) {
                $status = 1;
            } else {
                $status = 2;
            }

            //var_dump($main_ref); die();
            $save_acct = Users::createAcct($name, '', $phone, '', '', $bank, $acct_no, $main_ref, $member_id, $status);

            if (!empty($save_acct)) {
                $ref_detail = Transactions::getRefByUser($main_ref);


                if (empty($ref_detail)) {
                    //var_dump($ref_detail); die();
                    $_SESSION['result'] = array(2, 'An error occurred, please retry');
                } else {
                    
                    $ref_tree = (!empty($ref_detail['ref_tree'])) ? ($ref_detail['ref_tree'] . ',' . $main_ref) : ('1' . ',' . $main_ref);
                    //$ref_tree = $ref_detail['ref_tree'].','.$main_ref;

                    $save_referer = Transactions::addNewReferer($save_acct, $main_ref, $ref_detail['hierarchy'], ($ref_detail['tree_level'] + 1), $ref_tree);
                    $updateDownliner = Transactions::updateMyUpliner($ref_tree);

                    $_SESSION['result'] = array('1', 'New Client Successfully Registered with Member ID: <h4>' . $member_id . '</h4>');
                }

            } else {
                $_SESSION['result'] = array(2, 'An error occurred, please retry');
            }
/*
} else {
$_SESSION['result'] = array(2, 'Username already in use, please use another');
}
}

 */

        } else {
            $_SESSION['result'] = array(2, 'Fill in all fields');
        }
    }

    Misc::setToken();
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> New Member's Form </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> New Client Account</h3><br />
                    <form class="form-horizontal form-maerial" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="duty" value="acct" /><input
                            type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Referrer's Name</label>
                            <div class="col-md-12">
                                <select class="form-control select22" name="referer">

                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="col-md-12"> Client Fullname</label>
                                <div class="col-md-12">
                                    <input type="text" value="" required=""
                                        placeholder="Name as it appears on your bank account"
                                        class="form-control form-control-line" name="client_name" maxlength="">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12"> Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" value="" name="client_phone" placeholder=""
                                        class="form-control form-control-line" maxlength="">
                                </div>
                            </div>
                        </div>

                        <!--
                            <div class="form-group col-md-6">
                                <label class="col-md-12"> Email Address</label>
                                <div class="col-md-12">
                                    <input type="text" value="" required="" name="email" placeholder=""
                                        class="form-control form-control-line" maxlength="">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                        -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-12"> Bank Name</label>
                                <div class="col-md-12">
                                    <input type="text" value="" placeholder="Banker's Name"
                                        class="form-control form-control-line" name="bank" maxlength="50">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12">Account No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter bank aaccount no"
                                        class="form-control form-control-line" name="acct_no" maxlength="32">
                                </div>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="col-md-12"> Username</label>
                            <div class="col-md-12">
                                <input type="text" value="" required="" placeholder="Your Pet Name"
                                    class="form-control form-control-line" name="urname" maxlength="25">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" placeholder="Enter New Passord" required=""
                                    class="form-control form-control-line" name="pwd" maxlength="32">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Repeat Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control form-control-line" required="" name="cpwd"
                                    placeholder="Confirm Password" maxlength="32">
                            </div>
                        </div>
-->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
}

function new_deposit()
{

    if (isset($_POST['pg_lvl'])) {
/*
var_dump($_POST); die();
array(6) { ["pg_lvl"]=> string(1) "1" ["duty"]=> string(4) "acct" ["formToken"]=> string(16) "8RDuwxavyynIeeIx" ["depositor"]=> string(1) "5" ["gift_stage"]=> string(1) "4" ["amount"]=> string(4) "8900" }

 */

        $depositor = $_POST['depositor'];
        $plan = $_POST['gift_stage'];
        $amount = $_POST['amount'];

        if (!empty($depositor) && !empty($plan) && !empty($amount)) {

        }
    }
    ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> New Deposit Form </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> New Gifting</h3><br />
                    <form class="form-horizontal form-maerial" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="duty" value="acct" /><input
                            type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Depositor's Name</label>
                            <div class="col-md-12">
                                <select class="form-control select22" name="depositor">
                                    <?php
$members = Users::getAllUsersforList();

    foreach ($members as $value) {
        echo '<option value="' . $value["user_id"] . '"> ' . ucwords($value["name"]) . ' (' . $value["member_id"] . ')</option>';
    }
    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Gift Stage</label>
                            <div class="col-md-12">
                                <select required="" placeholder="" class="form-control form-control-line select22"
                                    name="gift_stage" maxlength="">
                                    <?php

    $plans = Transactions::getInvestmentPlans();

    foreach ($plans as $value) {
        ?>
                                    <option data-min="<?php echo $value['amount_deposited'] ?>"
                                        value="<?php echo $value['plan_id'] ?>"><?php echo $value['name']; ?></option>

                                    <?php
}
    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"> Amount</label>
                            <div class="col-md-12">
                                <input type="number" min="0" value="" required="" name="amount" id="plan_amt"
                                    class="form-control form-control-line" maxlength="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
}

function approve_new_clients()
{
    if (isset($_POST['pg_lvl'])) {
        //var_dump($_POST); die();
        $apprv = $_POST['approve'];
//$ref = $_POST['ref']; $i = 0;
        foreach ($apprv as $value) {

            $update_user_status = Users::UpdateUserStatus($value, 1);
        }

        $_SESSION['result'] = array('1', 'Activated Successfully');

    }
    ?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Pending Clients </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> </h3><br />
                    <p> These are clients who registered online, therefore here you acknowledge receipt of their
                        payments to make them active</p>
                    <form class="form-horizontal form-marial" method="post" action=""><input type="hidden" name="pg_lvl"
                            value="1" /><input type="hidden" name="duty" value="acct" /><input type="hidden"
                            name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />


                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12 col-xlg-12 col-md-12">
                                <div class="card">
                                    <div class="card-block">

                                        <style>
                                        .table-responsive {
                                            scrollbar-face-color: #f8bdfb !important;
                                        }
                                        </style>
                                        <div class="row">
                                            <div class="col-sm-12" style="margin: 0 auto;">

                                                <div class="table-responsive">
                                                    <table class=" table stylish-table table-bordered  table-striped"
                                                        id="dataTables-example3">
                                                        <thead>
                                                            <tr>
                                                                <th> S/N&otilde;</th>
                                                                <th> Date of Reg</th>
                                                                <th> Full Name</th>
                                                                <th> Phone No</th>
                                                                <th> Account No</th>
                                                                <th> Bank</th>
                                                                <th> Membership ID</th>

                                                                <th> <input type="submit" class="btn btn-danger"
                                                                        value="Approve"></th>


                                                            </tr>
                                                        </thead>

                                                        <tfoot>
                                                            <tr>
                                                                <th> S/N&otilde;</th>
                                                                <th> Date of Reg</th>
                                                                <th> Full Name</th>
                                                                <th> Phone No</th>
                                                                <th> Account No</th>
                                                                <th> Bank</th>
                                                                <th> Membership ID</th>

                                                                <th> <input type="submit" class="btn btn-danger"
                                                                        value="Approve"></th>

                                                            </tr>
                                                        </tfoot>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
}

function reftree()
{

    ?>
    <link rel="stylesheet" href="tree/Treant.css">

<link rel="stylesheet" href="tree/simple-scrollbar.css">

<link rel="stylesheet" href="tree/vendor/perfect-scrollbar/perfect-scrollbar.css">

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"> Referral Diagram </h3>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block" style="">

<div class="chart" id="OrganiseChart1"> --@-- </div>
</div></div></div></div></div>
<script src="tree/vendor/raphael.js"></script>
<script src="tree/Treant.js"></script>

<script src="tree/vendor/jquery.min.js"></script>
<script src="tree/vendor/perfect-scrollbar/jquery.mousewheel.js"></script>
<script src="tree/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>

<?php
list($result, $ids) = Transactions::createReferralTree();
//var_dump($ids); die();

    $out = '';

    $out = "
<script type='text/javascript'>

var config = {
        container: '#OrganiseChart1',
        rootOrientation: 'WEST', // NORTH || EAST || WEST || SOUTH
        scrollbar: '',
        //levelSeparation: 30,
        siblingSeparation: 20,
        subTeeSeparation: 60,

        nodeAlign: 'BOTTOM',
        animateOnInit: true,

        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1',
            collapsable: true
        },
        animation: {
            nodeAnimation: 'easeOutBounce',
            nodeSpeed: 700,
            connectorsAnimation: 'bounce',
            connectorsSpeed: 700
        }

    },
" .
        $result . "";
    ?>

<?php
$out .= "
ALTERNATIVE = [
    config, " . $ids . "
];

 </script>
 ";
    echo $out;

    ?>
     <script>
        new Treant(ALTERNATIVE);

    </script>


<?php
}
?>