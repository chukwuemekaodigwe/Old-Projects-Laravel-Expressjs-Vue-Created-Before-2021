<?php
session_start();
require 'control.php';
//echo session_cache_expire('2');
//session_destroy();
//session_unset();

Misc::authPage();

$duty = isset($_GET['pg']) ? $_GET['pg'] : "";
if ($duty == "") {
    $duty = isset($_POST['pg']) ? $_POST['pg'] : "";
}

$ulevel = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : "";
include 'head.php';
if ($ulevel == CLIENT) {

    switch ($duty) {

        case "dash":
            dash();
            break;

        case "credit":
            credit();
            break;

        case "debit":
            debit();
            break;

        case 'referallinks':
            banners();
            break;

        case 'edit_account':
            user();
            break;

        case "referrals":
            ref();
            break;

        case 'transactions':
            earnings();
            break;
        case 'withdraw_history':
            earnings(4);
            break;

        case 'deposit_history':
            earnings(6);
            break;

        case 'deposit_list':
            earnings(3);
            break;

            case 'plans':
                plans();
                break;

                
        case 'exit':
            logout();
            break;

        default:
            dash();
            break;
    }
} elseif ($ulevel == ADMIN) {

    switch ($duty) {
        case "dash":
            dash();
            break;

        case "clients":

            clients();
            break;

        case "mails":
       emails();
            break;

        case "deposits":
            depts();
            break;

        case "withdraws":
            withd();
            break;

        case "edit_acct":
            edit_acct();
            break;

        case "config":
            config();
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

        case "edit_account":
            user();
            break;

            case "btc_portal":
                btc_address_portal();
                break;

                case "plans":
                    plans();
                    break;

                    

        default:
            dash();
            break;
    }
}

include 'foot.php';

function dash()
{
    $user = array();
    $user = Users::getUserById($_SESSION['pid']);

    $ttlDepo = Transactions::getUserTotalDepositByStatus($_SESSION['pid'], CONFIRM);
    $expected_return = Transactions::getTotalExpReturnByUserId($_SESSION['pid']);
    $refComm = Transactions::getRefererTotalCommissn($_SESSION['pid'], 5);

    $total_earning = ($expected_return - $ttlDepo) + $refComm;
    $pend_withd = Transactions::getTotalWithdByStatus($_SESSION['pid'], PENDING);

    $lastDepo = Transactions::getLastDepositByUid($_SESSION['pid']);
    $lastWithd = Transactions::getLastWithdByUid($_SESSION['pid']);

    $ttlWithd = Transactions::getTotalWithdByStatus($_SESSION['pid'], CONFIRM);
    
    ?>
<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Your Account</h1>

        <div class="acc-title__btn">
            <a href="?pg=deposit_list" class="btn btn--major">Deposits</a>
            <a href="?pg=withdraw_history" class="btn">Withdrawals</a>
        </div>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">
            <div class="bl-bg acc-info">
                <div class="acc-info__icon"><img src="../assets/img/ic-account.png" alt=""></div>
                <div class="acc-info__name"><?php echo ucfirst($user['username']); ?></div>
                <div class="acc-info__email"><?php echo $user['email']; ?></div>
                <ul class="acc-info__details">

                    <li>
                        <span>Registered since</span>
                        <b><?php echo date('M-d-Y', strtotime($user['reg_date'])); ?></b>
                    </li>
                    <li>
                        <span>Recent Access</span>
                        <b> <?php echo date('M-d-Y', strtotime('today')); ?></b>
                    </li>
                    <li>
                        <span>Last IP Address</span>
                        <b><?php echo $_SERVER['REMOTE_ADDR']; ?></b>
                    </li>


                </ul>
            </div>

            <div class="bl-bg share-bl">
                <div class="share-bl__referal referal referal--simple">
                    <div class="referal__percent">5%</div>
                    <div class="referal__title">REFERRAL COMMISSION PROGRAM</div>
                </div>
                <div class="share-bl__title">Click to copy your referral link to clipboard</div>
                <a style="height: 44px;" href="<?php echo $_SERVER['SERVER_NAME'] . '/?ref=' . $user['ref']; ?>"
                    id="ref-copy" data-clipboard-text="<?php echo $_SERVER['SERVER_NAME'] . '/?ref=' . $user['ref']; ?>"
                    class="btn btn--major btn--bl">Copy referral link</a>

                <br>

                <textarea style="height: 80px; font-size: 14px;" class="input" onfocus="this.select();"
                    onmouseup="return false;"><?php echo $_SERVER['SERVER_NAME'] . '/?ref=' . $user['ref']; ?></textarea>
            </div>
        </div>
        <div class="side-wr__mid">
            <div class="profit-bl">
                <div class="profit-bl__item profit-bl__item--balance">
                    <div class="profit-bl__img"><img src="../assets/img/ic-profit-balance.png" alt=""></div>
                    <div class="profit-bl__txt">
                        <span>Account Balance</span>
                        <b>$ <?php echo number_format(Misc::calcUserBal($_SESSION['pid'], 5), 2); ?></b>

                        <div class="profit-bl__list">
                        </div>

                    </div>
                </div>
                <div class="profit-bl__item profit-bl__item--earned">
                    <div class="profit-bl__img"><img src="../assets/img/ic-profit-earned.png" alt=""></div>
                    <div class="profit-bl__txt">
                        <span>Total Earned</span>
                        <b>$ <?php echo !empty($total_earning) ? number_format($total_earning, 2) : '0.00'; ?></b>
                    </div>
                </div>
            </div>

            <div class="status-bl">
                <div class="status-bl__item">
                    <div class="status-bl__title">investment status</div>
                    <div class="status-bl__top">
                        <div class="status-bl__img"><img src="../assets/img/ic-status-inv.png" alt=""></div>
                        <div class="status-bl__total-wr">
                            <div class="status-bl__total">$
                                <?php echo !empty($ttlDepo) ? number_format($ttlDepo, 2) : '0.00'; ?></div>
                            <p>Total Deposit</p>
                        </div>
                    </div>
                    <ul class="status-bl__list">
                        <li>
                            <span>Active Deposit</span>
                            <b>$ <?php echo !empty($ttlDepo) ? number_format($ttlDepo, 2) : '0.00'; ?></b>
                        </li>
                        <li title="">
                            <span>Last Deposit</span>
                            <b>$ <?php echo !empty($lastDepo) ? number_format($lastDepo, 2) : '0.00'; ?></b>
                        </li>
                    </ul>
                </div>
                <div class="status-bl__item">
                    <div class="status-bl__title">withdrawal status</div>
                    <div class="status-bl__top">
                        <div class="status-bl__img"><img src="../assets/img/ic-status-with.png" alt=""></div>
                        <div class="status-bl__total-wr">
                            <div class="status-bl__total">$
                                <?php echo !empty($ttlWithd) ? number_format($ttlWithd, 2) : '0.00'; ?></div>
                            <p>Withdrew Total</p>
                        </div>
                    </div>
                    <ul class="status-bl__list">
                        <li>
                            <span>Pending Withdrawal</span>
                            <b>$ <?php echo !empty($pend_withd) ? number_format($pend_withd, 2) : '0.00'; ?></b>
                        </li>
                        <li title="">
                            <span>Last Withdrawal</span>
                            <b>$ <?php echo !empty($lastWithd) ? number_format($lastWithd, 2) : '0.00'; ?></b>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


</div>

</main>

</div>

<?php
}

function banners()
{

    $ref = Users::getRefLinkByUid($_SESSION['pid']);
    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Our banners</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">
            <div class="banner-bl">
                <div class="banner-bl__buttons">
                    <a href="javascript:void(0)" class="btn btn--foobar">120x120</a>
                    <a href="javascript:void(0)" class="btn btn--foobar">125x125</a>
                    <a href="javascript:void(0)" class="btn btn--foobar">160x600</a>
                    <a href="javascript:void(0)" class="btn btn--foobar">728x90</a>
                    <a href="javascript:void(0)" class="btn btn--major">468x60</a>
                </div>
            </div>
        </div>
        <div class="side-wr__mid">
            <div class="bl-bg">
                <h2 id="banner-selected" class="banner-bl__selected">468x60</h2>
                <form class="banners-form" onsubmit="return false;"><input type="hidden" name="form_id"
                        value="15539630869986"><input type="hidden" name="form_token"
                        value="23834ba6e4b3cadb4d7bbdb3bcb0e93c">
                    <label>Banner code: </label>

                    <div class="banner-item" id="banner-728x90" style="display: none;">
                        <textarea class="banner-item-code"
                            rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/images/728x90.gif" width="728" height="90" alt=""&gt;&lt;/a&gt;</textarea>
                        <div class="banner-item-image"><a target="_blank"
                                href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"><img
                                    src="../assets/images/728x90.gif" width="728" height="90" alt=""></a></div>
                    </div>

                    <div class="banner-item" id="banner-468x60" style="">
                        <textarea class="banner-item-code"
                            rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/images/468x60.gif" width="468" height="60" alt=""&gt;&lt;/a&gt;</textarea>
                        <div class="banner-item-image"><a target="_blank"
                                href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"><img
                                    src="../assets/images/468x60.gif" width="468" height="60" alt=""></a></div>
                    </div>

                    <div class="banner-item" id="banner-125x125" style="display: none;">
                        <textarea class="banner-item-code"
                            rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/images/125x125.gif" width="125" height="125" alt=""&gt;&lt;/a&gt;</textarea>
                        <div class="banner-item-image"><a target="_blank"
                                href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"><img
                                    src="../assets/images/125x125.gif" width="125" height="125" alt=""></a></div>
                    </div>

                    <div class="banner-item" id="banner-120x120" style="display: none;">
                        <textarea
                            class=" banner-item-code">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/images/120x120.gif" width="120" height="120" alt=""&gt;&lt;/a&gt;</textarea>
                        <div class="banner-item-image"><a target="_blank"
                                href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"><img
                                    src="../assets/images/120x120.gif" width="120" height="120" alt=""></a></div>
                    </div>

                    <div class="banner-item" id="banner-160x600" style="display: none;">
                        <textarea class="banner-item-code"
                            rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/images/160x600.gif" width="160" height="600" alt=""&gt;&lt;/a&gt;</textarea>
                        <div class="banner-item-image"><a target="_blank"
                                href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?ref=<?php echo $ref; ?>"><img
                                    src="../assets/images/160x600.gif" width="160" height="600" alt=""></a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

</main>

</div>


<?php
}

function credit()
{
    //var_dump($_POST); die();

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        Misc::stopRefresh();
        $amt = $_POST['amount'];
        $plan = $_POST['plan'];
        $pay_type = $_POST['pay_type'];

        if (!empty($amt) && !empty($plan)) {

            $status = ($_POST['pay_type'] == 2) ? CONFIRM : PENDING;
            $plan_detail = array();
            $plan_detail = Transactions::getInvestmentPlanById($plan);
            if (($plan_detail != null) && ($amt >= $plan_detail['min_deposit'])) {

                $btc = Misc::getBTCequv($amt);
                $return = (($plan_detail['profit'] / 100) * $amt) + $amt;

                if ($_POST['pay_type'] == 1) {

                    $deposit = Transactions::makeDeposit($_SESSION['pid'], $amt, $return, $plan, $btc, $status);

                    $name = 'ref';
                    if (isset($_COOKIE[$name])) {
                        $updRef = Transactions::updRefById($_SESSION['pid'], $_COOKIE['$name'], $deposit);
                    }

                    $btc_addr = Transactions::getActiveBtcAddress();
                    //var_dump($deposit); die();
                    Misc::generateInvoice($btc, $amt, $btc_addr, $plan_detail['name'], $_SESSION['pid']);
                } else {

                    if ($amt <= $_SESSION['bal']) {
                        $deposit = Transactions::makeDepositFromAcctByUid($_SESSION['pid'], $plan, $amt, $status, $return, $btc);
                        $_SESSION['result'] = array('1', 'Account Successfully Credited!');
                        unset($_SESSION['bal']);
                        //dash();
                        //echo '<script type="text/javascript"> window.location = "?pg=credit";</script>';

                    } else {
                        $_SESSION['result'] = array('2', 'Sorry, you don\'t have enough credit/balance to invest');
                    }
                }
            } else {
                $_SESSION['result'] = array(2, 'Error: Please select a plan');
            }
        }
    }

    Misc::setToken();

    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Make a Deposit</h1>

        <div class="acc-title__btn">
            <a href="?pg=deposit_list" class="btn btn--major">My Deposits</a>
            <a href="?pg=deposit_history" class="btn">Deposit history</a>
        </div>

    </div>


    <div class="side-wr">
        <div class="side-wr__side">




            <script language="javascript">
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
            <?php
$invest_plans = array();
    $invest_plans = Transactions::getActiveInvestmentPlans();

    ?>




            <form class="bl-bg new-deposit" method="post" name="spendform" autocomplete="off"><input type="hidden"
                    name="pg_lvl" value="1"><input type="hidden" name="formToken"
                    value="<?php echo $_SESSION['pgToken']; ?>">

                <div class="new-deposit__row">
                    <label>Choose Plan</label>
                    <div class="select-wr">


                        <select name="plan" id="plan" title="Choose investment plan">
                            <?php
foreach ($invest_plans as $value) {
        echo '<option value="' . $value['plan_id'] . '" data-min="' . $value['min_deposit'] . '">' . $value['name'] . '</option>';
    }
    ?>
                        </select>
                    </div>
                </div>

                <div class="new-deposit__row">
                    <label>Enter Deposit Amount</label>
                    <input name="amount" class="input" value="10" type="number" placeholder="Enter deposit amount"
                        id="amt" min="10">
                </div>

                <div class="new-deposit__row">
                    <label>Choose payment system</label>
                    <div class="select-wr">
                        <select name="pay_type" id="spend_from_extermal" title="Payment system">

                            <option id="pay_ss_process_48" value="1">Bitcoin</option>

                            <option id="account_48" value="2"> From Balance</option>


                        </select>
                    </div>
                </div>

                <button class="btn new-deposit__btn">PROCEED</button>

            </form>

            <script language="javascript">
            for (i = 0; i < document.spendform.type.length; i++) {
                if ((document.spendform.type[i].value.match(/^process_/))) {
                    document.spendform.type[i].checked = true;
                    break;
                }
            }
            updateCompound();
            </script>


        </div>
        <div class="side-wr__mid">
            <div class="bl-title bl-title--lg"><span>Investment Plans</span></div>
            <div class="plan-wr">
                <div class="plan-wr__container">
                    <div class="js-slider"
                        style="display: flex!important; flex-flow: row wrap; justify-content: space-around; align-items: stretch;">
                        <?php
foreach ($invest_plans as $value) {
        ?>
                        <div class="plan-card plan-card--simple">
                            <div class="plan-card__head">
                                <div class="plan-card__percent"><?php echo $value['profit']; ?>%</div>
                                After <?php echo $value['delay']; ?> Day(s)
                            </div>
                            <ul class="plan-card__list">
                                <li>
                                    <span>Min:</span>
                                    <b><?php echo number_format($value['min_deposit'], 2); ?> USD</b>
                                </li>
                                <li>
                                    <span>Max:</span>
                                    <b><?php echo ($value['plan_id'] != 3) ? number_format($value['max_deposit'], 2) . ' USD' : 'Unlimited' ?>
                                    </b>
                                </li>
                            </ul>
                            <div class="plan-card__deposit">Deposit Included</div>



                        </div>
                        <?php
}

    ?>
                    </div>

                </div>
            </div>

        </div>


    </div>
</div>
</main>
</div>


<?php

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

    $transTtl = Transactions::getTransTotalByUserId($_SESSION['pid']);
    $refComm = Transactions::getRefererTotalCommissn($_SESSION['pid'], 5);
    $pendWithdTtl = Transactions::getTotalWithdByStatus($_SESSION['pid'], PENDING);

    $ttlBal = ($transTtl + $refComm) - $pendWithdTtl;

    $un_dues = Transactions::getTotalUndueDepositByUid($_SESSION['pid']);

    $bal = $ttlBal - $un_dues;

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        Misc::stopRefresh();
        $amt = $_POST['amount'];
        if (!empty($amt) && $amt <= $bal) {
            //var_dump($_POST); die();
            $req = Transactions::makeWithdr($_SESSION['pid'], $amt);

            if ($req > 0) {
                $_SESSION['result'] = array('1', 'Request for Withdrawal Successful! ');
            } else {
                $_SESSION['result'] = array('2', 'An Error Occurred!');
            }
        } else {
            $_SESSION['result'] = array('2', 'Please fill up the request form');
        }

        if (isset($_POST['btc_addr']) && !empty($_POST['btc_addr'])) {
            $btc = $_POST['btc_addr'];
            $add = Users::addBitcoinAddrByUid($_SESSION['pid'], $btc);
            echo $add;
        }
    }

    $btc = Users::getBitcoinByUid($_SESSION['pid']);
    $pendWithdTtl = Transactions::getTotalWithdByStatus($_SESSION['pid'], PENDING);

    $ttlBal = ($transTtl + $refComm) - $pendWithdTtl;

    $bal = $ttlBal - $un_dues;
    Misc::setToken();
    ?>


<div class="container">

    <div class="acc-title">
        <h1 class="acc-title__txt">Withdraw Funds</h1>

        <div class="acc-title__btn">
            <a href="?pg=withdraw_history" class="btn btn--major">Withdraw History</a>
        </div>

    </div>






    <form method="post" action=""><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken"
            value="<?php echo $_SESSION['pgToken']; ?>">
        <input type="hidden" name="pg" value="debit">
        <input type="hidden" name="action" value="preview">


        <div class="profit-bl">
            <div class="profit-bl__item profit-bl__item--balance">
                <div class="profit-bl__img"><img src="../assets/img/ic-profit-balance.png" alt=""></div>
                <div class="profit-bl__txt">
                    <span>Available to withdrawal</span>
                    <b>$ <?php echo !empty($bal) ? number_format($bal, 2) : '0.00'; ?></b>
                </div>
            </div>
            <div class="profit-bl__item profit-bl__item--earned">
                <div class="profit-bl__img"><img src="../assets/img/ic-profit-earned.png" alt=""></div>
                <div class="profit-bl__txt">
                    <span>Pending Withdrawal</span>
                    <b>$ <?php echo !empty($pendWithdTtl) ? number_format($pendWithdTtl, 2) : '0.00'; ?></b>
                </div>
            </div>
        </div>

        <table cellspacing="0" cellpadding="2" border="0" class="tab">


            <tbody>
                <tr>
                    <td>Your Bitcoin Account:</td>
                    <td>
                        <?php
if (!empty($btc)) {
        echo '<p>' . $btc . '</p>';
    } else {
        ?>
                        <input type="text" name="btc_addr" required=""
                            placeholder="Please enter your bitcoin address" />
                        <?php
}
    ?>
                    </td>
                </tr>
            </tbody>
        </table>


        <table cellspacing="0" cellpadding="2" border="0" width="200" class="tab">
            <tbody>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>Select eCurrency:</td>
                    <td><select name="ec" class="inpts">
                            <option value="48">Bitcoin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Withdrawal ($):</td>
                    <td><input type="number" name="amount" value="10.00" class="inpts" size="15" min="1"
                            max="<?php echo $bal; ?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <button class="btn new-deposit__btn"
                            onclick="window.confirm('Do you really want to perform this transaction?')">Request</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>


</div>

</main>

</div>


<?php
}

function user()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        Misc::stopRefresh();

        $urname = $_POST['username'];
        $pwd = $_POST['password'];
        $cpwd = $_POST['password2'];

        if (!empty($urname) && !empty($pwd) && !empty($cpwd)) {

            if ($pwd == $cpwd) {
                //var_dump($_POST);
                $upd = Users::updUserAcct($urname, $pwd, $_SESSION['pid']);

                if (!empty($_POST['btc_addr']) && !empty($_POST['cbtc'])) {
                    $btc = $_POST['btc_addr'];
                    $confirm = $_POST['cbtc'];

                    if ($btc == $confirm) {
                        $upd = Users::addBitcoinAddrByUid($_SESSION['pid'], $confirm);
                    } else {
                        $_SESSION['result'] = array('2', 'Please crosscheck your bitcoin address fields,<br>They should be the same!');
                    }
                }

                $_SESSION['result'] = array('1', 'Update Completed Successfully!');
            } else {
                $_SESSION['result'] = array('2', 'Please crosscheck Passwords fields! They should be the same!');
            }
        }
        //                  var_dump($_SESSION);die();
    }

    Misc::setToken();

    $user_details = array();
    $user_details = Users::getUserById($_SESSION['pid']);

    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Profile Settings</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">
            <div class="bl-bg acc-info">
                <div class="acc-info__icon"><img src="../assets/img/ic-account.png" alt=""></div>
                <div class="acc-info__name"><?php echo ucwords($user_details['username']); ?></div>
                <div class="acc-info__email"><?php echo strtolower($user_details['email']); ?></div>
                <ul class="acc-info__details">

                    <li>
                        <span>Registered since</span>
                        <b><?php echo date('M-d-Y h:i:s A', strtotime($user_details['reg_date'])); ?></b>
                    </li>

                </ul>
            </div>

        </div>
        <div class="side-wr__mid">





            <script language="javascript">
            function IsNumeric(sText) {
                var ValidChars = "0123456789.";
                var IsNumber = true;
                var Char;
                if (sText == '') return false;
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
                    alert("Please check your password!");
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


            <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input
                    type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                <input type="hidden" name="pg" value="edit_account">
                <input type="hidden" name="action" value="edit_account">


                <div class="bl-title"><span>Update Personal Information</span></div>

                <div class="form-wr">
                    <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                        <tbody>
                            <tr>
                                <td>Account Email:</td>
                                <td><?php echo ($user_details['email']); ?></td>
                            </tr>
                            <tr>
                                <td>Registration date:</td>
                                <td><?php echo date('M-d-Y h:i:s A', strtotime($user_details['reg_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>Your Full Name:</td>
                                <td><input type="text" name="fullname"
                                        value="<?php echo ucwords($user_details['name']); ?>" class="inpts" size="30"
                                        required="">
                                </td>
                            </tr>

                            <tr>
                                <td>Your Account Name:</td>
                                <td><input type="text" name="username"
                                        value="<?php echo strtolower($user_details['username']); ?>" class="inpts"
                                        size="30" required=""></td>
                            </tr>


                            <tr>
                                <td>New Password:</td>
                                <td><input type="password" name="password" value="" class="inpts" size="30" required="">
                                </td>
                            </tr>
                            <tr>
                                <td>Retype Password:</td>
                                <td><input type="password" name="password2" value="" class="inpts" size="30"
                                        required=""></td>
                            </tr>
                            <tr>
                                <td>Your Bitcoin acc no:</td>
                                <td><input type="text" class="inpts" size="30" name="btc_addr"
                                        value="<?php echo ($user_details['btc_no']); ?>"></td>
                            </tr>

                            <tr>
                                <td>Repeat Bitcoin acc no:</td>
                                <td><input type="text" class="inpts" size="30" name="cbtc" value=""></td>
                            </tr>




                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="btn-wr" style="margin-top: 20px; text-align: center;">
                                        <button class="btn" style="min-width: 200px; ">Save</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!----
              <div class="form-wr">
                <div class="form-wr__col">
                  <label class="frm-label" for="full_name">Full name</label>
                  <input id="full_name" type="text" name="fullname"
                         value='tst'>
                </div>

                <div class="form-wr__col">
                  <label class="frm-label" for="email">Email address</label>
                  <input id="email" type="text" name="email"
                         value='tst@tst.tst'
                         disabled readonly>
                </div>

                <div class="form-wr__col">
                  <label class="frm-label" for="password">Password</label>
                  <input id="password" type="password" name="password" value=''>
                </div>
                <div class="form-wr__col">
                  <label class="frm-label" for="password2">Retype Password</label>
                  <input id="password2" type="password" name="password2" value=''>
                </div>
              </div>
      ---->

            </form>

        </div>
    </div>

</div>

</main>

</div>

<?php
}

function earnings($type = '')
{

    $get_type = isset($_POST['trans_type']) ? $_POST['trans_type'] : (!empty($type) ? $type : '');
    if ($get_type == '') {
        $get_type = isset($_GET['trans_type']) ? $_GET['trans_type'] : '1';
    }

    $records = array();

    $reg_date = Users::getUserRegDateById($_SESSION['pid']);

    $day = 24 * 60 * 60;
    $from = strtotime($reg_date);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['day_from'])) {
        $date = implode('-', array($_POST['year_from'], $_POST['month_from'], $_POST['day_from']));
        $_SESSION['from'] = date('Y-m-d', strtotime($date));
        //var_dump($_POST); var_dump($_SESSION);
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['day_to'])) {
        $date = implode('-', array($_POST['year_to'], $_POST['month_to'], $_POST['day_to']));
        $date1 = date('Y-m-d', strtotime($date));
        $date1 = strtotime($date1) + $day;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    //var_dump(date('Y-m-d', $from));
    switch ($get_type) {
        case '2':
            $records = Transactions::getWithdByUserIdPerStatus(PENDING, $_SESSION['pid'], $_SESSION['from'], $_SESSION['to'], '?pg=transactions&trans_type=' . $get_type . '&');
            $total = Transactions::getTotalWithdByStatus($_SESSION['pid'], PENDING);
            break;

        case '3':
            $records = Transactions::getUserDepositByStatus(CONFIRM, $_SESSION['pid'], $_SESSION['from'], $_SESSION['to'], '?pg=transactions&trans_type=' . $get_type . '&');
            $total = Transactions::getUserTotalDepositByStatus($_SESSION['pid'], CONFIRM);
            break;

        case '4':
            $records = Transactions::getWithdByUserIdPerStatus(CONFIRM, $_SESSION['pid'], $_SESSION['from'], $_SESSION['to'], '?pg=transactions&trans_type=' . $get_type . '&');

            $total = Transactions::getTotalWithdByStatus($_SESSION['pid'], CONFIRM);
            break;

        case '5':

            // all deposit id of refferral which has this uid as referer;// getDeposit By Id
            $ref_trans_id = array();

            $ref_trans_id = Transactions::chkRefByUserId($_SESSION['pid']);

            $total = Transactions::getRefererTotalCommissn($_SESSION['pid'], 5);
            break;

        case '6':
            $records = Transactions::getUserDepositByStatus(PENDING, $_SESSION['pid'], $_SESSION['from'], $_SESSION['to'], '?pg=transactions&trans_type=' . $get_type . '&');
            $total = Transactions::getUserTotalDepositByStatus($_SESSION['pid'], PENDING);
            break;

        default:
            $records = Transactions::getUserTransactionByTypeUntilDate($_SESSION['pid'], date('Y-m-d', strtotime($_SESSION['from'])), date('Y-m-d', strtotime($_SESSION['to'])), '?pg=transactions&trans_type=' . $get_type . '&');

            $total = $_SESSION['bal'];
            break;
    }

    //var_dump($total);var_dump($get_type);
    $trans_type = array('all', 'pending withdrawal', 'deposit', 'withdrawal', 'referral commission', 'pending deposits');
    $months = Misc::getMonthNames();
    //print_r($_SESSION);
    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Earnings History</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">

            <form class="period-bl bl-bg" method="post" name="opts" action="?pg=transactions&page=1"><input
                    type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken"
                    value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="period-bl__title">Search Transaction</div>

                <input type="hidden" name="pg" value="transactions">

                <?php
Misc::getDateTable(Users::getUserRegDateById($_SESSION['pid']));
    ?>
                <label>Select transaction type</label>
                <div class="select-wr">
                    <select name="trans_type" onchange="document.opts.submit();">
                        <?php
$v = 0;
    foreach ($trans_type as $value) {
        $v += 1;
        if ($v == $get_type) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        ?>
                        <option value="<?php echo $v; ?>" <?php echo $selected; ?>> <?php echo ucwords($value); ?>
                        </option>
                        <?php
}
    ?>

                    </select>
                </div>

                <button class="period-bl__btn btn">Search</button>
            </form>

        </div>
        <div class="side-wr__mid">
            <div class="bl-bg">



                <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                    <tbody>
                        <tr>
                            <th class="inheader"><b>Date</b></th>
                            <th class="inheader" width=""><b>Amount</b></th>

                            <?php if ($get_type == 5) {
        ?>
                            <th class="inheader" width=""><b> Commission</b></th>
                            <th class="inheader" width=""><b> Username</b></th>
                            <?php
} else {
        ?>
                            <th class="inheader" width=""><b>Transaction Type</b></th>
                            <?php
}
    ?>
                        </tr>
                        <?php
$amt = 0;
    if ($get_type == 5) {

        $deposit = array();
        foreach ($ref_trans_id as $value) {
            $deposit = Transactions::getTransactionByTrans_id($value);

            //var_dump($value);
            ?>

                        <tr>
                            <td align="center" valign="bottom">
                                <b><small><?php echo date('M-d-Y', strtotime($deposit['reg_date'])); ?> </small></b>
                            </td>
                            <td align="right"><b>$ <?php echo number_format($deposit['amount'], 2); ?></b> </td>
                            <td><b>$ <?php $commisn = ($deposit['amount'] * 0.05);
            echo number_format($commisn, 2);
            $amt += $commisn;?></b> <img src="../assets/img/48.gif" align="absmiddle" hspace="1" height="17"></td>
                            <td align="center" valign="bottom">
                                <b><small><?php echo Users::getNicnameById($deposit['client_id']); ?> </small></b></td>
                        </tr>

                        <?php

        }

        ?>

                        <?php
} else {

        foreach ($records[0] as $value) {

            $amt += $value['amount'];
            $name = '';

            if ($value['status'] == 1) {
                $name .= 'Pending ';
            }

            if ($value['type'] == 1) {
                $name .= 'Deposit';
            } else {
                $name .= 'Withdrawal';
            }

            //$name = ($value['type'] == 1) ? 'Deposit' : (($value['status'] == 1) ? 'Pending Witthdrawal' : 'Withdrawal');

            $date = getdate(strtotime($value['reg_date']));

            ?>
                        <tr>

                            <td align="center" valign="bottom">
                                <b><small><?php echo date('M-d-Y  h:i A', strtotime($value['reg_date'])); ?>
                                    </small></b></td>

                            <td align="right"><b>$ <?php echo number_format($value['amount'], 2); ?></b> <img
                                    src="../assets/img/48.gif" align="absmiddle" hspace="1" height="17"></td>
                            <td><b> <?php echo $name; ?></b></td>
                        </tr>

                        <?php

        }
    }
    ?>



                        <tr>
                            <td colspan="3">
                                <?php if ($get_type != 5) {
        echo $records[1];
    }
    ?>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2">For this period:</td>
                            <td align="right"><b>$ <?php echo !empty($amt) ? number_format($amt, 2) : '0.00'; ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Total:</td>
                            <td align="right"><b>$ <?php echo !empty($total) ? number_format($total, 2) : '0.00'; ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>




            </div>

        </div>


        <script language="javascript">
        function go(p) {
            document.opts.page.value = p;
            document.opts.submit();
        }
        </script>

    </div>


</div>

</main>

</div>


<?php
}

function depts()
{
    $day = 24 * 60 * 60;
    if (isset($_POST['approval']) && $_POST['approval'] == 1) {
        //var_dump($_POST);die();//array(2) { ["approval"]=> string(1) "1" ["approve"]=> array(1) { [0]=> string(1) "1" } }
        if (!empty($_POST['approve'])) {
            Misc::stopRefresh();
            //
            $apprv = array();
            $plan = array();
            $apprv = $_POST['approve'];
            foreach ($apprv as $value) {

                $confirm = Transactions::confirmDeposit($value);

                $chkRef = Transactions::chkRefByTransId($value);

                if ($chkRef > 0) {
                    $confirmRef = Transactions::updRefByStatus($value);
                }

                $plan = Transactions::getPlanIdByTransId($value);

                $plan_delay = Transactions::getPlanDelayByPlanId($plan);

                $due_date = time() + ($day * $plan_delay);

                $upd = Transactions::addDueDateByTid($value, $due_date);
                if ($upd > 0) {
                    $_SESSION['result'] = array('1', 'Confirmation(s) Successful!');
                }
            }
        }
    }

    //var_dump($upd); var_dump($confirmRef); var_dump($confirm);
    $from = time() - (60 * 60 * 24 * 3 * 30);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['day_from'])) {
        $date = implode('-', array($_POST['year_from'], $_POST['month_from'], $_POST['day_from']));
        $_SESSION['from'] = date('Y-m-d', strtotime($date));
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['day_to'])) {
        $date = implode('-', array($_POST['year_to'], $_POST['month_to'], $_POST['day_to']));
        $date1 = date('Y-m-d', strtotime($date));
        $date1 = strtotime($date1) + $day;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    Misc::setToken();
    $months = array();
    $months = Misc::getMonthNames();
    $depo = array();
    list($paging, $depo) = Transactions::getDepositsUntilDateByStatus($_SESSION['from'], $_SESSION['to'], PENDING, '?pg=deposits&');
    //var_dump($depo);die();
    ?>
<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Comfirm Deposits</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">

            <form class="period-bl bl-bg" method="post" name="opts" action="?pg=deposits&page=1"><input type="hidden"
                    name="pg_lvl" value="1"><input type="hidden" name="formToken"
                    value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="period-bl__title">Search Transaction</div>

                <input type="hidden" name="pg" value="withdraws">

                <?php

    Misc::getDateTable('2018-01-01');
    ?>
                <button class="period-bl__btn btn">Search</button>
            </form>

        </div>
        <div class="side-wr__mid">
            <div class="bl-bg" style="overflow-x: scroll;">



                <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

                    <form action="" method="post"><input type="hidden" name="approval" value="1" />
                        <input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>">
                        <thead>
                            <tr>
                                <th class="inheader"> S/N&otilde;</th>
                                <th class="inheader"> Username</th>
                                <th class="inheader"> Email Address</th>

                                <th class="inheader"> <?php echo 'Invoice Date'; ?></th>
                                <th class="inheader"> Amount</th>
                                <th title="BTC Equiv As From Invoice date"> BTC Amount</th>

                                <th class="inheader"> <?php echo 'Confirm'; ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
$i = 0;
    foreach ($depo as $value) {

        ?>

                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td> <?php echo Users::getNicnameById($value['client_id']); ?></td>
                                <td> <?php echo Users::getUserEmailById($value['client_id']); ?></td>
                                <td> <?php echo date('d/m/Y', strtotime($value['reg_date'])); ?></td>
                                <td> $ <?php echo number_format($value['amount'], 2); ?></td>
                                <td> <?php echo $value['btc_amt']; ?></td>
                                <td style="text-align: center"><input type="checkbox"
                                        value="<?php echo $value['trans_id']; ?>" name="approve[]" /></td>
                            </tr>

                            <?php
}
    ?>


                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align: right;" colspan="4"><button
                                        style="float: right; margin-right: 10px;" type="submit" value="Approve"
                                        class="period-bl__btn btn">Approve</button></td>
                            </tr>
                            <tr>
                                <td colspan="7"> <?php echo $paging; ?></td>

                            </tr>

                        </tbody>
                    </form>
                </table>




            </div>

        </div>


        <script language="javascript">
        function go(p) {
            document.opts.page.value = p;
            document.opts.submit();
        }
        </script>

    </div>


</div>

</main>

</div>

<?php
}

function withd()
{

    $day = 24 * 60 * 60;
    $from = time() - (60 * 60 * 24 * 3 * 30);
    $to = time() + (60 * 60 * 24);

    if (isset($_POST['approval']) && $_POST['approval'] == 1) {
        if (!empty($_POST['approve'])) {
            Misc::stopRefresh();
            //var_dump($_POST);die();
            $apprv = array();

            $apprv = $_POST['approve'];
            foreach ($apprv as $value) {
                //
                $confirm = Transactions::confirmDeposit($value);
                //var_dump($confirm);die();
                if ($confirm > 0) {
                    $_SESSION['result'] = array('1', 'Confirmation(s) Successful!');
                }
            }
        }
    }

    if (isset($_POST['day_from'])) {
        $date = implode('-', array($_POST['year_from'], $_POST['month_from'], $_POST['day_from']));
        $_SESSION['from'] = date('Y-m-d', strtotime($date));
        //var_dump($_POST); var_dump($_SESSION);
    } else {
        $_SESSION['from'] = isset($_SESSION['from']) ? $_SESSION['from'] : date('Y-m-d', $from);
    }

    if (isset($_POST['day_to'])) {
        $date = implode('-', array($_POST['year_to'], $_POST['month_to'], $_POST['day_to']));
        $date1 = date('Y-m-d', strtotime($date));
        $date1 = strtotime($date1) + $day;
        $_SESSION['to'] = date('Y-m-d', $date1);
    } else {
        $_SESSION['to'] = isset($_SESSION['to']) ? $_SESSION['to'] : date('Y-m-d', $to);
    }

    $depo = array();
    list($paging, $depo) = Transactions::getWithdrawsUntilDateByStatus($_SESSION['from'], $_SESSION['to'], PENDING, '?pg=withdraws&');

    Misc::setToken();
    //var_dump($_SESSION);
    ?>
<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Comfirm Withdrawal</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">
            <form class="period-bl bl-bg" method="post" name="opts" action="?pg=withdraws&page=1"><input type="hidden"
                    name="pg_lvl" value="1"><input type="hidden" name="formToken"
                    value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="period-bl__title">Search Transaction</div>

                <input type="hidden" name="pg" value="withdraws">

                <?php

    Misc::getDateTable('2018-01-01');
    ?>
                <button class="period-bl__btn btn">Search</button>
            </form>
        </div>
        <div class="side-wr__mid">
            <div class="bl-bg" style="overflow-x: scroll;">



                <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                    <form action="" method="post"><input type="hidden" name="approval" value="1" />
                        <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />

                        <thead>
                            <tr>
                                <th class="inheader"> S/N&otilde;</th>

                                <th class="inheader"> Email Address</th>

                                <th class="inheader"> <?php echo 'Date'; ?></th>
                                <th class="inheader"> Amount</th>
                                <th title="BTC Equiv As From Invoice date"> BTC Address</th>

                                <th class="inheader"> <?php echo 'Confirm'; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$sn = 0;
    foreach ($depo as $value) {
        ?>
                            <tr>
                                <td><?php echo ++$sn; ?></td>

                                <td><?php echo strtolower(Users::getUserEmailById($value['client_id'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($value['reg_date'])); ?></td>
                                <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                <td><?php echo Users::getBitcoinByUid($value['client_id']); ?></td>
                                <td style="text-align: center"><input type="checkbox"
                                        value="<?php echo $value['trans_id']; ?>" name="approve[]" /></td>
                            </tr>

                            <?php
}

    ?>



                            <tr>
                                <td colspan="3"></td>
                                <td colspan="4"><button style="
          float: right;
          margin-right: 10px;
      " type="submit" value="Approve" class="period-bl__btn btn">Approve</button></td>
                            </tr>
                            <tr>
                                <td colspan="6"> <?php echo $paging; ?></td>

                            </tr>
                        </tbody>
                    </form>
                </table>




            </div>

        </div>


        <script language="javascript">
        function go(p) {
            document.opts.page.value = p;
            document.opts.submit();
        }
        </script>

    </div>


</div>

</main>

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

    if ($_SESSION['page'] == DEPOSIT) {
        $header = 'Deposits';
    } else {
        $header = 'Withdrawals';
    }

    if (isset($_POST['status'])) {
        $_SESSION['status'] = $_POST['status'];
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
$day1 = (60 * 60 * 24);

    if ($_SESSION['page'] == DEPOSIT) {
        if (isset($_POST['approval']) && $_POST['approval'] == 1) {
            if (!empty($_POST['approve'])) {
                Misc::stopRefresh();
                //var_dump($_POST);die();
                $apprv = array();
                $plan = array();
                $apprv = $_POST['approve'];
                foreach ($apprv as $value) {
                    //
                    $confirm = Transactions::confirmDeposit($value);
                    $chkRef = Transactions::chkRefByTransId($value);

                    if ($chkRef > 0) {
                        $confirmRef = Transactions::updRefByStatus($value);
                    }

                    $plan = Transactions::getPlanIdByTransId($value);

                    $plan_delay = Transactions::getPlanDelayByPlanId($plan);

                    $due_date = time() + ($day1 * $plan_delay);

                    $upd = Transactions::addDueDateByTid($value, $due_date);
                    if ($upd > 0) {
                        $_SESSION['result'] = array('1', 'Confirmation(s) Successful!');
                    }
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

        $depo = array();
        list($paging, $depo) = Transactions::getDepositsUntilDateByStatus($_SESSION['from'], $_SESSION['to'], $_SESSION['status'], '?pg=config&');
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
                            <form method="post" action="?pg=config" id="date_form">
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

                                    <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>-->
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
        ?> Deposits<br> As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To
                        <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></h3>
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
                                    <table class=" table stylish-table table-bordered  table-striped"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th> S/N&otilde;</th>
                                                <th> Username</th>
                                                <th> Email Address</th>
                                                <th> Investment Plan</th>
                                                <th> <?php if ($_SESSION['status'] == CONFIRM) {
            echo 'Payment Date';
        } else {
            echo 'Invoice Date';
        }
        ?></th>
                                                <th> Amount</th>
                                                <th title="BTC Equiv As From Invoice date"> BTC Amount</th>

                                                <th> <?php if ($_SESSION['status'] == CONFIRM) {
            echo 'PayOut Time';
        } else {
            echo 'Confirm';
        }
        ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
//payment date, delay  ==> for confirmed persons
        if ($depo != null) {
            $i = 0;
            foreach ($depo as $value) {

                $payout = (strtotime($value['due_date'])) - time();
                $payout = Misc::secondsToTime3($payout);
                ?>
                                            <tr>
                                                <td> <?php echo ++$i; ?></td>
                                                <td> <?php echo Users::getNicnameById($value['client_id']) ?></td>
                                                <td> <?php echo Users::getUserEmailById($value['client_id']) ?></td>
                                                <td> <?php echo ucwords(Transactions::getPlanNameById($value['plan_id'])); ?>
                                                </td>
                                                <td> <?php if ($_SESSION['status'] == CONFIRM) {
                    $date = 'paymt_date';
                } else {
                    $date = 'reg_date';
                }
                echo date('Y/m/d', strtotime($value["$date"]));?></td>
                                                <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                                <td> <?php echo $value['btc_amt']; ?></td>
                                                <td> <?php if ($_SESSION['status'] != CONFIRM) {?> <input
                                                        type="checkbox" name="approve[]"
                                                        value="<?php echo $value['trans_id']; ?>" /><?php } else {
                    echo $payout;
                }?> </td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <?php
}
            ?>
                                            <tr>
                                                <td colspan="8" class="text-right">
                                                    <?php if ($_SESSION['status'] == PENDING) {?> <input type="submit"
                                                        value="Confirm" class="btn btn-primary" /><?php }?> </td>
                                            </tr>

                                            <?php
}
        ?>

                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>


                        <div class="col-lg-12 col-xlg-12 col-md-12">

                            <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <form method="post" action="?pg=config" id="form1">
                        <select class="custom-select pull-right" name="status"
                            onchange="return $('#form1').trigger('submit');">
                            <option> View Toogle</option>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>

                        </select>
                    </form>
                    <h6> You may view the Confirmed deposit &rarr;</h6>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
} else {
        // THIS IS FOR WITHDRAW PAGE
        if (isset($_POST['approval']) && $_POST['approval'] == 1) {
            if (!empty($_POST['approve'])) {
                Misc::stopRefresh();
                //var_dump($_POST);die();
                $apprv = array();
                $plan = array();
                $apprv = $_POST['approve'];
                foreach ($apprv as $value) {
                    //
                    $confirm = Transactions::confirmDeposit($value);

                    if ($confirm > 0) {
                        $_SESSION['result'] = array('1', 'Confirmation(s) Successful!');
                    }
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

        $depo = array();
        list($paging, $depo) = Transactions::getWithdrawsUntilDateByStatus($_SESSION['from'], $_SESSION['to'], $_SESSION['status'], '?pg=config&');
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

                                <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>-->
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
        ?> Withdrawals<br> As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To
                    <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></h3>
                <style>
                td {
                    text-align: center;
                }
                </style>

                <div class="row">
                    <div class="col-sm-12" style="margin: 0 auto;">
                        <form action="?pg=config" method="post"><input type="hidden" name="approval" value="1" /><input
                                type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                            <div class="table-responsive">
                                <table class="table stylish-table table-bordered  table-striped"
                                    id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> S/N&otilde;</th>
                                            <th> Username</th>
                                            <th> Email Address</th>

                                            <th> <?php if ($_SESSION['status'] == CONFIRM) {
            echo 'Confirmation Date';
        } else {
            echo 'Request Date';
        }
        ?></th>
                                            <th> Amount</th>

                                            <?php if ($_SESSION['status'] != CONFIRM) {
            ?>

                                            <th title="The Client's Balance"> Total Returns</th>

                                            <th> BTC Address</th>
                                            <th> Confirm</th>

                                            <?php
}
        ?>
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
                                            <td> <?php echo Users::getNicnameById($value['client_id']) ?></td>
                                            <td> <?php echo Users::getUserEmailById($value['client_id']) ?></td>

                                            <td> <?php if ($_SESSION['status'] == CONFIRM) {
                    $date = 'paymt_date';
                } else {
                    $date = 'reg_date';
                }
                echo date('Y/m/d', strtotime($value["$date"]));?></td>
                                            <td>$ <?php echo number_format($value['amount'], 2); ?></td>

                                            <?php if ($_SESSION['status'] != CONFIRM) {
                    ?>
                                            <td>$<?php echo number_format(Misc::calcUserBal($value['client_id'], 3), 2); ?>
                                            </td>
                                            <td> <?php echo Users::getBitcoinByUid($value['client_id']); ?></td>
                                            <td> <input type="checkbox" name="approve[]"
                                                    value="<?php echo $value['trans_id']; ?>" /> </td>


                                            <?php
}
                ?>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <?php
}
            ?>
                                        <tr>
                                            <td colspan="9" class="text-right">
                                                <?php if ($_SESSION['status'] == PENDING) {?> <input type="submit"
                                                    value="Confirm" class="btn btn-primary" /><?php }?> </td>
                                        </tr>

                                        <?php
}
        ?>

                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </form>
                    </div>


                    <div class="col-lg-12 col-xlg-12 col-md-12">

                        <div style="margin: 0 auto!important;"> <?php echo $paging; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-block">
                <form method="post" action="?pg=config" id="form1">
                    <select class="custom-select pull-right" name="status"
                        onchange="return $('#form1').trigger('submit');">
                        <option> View Toogle</option>
                        <option value="1">Pending</option>
                        <option value="2">Confirmed</option>

                    </select>
                </form>
                <h6> You may view the Confirmed deposit &rarr;</h6>
            </div>
        </div>
    </div>

</div>
</div>
<?php
}
}

function clients()
{

    $depo = array();
    list($paging, $depo) = Users::getAllUsers('?pg=clients&');
    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Clients Profile</h1>

    </div>



    <div class="side-wr">
        <div class="side-wr__mid" style="width: 100%!important;">
            <div class="bl-bg">

                <div class="table-responsive">
                    <table class=" table stylish-table table-bordered  table-striped" id="dataTables-example">
                        <thead>
                            <tr>
                                <th> S/N&otilde;</th>
                                <th> Username</th>
                                <th> Full Name</th>
                                <th> Email Address</th>
                                <th> BTC Address</th>
                                <th> Net Balance</th>
                                <th> Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
if ($depo != null) {
        $i = 0;
        foreach ($depo as $value) {
            $bal = Misc::calcUserBal($value['user_id'], 3);

            ?>
                            <tr>
                                <td> <?php echo ++$i; ?></td>
                                <td> <?php echo $value['username']; ?></td>
                                <td> <?php echo ucwords($value['name']); ?></td>
                                <td> <?php echo $value['email']; ?></td>
                                <td> <?php echo $value['btc_no']; ?></td>
                                <td>$ <?php echo number_format($bal, 2); ?></td>
                                <td class="text-center"> <a
                                        href="?pg=edit_acct&u=<?php echo $value['user_id']; ?>"><i>edit</i> &nbsp;</td>
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

</main>
</div>
<?php

}

function emails()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //Misc::stopRefresh();
        $subj = $_POST['subj'];
        $msg = $_POST['message'];
        $type = $_POST['type'];
        $savedAddr=1;

        if (!empty($subj) && !empty($msg) && !empty($type)) {
            $users = array();
            if ($_POST['type'] != 1) {
                $users = $_POST['users'];
                      } else {
                $users = Users::getAllUserForMail();
              
                }
                        

                $from['name'] = CORP.': HR Manager';
                $from['email'] = 'info@'.$_SERVER['SERVER_NAME'];
    
           $sent =   mailer::sendviaSwift($users['email'], $users['name'], $from, $subj, $textmail= strip_tags($msg), $htmlmail = $msg, $attachment = null);


/*            $send[] = mailer::sendViaPhpmailer($addAttch='', $attach = '', $subj, $msg, $bodyText = '', CORP.': HR Manager', $users['email'],$users['name'], 'info@'.$_SERVER['SERVER_NAME'], CORP.': HR Manager');
            
  */      
           

            if (!empty($send)) {
                $save = Misc::recordMail($subj, $msg, $savedAddr, $_POST['type']);
                $_SESSION['result'] = array('1', 'Successfully Sent!');
            } else {

                $_SESSION['result'] = array('2', 'An error occurred!, Mail Not Sent!');
            }
        }
    } // getUserFullNameByEmail($addr)


    Misc::setToken();
    ?>
<link rel="stylesheet" href="../assets/vendor/cleditor/jquery.cleditor.css" />
<link rel="stylesheet" href="../css/vendor/cleditor/jquery.cleditor-hack.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.10/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
  selector: '#tinymce',  // change this value according to your html
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  height: 400,
  width: 500,
  image_caption: true,
  
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link table",
  
  images_upload_url: 'imagehandler.php',
  images_upload_base_path: '',
  images_upload_credentials: false
});


/*

tinymce.init({
  selector: 'textarea#full-featured-non-premium',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: '//www.tiny.cloud/css/codepen.min.css',
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog *
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog *
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog *
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
 });

*/



</script>

<div class="container">

    <div class="info-bl" style="border: 0px; margin: auto!important;">

        <div class="info-bl__icon"><img src="../assets/img/ic-info-1.png" alt=""></div>
        <div class="info-bl__txt">
            <h2> Send Mails to Clients</h2>
        </div>


    </div>

    <div class="support-form">



        <script language=javascript>
        function checkform() {
            if (document.mainform.name.value == '') {
                alert("Please type your full name!");
                document.mainform.name.focus();
                return false;
            }
            if (document.mainform.email.value == '') {
                alert("Please enter your e-mail address!");
                document.mainform.email.focus();
                return false;
            }
            if (document.mainform.message.value == '') {
                alert("Please type your message!");
                document.mainform.message.focus();
                return false;
            }
            return true;
        }
        </script>
        <style>
        .hidden {
            visibility: hidden;
        }
        </style>

        <form method="post" action="" name="mainform" id="support-form" class="form-wr"><input required type="hidden"
                name="pg_lvl" value="1"><input required type="hidden" name="formToken"
                value="<?php echo $_SESSION['pgToken']; ?>">

            <div class="form-wr" style="clear:both;">
                <div class="form-wr__col">
                    <label for="username"> Mail Subject</label>
                    <input value="" required type="text" class="input" placeholder="Subject" name="subj"> </div>

                <div class="form-wr__col">
                    <label for="emai-type"> Type</label>

                    <div class="select-wr">
                        <select name="type" id="message_type" required="">
                            <option selected="" value=""> Type of receipients</option>
                            <option value="1"> All</option>
                            <option value="2"> Specific</option>
                        </select>
                    </div>

                </div>
            </div>
            <div id="addr_content" class="form-wr" style="clear:both; display: contents; ">


            </div>
            <div class="form-wr" style="display:none;" id="more">
                <button type="button" onclick="return add_field()" class="btn"
                    style="float:right; margin: -20px -50px 10px; background: blue; color: #fff; font-size:2em; padding: 1px 3px; border-radius: 10px;">
                    + </button>
            </div>

            <label for="message" style="clear: both;">Message</label>
            <textarea name="message" data-label="Message" id="tinymce"
                placeholder="Enter the message here"></textarea>

            <input required type="hidden" name="pg" value="mails">
            <input required type="hidden" name="action" value="send">

            <div class="form-wr__btn-bl">
                <button class="btn" style="min-width: 200px;">submit</button>
            </div>
        </form>
    </div>

</div>

</main>

</div>


<?php
}

function edit_acct()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        //array(10) { ["pg_lvl"]=> string(1) "1" ["formToken"]=> string(16) "Mtk949zVlcUbDriX" ["pg"]=> string(9) "edit_acct" ["task"]=> string(6) "update" ["email"]=> string(14) "macd@gmail.com" ["fullname"]=> string(6) "Philip" ["username"]=> string(7) "tooflat" ["password2"]=> string(10) "contra1990" ["btc_addr"]=> string(34) "1CqqDGCrt6YC8SLozBTj77TpKjJqnS1a89" ["status"]=> string(1) "1" }

        $urname = $_POST['username'];
        $email = $_POST['email'];

        $name = $_POST['fullname'];
        $pwd = $_POST['password2'];
        $btc_addr = $_POST['btc_addr'];
        $status = $_POST['status'];
        $user = $_POST['uid'];
        if ($status != 1) {
            $upd_status = Users::changeUserStatus($user);
        }

        $updAcct = Users::updUserAcct($urname, $pwd, $user);
        $upd_btc = Users::addBitcoinAddrByUid($user, $btc_addr);

        $_SESSION['result'] = array(1, 'Client details updated successfully!');
    }
    ?>
<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Edit Client Details</h1>

    </div>
    <?php

    $user = isset($_GET['u']) ? $_GET['u'] : (isset($_POST['u']) ? $_POST['u'] : '1');

    $user_details = array();
    $user_details = Users::getUserById($user);

    $users = Users::getAllUserFullName();
    ?>


    <div class="side-wr">
        <div class="side-wr__side">
            <div class="bl-bg acc-info">
                <div class="acc-info__icon"><img src="../assets/img/ic-account.png" alt=""></div>

                <form class="" method="post" name="opts" action="?pg=edit_acct">

                    <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                    <div class="period-bl__title">Select Client</div>

                    <input type="hidden" name="task" value="select">
                    <div class="select-wr">
                        <select name="u" onchange="document.opts.submit();">
                            <?php

    foreach ($users as $value) {
        $selected = ($value['user_id'] == $user) ? 'selected' : '';
        ?>
                            <option value="<?php echo $value['user_id'] ?>"
                                accesskey="<?php echo substr($value['name'], 0, 1) . '"' . $selected; ?> title="
                                <?php echo $value['email']; ?>"> <?php echo $value['username']; ?></option>
                            <?php
}
    ?>
                        </select>
                    </div>
                    <button class="period-bl__btn btn">Search</button>
                </form>

            </div>

        </div>
        <div class="side-wr__mid">

            <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input
                    type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                <input type="hidden" name="pg" value="edit_acct">
                <input type="hidden" name="uid" value="<?php echo $user_details['user_id']; ?>">


                <div class="bl-title"><span>Update Client's Information</span></div>

                <div class="form-wr">
                    <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                        <tbody>
                            <tr>
                                <td>Registration date:</td>
                                <td><?php echo date('M-d-Y h:i:s A', strtotime($user_details['reg_date'])); ?></td>
                            </tr>

                            <tr>
                                <td>Account Email:</td>
                                <td><input type="email" name="email" readonly=""
                                        value="<?php echo $user_details['email']; ?>" class="inpts" size="30"
                                        required=""></td>
                            </tr>
                            <tr>
                                <td>Full Name:</td>
                                <td><input type="text" name="fullname"
                                        value="<?php echo ucwords($user_details['name']); ?>" class="inpts" size="30"
                                        required="">
                                </td>
                            </tr>

                            <tr>
                                <td>Account Name:</td>
                                <td><input type="text" name="username"
                                        value="<?php echo strtolower($user_details['username']); ?>" class="inpts"
                                        size="30" required=""></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type="text" name="password2" value="<?php echo $user_details['password']; ?>"
                                        class="inpts" size="30"></td>
                            </tr>
                            <tr>
                                <td> Bitcoin address:</td>
                                <td><input type="text" class="inpts" size="30" name="btc_addr"
                                        value="<?php echo ($user_details['btc_no']); ?>"></td>
                            </tr>

                            <tr>
                                <td> Modify Status:</td>
                                <td>
                                    <select name="status" class="inpts">
                                        
                                        <option value="1">Activate</option>
                                        <option value="2">Suspend</option>
                                    </select>

                                </td>
                            </tr>




                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="btn-wr" style="margin-top: 20px; text-align: center;">
                                        <button class="btn" style="min-width: 200px; ">Save</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </form>



        </div>
    </div>

</div>

</main>

</div>

<?php
}

function ref()
{

    $active_ref = Transactions::getActiveRefByUid($_SESSION['pid']);
    $passive = Transactions::getPassiveRefByUid($_SESSION['pid']);
    $commisn = Transactions::getRefererTotalCommissn($_SESSION['pid'], 5);
    $my_refs = array();
    $my_refs = Transactions::getAllMyRefereeByUid($_SESSION['pid']);

    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Your Referrals</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">

            <div class="bl-bg ref-stat">
                <div class="ref-stat__item">
                    <div class="ref-stat__img"><img src="../assets/img/ic-ref-1.png" alt=""></div>
                </div>
                <div class="ref-stat__item">
                    <div class="ref-stat__img"><img src=".../assets/img/ic-ref-2.png" alt=""></div>
                    <div>
                        <span>Total Referrals</span>
                        <b><?php $sum = $active_ref + $passive;
    echo number_format($sum);?></b>
                    </div>
                </div>
                <div class="ref-stat__item">
                    <div class="ref-stat__img"><img src="../assets/img/ic-ref-3.png" alt=""></div>
                    <div>
                        <span>Active Referrals</span>
                        <b> <?php echo number_format($active_ref); ?></b>
                    </div>
                </div>

                <div class="ref-stat__item">
                    <div class="ref-stat__img"><img src="../assets/img/ic-ref-3.png" alt=""></div>
                    <div>
                        <span>Passive Referrals</span>
                        <b> <?php echo number_format($passive); ?></b>
                    </div>
                </div>

                <div class="ref-stat__item">
                    <div class="ref-stat__img"><img src="../assets/img/ic-ref-4.png" alt=""></div>
                    <div>
                        <span>Total Commission</span>
                        <b>$ <?php echo !empty($commisn) ? number_format($commisn, 2) : '0.00'; ?></b>
                    </div>
                </div>
            </div>

            <div class="bl-bg share-bl">
                <div class="share-bl__referal referal referal--simple">
                    <div class="referal__percent">5%</div>
                    <div class="referal__title">REFERRAL COMMISSION PROGRAM</div>
                </div>
                <div class="share-bl__title">Click to copy your referral link to clipboard</div>
                <a style="height: 44px;"
                    href="https://<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . Users::getRefLinkByUid($_SESSION['pid']); ?>"
                    id="ref-copy"
                    data-clipboard-text="https://<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . Users::getRefLinkByUid($_SESSION['pid']); ?>"
                    class="btn btn--major btn--bl">Copy referral link</a>

                <br>

                <textarea style="height: 80px" class="input" onfocus="this.select();"
                    onmouseup="return false;">https://<?php echo $_SERVER['SERVER_NAME'] . '?ref=' . Users::getRefLinkByUid($_SESSION['pid']); ?></textarea>
            </div>

        </div>
        <div class="side-wr__mid">

            <div class="bl-bg">
                <table class="table--lg">
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <th>Email address</th>
                            <th>Status</th>
                        </tr>

                        <?php
foreach ($my_refs as $value) {

        ?>
                        <tr>
                            <td>
                                <?php echo ucwords(Users::getNicnameById($value['new_cust_id'])); ?>
                            </td>
                            <td>
                                <?php echo strtolower(Users::getUserEmailById($value['new_cust_id'])); ?>
                            </td>
                            <td>
                                <?php echo strtoupper(($value['status'] == 1) ? 'Active' : 'Passive'); ?>
                            </td>
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

</main>

</div>

<?php
}

function addTransaction()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        Misc::stopRefresh();

        //var_dump($_POST); die();

        $username = trim($_POST['name']);
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

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt">Add Transactions</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side" style="width: auto;">
            <div class="bl-bg profit-bl__item profit-bl__item--earned"
                style="display: flex; float: left; flex-flow: row; align-items: center; justify-content: center;">
                <div class="acc-info__icon"><img src="../assets/img/ic-account.png" height="50px" width="50px" alt="">
                </div>
            </div>
        </div>
        <div class="side-wr__mid" style="width: 700px; ">
            <div class="support-form">

                <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl"
                        value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                    <input type="hidden" name="pg" value="generate">

                    <div class="form-wr">
                        <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                            <tbody>

                                <tr>
                                    <td>Account Name:</td>
                                    <td><input type="text" name="name" class="inpts" size="30" required=""></td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td><input type="number" name="amt" class="inpts" size="30" required="" min="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td> Tranaction Type</td>
                                    <td>
                                        <select name="type" class="inpts">
                                            <option value="1">Deposit</option>
                                            <option value="2">Withdrawal</option>
                                        </select>

                                    </td>
                                </tr>




                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div class="btn-wr" style="margin-top: 20px; text-align: center;">
                                            <button class="btn" style="min-width: 200px; ">Save</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </form>



            </div>

        </div>


        <script language="javascript">
        function go(p) {
            document.opts.page.value = p;
            document.opts.submit();
        }
        </script>

    </div>


</div>

</main>

</div>

<?php

}


function plans(){
    if(isset($_POST['duty']) && !empty($_POST['duty'])){
        $item = isset($_GET['item']) ? $_GET['item'] : (isset($_POST['item']) ? $_POST['item'] : '');
        
        $duty = $_POST['duty'];
        
        switch ($duty) {
            case 'edit':
                if(!empty($item)){
                $plan = Transactions::getInvestmentPlanById($item);
                }
                break;

                case 'deactivate':
                    if(!empty($item)){
                        
                        //var_dump($item); die();
                        $delete = Transactions::changePlanStatus($item, $_POST['status']);
                        $_SESSION['result'] = array(1, 'Successful');
                    }
                    break;

                    case 'save':
                        Misc::stopRefresh();
                        //["name"]=> string(6) "test 2" ["min_dept"]=> string(2) "20" ["max_dept"]=> string(3) "100" ["profit"]=> string(1) "3" ["delay"]=> string(1) "1" } 
                          //  var_dump($_POST);
                            $name = $_POST['name'];
                            $min = $_POST['min_dept'];
                            $max = $_POST['max_dept'];
                            $profit = $_POST['profit'];
                            $delay = $_POST['delay'];

                            if(!empty($name) && !empty($min) && !empty($max) && !empty($profit) && !empty($delay)){
                                $save = Transactions::saveNewPlan($name, $min, $max, $profit, $delay);
                               if($save > 0){
                                $_SESSION['result'] = array(1, 'New Plan Created Successfully');
                               }else{
                                $_SESSION['result'] = array(2, ' UnSuccessfully');
                               }
                            }else{
                                $_SESSION['result'] = array(2, 'Erro: Please fillin all the fields');
                            }

                        break;

                        case 'update':
                            $name = $_POST['name'];
                            $min = $_POST['min_dept'];
                            $max = $_POST['max_dept'];
                            $profit = $_POST['profit'];
                            $delay = $_POST['delay'];
                            $plan = $_POST['plan'];

                            if(!empty($name) && !empty($min) && !empty($max) && !empty($profit) && !empty($delay)){
                                $save = Transactions::updatePlan($name, $min, $max, $profit, $delay, $plan);
                               if($save > 0){
                                $_SESSION['result'] = array(1, 'Successfully');
                               }else{
                                $_SESSION['result'] = array(2, ' UnSuccessfully');
                               }
                            }else{
                                $_SESSION['result'] = array(2, 'Erro: Please fillin all the fields');
                            }
                            break;
            
            default:
                
                break;
        }
    }

    Misc::setToken();
    ?>

<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt"> Manage Investment Platforms</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">

            <form class="period-bl bl-bg" method="post" id="plan" action="">
            <input type="hidden" name="duty" id="duty" value="save"> <input type="hidden" name="plan" id="edit_plan" value="">
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="period-bl__title">  New Platform</div>



                        <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                            <tbody>
                                <tr> 
                                    <td colspan="2"><input type="text" id="plan_name" name="name" class="inpts" size="30"  required="" placeholder="Title for Identification"></td>
                                </tr>
                                <tr class="tr_form">
                                    
                                <td><input type="number" name="min_dept" id="min" class="inpts" size="30" required="" title="" placeholder="Mininmum Deposit">
                                    </td>

                                    <td><input type="number" name="max_dept" id="max" class="inpts" size="30" required="" placeholder="Maximum Deposit">
                                    </td>
                                </tr>

                                <tr class="tr_form">
                                    
                                <td><input type="number" name="profit" id="profit" class="inpts" size="30" required="" placeholder="% Profit Incurred">
                                    </td>

                                    <td><input type="number" name="delay" id="delay" class="inpts" size="30" required="" placeholder="Delay in days" title="Delay before Withdrawal in days">
                                    </td>
                                </tr>




                                <tr>
                                    
                                    <td>
                                        <div class="btn-wr" style="margin-top: 20px; text-align: center;">
                                        <button class="period-bl__btn btn">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
               
            </form>

        </div>
        <div class="side-wr__mid">
            <div class="bl-bg" style="overflow-x: scroll;">



                <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

                    <form action="" method="post"><input type="hidden" name="approval" value="1" />
                        <input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>">
                        <thead>
                            <tr>
                                
                                <th class="inheader"> Name/Title</th>
                                <th class="inheader"> Min</th>

                                <th class="inheader">  Max</th>
                                <th class="inheader"> %Profit</th>
                                <th class="inheader"> Delay in Days</th>
                                <th class="inheader"> Status </th>
                                <th class="inheader"> </th>
                                <th class="inheader"> </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
$plans = Transactions::getInvestmentPlans();
foreach($plans as $plan){

        ?>

                            <tr id="<?php echo $plan['plan_id'];?>">
                                <td> <?php echo ucwords($plan['name']); ?></td>
                                <td> <?php echo number_format($plan['min_deposit'], 2); ?></td>
                                <td> <?php echo number_format($plan['max_deposit'], 2); ?></td>
                                <td> <?php echo $plan['profit']; ?> %</td>
                                <td> <?php echo $plan['delay']; ?> days</td>
                                <td> <?php echo ($plan['status'] == 1) ? 'Active' : 'Not Active'; ?></td>
                                <td>
                               <button type="button" class="btn btn-link edit" data-plan="<?php echo $plan['plan_id'];?>" data-name="<?php echo $plan['name'];?>" data-min="<?php echo $plan['min_deposit'];?>" data-max="<?php echo $plan['max_deposit'];?>" data-delay="<?php echo $plan['delay'];?>" data-profit="<?php echo $plan['profit'];?>">
                               Edit
                               </button>
                                
                                </td>
                                <td>
                                
                                <form method="post" action="">
                                <input type="hidden" name="duty" value="deactivate">
                                <input type="hidden" name="status" value="<?php echo ($plan['status'] != 1) ? '1' : '0'; ?>">
                                
                                <input type="hidden" name="item" value="<?php echo $plan['plan_id'];?>">
                                
                                <button class="btn btn-link"><?php echo ($plan['status'] != 1) ? 'activate' : 'deactivate'; ?>
                                </button>
                                
                                </form>
                                
                                </td>

                            <?php
}
    ?>


                            </tr>
                            

                        </tbody>
                    </form>
                </table>




            </div>

        </div>


        <script language="javascript">
       $('.edit').click(function () {
        var item = $(this); var form = $('#plan');

        name = item.data('name');
        min = item.data('min');
        max = item.data('max');
        delay = item.data('delay');
        profit = item.data('profit');

        $('#plan_name').val(name);
        $('#min').val(min);
        $('#max').val(max);
        $('#delay').val(delay);
        $('#profit').val(profit);
        $('#edit_plan').val(item.data('plan'));
        $('#duty').val('update');
        //form.trigger('focus');
        $('#plan_name').focus();

       });

        
        </script>

    </div>


</div>

</main>

</div>

    <?php
}


function btc_address_portal(){

    if(isset($_POST['duty']) && !empty($_POST['duty'])){
        
        switch ($_POST['duty']) {
            
            case 'edit':
                if(!empty($item)){
                $plan = Transactions::getInvestmentPlanById($item);
                }
                break;

                case 'status':
                    
                    if(!empty($_POST['status'])){
                        Transactions::releaseBTCStatus();
                        $delete = Transactions::changeBTCStatus($_POST['status']);
                        
                        $_SESSION['result'] = array(1, 'Changed Successfully');
                    }
                    break;

                    case 'save':
                        //Misc::stopRefresh();
                        /*["btc"]=> string(18) "jggatatagsfsfgsfgs" ["formToken"]=> string(16) "gnf8FFkd6ko9Frc5" ["name"]=> string(11) "Mac Dominic" ["btc_descr"]=> string(0) "" }
                            var_dump($_POST); die();
                            */
                            $name = $_POST['name'];
                            $btc = $_POST['btc'];
                            $desc = $_POST['btc_descr'];
                          

                            if(!empty($name) && !empty($btc)){

                                $status = (isset($_POST['activate']) && !empty($_POST['activate'])) ? '1' : '0'; 

                                $save = Transactions::addBTC($name, $btc, $desc, $status);
                               if($save > 0){
                                $_SESSION['reult'] = array(1, 'Created Successfully');
                               }else{
                                $_SESSION['reult'] = array(2, ' UnSuccessfully');
                               }
                            }else{
                                $_SESSION['reult'] = array(2, 'Erro: Please fillin  the  basic fields');
                            }

                        break;

                        case 'update':
                            $name = $_POST['name'];
                            $btc = $_POST['btc'];
                            $descr = $_POST['btc_descr'];
                            $id = $_POST['btc_id'];

                            if(!empty($name) && !empty($btc)){
                                $status = (isset($_POST['activate']) && !empty($_POST['activate'])) ? '1' : '0'; 
//var_dump($_POST); die();
                                $save = Transactions::updateBTC($name, $btc, $descr, $status, $id);
                               if($save > 0){
                                $_SESSION['reult'] = array(1, 'Successfully');
                               }else{
                                $_SESSION['reult'] = array(2, ' UnSuccessfully');
                               }
                            }else{
                                $_SESSION['reult'] = array(2, 'Erro: Please fillin all the fields');
                            }
                            break;
            
            default:
                
                break;
        }
    }

    Misc::setToken();
    
    ?>
<div class="container">
    <div class="acc-title">
        <h1 class="acc-title__txt"> Manage BTC Addresses</h1>

    </div>

    <div class="side-wr">
        <div class="side-wr__side">

            <form class="period-bl bl-bg" method="post" name="opts" action="?pg=btc_portal">
            <input type="hidden" name="pg_lvl" value="1">
            <input type="hidden" name="duty" value="save" id="duty">
            <input type="hidden" name="btc_id" value="" id="edit_btc">
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="period-bl__title"> Add New BTC</div>



                        <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                            <tbody>

                                <tr>
                                    
                                    <td><input type="text" name="name" class="inpts" size="30" required="" id="btc_name" placeholder="Name for Identification"></td>
                                </tr>
                                <tr>
                                    
                                    <td><input type="text" name="btc" class="inpts" size="30" id="btcaddress" required="" placeholder="New BTC Address">
                                    </td>
                                </tr>

                                <tr>
                                    
                                    <td>
                                        <textarea name="btc_descr" id="descr" cols="30" rows="3" placeholder="Optionally add a short description"></textarea>

                                    </td>
                                </tr>

                                <tr>
                                    
                                    <td>
                                        <label> Make this the active BTC Address <input type="checkbox" name="activate" value="1" id=""> </label>

                                    </td>
                                </tr>

                                <tr>
                                    
                                    <td>
                                        <div class="btn-wr" style="margin-top: 20px; text-align: center;">
                                        <button class="period-bl__btn btn">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
               
            </form>

        </div>
        <div class="side-wr__mid">
            <div class="bl-bg" style="overflow-x: scroll;">



                <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">

                    <form action="?pg=btc_portal" method="post">
                        <input type="hidden" name="duty" value="status"><input type="hidden" name="formToken"
                            value="<?php echo $_SESSION['pgToken']; ?>">
                        <thead>
                            <tr>
                                <th class="inheader"> Date Created</th>
                                <th class="inheader"> Name/Title</th>
                                <th class="inheader"> BTC Address</th>

                                <th class="inheader">  Short Description</th>
                                <th class="inheader">  </th>
                                <th class="inheader"> <i>options</i> </th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php
$i = 0;
$btc_addresses = Transactions::getBtcAddresses();
    foreach ($btc_addresses as $value) {
$status = ($value['status'] == 1) ? 'checked' : '';
        ?>

                            <tr>
                                
                                <td> <?php echo date('d-m-y', strtotime($value['reg_date'])) ?></td>
                                <td> <?php echo ucwords($value['identifier']); ?></td>
                                <td> <?php echo $value['btc_address']; ?></td>
                                <td> <?php echo $value['description'] ?></td>
                                
                                <td style="text-align: center"><input type="radio"
                                        value="<?php echo $value['id']; ?>" <?php echo $status; ?> name="status" onclick="$(this).trigger('submit')" />
                                        
                                        </td>

                                        <td>
                                        <button type="button" class="btn btn-link edit" data-btc="<?php echo $value['btc_address'];?>" data-name="<?php echo $value['identifier'];?>" data-descr="<?php echo $value['description'];?>" 
                                        data-id="<?php echo $value['id'];?>" 
                                        >
                               Edit
                               </button>
                                
                                        </td>
                            </tr>

                            <?php
}
    ?>


                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align: right;" colspan="4"><button
                                        style="float: right; margin-right: 10px;" type="submit" value="Approve"
                                        class="period-bl__btn btn">make active</button></td>
                            </tr>

                        </tbody>
                    </form>
                </table>




            </div>

        </div>

        <script language="javascript">
       $('.edit').click(function () {
        var item = $(this); var form = $('#new_btc');

        name = item.data('name');
        btc = item.data('btc');
        descr = item.data('descr');
       

        $('#btc_name').val(name);
        $('#btcaddress').val(btc);
        $('#descr').val(descr);
        
        $('#edit_btc').val(item.data('id'));
        $('#duty').val('update');
        //form.trigger('focus');
        $('#btc_name').focus();

       });

        
        </script>

    </div>


</div>

</main>

</div>


    <?php
}
?>