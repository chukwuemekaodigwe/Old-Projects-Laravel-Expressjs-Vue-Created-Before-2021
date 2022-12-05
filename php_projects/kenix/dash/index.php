<?php

session_start();
require 'control.php';

$auth = Misc::authPage();

$duty = isset($_GET['pg']) ? $_GET['pg'] : "";
if ($duty == "") {
    $duty = isset($_POST['pg']) ? $_POST['pg'] : "";
}

//var_dump($_REQUEST); die();
include 'head.php';

if ($_SESSION['user_level'] != CLIENT) {

    switch ($duty) {

        case "dash":
            home();
            break;

        case 'exit':
            logout();
            break;

        case "accounts":
            accounts();
            break;

        case "receive":
            debit();
            break;

        case 'profile':
            profile();
            break;

        case 'add_fake':
            add_fake();
            break;

        case 'users':
            users();
            break;

        case 'merge':
            merge();
            break;

        case "recycle":
            recycle();
            break;

        case 'unpin':
            unpin();
            break;

        default:
            home();
            break;
    }
} else {

    switch ($duty) {

        case "dash":
            home();
            break;

        case 'exit':
            logout();
            break;

        case "accounts":
            accounts();
            break;

        case "receive":
            debit();
            break;

        case 'profile':
            profile();
            break;

        default:
            home();
            break;
    }
}

include 'foot.php';

function home()
{
    //$_SESSION['result'] = array('1', '<b> Welcome '.Users::getNicnameById($_SESSION['user']).'!</b>')
    ?>
<style>
@media(max-width: 600px) {
    .overview-wrap .title-1 {
        display: none;
    }
}
</style>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Welcome <?php echo Users::getNicnameById($_SESSION['user']) . '!'; ?></h2>
                        <a class="au-btn au-btn-icon au-btn--blue" href="https://t.me/joinchat/MdcrKhOtYPemMzunJsX6Pg"
                            target="_blank">
                            <i class="fa fa-comments fa-2x"></i> Chat Us</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fa fa-group fa-3x"></i>
                                </div>
                                <?php

    $membr = substr(time(), 5, 4);
    $total = Pledge::getUserTotalReturn($_SESSION['user']);

    $pending = Pledge::getUserPendingReturn($_SESSION['user']);

    ?>


                                <div class="text">
                                    <h2><?php echo $membr; ?></h2>
                                    <span>members online</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <div class="text">
                                    <h2> &#8358; <?php echo !empty($pending) ? number_format($pending) : '0.00'; ?></h2>
                                    <span> Total Invested</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="text">
                                    <h2> &#8358; <?php echo !empty($total) ? number_format($total) : '0.00'; ?> </h2>
                                    <span>total earnings</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <h3 class="title-2">recent reports</h3>
                            <div class="chart-info">
                                <div class="chart-info__left">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note mr-0">
                                        <span class="dot dot--green"></span>
                                        <span>services</span>
                                    </div>
                                </div>
                                <div class="chart-info__right">
                                    <div class="chart-statis">
                                        <span class="index incre">
                                            <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                                        <span class="label">products</span>
                                    </div>
                                    <div class="chart-statis mr-0">
                                        <span class="index decre">
                                            <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                                        <span class="label">services</span>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-report__chart">
                                <canvas id="recent-rep-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="au-card chart-percent-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 tm-b-5">char by %</h3>
                            <div class="row no-gutters">
                                <div class="col-xl-6">
                                    <div class="chart-note-wrap">
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--blue"></span>
                                            <span>products</span>
                                        </div>
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--red"></span>
                                            <span>services</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="percent-chart">
                                        <canvas id="percent-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                            <div class="bg-overlay bg-overlay--blue"></div>
                            <h3>
                                <i class="zmdi zmdi-account-calendar"></i> Latest Payouts</h3>

                        </div>
                        <?php
$payouts = Pledge::getLatestPayouts();
    ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <?php
$i = 0;

    foreach ($payouts as $value) {
        
        if($value['receiver_id'] == 1) continue;
        ?>
                                    <tr>
                                        <td><?php echo ++$i; ?> </td>
                                        <td class="text-center">
                                            <?php echo (!empty($value['receiver_id'])) ? Users::getNicnameById($value['receiver_id']) : ucwords($value['receiver']); ?></td>
                                        <td class="text-center"><b> &#8358;
                                                <?php echo number_format(InvestmentPlan::getPlanById($value['plan_id'])['min_deposit']); ?>
                                            </b></td>
                                    </tr>

                                    <?php
}
    ?>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                            <div class="bg-overlay bg-overlay--blue"></div>
                            <h3>
                                <i class="zmdi zmdi-comment-text"></i>New Comments</h3>
                            <button class="au-btn-plus">
                                <i class="zmdi zmdi-plus"></i>
                            </button>
                        </div>
                        <div class="au-inbox-wrap js-inbox-wrap">
                            <div class="au-message js-list-load">
                                <div class="au-message__noti">
                                    <p>You Have
                                        <span>2</span> new comments
                                    </p>
                                </div>

                                <div class="au-message__item unread">
                                    <div class="au-message__item-inner">
                                        <div class="au-message__item-text">
                                            <div class="avatar-wrap online">
                                                <div class="avatar">
                                                    <img src="images/men3.jpg" alt="Nicholas Martinez">
                                                </div>
                                            </div>
                                            <div class="text">
                                                <h5 class="name">Nicholas Walleta</h5>
                                                <p>This is a mutual help platform created to alleviate the poor.
                                                    Together we can change the world; <br>It pays</p>
                                            </div>
                                        </div>
                                        <div class="au-message__item-time">
                                            <span>11:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-message__item">
                                    <div class="au-message__item-inner">
                                        <div class="au-message__item-text">
                                            <div class="avatar-wrap online">
                                                <div class="avatar">
                                                    <img src="images/men5.jpg" alt="Michelle Sims">
                                                </div>
                                            </div>
                                            <div class="text">
                                                <h5 class="name">Michelle Sims</h5>
                                                <p> KINEX IS THE BEST; Its a BLESSING TO ALL NIGERIANS. U better wise up
                                                    if you've not joined the community</p>
                                            </div>
                                        </div>
                                        <div class="au-message__item-time">
                                            <span>Yesterday</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="au-message__item">
                                    <div class="au-message__item-inner">
                                        <div class="au-message__item-text">
                                            <div class="avatar-wrap online">
                                                <div class="avatar">
                                                    <img src="images/men.jpg" alt="Michelle Sims">
                                                </div>
                                            </div>
                                            <div class="text">
                                                <h5 class="name">Michelle Sims</h5>
                                                <p>
                                                    I kept getting paid every single day as I keep refreshing my account
                                                    by reinvesting. This is really good
                                                </p>
                                            </div>
                                        </div>
                                        <div class="au-message__item-time">
                                            <span>Yesterday</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-message__item">
                                    <div class="au-message__item-inner">
                                        <div class="au-message__item-text">
                                            <div class="avatar-wrap online">
                                                <div class="avatar">
                                                    <img src="images/lady1.jpg" alt="Michelle Sims">
                                                </div>
                                            </div>

                                            <div class="text">
                                                <h5 class="name"> Frances</h5>
                                                <p> I was afraid before but made up my mind to give a trial and
                                                    it paid off. Today, I've registered many people down my line and
                                                    they weren't disappointed. <br> Thanks To Kinex Global
                                                </p>
                                            </div>

                                        </div>
                                        <div class="au-message__item-time">
                                            <span>Yesterday</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="au-message__item">
                                    <div class="au-message__item-inner">
                                        <div class="au-message__item-text">
                                            <div class="avatar-wrap online">
                                                <div class="avatar">
                                                    <img src="images/lady2.jpg" alt="Michelle Sims">
                                                </div>
                                            </div>
                                            <div class="text">
                                                <h5 class="name">Michelle Franca</h5>
                                                <p>
                                                    May God bless the managers of this great innovation.... I can get
                                                    everything I nedded with <b>Kinex</b>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="au-message__item-time">
                                            <span>Yesterday</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="au-message__footer">
                                    <button class="au-btn au-btn-load js-load-btn">load more</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-9">
                    <h2 class="title-1 m-b-25">Earnings By Items</h2>
                    <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>date</th>
                                    <th>order ID</th>
                                    <th>name</th>
                                    <th class="text-right">price</th>
                                    <th class="text-right">quantity</th>
                                    <th class="text-right">total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2018-09-29 05:57</td>
                                    <td>100398</td>
                                    <td>iPhone X 64Gb Grey</td>
                                    <td class="text-right">$999.00</td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">$999.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-28 01:22</td>
                                    <td>100397</td>
                                    <td>Samsung S8 Black</td>
                                    <td class="text-right">$756.00</td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">$756.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-27 02:12</td>
                                    <td>100396</td>
                                    <td>Game Console Controller</td>
                                    <td class="text-right">$22.00</td>
                                    <td class="text-right">2</td>
                                    <td class="text-right">$44.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-26 23:06</td>
                                    <td>100395</td>
                                    <td>iPhone X 256Gb Black</td>
                                    <td class="text-right">$1199.00</td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">$1199.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-25 19:03</td>
                                    <td>100393</td>
                                    <td>USB 3.0 Cable</td>
                                    <td class="text-right">$10.00</td>
                                    <td class="text-right">3</td>
                                    <td class="text-right">$30.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-29 05:57</td>
                                    <td>100392</td>
                                    <td>Smartwatch 4.0 LTE Wifi</td>
                                    <td class="text-right">$199.00</td>
                                    <td class="text-right">6</td>
                                    <td class="text-right">$1494.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-24 19:10</td>
                                    <td>100391</td>
                                    <td>Camera C430W 4k</td>
                                    <td class="text-right">$699.00</td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">$699.00</td>
                                </tr>
                                <tr>
                                    <td>2018-09-22 00:43</td>
                                    <td>100393</td>
                                    <td>USB 3.0 Cable</td>
                                    <td class="text-right">$10.00</td>
                                    <td class="text-right">3</td>
                                    <td class="text-right">$30.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h2 class="title-1 m-b-25">Top countries</h2>
                    <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-top-countries">
                                    <tbody>
                                        <tr>
                                            <td>United States</td>
                                            <td class="text-right">$119,366.96</td>
                                        </tr>
                                        <tr>
                                            <td>Australia</td>
                                            <td class="text-right">$70,261.65</td>
                                        </tr>
                                        <tr>
                                            <td>United Kingdom</td>
                                            <td class="text-right">$46,399.22</td>
                                        </tr>
                                        <tr>
                                            <td>Turkey</td>
                                            <td class="text-right">$35,364.90</td>
                                        </tr>
                                        <tr>
                                            <td>Germany</td>
                                            <td class="text-right">$20,366.96</td>
                                        </tr>
                                        <tr>
                                            <td>France</td>
                                            <td class="text-right">$10,366.96</td>
                                        </tr>
                                        <tr>
                                            <td>Australia</td>
                                            <td class="text-right">$5,366.96</td>
                                        </tr>
                                        <tr>
                                            <td>Italy</td>
                                            <td class="text-right">$1639.32</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © <?php echo date('Y', strtotime('today')); ?> All rights reserved. <a
                                href="">Kinex
                                Global </a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

function accounts()
{
    $type = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : 'all');
    $target = '?pg=accounts&type=' . $type . '&';

    switch ($type) {
        case '1':
            list($paging, $transactions) = Transaction::getUserPledges($target, $_SESSION['user']);
            break;

        case '2':
            list($paging, $transactions) = Transaction::getUserProfits($target, $_SESSION['user']);
            var_dump($transactions);
            break;

        default:
            list($paging, $transactions) = Transaction::getUserTransactions($target, $_SESSION['user']);
            var_dump($transactions);
            break;

    }

    ?>


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Transactions</h2>

                    </div>
                </div>
            </div>

            <div class="row m-t-25">
                <div class="col-lg-12">

                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <form method="post" acion="?pg=accounts">
                                    <select class="js-select2" name="type" onchange="return $(this).submit();">
                                        <option value="0"> <?php echo ucfirst($type); ?>
                                        <option value="all">All Transactions</option>
                                        <option value="1"> Investments</option>
                                        <option value="2"> Profits</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                            </div>

                            <button class="au-btn au-btn-icon btn-danger au-btn--small">
                                <i class="fas fa-folder-open"></i> Get</button>
                        </div>
                        </form>
                    </div>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                        
                              
                            <thead>
                                <tr>
                                    <th>date</th>
                                    <th class="">type of transaction</th>

                                    <th class="">amount</th>
                                    <th class="">package</th>
                                    <th> 
                    User Involved
                                </th>

                                </tr>
                            </thead>
                            <tfoot>
                                <?php echo $paging; ?>
                            </tfoot>
                            <tbody>
                            <?php
$types = array('investment', 'profit');
//var_dump($transactions); die();
    foreach ($transactions as $transaction) {

        $plan = InvestmentPlan::getPlanById($transaction['plan_id']);
        if ($transaction['pledger_id'] == $_SESSION['user']) {
            $name = $transaction['receiver_id'];
            $type = $types[0];
        } elseif ($transaction['receiver_id'] == $_SESSION['user']) {
            $name = $transaction['pledger_id'];
            $type = $types[1];
        }

        ?>
                                <tr>
                                    <td> <?php echo date('Y-m-d H:i', strtotime($transaction['reg_date'])); ?></td>
                                    <td class=""> <?php echo ucwords($type); ?></td>
                                    <td class="text-right"> &#8358;
                                        <?php echo number_format($plan['min_deposit'], 2); ?></td>
                                    <td class=""><?php echo $plan['name']; ?></td>
                                    <td class=""> <?php echo Users::getUserFullNameById($name); ?></td>

                                </tr>
                                <?php
}
    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function recycle()
{
    // craet e a plede array, te due date, ten enter a transaction
    Misc::makeInvest($_SESSION['user']);
}

function debit()
{
    if (isset($_POST['confirm'])) {
        //      var_dump($_POST); echo $_SESSION['pgToken']; die();
        //Misc::stopRefresh();
        $confirm = array();
        $confirm = $_POST['returnee'];

        foreach ($confirm as $value) {
            $result[] = Pledge::ConfirmReturn($value);

            $pledge = Pledge::getPledgeById($value);
            $due_date = (InvestmentPlan::getPlanById($pledge['plan_id'])['delay'] * 24 * 60 * 60) + time();

            $add_transaction = Transaction::createTransaction($pledge, date('Y-m-d', $due_date));
            $addRepayment = Redirect::addRedirect($pledge['pledger_id'], 2, $pledge['plan_id']);

            $changeStatus = Users::changeUserStatus($pledge['pledger_id'], CONFIRM);
            //var_dump($changeStatus); die();        }

        }

        if ((count($result) != null)) {
            $_SESSION['result'] = array('1', 'Confirmed, successfully');
        } else {
            $_SESSION['result'] = array('2', 'Confirmation failed, please try again');
        }
        // if second re-invest

    }
    Misc::setToken();
    $returnees = Pledge::getPendingReturnByReceiver($_SESSION['user']);
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Acknowledge Payback</h2>

                        </div>
                    </div>
                </div>

                <div class="row m-t-25">


                    <div class="col-lg-12">
                        <p> Please confirm if you receive funds from the following persons. They will be replaced on the
                            expiration of their grace period </p>
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                            <form method="post" action="">
                                <input type="hidden" name="confirm" value="1" /> <input type="hidden" name="formToken"
                                    value="<?php echo $_SESSION['pgToken']; ?> " />
                                <table class="table table-borderless table-striped table-earning" id="earning">
                                    <thead>
                                        <tr>
                                            <th>
                                                <!--                                        <label class="au-checkbox">
                                                <input type="checkbox" name="all" value="1" id="select-all">
                                                <span class="au-checkmark"></span>
                                            </label>
                                            -->
                                            </th>
                                            <th> date made </th>
                                            <th>name</th>
                                            <th>bank</th>
                                            <th>account no</th>
                                            <th>amount</th>
                                            <th>phone no</th>
                                            <th>username</th>
                                            <th>grace period</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8"> <input type="submit" value="confirm"
                                                    class="au-btn au-btn-icon btn-danger au-btn--small" /> </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
foreach ($returnees as $returnee) {
        $user = Users::getUserById($returnee['pledger_id']);
        ?>
                                        <tr class="tr-shadow" onclick="mark(<?php echo $returnee['id']; ?>)">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" name="returnee[]"
                                                        value="<?php echo $returnee['id']; ?>"
                                                        id="<?php echo $returnee['id']; ?>">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td><?php echo date('d/m/Y', strtotime($returnee['reg_date'])); ?></td>
                                            <td><?php echo ucwords($user['name']); ?></td>

                                            <td class="desc">
                                                <?php echo (!empty($user['bank']) ? $user['bank'] : '<i>Not Specified</i>'); ?>
                                            </td>

                                            <!--<span class="block-email"> </span>-->

                                            <td class="desc">
                                                <?php echo (!empty($user['acct_no']) ? $user['acct_no'] : '<i>Not Specified</i>'); ?>
                                            </td>
                                            <td> &#8358;
                                                <?php echo number_format(InvestmentPlan::getPlanById($returnee['plan_id'])['min_deposit'], 2); ?>
                                            </td>
                                            <td>
                                                <?php echo $user['phone']; ?>
                                            </td>
                                            <td> <?php echo $user['username']; ?></td>
                                            <td>
                                                <?php echo date('d/m/Y H:i:s', strtotime($returnee['due_date'])); ?>
                                            </td>
                                        </tr>


                                        <?php
}

    ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

function users()
{
    if (isset($_GET['item'])) {
        $user = $_GET['id'];

        $item = $_GET['item'];
        switch ($item) {
            case 'edit':
                profile($user);
                break;

            case 'delete':
                $delete = Users::changeUserStatus($user, 0);
                $_SESSION['result'] = array('1', 'Account successfully deleted/suspended!');
                break;
        }

    }

    list($paging, $users) = Users::getAllUsers('?pg=users&');

    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1"> List of Clients</h2>

                        </div>
                    </div>
                </div>
                <div class="row m-t-25">

                    <div class="col-lg-12">
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                            <form method="" action="">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>name</th>

                                            <th>username</th>
                                            <th>phone no</th>
                                            <th>email</th>
                                            <th>package</th>
                                            <th>reg date</th>

                                            <th> options</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr> <td colspan="7"><?php echo $paging; ?></td></tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
foreach ($users as $user) {
        $plan = InvestmentPlan::getPlanById($user['matrix_level']);
        ?>


                                        <tr class="tr-shadow">
                                            <td> <?php echo ucwords($user['name']); ?></td>
                                            <td>
                                                <span class="block-email"><?php echo $user['username']; ?></span>
                                            </td>
                                            <td class="desc"><?php echo $user['phone']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td>
                                                <span class="status--process"><?php echo $plan['name']; ?></span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($user['reg_date'])); ?></td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit" type="button"
                                                        onclick="return window.location='?pg=users&id=<?php echo $user['user_id']; ?>&item=edit';">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Delete" type="button"
                                                        onclick="return window.location='?pg=users&id=<?php echo $user['user_id']; ?>&item=delete';">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        <?php
}
    ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

function merge()
{
// Merge:: name, plan type, amount, recipient
    if (isset($_POST['marked']) && count($_POST['marked']) != 0) {

        $transactions = array();
        $transactions = $_POST['marked'];

        foreach ($transactions as $trans) {

            $admin = $_POST['admin_' . $trans];
            $user_trans = Transaction::getTransactionById($trans);
            $due = time() + (2 * 24 * 60 * 60);
            $pledge[] = Pledge::makePledge($admin, $user_trans['pledger_id'], $user_trans['id'], $user_trans['plan_id'], $due);

        }

        if (count($pledge) > 0) {
            $count = count($pledge);

            $result = array('1', $count . 'transactions successfully merged');
        } else {
            $result = array(2, 'Merging unsuccessful');
        }
    }

    $clients = array();

    $actives = Pledge::getExpiringTransactions();
    $compare = Repayment::getPendingRepayments();
    
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1"> Manual Merging</h2>
                        </div>
                        <p> When a clients' delay/waiting period expires, he is manually merged to an admin account.
                        </p>
                    </div>
                </div>

                <div class="row m-t-25">

                    <div class="col-lg-12">
                        <br>
                        <div class="table-responsive table--no-card m-b-30">
                            <form method="post" action=""> <input type="hidden" value="1" name="merge">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>

                                                <button class="au-btn au-btn-icon btn-danger au-btn--small">
                                                    <i class="fa fa-upload"></i> </button>


                                            </th>

                                            <th>due date </th>
                                            <th>select admin</th>
                                            <th>amount</th>
                                            <th>name</th>
                                            <th>bank</th>
                                            <th>account no</th>


                                            <th>phone no</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8"><button class="au-btn au-btn-icon btn-danger au-btn--small">
                                                    <i class="fa fa-upload"></i> </button>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
$admins = Users::getAdminAccts();
    if (!empty($compare)) {
        foreach ($compare as $client) {
            $detail = Transaction::getTransactionById($client['trans_id']);
            $user = Users::getUserById($detail['pledger_id']);
            $amount = InvestmentPlan::getPlanById($detail['plan_id'])['min_deposit'];
            ?>
                                        <tr class="tr-shadow">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" name="marked[]"
                                                        id="<?php echo $detail['id'] ?>"
                                                        value="<?php echo $detail['id'] ?>">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td> <?php echo date('Y-m-d H:i', strtotime($detail['due_date'])); ?></td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <div class="rs-select2--light rs-select2--md">
                                                        <select class="js-select2"
                                                            name="admin.<?php echo $detail['id']; ?>"
                                                            onchange="mark(<?php echo $detail['id'] ?>)">
                                                            <option value="0" selected="selected">Select an admin acct
                                                            </option>
                                                            <?php
foreach ($admins as $admin) {
                ?>
                                                            <option value="<?php echo $admin['user_id']; ?>"
                                                                accesskey="<?php echo substr($admin['name'], 0, 1); ?>">
                                                                <?php echo ucwords($admin['name']); ?></option>
                                                            <?php
}
            ?>


                                                        </select>
                                                        <div class="dropDownSelect2"></div>
                                                    </div>

                                                </div>
                                            </td>
                                            <td><span class="block-email"> &#8358;
                                                    <?php echo number_format($amount, 2); ?></span> </td>
                                            <td> <?php echo $user['name']; ?></td>
                                            <td> <?php echo (!empty($user['bank']) ? $user['bank'] : '<i>Not Specified</i>'); ?>
                                            </td>
                                            <td> <?php echo (!empty($user['acct_no']) ? $user['acct_no'] : '<i>Not Specified</i>'); ?>
                                            </td>

                                            <td> <?php echo $user['phone']; ?></td>


                                        </tr>
                                        <?php
}

    } else {
        ?>
                                        <tr>
                                            <td colspan="8"> Presently, we have no need for manual merging, check later
                                            </td>
                                        </tr>
                                        <?php
}
    ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>

                
    
                    <div class="col-lg-12">
                    <br>            
<button class="btn btn-link col-md-12">
Your Unconfirmed Pledges
</button>
<br>                    
                        <div class="table-responsive table--no-card m-b-30">

                            <form method="post" action="">
                                <input type="hidden" name="confirm" value="1" /> <input type="hidden" name="formToken"
                                    value="<?php echo $_SESSION['pgToken']; ?> " />
                                <table class="table table-borderless table-striped table-earning" id="earning">
                                    <thead>
                                        <tr>
                                            <th> date made </th>
                                            <th>name</th>
                                            <th>bank</th>
                                            <th>account no</th>
                                            <th>amount</th>
                                            <th>phone no</th>
                                            <th>username</th>
                                            <th>grace period</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            
                                            $pledgees = Pledge::getPendingPledgeByPledger($_SESSION['user']);
                                            //var_dump($pledgees);
                                        
foreach ($pledgees as $pledge_id) {
$returnee = Pledge::getPledgeById($pledge_id);
        $user = Users::getUserById($returnee['receiver_id']);
        ?>
                                        <tr class="tr-shadow" ">
                                            <td><?php echo date('d/m/Y', strtotime($returnee['reg_date'])); ?></td>
                                            <td><?php echo ucwords($user['name']); ?></td>

                                            <td class="desc">
                                                <?php echo (!empty($user['bank']) ? $user['bank'] : '<i>Not Specified</i>'); ?>
                                            </td>

                                            <!--<span class="block-email"> </span>-->

                                            <td class="desc">
                                                <?php echo (!empty($user['acct_no']) ? $user['acct_no'] : '<i>Not Specified</i>'); ?>
                                            </td>
                                            <td> &#8358;
                                                <?php echo number_format(InvestmentPlan::getPlanById($returnee['plan_id'])['min_deposit'], 2); ?>
                                            </td>
                                            <td>
                                                <?php echo $user['phone']; ?>
                                            </td>
                                            <td> <?php echo $user['username']; ?></td>
                                            <td>
                                                <?php echo date('d/m/Y H:i:s', strtotime($returnee['due_date'])); ?>
                                            </td>
                                        </tr>


                                        <?php
}

    ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>

    <?php

}

function logout()
{
    //var_dump($_REQUEST);die();

}

function profile($id = '')
{

    if (isset($_POST['duty'])) {

        Misc::stopRefresh();

        if ($_POST['duty'] == 'user') {

            $user = $_POST["user"];
            $name = ucwords($_POST["name"]);
            $bank = ucwords($_POST["bank"]);
            $acct = $_POST["acctno"];
            $phone = $_POST["phone"];
            $email = strtolower($_POST["email"]);

            if (!empty($name) && !empty($bank) && !empty($acct) && !empty($phone) && !empty($email)) {
                $update = Users::updateUser($name, $email, $phone, $bank, $acct, $user);

                $_SESSION['result'] = array('1', 'Updated Successsfully');

            }

        } else {
            /// Acct details

            $user = $_POST["user"];

            $username = $_POST["username"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];

            if ($password != $password2) {
                $_SESSION['result'] = array('2', 'The password fields must be same, please crosscheck');
            } else {
                $update = Users::updateUserAcct($username, $password, $user);

                $_SESSION['result'] = array('1', 'Updated Successsfully');
            }

            if (isset($_POST['user_type'])) {
                $changeType = Users::changeUserTypeById($_POST['user_type'], $user);
            }

        }
    }

    Misc::setToken();
    $user = !empty($id) ? $id : $_SESSION['user'];
    $details = Users::getUserById($user);
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">
                                User Profile
                            </h2>

                        </div>
                    </div>
                </div>
                <style>
                ::placeholder {
                    font-size: 12px;
                }
                </style>
                <div class="row m-t-30">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"> Personal Details</div>
                            <div class="card-body">

                                <form action="" method="post">
                                    <input type="hidden" name="user" value="<?php echo $user; ?>" /> <input
                                        type="hidden" name="duty" value="user" />

                                    <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                                    <div class="form-group">

                                        <input id="cc-pament" name="name" type="text" class="form-control"
                                            value="<?php echo $details['name']; ?>" aria-required="true"
                                            placeholder="Surname, Other Names" aria-invalid="false">
                                    </div>
                                    <div class="form-group has-success">

                                        <input id="cc-name" name="bank" type="text" class="form-control cc-name valid"
                                            placeholder="Bank" value="<?php echo $details['bank']; ?>" data-val="true"
                                            data-val-required="Please enter the name of your bank"
                                            autocomplete="cc-name" aria-required="true" aria-invalid="false"
                                            aria-describedby="cc-name-error">
                                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                            data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="form-group">

                                        <input id="cc-number" name="acctno" type="text" placeholder="Bank Account No"
                                            value="<?php echo $details['acct_no']; ?>"
                                            class="form-control cc-number identified visa" data-val="true"
                                            autocomplete="cc-number">
                                        <span class="help-block" data-valmsg-for="cc-number"
                                            data-valmsg-replace="true"></span>
                                    </div>

                                    <div class="form-group">

                                        <input id="cc-number" name="phone" type="text" placeholder="Phone No"
                                            class="form-control cc-number identified visa"
                                            value="<?php echo $details['phone']; ?>" data-val="true"
                                            autocomplete="cc-number">
                                        <span class="help-block" data-valmsg-for="cc-number"
                                            data-valmsg-replace="true"></span>
                                    </div>

                                    <div class="form-group">

                                        <input id="cc-number" name="email" type="email" placeholder="Email Address"
                                            value="<?php echo $details['email']; ?>"
                                            class="form-control cc-number identified visa" data-val="true"
                                            autocomplete="cc-number">
                                        <span class="help-block" data-valmsg-for="cc-number"
                                            data-valmsg-replace="true"></span>
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-danger btn-block">
                                            <i class="fa fa-link fa-lg"></i>&nbsp;
                                            <span id="payment-button-amount"> Save</span>

                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Account Credentials</strong>

                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post">

                                    <input type="hidden" name="user" value="<?php echo $user; ?>" /> <input
                                        type="hidden" name="duty" value="acct" />
                                    <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                                    <div class="form-group">

                                        <input type="text" name="username" id="company"
                                            placeholder="Enter your username"
                                            value="<?php echo $details['username']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">

                                        <input type="password" id="vat" name="password" placeholder="Password"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">

                                        <input type="password" id="street" name="password2"
                                            placeholder="Repeat Password" class="form-control">
                                    </div>
                                    <?php
if ($_SESSION['user_level'] == ADMIN) {
        ?>

                                    <div class="form-group">
                                        <div class="rs-select2 rs-select2">
                                            <select class="js-select2" name="user_type"
                                                onchange="return $(this).submit();">
                                                <option value="0"> Changge Account Type </option>
                                                <option value="1"> Admin</option>
                                                <option value="2"> Client</option>

                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <?php
}
    ?>



                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-danger btn-block">
                                            <i class="fa fa-refresh "></i>&nbsp;
                                            <span id="payment-button-amount"> Update</span>

                                        </button>
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

function unpin()
{
    if ($_SESSION['user'] == 1) {
        $last_pause = Repayment::checkAdminPause();
        $change = Repayment::changeRepaymetStatus($last_pause);
        if ($change > 0) {
            $result = array('1', 'Transactions Released successfully');
            home();
        } else {
            $result = array('2', 'Transactions Released Unsuccessful');
            home();
        }
    } else {
        home();
    }
}

function add_fake()
{
    if (isset($_POST['pg_lvl'])) {
        Misc::stopRefresh();
        $pledger = $_POST['pledger'];
        $receiver = $_POST['receiver'];
        $plan = $_POST['plan'];
        $type = $_POST['type'];

        if (!empty($pledger) && !empty($receiver) && !empty($plan) && !empty($type)) {
            $status = ($type == 1) ? 0 : 1;
            $add = Pledge::addFakeTransaction($pledger, $receiver, $plan, $status);

            if ($add > 0) {
                $_SESSION['result'] = array(1, 'Successfully generated!');
            } else {
                $_SESSION['result'] = array(2, 'Not successfully generated!');
            }

        } else {
            $_SESSION['result'] = array(2, 'please fill up all the fields!');
        }

    }

    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">
                                <strong> Generate Transactions</strong>
                            </h2>

                        </div>
                        <p>This is used to populate the transactions preview table</p>
                    </div>
                </div>
                <div class="row m-t-50">
                    <div class="col-lg-6" style="margin: 0 auto;">
                        <div class="card">
                            <div class="card-header">
                                ...

                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post">

                                    <input type="hidden" name="pg_lvl" value="1" />
                                    <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                                    <div class="form-group">

                                        <input type="text" name="pledger" id="company"
                                            placeholder="Pledger's name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="vat" name="receiver" placeholder="Receiver's Name"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <div class="rs-select2 rs-select2">
                                            <select class="js-select2" name="plan">

                                                <option value="0"> Select Investment Plan </option>
                                                <?php
$plans = InvestmentPlan::getAll();
    foreach ($plans as $plan) {
        ?>
                                                <option value="<?php echo $plan['id']; ?>">
                                                    <?php echo ucwords($plan['name']) . ' (&#8358; ' . $plan['min_deposit'] . ')'; ?>
                                                </option>
                                                <?php
}

    ?>

                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <br>
                                        <div class="form-group">

                                            <div class="rs-select2 rs-select2--lg">
                                                <select class="js-select2" name="type"
                                                    onchange="return $(this).submit();">
                                                    <option value="0"> Transaction Type </option>
                                                    <option value="1"> Pledge </option>
                                                    <option value="2"> Withdrawal</option>

                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
<br>
                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-danger btn-block">
                                                <i class="fa fa-upload "></i>
                                                <span id="payment-button-amount"> Submit</span>

                                            </button>
                                        </div>

                                </form>
                            </div>
                        </div>
                        <?php

}

?>