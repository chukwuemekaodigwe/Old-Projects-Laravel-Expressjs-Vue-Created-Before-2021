<?php
/*
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on'){
header("location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
exit();
}
 */
session_start();
if (isset($_SESSION['set_cookie'])) {
    $data = array();
    $data = $_SESSION['set_cookie'];
    list($name, $value, $duratn) = $data;

    setcookie($name, $value, $duratn);
}

require 'control.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
if ($action == '') {
    $action = isset($_POST['a']) ? $_POST['a'] : "";
}

//var_dump($_SESSION);//die();
if (isset($_SESSION['userAuth'])) {

    Misc::pgAuth();
    include 'head.php';
    switch ($action) {

        case 'account':
            home();
            break;

        case 'deposit':
            makeDepo();
            break;

        case 'withdraw':
            withdrawals();
            break;

        case 'deposit_list':
            depositList();
            break;

        case 'control':
            earnings();
            break;

        case 'referals':
            referals();
            break;

        case 'referallinks':
            banners();
            break;

        case 'edit_account':
            settings();
            break;

        case 'edit_acct':
            user_upd();
            break;

        case 'generate':
            addTransaction();
            break;

        case 'mails':
            bulk_mail();
            break;

        case 'logout':
            session_unset();
            session_destroy();
            echo ('<script type="text/javascript"> window.location = "../" </script> ');
            break;

        default:
            home();
            break;
    }

    include 'foot.php';
} else {

    switch ($action) {

        case 'login':
            userAcct();
            break;

        case 'ref':
            referred();
            break;

        case 'signup':
            userAcct();
            break;
        case 'forgot_password':
            f_pass();
            break;

        case 'support':
            customerMail();
            break;

        case 'invoice':
            makeDepo(1);
            break;

        case 'notify':
            depositConfirm();
            break;

        default:
            echo '<script type="text/javascript"> window.location = "../index.php";</script>';
            break;
    }
}

function home()
{

    $totalDeposit = Transactions::getDepoTotalByUid('');
    ?>

<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1>Cabinet</h1>
            </div>
            <br><br><br><br><br>
            <div class="cabinet-splash-block" style="margin: 0px!important;">
                <div class="box">
                    <div class="person-stat">
                        <div class="page-title">
                            <h1>Personal<br>statistics</h1>
                        </div>
                        <div class="diagram">
                            <div class="ct-chart"></div>
                            <div class="summary-list">
                                <ul>
                                    <li><span>Active deposits</span><b>$ <?php if ($totalDeposit != 0) {
        echo number_format($totalDeposit, 2);
    } else {
        echo number_format(0, 2);
    }
    ?></b></li>
                                    <li><span>Sign Up
                                            date:</span><b><?php echo date('M-d-Y', strtotime($_SESSION['regDate'])); ?></b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Total deposits</span><i>$ <?php if ($totalDeposit != 0) {
        echo number_format($totalDeposit, 2);
    } else {
        echo number_format(0, 2);
    }
    ?></i></p>
                                </li>
                                <li>
                                    <p><span>Balance</span><i>$ <?php $bal = Transactions::getUserBalance();
    echo $bal;?></i></p>
                                </li>
                                <li>
                                    <p><span>Total withdraw</span><i>$ <?php $p = Transactions::getWithdrawByUserId(2, '');
    if ($p == '') {echo number_format(0, 2);} else {echo number_format($p, 2);}?></i></p>
                                </li>

                                <li>
                                    <p><span>Pending withdraw</span><i>$ <?php $p = Transactions::getWithdrawByUserId(1, '');
    if ($p == '') {
        echo number_format(0, 2);
    } else {
        echo number_format($p, 2);
    }
    ?></i></p>
                                </li>

                            </ul>
                        </div>
                        <div class="page-link"><a href="?a=deposit">Make a deposit</a></div>
                    </div>
                </div>
                <div class="box">
                    <div class="company-stat">
                        <div class="page-title">
                            <h1>Company<br>statistics</h1>
                        </div>
                        <div class="info">
                            <ul>
                                <li><span>Days
                                        Online:</span><b><?php echo unixtojd(strtotime('today')) - unixtojd(strtotime('2015-09-01')) ?></b>
                                </li>
                                <li><span>Total investors:</span><b>114578</b></li>
                            </ul>
                        </div>

                        <?php
$depositors = array();
    $depositors = Transactions::getLatestDeposits();

    $withdraws = array();
    $withdraws = Transactions::getLatestWithdrawal();
    ?>

                        <div class="company-stat-tabs ui-tabs ui-corner-all ui-widget ui-widget-content"
                            id="company-stat-tabs">
                            <ul class="company-stat-tabs-nav ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
                                role="tablist">
                                <li role="tab" tabindex="0"
                                    class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                    aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true"
                                    aria-expanded="true">
                                    <a href="#tabs-1" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                        id="ui-id-1"><b>Recent Deposits</b><span>Total deposits</span></a>
                                </li>
                                <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                    aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false"
                                    aria-expanded="false">
                                    <a href="#tabs-2" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                        id="ui-id-2"><b>Recent Payouts</b><span>Total commission</span></a>
                                </li>
                            </ul>

                            <div class="company-stat-tabs-info ui-tabs-panel ui-corner-bottom ui-widget-content"
                                id="tabs-1" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                                <div class="list">
                                    <ul>
                                        <?php

    foreach ($depositors as $value) {

        if (empty($value['admin'])) {
            $name = Users::getUrnameById($value['customer_id']);
        } else {
            $name = $value['username'];
        }
        ?>
                                        <li>
                                            <p><span> <?php echo ucwords($name); ?></span><i><b>$
                                                        <?php echo number_format($value['amount'], 2); ?></b></i></p>
                                        </li>

                                        <?php
}

    ?>
                                    </ul>
                                </div>

                            </div>
                            <div class="company-stat-tabs-info ui-tabs-panel ui-corner-bottom ui-widget-content"
                                id="tabs-2" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;"
                                aria-hidden="true">

                                <div class="list">
                                    <ul>
                                        <?php

    foreach ($withdraws as $value) {
        if (empty($value['admin'])) {
            $name = Users::getUrnameById($value['user_id']);
        } else {
            $name = $value['username'];
        }
        ?>
                                        <li>
                                            <p><span><?php echo ucwords($name) ?></span><i><b>$
                                                        <?php echo number_format($value['amount']); ?></b></i></p>
                                        </li>

                                        <?php

    }
    ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </font>
    </div>
</div>


<?php
}

function makeDepo($accept = '')
{
    $token = isset($_POST['form_token']) ? $_POST['form_token'] : "";
    if (!isset($_SESSION['token'])) {
        Misc::generateToken();
    }
//var_dump($_POST['form_token']); echo '<br>'; var_dump($_SESSION['token']);
    if (!empty($token) && ($token == $_SESSION['token'])) {
        Misc::generateToken();

        $invest_plan = array_pop($_POST['plan_type']);
        $amt = $_POST['amount'];

        if (!empty($invest_plan) && !empty($amt)) {
            $plan = array();
            $plan_id = explode('_', $invest_plan);
            $plan_id = $plan_id[1];
            $plan = Transactions::getInvestPlanById($plan_id);
            if ($amt >= $plan['min_deposit']) {
                $custName = Users::getUserNameById($_SESSION['uid']);
                $deposit_id = Transactions::recordDepost($plan_id, $amt, 'BTC');
                if ($deposit_id != null) {
                    //$url = "https://blockchain.info/tobtc?currency=USD&value=$amt";
                    $url = "https://blockchain.info/ticker";
                    $json = file_get_contents($url);
                    $data = json_decode($json, true);
                    $expected_btc = ($amt / $data['USD']['last']);
                    $address = '1CyDZAvp4exyf6n1zect9endgu9zugQ';

                    /*$payment_id = Transactions::makePaymentApi($deposit_id, $amt, $plan['name']);
                    if ($payment_id != NULL) {

                    $details = Transactions::getTransactionDetail($payment_id);
                    if ($details['payment_id'] == $payment_id) {
                     *
                    $update = Transactions::updDeposit($deposit_id, $payment_id, $details['status'], $details['create_time'], $details['address'], $details['expected_amount']);
                     */
                    $update = Transactions::updDeposit($deposit_id, '', 'pending', date('Y-m-d', strtotime('today')), $address, $expected_btc);
                    if (isset($_COOKIE['crypto_reffer'])) {
                        $updRef = Transactions::updRef('', $deposit_id);
                    }
                    ?>
<DIV class="faq-inner">
    <DIV class="container row">
        <DIV class="faq-inner-block"
            style="width: 100%;  padding: auto 100px; font-style: normal; font-weight: ; color: black;">">
            <DIV class="box">
                <DIV class="text">
                    <style>
                    td {
                        padding: 5px;
                        font-size: 1.5em;
                        text-align: right;
                    }

                    #item {
                        text-align: left;
                        font-weight: bold;
                    }
                    </style>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <td colspan="2" style="text-align: left">
                                    <h2> Invoice for Deposit:</h2>
                                </td>
                                <td><img src="../static/img/header/logo.jpg" alt="Expert Cryptos Ltd"
                                        style="height:90px;z-index: 7; border-radius: 5px " /></td>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr style="border: 2px solid #0598fa;" />
                            </td>
                        </tr>
                        <tr>

                            <td colspan="3" style="text-align: left">Your Order has been processed, please complete the
                                transaction with the following information:</td>

                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>

                            <td>Date:</td>
                            <td id="item"><?php echo date('M d, Y', strtotime('today')) ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Investment Plan:</td>
                            <td id="item"><?php echo strtoupper($plan['name']); ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Profit:</td>
                            <td id="item"><?php echo $plan['profit']; ?>%</td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Client Name:</td>
                            <td id="item"><?php echo ucwords($custName); ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td> Bitcoin Address:</td>
                            <td id="item"><?php echo $address; ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Amount Payable(BTC):</td>
                            <td id="item"><?php echo $expected_btc; ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Dollar Eq:</td>
                            <td id="item">$<?php echo $amt; ?></td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>

                            <td>Status:</td>
                            <td id="item"> Not Yet Paid</td>
                            <td>&nbsp;&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr style="border: 2px solid #0598fa;" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center"><i>Please endeavour to complete the deposit
                                    <strong>IMMEDIATELY</strong> for speedy processing of your profits.<br><br> Send an
                                    email to bills@expert-cryptos.com immediately after payment to complete the
                                    transaction</i>
                                <br />
                                <p
                                    style="font-family:new times roman!important; font-weight: lighter; color: #fe011b; font-size: 0.8em">
                                    NB: You should include the following to email;<br />Your Username; the Amount in
                                    Bitcoin; and the date you made the payment.<br> Please act accordingly for speedy
                                    processing of your profits!</p>
                            </td>

                        </tr>

                    </table>
                    </h3>
                </div>
            </DIV>
        </DIV>
    </DIV>
</DIV>

<?php
//die();
                } else {
                    $_SESSION['error'] = 'An error occurred, please try again later';
                }
                /* } else {
            $_SESSION['error'] = 'An error occurred, please try again later';
            }
            } else {
            $_SESSION['error'] = 'An error occurred, please try again later';
            }*/
            } else {
                $_SESSION['error'] = 'An error occurred, please try again later';
            }
        } else {
            echo '<script type=""> window.location = "?deposit"</script>';
        }
    } else {
        ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1>Make a deposit <br>
                </h1>

            </div>

            <div class="cabinet-balance-block">

                <script type="text/javascript">
                <!--
                function openCalculator(id) {

                    w = 225;
                    h = 400;
                    t = (screen.height - h - 30) / 2;
                    l = (screen.width - w - 30) / 2;
                    window.open('?a=calendar&type=' + id, 'calculator' + id, "top=" + t + ",left=" + l + ",width=" + w +
                        ",height=" + h + ",resizable=1,scrollbars=0");
                    for (i = 0; i < document.spendform.h_id.length; i++) {
                        if (document.spendform.h_id[i].value == id) {
                            document.spendform.h_id[i].checked = true;
                        }
                    }



                }

                function updateCompound() {
                    var id = 0;
                    var tt = document.spendform.h_id.type;
                    if (tt && tt.toLowerCase() == 'hidden') {
                        id = document.spendform.h_id.value;
                    } else {
                        for (i = 0; i < document.spendform.h_id.length; i++) {
                            if (document.spendform.h_id[i].checked) {
                                id = document.spendform.h_id[i].value;
                            }
                        }
                    }

                    var cpObj = document.getElementById('compound_percents');
                    if (cpObj) {
                        while (cpObj.options.length != 0) {
                            cpObj.options[0] = null;
                        }
                    }

                    if (cps[id] && cps[id].length > 0) {
                        document.getElementById('coumpond_block').style.display = '';
                        for (i in cps[id]) {
                            cpObj.options[cpObj.options.length] = new Option(cps[id][i]);
                        }
                    } else {
                        document.getElementById('coumpond_block').style.display = 'none';
                    }
                }
                var cps = {};
                -->
                </script>

                <div class="box">
                    <div class="left-box">
                        <!--VISUAL MANUAL PLAN START--->
                        <div class="splash-calculator">
                            <div class="invest-type">
                                <div class="list">
                                    <ul>
                                        <?php
$investmt = Transactions::getAllInvestmtPlans();
        foreach ($investmt as $value) {
            if ($value['plan_id'] == 1) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            echo '
								<li class="invest-' . $value['plan_id'] . '" data-id="plan_' . $value['plan_id'] . '" data-min="' . $value['min_deposit'] . '" data-percent="' . $value['profit'] . '">
                                    <input id="f' . $value['plan_id'] . '" type="radio" name="ff" ' . $checked . '/>
                                    <label for="f' . $value['plan_id'] . '"><i style="background-image: url("../static/img/splash/calc-ic' . $value['plan_id'] . '.png")"></i><b>' . $value['profit'] . '%</b><span>' . $value['name'] . '</span></label>
                                </li>

								';
        }
        ?>

                                    </ul>
                                </div>

                                <?php
foreach ($investmt as $value) {
            if ($value['plan_id'] == 1) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            echo '
                                        <div class="invest-type-info block-' . $value['plan_id'] . '">
                            <div class="title">Investment <br/>Portfolios</div>

                            <div class="subtitle">' . $value['name'] . '</div>

                            <div class="info">
                                <ul>
                                    <li>
                                        <p><span>Minimum deposit</span><i>' . $value['min_deposit'] . '$</i></p>
                                    </li>
                                    <li>
                                        <p><span>Maximum deposit</span><i>' . $value['max_deposit'] . '$</i></p>
                                    </li>
                                    <li>
                                        <p><span>Term of deposit</span><i>' . $value['no_of_days'] . ' day</i></p>
                                    </li>
                                    <li>
                                        <p><span>Daily earnings</span><i>' . $value['profit'] . '%</i></p>
                                    </li>
                                    <li>
                                        <p><span>Profit</span><i>' . $value['profit'] . '%</i></p>
                                    </li>
                                    <li><p><span>Return deposit</span><i>Yes**</i></p></li>
                                </ul>
                            </div>

                            <div class="result"><b>' . $value['profit'] . '%</b><span>for ' . $value['no_of_days'] . '<br/>day</span></div>
                        </div>
                        ';
        }
        ?>

                            </div>
                        </div>
                        <!-----Visual MANUAL PLAN------->
                        <?php ?>
                    </div>

                </div>
                <div class="box">
                    <div class="right-box">
                        <div class="calculation">

                            <form method=post name="" id="dept_form">
                                <input type="hidden" name="form_id" value="15366253876544">
                                <input type="hidden" name="form_token" value="<?php echo $_SESSION['token']; ?>">
                                <input type=hidden name=a value=deposit />

                                <div class="title">Enter amount<br />and payment system</div>
                                <div class="area">
                                    <label>Invest amount:</label>
                                    <input id="amount" type="number" name=amount value='10.00' class=inpts min="10"
                                        required="" max="100000">
                                    <input type=hidden name=plan_type[] value="plan_1" />
                                </div>

                                <div class="system">
                                    <ul>
                                        <li>
                                            <input id="pay_48" type=radio name=type value="process_48" required>
                                            <label for="pay_48" data-fiat="USD">
                                                <p><b>Bitcoin</b></p>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="button"><button type=submit value="Spend" class=sbmt>Make a deposit</button>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <script>
            jQuery(document).ready(function() {
                jQuery('.invest-type li').on('click', function() {
                    var plan, input, min;
                    plan = $(this).data('id');
                    input = '<input type=hidden name="plan_type[]" value="' + plan + '"/>';
                    $('#dept_form').append(input);
                    min = jQuery(this).data('min');
                    jQuery('#amount').val(min);
                    jQuery('#amount').attr('min', min);
                    jQuery('#amount').attr('max', '50000');
                    jQuery('#' + jQuery(this).data('id')).prop("checked", true);
                    jQuery('#amount').change();
                });
                jQuery('#amount').on('change keyup', function() {
                    jQuery('#result2').html('$' + (jQuery('#amount').val() * jQuery(
                            'input[name=ff]:checked').parent().data('percent') /
                        100).toFixed(1));
                });
                jQuery('#amount').change();
            });
            </script>

            <!--<script>
                    jQuery(document).ready(function () {
                    jQuery('#summ').on('change keyup', function () {
                    jQuery('.balance_add').html(jQuery(this).val() * 1 + jQuery(this).val() * jQuery('input[name=h_id]:checked').next().data('percent') / 100);
                    jQuery('.fiat').html(jQuery('input[name=type]:checked').next().data('fiat'));
                    });
                    jQuery('input[name=type]').on('change', function () {
                    jQuery('.fiat').html(jQuery(this).next().data('fiat'));
                    });
                    jQuery('input[name=h_id]').on('change', function () {
                    jQuery('.balance_add').html(jQuery('#summ').val() * 1 + jQuery('#summ').val() * jQuery(this).next().data('percent') / 100);
                                            });
                    jQuery('.balance_add').html(jQuery('#summ').val() * 1 + jQuery('#summ').val() * jQuery('input[name=h_id]:checked').next().data('percent') / 100);
                    jQuery('.fiat').html(jQuery('input[name=type]:checked').next().data('fiat'));
                    });
                            </script>  -->
        </font>
    </div>
</div>
<?php
}
}

function depositList()
{

    if (!isset($_GET['item'])) {

        $totalDeposit = Transactions::getDepoTotalByUid('');

        $investmt_type = array();
        $investmt_type = Transactions::getAllInvestmtPlans();
        ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1>Deposits</h1>
            </div>

            <b>Total: $<?php echo number_format($totalDeposit, 2); ?></b><br><br>
            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">

                    <?php
foreach ($investmt_type as $value) {
            $depoByPlan = Transactions::getDepoByPlanId($value['plan_id'], '');
            ?>
                    <table class="line" width="100%" cellspacing="1" cellpadding="2" border="0">
                        <tbody>
                            <tr>
                                <td class="item">
                                    <table class="tab" width="100%" cellspacing="1" cellpadding="2" border="0">
                                        <tbody>
                                            <tr>
                                                <td colspan="3" align="center">
                                                    <b><?php echo strtoupper($value['name']); ?></b></td>
                                            </tr>
                                            <tr>
                                                <th class="inheader">Plan</th>
                                                <th class="inheader" width="200">Amount Spent ($)</th>
                                                <th class="inheader" width="100" nowrap="nowrap">
                                                    <nobr> Profit ($)</nobr>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class="item"><?php echo strtoupper($value['name']); ?></td>
                                                <td class="item" align="right">
                                                    <?php echo number_format($value['min_deposit'], 2) . ' - ' . number_format($value['max_deposit'], 2); ?>
                                                </td>
                                                <td class="item" align="right"><?php echo $value['profit']; ?>%</td>
                                            </tr>
                                            <?php
if ($depoByPlan != 0) {
                ?>
                                            <tr>
                                                <td class="item"><?php echo strtoupper($value['name']); ?></td>
                                                <td class="item" align="right">
                                                    <b><?php echo number_format($depoByPlan, 2); ?></b></td>
                                                <td class="item" align="right">
                                                    <?php echo number_format($depoByPlan * ($value['profit'] / 100), 2); ?>
                                                </td>
                                            </tr><br />
                                            <?php
}
            ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <?php if ($depoByPlan == 0) {
                ?>
                                    <table width="100%" cellspacing="1" cellpadding="2" border="0">
                                        <tbody>
                                            <tr>
                                                <td colspan="4"><b>No deposits for this plan</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <?php
}
            ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>

                    <?php
}
        ?>
                    <p> View your <a href="?a=deposit_list&item=not_paid">pending deposits &rarr;</a></p>
                </div>
            </div>

        </font>
    </div>
</div>

<?php
} else {

        $investmt_type = array();
        $investmt_type = Transactions::getAllInvestmtPlans();
        ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1 title="Deposits you've not yet remitted">Pending Deposits</h1>
            </div>

            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">

                    <table class="tab" width="100%" cellspacing="1" cellpadding="2" border="0">
                        <tbody>
                            <tr>
                                <th class="inheader" width="50">Date</th>
                                <th class="inheader" width="150"> BTC Addres</th>
                                <th class="inheader" width="150"> Amount (BTC)</th>
                                <th class="inheader" width="100">Amount (USD) ($)</th>

                                <th class="inheader" width="100" nowrap="nowrap">
                                    <nobr> Profit ($)</nobr>
                                </th>
                            </tr>

                            <?php
foreach ($investmt_type as $value) {
            $depoByPlan = Transactions::getPendingDepoByPlanId($value['plan_id']);

            ?>

                            <tr>
                                <td colspan="5" align="center">
                                    <b><?php echo strtoupper($value['name']) . ' &nbsp;(' . $value['profit']; ?>% Profit
                                        )</b></td>
                            </tr>
                            <?php
if ($depoByPlan != null) {
                foreach ($depoByPlan as $pend) {

                    ?>
                            <tr>
                                <td> <?php echo date('m-d-Y', strtotime($pend['reg_date'])); ?></td>
                                <td class="item">
                                    <?php echo ($pend['btc_address'] != '') ? $pend['btc_address'] : '<i> Not Set</i>'; ?>
                                </td>
                                <td class="item" align="right">
                                    <b><?php echo ($pend['btc_amt'] != '') ? number_format($pend['btc_amt'], 13) : '<i>Not Set</i>'; ?></b>
                                </td>
                                <td class="item" align="right"><?php echo number_format($pend['amount'], 2); ?></td>
                                <td class="item" align="right">
                                    <?php echo number_format($pend['amount'] * ($value['profit'] / 100), 2); ?></td>

                            </tr>
                            <?php
}
            } else {
                ?>
                            <tr>
                                <td colspan="5"><b>No deposits for this plan</b></td>
                            </tr>
                            <?php
}

        }
        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </font>
    </div>
</div>
<?php
}
    ?>


<?php
}

function earnings()
{

    if ($_SESSION['user_level'] != ADMIN) {
        echo '<script type="text/javascript"> window.location = "?a=account";</script>';
    } else {
        $duty = isset($_GET['item']) ? $_GET['item'] : "";

        if (($duty == '') || ($duty != 'deposits' && $duty != 'users' && $duty != 'withdrawals')) {
            echo '<script type="text/javascript"> window.location = "?a=account";</script>';
        }
        if ($duty == 'deposits') {
            if (isset($_POST['approve'])) {
                $record = array();
                $record = $_POST['approved'];
                foreach ($record as $value) {
                    $upd = Transactions::depositConfirm($value);
                }

            }
            $type = explode('-', date('Y-m-d', strtotime('today')));
            $month = $type[1] - 1;
            $day = $type[2] + 2;

            $type2 = implode('-', array($type[0], $month, $type[2]));

            if (checkdate($type[1], $day, $type[0])) {
                $type3 = implode('-', array($type[0], $type[1], $day));
            } else {
                //$type3 = implode('-', strtotime($type[0], $type[1]+1, '01'));
                $type3 = date('Y-m-d', strtotime('today'));
            }

            $from = date('Y-m-d', strtotime($type2));
            $to = date('Y-m-d', strtotime($type3));
            if (isset($_POST['from'])) {

                $date1 = date('Y-m-d', strtotime($_POST['from']));
                $_SESSION['from'] = $date1;
            } elseif (isset($_GET['from'])) {
                $date1 = isset($_SESSION['from']) ? date('Y-m-d', strtotime($_SESSION['from'])) : date('Y-m-d', strtotime($_GET['from']));
            } else {
                $date1 = $from;
            }

            if (isset($_POST['to'])) {

                $date2 = date('Y-m-d', strtotime($_POST['to']));
                $_SESSION['to'] = $date2;
            } elseif (isset($_GET['to'])) {
                $date2 = isset($_SESSION['to']) ? date('Y-m-d', strtotime($_SESSION['to'])) : date('Y-m-d', strtotime($_GET['to']));
            } else {
                $date2 = $to;
            }

            $day1 = (60 * 60 * 24);
            $out1 = strtotime($date2);
            $out = $out1 + $day1;

            //$date2 = isset($_POST['to']) ? (date('Y-m-d', strtotime($_POST['to']))) : $to;
            //var_dump($date1); die();

            $deposits = array();
            list($paging, $deposits) = Transactions::getAllDeposits('?a=control&item=deposits&from=' . $from . '&to=' . $to . '&', date('Y-m-d', strtotime($date1)), date('Y-m-d', ($out)));

            //var_dump($deposits);die();
            ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title" style="text-align: center; text-transform: uppercase;">
                <h2>
                    List of Deposits <br> As From<br>
                    <?php echo date('D, jS M, Y', strtotime($date1)); ?>&nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;
                    <?php echo date('D, jS M, Y', strtotime($date2)); ?>
                </h2>

            </div>

            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">

                    <table class="tab" cellspacing="0" cellpadding="2" border="0" id="myTable">
                        <span style="float: right" class="col-md-2">
                            <input type="search" id="myInput" onkeyup="myFunction(1)" class="right form-control"
                                placeholder="Search through.."
                                style="display: inline-block; padding-top: 0; padding-bottom: 0; margin-top: -5px;"
                                title="Search based on username" />
                        </span>
                        <tbody>
                            <form action='' method="post"><input type="hidden" value="1" name="approve" /><input
                                    type="hidden" name="from" value="<?php echo $date1; ?>" /> <input type="hidden"
                                    name="to" value="<?php echo $date2; ?>" />
                                <tr>
                                    <th>Date Sent</th>
                                    <th> Username</th>
                                    <th> Amount Deposited</th>
                                    <th> Plan</th>
                                    <th> Amount In BTC</th>
                                    <th> Confirm</th>
                                </tr>
                                <?php
foreach ($deposits as $value) {

                ?>

                                <tr>
                                    <td><?php echo date('d-m-Y', strtotime($value['date_paid'])); ?> </td>
                                    <td><?php echo ucwords(Users::getUrnameById($value['customer_id'])); ?> </td>
                                    <td><b>$ <?php echo number_format($value['amount'], 2); ?> </b></td>
                                    <td><?php echo ucfirst(Transactions::getPlanNameById($value['plan_id'])); ?> </td>
                                    <td><?php echo $value['btc_amt']; ?> </td>
                                    <td>
                                        <center><input type="checkbox" name="approved[]"
                                                value="<?php echo $value['table_id']; ?>" /></center>
                                    </td>

                                </tr>


                                <?php
}

            ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td style="text-align: center"><button class="btn btn-primary">Submit</button></td>
                                </tr>
                        </tbody>
                        </form>
                        <tfoot>

                            <tr>

                                <td colspan="6" style="text-align: center;">
                                    <?php echo $paging; ?>
                                </td>
                            </tr>

                        </tfoot>
                        <div>
                            <form action="?a=control&item=deposits" method="post" class="form-horizontal"
                                class="date_selector">
                                <div class="form-group">
                                    <label class="control-label col-xs-1 col-sm-1 col-lg-1 col-md-1"> Select
                                        Date</label>

                                    <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="color: #fff!important;">
                                                From
                                            </span>
                                            <input required type="date" name="from" min="2015-01-01"
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                value="<?php echo $date1; ?>" size=30
                                                class="form-control col-md-2 col-lg-2 col-sm-2 col-xs-2">

                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon" style="color: #fff">
                                                To
                                            </span>
                                            <input required type="date" name="to" min="2015-01-01"
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                value="<?php echo $date2; ?>" size=30
                                                class="form-control col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                            <span class="input-group-btn" style="color: #fff">
                                                <input type="submit" class="btn btn-primary" />
                                            </span>
                                        </div><br />

                                    </div>
                                </div>
                            </form>
                        </div>
                    </table>
                </div>
            </div>
        </font>
    </div>
</div>



<?php
}

        if ($duty == 'withdrawals') {
            //var_dump(Transactions::getRefInfoByUid(4));
            if (isset($_POST['approve'])) {
                $record = array();
                $record = $_POST['approved'];
                foreach ($record as $value) {
                    $upd = Transactions::updWithdraw($value);
                }

            }
            $type = explode('-', date('Y-m-d', strtotime('today')));
            $month = $type[1] - 3;
            $day = $type[2] + 2;
            $type2 = implode('-', array($type[0], $month, $type[2]));
            //$type3 = implode('-', array($type[0], $type[1], $day));
            if (checkdate($type[1], $day, $type[0])) {
                $type3 = implode('-', array($type[0], $type[1], $day));
            } else {
                //$type3 = implode('-', strtotime($type[0], $type[1]+1, '01'));
                $type3 = date('Y-m-d', strtotime('today'));
            }

            $from = date('Y-m-d', strtotime($type2));
            $to = date('Y-m-d', strtotime($type3));
            if (isset($_POST['from'])) {

                $date1 = date('Y-m-d', strtotime($_POST['from']));
                $_SESSION['from'] = $date1;
            } elseif (isset($_GET['from'])) {
                $date1 = isset($_SESSION['from']) ? date('Y-m-d', strtotime($_SESSION['from'])) : date('Y-m-d', strtotime($_GET['from']));
            } else {
                $date1 = $from;
            }

            if (isset($_POST['to'])) {

                $date2 = date('Y-m-d', strtotime($_POST['to']));
                $_SESSION['to'] = $date2;
            } elseif (isset($_GET['to'])) {
                $date2 = isset($_SESSION['to']) ? date('Y-m-d', strtotime($_SESSION['to'])) : date('Y-m-d', strtotime($_GET['to']));
            } else {
                $date2 = $to;
            }

            $day1 = (60 * 60 * 24);
            $out1 = strtotime($date2);
            $out = $out1 + $day1;

            //$real = Misc::getRealDate($date2);

            //var_dump($real); die();
            //var_dump($date1); die();
            $deposits = array();
            list($paging, $deposits) = Transactions::getAllWithdrawReq('?a=control&item=withdrawals&from=' . $from . '&to=' . $to . '&', date('Y-m-d', strtotime($date1)), date('Y-m-d', ($out)));
            /*
            $day1 = (60 * 60 * 24);
            $out1 = time();
            $out = $out1 + $day1;
            var_dump($out);
            echo date('Y-m-d', ($out));
            die();
             */
            ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title" style="text-align: center; text-transform: uppercase;">
                <h2>
                    Withdrawal Requests <br> As From<br>
                    <?php echo date('D, jS M, Y', strtotime($date1)); ?>&nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;
                    <?php echo date('D, jS M, Y', strtotime($date2)); ?>
                </h2>

            </div>
            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">

                    <table class="tab" cellspacing="0" cellpadding="2" border="0" id="myTable">
                        <span style="float: right" class="col-md-2">
                            <input type="search" id="myInput" onkeyup="myFunction(0)" class="right form-control"
                                placeholder="Search through.."
                                style="display: inline-block; padding-top: 0; padding-bottom: 0; margin-top: -5px;"
                                title="Search within this result by date" />
                        </span>
                        <tbody>
                            <form action='' method="post"><input type="hidden" value="1" name="approve" />
                                <tr>
                                    <th>Date of Req.</th>
                                    <th> Username</th>
                                    <th> Amount Requested</th>
                                    <th> Total Investment</th>
                                    <th title="User's BTC Adress"> BTC Address</th>
                                    <th> Approval</th>
                                </tr>
                                <?php
foreach ($deposits as $value) {
                $approval_id = $value['user_id'] . '&&' . $value['amount'] . '&&' . $value['date_req'];
                ?>

                                <tr>
                                    <td><?php echo date('d-m-Y', strtotime($value['date_req'])); ?> </td>
                                    <td><?php echo ucwords(Users::getUrnameById($value['user_id'])); ?> </td>
                                    <td>$ <?php echo number_format($value['amount'], 2); ?> </td>
                                    <td><b>$ <?php echo ucfirst(Transactions::getUserBalance('', $value['user_id'])); ?>
                                        </b></td>
                                    <td><?php echo Transactions::getBitcoinAddrByUsId($value['user_id']); ?> </td>
                                    <td>
                                        <center><input type="checkbox" name="approved[]"
                                                value="<?php echo $value['table_id']; ?>" /></center>


                                    </td>
                                </tr>


                                <?php
}

            ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td style="text-align: center"><button class="btn btn-primary">Submit</button></td>
                                </tr>
                        </tbody>
                        </form>
                        <tfoot>

                            <tr>

                                <td colspan="6" style="text-align: center;">
                                    <?php echo $paging; ?>
                                </td>
                            </tr>

                        </tfoot>
                        <div>
                            <form action="?a=control&item=withdrawals" method="post" class="form-horizontal"
                                class="date_selector">
                                <div class="form-group">
                                    <label class="control-label col-xs-1 col-sm-1 col-lg-1 col-md-1"> Select
                                        Date</label>

                                    <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="color: #fff!important;">
                                                From
                                            </span>
                                            <input required type="date" name="from" min="2015-01-01"
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                value="<?php echo $date1; ?>" size=30
                                                class="form-control col-md-2 col-lg-2 col-sm-2 col-xs-2">

                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon" style="color: #fff">
                                                To
                                            </span>
                                            <input required type="date" name="to" min="2015-01-01"
                                                max="<?php echo date('Y-m-d', strtotime('today')); ?>"
                                                value="<?php echo $date2; ?>" size=30
                                                class="form-control col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                            <span class="input-group-btn" style="color: #fff">
                                                <input type="submit" class="btn btn-primary" />
                                            </span>
                                        </div><br />

                                    </div>
                                </div>
                            </form>
                        </div>
                    </table>
                </div>
            </div>
        </font>
    </div>
</div>
<?php

        }

        if ($duty == 'users') {

            $user = array();
            list($paging, $user) = Users::getAllUsers('?a=control&item=users&');

            //var_dump($deposits);die();
            ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h2 style="text-align: center; text-transform: uppercase;">
                    List of Investors (<?php echo Users::countUsers(); ?> in Total)
                </h2>
            </div>
            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">
                    <style>
                    td {
                        text-align: center;
                    }
                    </style>
                    <table class="tab" cellspacing="0" cellpadding="2" border="0" id="myTable">
                        <span style="float: right" class="col-md-2">
                            <input type="search" id="myInput" onkeyup="myFunction(2)" class="right form-control"
                                placeholder="Search through.."
                                style="display: inline-block; padding-top: 0; padding-bottom: 0; margin-top: -5px;"
                                title="Search within this result by Username" />
                        </span>
                        <tbody>
                            <tr>
                                <th>S/No</th>
                                <th> Name</th>
                                <th> Username</th>
                                <th>Email</th>
                                <th> Options</th>
                            </tr>
                            <?php
$i = 0;
            foreach ($user as $value) {

                ?>

                            <tr>
                                <td><?php echo ++$i; ?> </td>
                                <td><?php echo ucwords($value['name']); ?> </td>
                                <td><?php echo ucwords($value['username']); ?> </td>
                                <td><?php echo $value['email']; ?> </td>
                                <td> <a href="?a=edit_acct&item=<?php echo $value['user_id']; ?>"
                                        style="color: black; font-weight: bold; font-style:italic"> Edit</a></td>
                            </tr>


                            <?php
}

            ?>

                        </tbody>
                        <tfoot>

                            <tr>

                                <td colspan="5" style="text-align: center;">
                                    <?php echo $paging; ?>
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>

            </div>
        </font>
    </div>
</div>
<?php
}

    }
}

function referals()
{
    ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-partner">
                <div class="container row">
                    <div class="cabinet-page-title">
                        <h1>Referrals</h1>
                    </div>

                    <div class="cabinet-partner-list">
                        <ul>
                            <li>
                                <div class="block">
                                    <div class="avatar">
                                        <div class="icon">
                                            <i style="background-image: url('../static/img/splash/ava.png')"></i>
                                        </div>
                                        <div class="text">
                                            <b>-</b>

                                        </div>
                                    </div>
                                    <div class="info">
                                        <p>
                                            <i><img src="../static/img/admin/part-ic1.png"></i>
                                            <b>-</b>
                                        </p>
                                        <p>
                                            <i><img src="../static/img/admin/part-ic2.png"></i>
                                            <span>-</span>
                                        </p>
                                        <p>
                                            <i><img src="../static/img/admin/part-ic3.png"></i>
                                            <span>-</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php
$refNo = Transactions::countRef();
    $activeRef = Transactions::activeReferee();
    $comm = '0';
    ?>
                            <li>
                                <div class="block">
                                    <div class="title">Referrals<br>1 level</div>
                                    <div class="ref-info">
                                        <p class="blue"><span>Referrals:</span><b><?php echo $refNo; ?></b></p>
                                        <p class="green"><span>Active referrals:</span><b><?php echo $activeRef; ?></b>
                                        </p>
                                        <p class="dark"><span>Earn commission:</span><b><?php echo $comm; ?></b></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="title">Referrals<br>2-10 level</div>
                                    <div class="ref-info" style="margin-top: 70px;">
                                        <p class="blue"><span>Referrals:</span><b>0</b></p>
                                        <p class="green"><span>Active referrals:</span><b>0</b></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="cabinet-partner-tabs">
                        <div class="cabinet-partner-tabs-info">

                        </div>
                    </div>
                </div>
            </div>





        </font>
    </div>
</div>

<?php
}

function banners()
{
    ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">


            <div class="cabinet-partner">
                <div class="container row">
                    <div class="cabinet-page-title">
                        <h1>Banners</h1>
                    </div>

                    <div class="cabinet-partner-tabs">
                        <div class="cabinet-partner-tabs-info">


                            <div style="text-align:left;padding: 20px;
                                                     color: #202020;
                                                     border: 1px solid #dddddd;">
                                <h4 style="
                                                        display: inline-block;
                                                        color: #ffffff;
                                                        line-height: 30px;
                                                        font-size: 24px;
                                                        padding: 10px 30px 10px 15px;
                                                        background: #202e31;
                                                        text-transform: uppercase;
                                                        font-weight: 800;">125x125 banner</h4><br><br>
                                <img src="../static/img/admin/banner_125.htm" alt="" width="125" height="125"><br><br>

                                <textarea class="reftextarea" cols="35" rows="4" style="padding: 20px;
                                                              color: #202020;
                                                              border: 1px solid #dddddd;">&lt;a href=<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . $_SESSION['username']; ?>&gt;&lt;img src="../images/banner_125.gif" alt="" width="125" height="125" /&gt;&lt;/a&gt;
                                                    </textarea><br><br>

                                <h4 style="
                                                        display: inline-block;
                                                        color: #ffffff;
                                                        line-height: 30px;
                                                        font-size: 24px;
                                                        padding: 10px 30px 10px 15px;
                                                        background: #202e31;
                                                        text-transform: uppercase;
                                                        font-weight: 800;">468x60 banner</h4><br> <br>
                                <img src="../static/img/admin/banner_468.htm" alt="" width="468" height="60"><br><br>

                                <textarea class="reftextarea" cols="35" rows="4" style="padding: 20px;
                                                              color: #202020;
                                                              border: 1px solid #dddddd;">&lt;a href=<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . $_SESSION['username']; ?>&gt;&lt;img src="../images/banner_468.gif" alt="" width="468" height="60" /&gt;&lt;/a&gt;
                                                    </textarea>
                                <br><br>

                                <h4 style="
                                                        display: inline-block;
                                                        color: #ffffff;
                                                        line-height: 30px;
                                                        font-size: 24px;
                                                        padding: 10px 30px 10px 15px;
                                                        background: #202e31;
                                                        text-transform: uppercase;
                                                        font-weight: 800;">728x90 banner</h4><br><br>
                                <img src="../static/img/admin/banner_728.htm" width="728" height="90"><br><br>
                                <textarea class="reftextarea" cols="35" rows="4" style="padding: 20px;
                                                              color: #202020;
                                                              border: 1px solid #dddddd;">&lt;a href=<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . $_SESSION['username']; ?>&gt;&lt;img src="../images/banner_728.gif" alt="" width="728" height="90" /&gt;&lt;/a&gt;
                                                    </textarea><br><br>

                                <h4 style="
                                                        display: inline-block;
                                                        color: #ffffff;
                                                        line-height: 30px;
                                                        font-size: 24px;
                                                        padding: 10px 30px 10px 15px;
                                                        background: #202e31;
                                                        text-transform: uppercase;
                                                        font-weight: 800;">160x600 benner</h4><br> <br>
                                <img src="../static/img/admin/banner_160.htm" alt="" width="160" height="600"><br><br>

                                <textarea class="reftextarea" cols="35" rows="4" style="padding: 20px;
                                                              color: #202020;
                                                              border: 1px solid #dddddd;">&lt;a href=<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . $_SESSION['username']; ?>&gt;&lt;img src="../images/banner_160.gif" alt="" width="468" height="60" /&gt;&lt;/a&gt;
                                                    </textarea>
                                <br><br>
                            </div>


                        </div>
                    </div>


                </div>
            </div>



        </font>
    </div>
</div>

<?php
}

function settings()
{
    $token = isset($_POST['form_token']) ? $_POST['form_token'] : "";

    if (!empty($token) && $token == $_SESSION['token']) {
        if ($_POST['form_type'] == 'email') {

            $name = ucwords($_POST['fullname']);
            $email = strtolower(trim($_POST['email']));

            if (!empty($name) && !empty($email)) {
                $update = Users::updUserInfo($name, $email);
                //if($update != NULL){
                $_SESSION['info'] = 'Account Updated Successfully';
                //}else{
                //$_SESSION['error'] = 'An error occured, please try again';
                //}
            }
        } elseif ($_POST['form_type'] == 'pwd') {
            $pwd = $_POST['password'];
            $cpwd = $_POST['password2'];
            $bit_acct = $_POST['pay_account'];
            if (!empty($pwd) && !empty($cpwd) && $pwd == $cpwd) {
                $update = Users::modifyPassword($pwd);
                //var_dump($bit_acct);die();
                if (!empty($bit_acct)) {

                    $addAcct = Transactions::addBitcoinAccNo($bit_acct['48']);
                }
                //if($update >= 1){
                $_SESSION['info'] = 'Account Updated Successfully';
                //}
            }
        }
    }

    Misc::generateToken();
    ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <script language="javascript">
            function IsNumeric(sText) {
                var ValidChars = "0123456789.";
                var IsNumber = true;
                var Char;
                if (sText == '')
                    return false;
                for (i = 0; i < sText.length && IsNumber == true; i++) {
                    Char = sText.charAt(i);
                    if (ValidChars.indexOf(Char) == -1) {
                        IsNumber = false;
                    }
                }
                return IsNumber;
            }

            function checkform() {
                if (document.editform.fullname.value == '') {
                    alert("Please type your full name!");
                    document.editform.fullname.focus();
                    return false;
                }


                if (document.editform.password.value != document.editform.password2.value) {
                    alert("Ple
                        ase check your password!");
                        document.editform.fullname.focus();
                        return false;
                    }




                    if (document.editform.email.value == '') {
                        alert("Please enter your e-mail address!");
                        document.editform.email.focus();
                        return false;
                    }

                    return true;
                }
            </script>

            <div class="cabinet-settings">
                <div class="container row">
                    <div class="cabinet-page-title">
                        <h1>Settings</h1>
                    </div>

                    <div class="cabinet-settings-block">


                        <div class="box">
                            <div class="pers-data">
                                <form action="" method="post" onsubmit="return checkform()" name="editform"><input
                                        name="form_id" value="15366245541521" type="hidden"><input name="form_token"
                                        value="<?php echo $_SESSION['token']; ?>" type="hidden">
                                    <input name="a" value="edit_account" type="hidden">
                                    <input name="action" value="edit_account" type="hidden">
                                    <div class="page-title">
                                        <h1>Your personal<br>details</h1>
                                    </div>
                                    <div class="list">
                                        <ul>

                                            <li>
                                                <label>Login:</label>
                                                <input value="<?php echo $_SESSION['username'] ?>" disabled="disabled"
                                                    type="text">
                                            </li>
                                            <li>
                                                <label>E-mail address:: </label>
                                                <input name="email" value="<?php
$email = Users::getUserEmailById($_SESSION['uid']);
    echo $email;
    ?>" class="inpts" size="30" type="text" required=""> </li>
                                            <li>
                                                <label>Name:</label>
                                                <input name="fullname" value="<?php
$name = Users::getUserNameById($_SESSION['uid']);
    echo $name;
    ?>" type="text" required="">
                                            </li>

                                            <li>
                                                <input type="hidden" name="form_type" value="email" />
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="button"><button type="submit">Update Account</button></div>
                                </form>
                            </div>
                        </div>

                        <div class="box">
                            <div class="pay-data">
                                <form action="" method="post" onsubmit="return checkform()" name="editform"><input
                                        name="form_id" value="15366245541521" type="hidden"><input name="form_token"
                                        value="<?php echo $_SESSION['token']; ?>" type="hidden">
                                    <input name="a" value="edit_account" type="hidden">
                                    <input name="action" value="edit_account" type="hidden">

                                    <div class="page-title">
                                        <h1>Other<br>details</h1>
                                    </div>

                                    <div class="pass-list">
                                        <div class="page-title">
                                            <h1>Change password</h1>
                                        </div>
                                        <ul>

                                            <li>
                                                <label>New password: </label>
                                                <input name="password" value="" class="inpts" size="30" type="password"
                                                    required="">
                                            </li>


                                            <li>
                                                <label>Confirm password: </label>
                                                <input name="password2" value="" class="inpts" size="30" type="password"
                                                    required="">
                                            </li>




                                            <li>
                                                <label>Your Bitcoin acc no: </label>

                                                <input class="inpts" size="30" name="pay_account[48]" type="text"
                                                    required=""> </li>
                                            <li>
                                                <input type="hidden" name="form_type" value="pwd" />
                                            </li>
                                        </ul>

                                        <div class="button"><button type="submit">Save details</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </font>
    </div>
</div>

<?php
}

function withdrawals()
{
    ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1>Withdraw

                </h1>
            </div>
            <div class="cabinet-deposit-tabs">
                <div class="cabinet-deposit-tabs-info">

                    <form method="post"><input name="form_id" value="15366249292468" type="hidden"><input
                            name="form_token" value="03468939755d61d2c574f8385db66829" type="hidden">
                        <input name="a" value="withdraw" type="hidden">
                        <input name="action" value="preview" type="hidden">

                        <table class="tab" cellspacing="0" cellpadding="2" border="0">
                            <tbody>
                                <tr>
                                    <th>Account Balance:</th>
                                    <th>$<b><?php $bal = Transactions::getUserBalance();
    echo $bal;?></b></th>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td> <small>
                                        </small></td>
                                </tr>
                                <tr>
                                    <td>Pending Withdrawals: </td>
                                    <td><b>$<?php $p = Transactions::getWithdrawByUserId(1, '');
    if ($p == '') {
        echo number_format(0, 2);
    } else {
        echo number_format($p, 2);
    }
    ?></b></td>
                                </tr>

                                <tr>
                                    <td>Your Bitcoin Account:</td>
                                    <td><?php
$addr = Transactions::getBitcoinAddrByUsId();
    if (!empty($addr)) {
        echo $addr;
    } else {
        echo '<a href="?a=edit_account"><i>not set</i></a></td>';
    }

    ?>


                                </tr>
                            </tbody>
                        </table>


                        <br><br>
                        <?php
$balance = Transactions::getUserBalance(2);
    $pendWithd = Transactions::getWithdrawByUserId(1);
    $withd = $balance - $pendWithd;
    if ($bal != 0.00) {
        echo '<p> You can make request for withdrawal <a href="../?a=support&item=withdraw&m=' . $withd . '"> <b>here &rarr;</b></a></p>';
    } else {
        echo 'You have no funds to withdraw.';
    }

    ?>
                    </form>



                </div>
            </div>
        </font>
    </div>
</div>

<?php
}

function userAcct()
{
    $token = isset($_POST['form_token']) ? $_POST['form_token'] : "";

    //if (isset($token) && ($token == $_SESSION['token'])){
    //Misc::generateToken();
    if ($_POST['a'] == 'signup') {
        $name = $_POST['fullname'];
        $urname = strtolower(trim($_POST['username']));
        $pwd = $_POST['password'];
        $cpwd = $_POST['password2'];
        $email = $_POST['email'];
        $c_email = $_POST['email1'];

        if (!empty($name) && !empty($urname) && !empty($pwd) && !empty($email)) {

            if (($pwd == $cpwd) && ($email == $c_email)) {
                $check = Users::getUserIdByUsername($urname);
                if ($check == 0) {
                    $acct = '';
                    $create = Users::createAcct($name, $email, $urname, $pwd, $acct);
                    //var_dump($create);die();
                    if ($create != 0) {
                        if (isset($_COOKIE['crypto_reffer'])) {
                            $userid = Users::getUserIdByUsername($_COOKIE['crypto_reffer']);
                            $addRef = Transactions::addReferral($userid, $create);
                        }

                        $check = array();
                        $check = Users::getUserInfoByUrname($urname, $pwd);
                        if ($check != 0) {
                            $time = time() + 60 * 60;
                            //session_start();
                            setcookie('accessToken', '1487', $time);
                            $_SESSION['username'] = $urname;
                            $_SESSION['user_level'] = $check['user_level'];
                            $_SESSION['regDate'] = date('Y-m-d H:i:s', strtotime($check['reg_date']));
                            $_SESSION['uid'] = $check['user_id'];
                            $_SESSION['userAuth'] = 'Fine';
                            include_once 'head.php';
                            ?>
<DIV class="faq-inner">
    <DIV class="container row">
        <DIV class="faq-inner-block" style="width: 100%">
            <DIV class="box">
                <DIV class="text">
                    <h3 style="text-align: center; font-style: italic; font-weight: ; color: black;">
                        Thank you for joining us! <br /> You are now an official member of this program. Please visit
                        your email to confirm the email verification. Please add your bank account details after login
                        via >>Settings <br /> In a while you will be redirected to your dashboard to start investing
                        with us.
                    </h3>
                </div>
            </DIV>
        </DIV>
    </DIV>
</DIV>
<script type="text/javascript">
setTimeout(function() {
    window.location = "index.php";
}, 5000);
</script>
<?php
} else {
                            $error = 'An error occured, please try again later';
                        }
                    } else {
                        $error = 'An error occured, please try again later';
                    }
                } else {
                    $error = 'This username is already in use, please choose another';
                }
            } else {
                $error = 'An error occured! Please crosscheck your data.';
            }
        } else {
            $error = 'Please fill up all the fields of the form';
        }

        if (isset($error)) {
            $_SESSION['error'] = $error;
            echo ('<script type="text/javascript"> window.location = "../?a=login";</script>');
        }
    } else {
        //login
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $check = array();
        $check = Users::getUserInfoByUrname($username, $pwd);
        if ($check != 0) {
            //var_dump($_POST);
            //session_start();
            $time = time() + 60 * 60;
            setcookie('accessToken', '1487', $time);
            $_SESSION['username'] = $username;
            $_SESSION['user_level'] = $check['user_level'];
            $_SESSION['regDate'] = date('Y-m-d H:i:s', strtotime($check['reg_date']));
            $_SESSION['uid'] = $check['user_id'];
            $_SESSION['userAuth'] = 'Fine';
            //header('location: ?home');
            echo '<script type="text/javascript"> window.location = "?a=account";</script>';
        } else {

            $error = 'Incorrect user credentials, please crosscheck and try again';

            if ($error != null) {
                $_SESSION['error'] = $error;
                echo ('<script type="text/javascript"> window.location = "../?a=login";</script>');
            }
        }
    }

    // }
}

function depositConfirm()
{
    $data = file_get_contents('php://input');

    $add = Transactions::getNortifications($data);
    return (true);
}

function customerMail()
{

    if (isset($_POST['withdraw'])) {
        $amt = $_POST['withd_amt'];
        $userBal = Transactions::getUserBalance(2);
        $pendWithd = Transactions::getWithdrawByUserId(1);
        $withd = $userBal - $pendWithd;
        if ($amt <= $withd) {
            $add = Transactions::addWithdrawReq($amt);
            if ($add > 0) {

                // mail the admin
                $name = Users::getUserNameById($_SESSION['uid']);
                $emailAddr = Users::getUserEmailById($_SESSION['uid']);
                $bitAddr = Transactions::getBitcoinAddrByUsId($_SESSION['uid']);
                $msg = 'You have a withdrawal request from a customer. The details are as follows: <br>

Name :' . $name . '<br>
Email: ' . $emailAddr . ' <br>
Amount : ' . $amt . ' <br>
Bitcoin Address: ' . $bitAddr . ' <br>

Please visit your dashboard for more details.<br>

.... Dated:
' . date('D, dS F, Y', strtotime('today'));

                $subj = 'Withdrawal Request Received!';
                $type = ADMIN;
                $send = Misc::sendMail($body, $subj, CORP, 'admin@'.$_SERVER['SERVER_NAME']);
                //var_dump($send);die();

                $_SESSION['userAuth'] = 'Fine';
                $_SESSION['info'] = 'Withdrawal Request Successsful !';
                echo ('<script type="text/javascript"> window.location = "?a=withdraw"; </script>');
            } else {
                $_SESSION['error'] = 'An error occurred please try again';
                echo ('<script type="text/javascript"> window.location = "../"; </script>');
            }
        } else {
            $_SESSION['error'] = 'Please the amount you can withdraw must not exceed ' . $withd;
            echo ('<script type="text/javascript"> window.location = "../?a=support"; </script>');
        }

        echo ('<script type="text/javascript"> window.location = "../"; </script>');
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['message'];
        if (!empty($name) && !empty($email) && !empty($msg)) {
            $subj = 'New Support Message Received! @ ' . $_SERVER['SERVER_NAME'];
            $type = ADMIN;
            $body = 'Dear Sir, you have a message from a visitor/customer. The details of the message is as follows:<br/>

Visitor\'s Name: ' . $name . '<br>
Email : ' . $email . '<br>
Message: <blockquote>' . $msg . '</blockquote>

...Dated:
' . date('D, dS F, Y', strtotime('today')) . '
From engine@.' . $_SERVER['SERVER_NAME'];

            $send = Misc::sendMail($body, $subj, CORP, 'admin@'.$_SERVER['SERVER_NAME']);
            if ($send) {
                $_SESSION['info'] = 'Message sent Successsful !<br> Thanks for your confidence in us!';
                echo ('<script type="text/javascript"> window.location = "../"; </script>');
            } else {
                $_SESSION['error'] = 'Message not sent ';
                echo ('<script type="text/javascript"> window.location = "../?a=support"; </script>');
            }

        }

    }
}

function user_upd()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        $token = isset($_POST['form_token']) ? $_POST['form_token'] : "";

        if (!empty($token) && $token == $_SESSION['token']) {

            $name = ucwords($_POST['fullname']);
            $email = strtolower(trim($_POST['email']));
            $pwd = $_POST['password'];
            $bit_acct = $_POST['pay_account'];

            if (!empty($name) && !empty($email) && !empty($_POST['password']) && !empty($_POST['pay_account'])) {
                $user_id = $_POST['user'];
                $update1 = Users::updUserInfo($name, $email, $user_id);

                $update = Users::modifyPassword($pwd, $user_id);
                $addAcct = Transactions::addBitcoinAccNo($bit_acct['48'], $user_id);

                $statusChange = Users::changeStatus($_POST['status'], $user_id);

                $_SESSION['info'] = 'Account Updated Successfully';
                echo ('<script type="text/javascript"> window.location = "?a=control&item=users"; </script>');

            }

        }

    }

    $user = isset($_GET['item']) ? $_GET['item'] : '';
    if ($user == '') {
        echo ('<script type="text/javascript"> window.location = "?a=home"; </script>');
    } else {

        $details = array();
        $details = Users::getUserInfoById($user);

        Misc::generateToken();
        ?>
<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <script language="javascript">
            function IsNumeric(sText) {
                var ValidChars = "0123456789.";
                var IsNumber = true;
                var Char;
                if (sText == '')
                    return false;
                for (i = 0; i < sText.length && IsNumber == true; i++) {
                    Char = sText.charAt(i);
                    if (ValidChars.indexOf(Char) == -1) {
                        IsNumber = false;
                    }
                }
                return IsNumber;
            }

            function checkform() {
                if (document.editform.fullname.value == '') {
                    alert("Please type your full name!");
                    document.editform.fullname.focus();
                    return false;
                }


                if (document.editform.password.value != document.editform.password2.value) {
                    alert("Ple
                        ase check your password!");
                        document.editform.fullname.focus();
                        return false;
                    }




                    if (document.editform.email.value == '') {
                        alert("Please enter your e-mail address!");
                        document.editform.email.focus();
                        return false;
                    }

                    return true;
                }
            </script>

            <div class="cabinet-settings">
                <div class="container row">
                    <div class="cabinet-page-title">
                        <h1> Modify Account</h1>
                    </div>

                    <div class="cabinet-settings-block">


                        <div class="box">
                            <div class="pers-data">
                                <form action="" method="post" onsubmit="return checkform()" name="editform"><input
                                        name="form_token" value="<?php echo $_SESSION['token']; ?>" type="hidden">
                                    <input type="hidden" name="user" value="<?php echo $user; ?>" />
                                    <input name="pg_lvl" value="1" type="hidden">

                                    <div class="page-title">
                                        <h1> Personal<br>details</h1>
                                    </div>
                                    <div class="list">
                                        <ul>

                                            <li>
                                                <label>Username:</label>
                                                <input value="<?php echo $details['username'] ?>" disabled="disabled"
                                                    type="text">
                                            </li>

                                            <li>
                                                <label>New password: </label>
                                                <input name="password" class="inpts" size="30" type="text"
                                                    value="<?php echo $details['password'] ?>">
                                            </li>

                                            <li>
                                                <label>E-mail address:: </label>
                                                <input name="email" value="<?php echo $details['email'] ?>"
                                                    class="inpts" size="30" type="text"> </li>




                                        </ul>
                                    </div>


                            </div>
                        </div>

                        <div class="box">
                            <div class="pay-data">

                                <div class="page-title">
                                    <h1> Transaction <br> Details</h1>
                                </div>

                                <div class="pass-list">

                                    <ul>
                                        <li>
                                            <label> Full Name:</label>
                                            <input name="fullname" value="<?php echo ucwords($details['name']); ?>"
                                                type="text" required="">
                                        </li>

                                        <li>

                                            <label>Bitcoin N&otilde;: </label>

                                            <input class="inpts" size="30" name="pay_account[48]" type="text"
                                                value="<?php echo $details['user_acct_no'] ?>">

                                        </li>
                                        <?php
$status = array('1' => 'active', '2' => 'suspend');

        ?>
                                        <li>
                                            <label> User Status:</label>
                                            <select name="status" id="status" class="inpts">
                                                <?php
foreach ($status as $key => $value) {
            ?>
                                                <option value="<?php echo $key; ?>"
                                                    <?php echo ($key == $details['status']) ? 'selected' : ''; ?>>
                                                    <?php echo ucwords($value); ?> </option>
                                                <?php
}

        ?>
                                            </select>
                                        </li>
                                    </ul>

                                    <div class="button"><button type="submit"> Modify</button> </div>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </font>
    </div>
</div>

<?php
}
}

function addTransaction()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        $token = isset($_POST['form_token']) ? $_POST['form_token'] : "";

        if (!empty($token) && ($token == $_SESSION['token'])) {

            $username = trim($_POST['username']);
            $amt = $_POST['amt'];
            $type = $_POST['type'];

            if (!empty($username) && !empty($amt) && !empty($type)) {

                if ($type == 1) {
                    $generate = Transactions::addAdminDeposit($username, $amt, $type);
                } elseif ($type == 2) {
                    $generate = Transactions::addAdminWithdraw($username, $amt, $type);
                }

                if ($generate > 0) {

                    $_SESSION['info'] = 'Generated Successfully';
                } else {

                    $_SESSION['error'] = 'An error occurred, please try again later';
                }

            } else {
                $_SESSION['error'] = 'Please fill in all the fields';
            }
        }
    }
    Misc::generateToken();
    ?>


<div class="cabinet-splash">
    <div class="container row">
        <font color="#282828">

            <div class="cabinet-page-title">
                <h1>Generate Transaction</h1>
            </div>
            <br><br><br><br><br>
            <div class="cabinet-splash-block" style="margin: 0px!important;">
                <div class="box">
                    <div class="person-stat transaction">
                        <div class="page-title">
                            <h1>New<br>Transaction</h1>
                        </div>
                        <div class="form" style="margin-top: 50px;">
                            <form method=post action="" onsubmit="return checkform()" name="regform">
                                <input type="hidden" name="pg_lvl" value="1" />
                                <input type="hidden" name="form_token" value="<?php echo $_SESSION['token']; ?>">
                                <ul>
                                    <li class="part">
                                        <label>Username: * </label>
                                        <input required type="text" name="username" value="" class="inpts" size="30">
                                    </li>
                                    <li>
                                        <label>Amount: *</label>
                                        <input required type="number" min="10" name="amt" value="" class="inpts"
                                            size="30">
                                    </li>
                                    <li>
                                        <label>Type: * </label>
                                        <select name="type" id="type" class="inpts">
                                            <option value="1" selected=""> Deposit </option>
                                            <option value="2"> Withdrawal </option>
                                        </select>
                                    </li>
                                </ul>

                                <div class="button" style="margin-top: 50px;"><button required type="submit"
                                        value="Create" class="sbmt">
                                        Create</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="company-stat">
                        <div class="page-title">
                            <h1>Recent <br>Transactions</h1>
                        </div>
                        <?php
$depositors = array();
    $depositors = Transactions::getLatestDeposits();

    $withdraws = array();
    $withdraws = Transactions::getLatestWithdrawal();
    ?>

                        <div class="company-stat-tabs ui-tabs ui-corner-all ui-widget ui-widget-content"
                            id="company-stat-tabs">
                            <ul class="company-stat-tabs-nav ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
                                role="tablist">
                                <li role="tab" tabindex="0"
                                    class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                    aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true"
                                    aria-expanded="true">
                                    <a href="#tabs-1" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                        id="ui-id-1"><b>Recent Deposits</b><span>Total deposits</span></a>
                                </li>
                                <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                    aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false"
                                    aria-expanded="false">
                                    <a href="#tabs-2" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                        id="ui-id-2"><b>Recent Payouts</b><span>Total commission</span></a>
                                </li>
                            </ul>

                            <div class="company-stat-tabs-info ui-tabs-panel ui-corner-bottom ui-widget-content"
                                id="tabs-1" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                                <div class="list">
                                    <ul>
                                        <?php

    foreach ($depositors as $value) {

        if (empty($value['admin'])) {
            $name = Users::getUrnameById($value['customer_id']);
        } else {
            $name = $value['username'];
        }
        ?>
                                        <li>
                                            <p><span> <?php echo ucwords($name); ?></span><i><b>$
                                                        <?php echo number_format($value['amount'], 2); ?></b></i></p>
                                        </li>

                                        <?php
}

    ?>
                                    </ul>
                                </div>

                            </div>
                            <div class="company-stat-tabs-info ui-tabs-panel ui-corner-bottom ui-widget-content"
                                id="tabs-2" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;"
                                aria-hidden="true">

                                <div class="list">
                                    <ul>
                                        <?php

    foreach ($withdraws as $value) {
        if (empty($value['admin'])) {
            $name = Users::getUrnameById($value['user_id']);
        } else {
            $name = $value['username'];
        }
        ?>
                                        <li>
                                            <p><span><?php echo ucwords($name) ?></span><i><b>$
                                                        <?php echo number_format($value['amount']); ?></b></i></p>
                                        </li>

                                        <?php

    }
    ?>

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </font>
    </div>
</div>


<?php

}

function bulk_mail()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //Misc::stopRefresh();
        $subj = $_POST['subject'];
        $msg = $_POST['message'];

        if (!empty($subj) && !empty($msg)) {
            if (!empty($_POST['few'])) {
                $emails = explode(';', $_POST['few']);
                foreach ($emails as $user) {
                
                    $send[] = Misc::sendMail($msg, $subj, 'Client', $user);
                    
                }
                
            } else {
                $users = array();
                $users = Users::getAllUsers('')[1];
                foreach ($users as $user) {
                    $send[] = Misc::sendMail($msg, $subj, $user['name'], $user['email']);

                }
            }
        
            if (count($send) > 0) {
            
            $_SESSION['info'] = 'Mail Successfully Sent!';
        } else {

            $_SESSION['error'] = 'An error occurred!, Mail Not Sent!';
        }
    }else{
        $_SESSION['error'] = 'Please fill in all the fields!';
    }
    }
    Misc::generateToken();
    ?>
<link rel="stylesheet" href="../static/vendor/cleditor/jquery.cleditor.css" />
<link rel="stylesheet" href="../static/vendor/cleditor/jquery.cleditor-hack.css" />
<style>
.cabinet-settings-block .box .pers-data .list ul li label,
.cabinet-settings-block .box .pay-data .pass-list ul li label {
    width: 60px !important;

}

.cabinet-settings-block .box .pers-data .list ul li input,
.cabinet-settings-block .box .pay-data .pass-list ul li input,
.cabinet-settings-block .box .pay-data .pass-list ul li select {

    width: 100% !important;
}
</style>
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->

        <div id="result" style="min-height: 50px; width: 100%;">

        </div>
        <div class="cabinet-splash">
            <div class="container row">
                <font color="#282828">

                    <script language="javascript">
                    function IsNumeric(sText) {
                        var ValidChars = "0123456789.";
                        var IsNumber = true;
                        var Char;
                        if (sText == '')
                            return false;
                        for (i = 0; i < sText.length && IsNumber == true; i++) {
                            Char = sText.charAt(i);
                            if (ValidChars.indexOf(Char) == -1) {
                                IsNumber = false;
                            }
                        }
                        return IsNumber;
                    }

                    function checkform() {
                        if (document.editform.fullname.value == '') {
                            alert("Please type your full name!");
                            document.editform.fullname.focus();
                            return false;
                        }


                        if (document.editform.password.value != document.editform.password2.value) {
                            alert("Ple
                                ase check your password!");
                                document.editform.fullname.focus();
                                return false;
                            }




                            if (document.editform.email.value == '') {
                                alert("Please enter your e-mail address!");
                                document.editform.email.focus();
                                return false;
                            }

                            return true;
                        }
                    </script>

                    <div class="cabinet-settings">
                        <div class="container row">
                            <div class="cabinet-page-title">
                                <h1> Send Mail</h1>
                            </div>

                            <div class="cabinet-settings-block">


                                <div class="box">
                                    <div class="pers-data">

                                        <div class="page-title">

                                        </div>
                                        <div class="list">
                                            <ul>
                                                <li>

                                                </li>
                                            </ul>
                                        </div>


                                        </form>
                                    </div>
                                </div>

                                <div class="box">
                                    <div class="pay-data">

                                        <div class="page-title">
                                            <h1> Send<br>to All Clients</h1>
                                        </div>

                                        <div class="pass-list">
                                            <form method="post" action="">
                                                <input type="hidden" name="pg_lvl" value="1">
                                                <ul>
                                                    <li>
                                                        <label> Subject:</label>
                                                        <input name="subject" value="" type="text" required="">
                                                    </li>

                                                    <li>

                                                        <label>Mail Body: </label>

                                                        <textarea class="inpts" required="" id="message"
                                                            name="message"></textarea>


                                                    </li>

                                                    <li>
                                                        <label> Send To Few:</label>
                                                        <input name="few" 
                                                        placeholder="Enter the emails each separated by a semi-colon (;)" value="" type="text">
                                                    </li>

                                                </ul>

                                                <div class="button"><button type="submit"> Send</button> </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </font>
            </div>
        </div>

    </div>
</div>
<?php
}


?>