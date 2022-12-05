<?php
class Users
{

    public static function createAcct($name, $email, $pet, $pwd, $reflink)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO users (name, email, username, password, user_level, reg_date, status, ref) VALUES(:name, :mail, :urname, :pwd, :ulevel, NOW(), 1, :ref)');
        $insert->bindValue(':name', $name, PDO::PARAM_STR);
        $insert->bindValue(':mail', $email, PDO::PARAM_STR);
        $insert->bindValue(':urname', $pet, PDO::PARAM_STR);
        $insert->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $insert->bindValue(':ulevel', CLIENT, PDO::PARAM_INT);

        $insert->bindValue(':ref', $reflink, PDO::PARAM_STR);
        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;
    }

    public static function authAcct($email, $pwd)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id, user_level FROM users WHERE username = :mail AND password = :pwd');
        $get->bindValue(':mail', $email, PDO::PARAM_STR);
        $get->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $get->execute();

        $list = array();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;
    }

    public static function getUserIdByEmail($email)
    {
        // For verifying email

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE email = :mail');
        $get->bindValue(':mail', $email, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];

        $db = null;
        return $result;
    }

    public static function getUserFullNameById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];

        $db = null;
        return $name;
    }

    public static function getUserRegDateById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT reg_date FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['reg_date'];

        $db = null;
        return $name;
    }

    public static function getUserFullNameByEmail($mail)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM users WHERE email = :id');
        $get->bindValue(':id', $mail, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];

        $db = null;
        return $name;
    }

    public static function getNicnameById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT username FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['username'];

        $db = null;
        return $name;
    }

    public static function getUserEmailById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT email FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['email'];

        $db = null;
        return $name;
    }

    public static function getAllUsers($target)
    {

        $sql = "SELECT * FROM users WHERE user_level = 2 ORDER BY user_id desc";
        $table = 'users';
        $limit = 20;
        $count = 'SELECT COUNT(*)AS "num" FROM users WHERE user_level = 2';
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql, $count);

        return array($paginate, $result);
        /*

     */
    }

    public static function getAllUserEmail()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT email FROM users WHERE user_level = 2');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['email'];
        }

        $db = null;
        return $list;
    }

    public static function getAllUserFullName()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT name, user_id, email, username FROM users WHERE user_level = 2 ORDER BY username ASC');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }

    public static function getUserById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM users WHERE user_id = :uid');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;
    }

    public static function updUserAcct($pet = '', $pwd, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET username = :urn, password = :pwd WHERE user_id = :uid');
        $upd->bindValue(':urn', $pet, PDO::PARAM_STR);
        $upd->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);

        $upd->execute();
        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function updUserPwd($pwd, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET password = :pwd WHERE user_id = :uid');
        $upd->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);

        $upd->execute();
        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function addBitcoinAddrByUid($uid, $btc_addr)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET btc_no = :btc WHERE user_id = :uid');
        $upd->bindValue(':btc', $btc_addr, PDO::PARAM_STR);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function getBitcoinByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT btc_no FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $btc_addr = $row['btc_no'];

        $db = null;
        return $btc_addr;
    }

    public static function getRefLinkByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT ref FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['ref'];

        $db = null;
        return $name;
    }

    public static function getUserIdByRef($ref)
    {
        // For verifying refLinks

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE ref = :mail');
        $get->bindValue(':mail', $ref, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];

        $db = null;
        return $result;
    }

    public static function changeUserStatus($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('UPDATE users SET status = 0 WHERE user_id = :uid');
        $get->bindValue(':uid', $user, PDO::PARAM_INT);

        $get->execute();

        $test = $get->rowCount();
        $db = null;

        return $test;
    }
}

class Misc
{

    public static function generateInvoice($btc, $amt, $btc_address, $plan, $uid)
    {
        //include('../../head.php');

        ?>


<style>
@media print {
    .page-header {
        display: none;
    }

    .paage-foooter {
        display: none;
    }

    .acc-nav {
        display: none;
    }
}


.container-fluid {

    top: 10%;
    left: 250px;
    margin: 20px auto;
    background: #fff no-repeat center center;
    padding: 50px 70px;
    border-radius: 5px;
    width: 800px;
    z-index: 200;
    box-shadow: 0 3px 3px rgba(0, 0, 0, .05);
}

.row {
    padding: 1px !important;
}

.holder {
    display: flex;
    flex-flow: row;
    justify-content: space-between;
    align-items: center;
}
</style>
<div class="container">

    <div class="container-fluid">


        <div class="acc-title">
            <h1 class="acc-title__txt">Deposit Invoice</h1>
        </div>


        <!-- Row -->
        <style>
        td:odd {
            text-align: right !important;
            font-weight: bold;
        }
        </style>
        <div class="holder">
            <div class="img-responsive">
                <img src="../assets/img/logo.jpg" alt="LOGO" height="80px" />
            </div>

            <div class="addr">
                <p class="text-right">
                    <?php echo CORP; ?> <br> 71-75 Shelton Street,<br> London, Greater London, <br> United Kingdom, WC2H
                    9JQ

                    <br><span style="font-style: italic">customercare@<?php echo $_SERVER['SERVER_NAME']; ?></span>
                </p>
            </div>
        </div>
        <div class="holder">
            <div class="">
                <h3 class="card-title"> Deposit Invoice:</h4>
                    <p><b> Dated:</b> <?php echo date('d-m-Y', strtotime('today')); ?><br>
                        <b>Due Date: </b><?php echo date('d-m-Y', strtotime('today')); ?></p>
            </div>
            <div>
                <h3 class="card-title"> Invoiced To:</h4>
                    <p> <?php echo Users::getUserFullNameById($uid); ?></p>
            </div>
            <div class="">
                <h2 class="h2" style="transform: rotate(-30deg); margin-left: -10px;"> NOT YET PAID</h2>
            </div>
        </div>
        <div class="" style="margin: 20px auto;">
            <div class="table-responsive m-t-20 m-b-30">

                <table class="table table-condensed table-striped -table">

                    <tr>
                        <th colspan="2">
                            <h3>Transaction Details</h3>
                        </th>
                    </tr>
                    </thead>
                    <tr>
                        <td>
                            Investment Plan

                        </td>

                        <td>
                            <?php echo ucfirst($plan); ?>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Amount Payable(BTC)

                        </td>

                        <td>
                            <?php echo $btc; ?>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            Amount In Dollars

                        </td>

                        <td>
                            <?php echo $amt; ?>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            Bitcoin Address

                        </td>

                        <td style="word-wrap: break-word!important;">
                            <?php echo $btc_address; ?>
                        </td>

                    </tr>


                </table>
            </div>
        </div>


        <div class="alert alert__info">
            <div class="text-left">

                <span class="info"> <strong>NB:</strong> Immediately after payment send the following details to
                    bills@<?php echo $_SERVER['SERVER_NAME']; ?> :</span>
                <ol style="list-style-type: disc">
                    <li><i class="fa fa-check-square-o"></i> &nbsp; Your Bitcoin Address</li>
                    <li><i class="fa fa-check-square-o"></i> &nbsp; Your Email Address, </li>
                    <li><i class="fa fa-check-square-o"></i> &nbsp; BTC Amount Sent,<i>and</i></li>
                    <li><i class="fa fa-check-square-o"></i> &nbsp; Date of Payment</li>
                </ol>
            </div>

        </div>
        <div style="display: block; padding:20px; margin-top:10px;">
            <button style="float: right;" class="btn btn--bl" onclick=" return window.print();"> Print</button>
        </div>
    </div>


</div>


</div>
</div>
</div>
</div>
</div>
</main>
</div>

<?php

        unset($_SESSION['bal']);
        include 'foot.php';
        die();
    }

    public static function calcUserBal($uid, $percent)
    {

        $transTtl = Transactions::getTransTotalByUserId($uid);
        $refComm = Transactions::getRefererTotalCommissn($uid, $percent);
        $pendWithdTtl = Transactions::getTotalWithdByStatus($uid, PENDING); //pending withdrawals

        $ttlBal = ($transTtl + $refComm) - $pendWithdTtl;

        return $ttlBal;
    }

    public static function getBTCequv($dollar)
    {
        $url = "http://api.coindesk.com/v1/bpi/currentprice/USD.json";
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);
        $result = json_decode($response, true);
        /*
        $response = file_get_contents($url);
        $result = json_decode($response, TRUE);
        //var_dump($result['bpi']['USD']['rate_float']);
         */
        $btc = $result['bpi']['USD']['rate_float'];

        if ($btc == null) {
            $final_result = 0.00;
        } else {

            $final_result = $dollar / $btc;
            //echo $final_result;
        }
        return $final_result;
    }

    public static function recordMail($subj, $msg, $addr = '', $all)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $add = $db->prepare('INSERT INTO msg (title, body, reg_date, addresses, sent_to_all, status) VALUES(:subj, :msg, NOW(), :addr, :all, 1)');
        $add->bindValue(':subj', $subj, PDO::PARAM_STR);
        $add->bindValue(':msg', $msg, PDO::PARAM_STR);
        $add->bindValue(':addr', $addr, PDO::PARAM_STR);
        $add->bindValue(':all', $all, PDO::PARAM_INT);

        $add->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;
    }

    public static function sendMail($msg, $subj, $addr, $userName)
    {
        $to = $addr;
        $replyTo = 'do-not-reply@' . $_SERVER['SERVER_NAME'];
        //$replyTo = 'calipsomelodies@gmail.com';
        $name = ucwords($userName);
        $sender = CORP;
        $replyName = CORP;

        //$from = 'admin@' . $_SERVER['SERVER_NAME'];
        $from = 'mailer.digitalplazas.com';

        $send = mailer::sendViaDefault(CORP, $name.' <'. $addr.'>', $subj, $msg);

        //$send = mailer::sendviaSwift($to, $from, $subj, '', $msg, '');
        if ($send) {
           return (true);
            //var_dump($send); die();
        } else {
            return $send;
        }
    }

    public static function getAllSentMsgUntilDate($date1, $date2, $target)
    {
        $sql = "SELECT * FROM msg WHERE reg_date BETWEEN '$date1' AND '$date2' ORDER BY msg_id DESC";
        $table = 'msg';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    public static function paginator($tbl_name, $targetpage, $limit, $sql, $count = '')
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $adjacents = 1;
        //$limit = 20;

        if ($count == '') {
            $query = $db->prepare("SELECT COUNT(*) AS 'num' FROM `$tbl_name`");
        } else {
            $query = $db->prepare($count); //SELECT COUNT(*) AS 'num' FROM transaction WHERE type = 1 AND plan_id = 3 AND status = 1
        }

        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $total_pages = $row['num'];

        $page = isset($_GET['page']) ? $_GET['page'] : "";
        if ($page) {
            $start = ($page - 1) * $limit;
        }
        //first item to display on this page
        else {
            $start = 0;
        }
        //if no page var is given, set start to 0

        $list = array();
        $result = $db->query($sql . " LIMIT $start, $limit");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        if ($page == 0) {
            $page = 1;
        }

        $prev = $page - 1; //previous page is page - 1
        $next = $page + 1; //next page is page + 1
        $lastpage = ceil($total_pages / $limit); //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1; //last page minus 1

        /*
        Now we apply our rules and draw the pagination object.
        We're actually saving the code to a variable in case we want to draw it more than once.
         */
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= '<ul class="table-paging">';
            //previous button
            if ($page > 1) {
                $pagination .= '<li class="table-paging__prev"><a href="' . $targetpage . 'page=' . $prev . '">&laquo; previous</a></li>';
            } else {
                $pagination .= '<li class="disabled"><span>&laquo; previous</span></li>';
            }

            //pages
            if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page) {
                        $pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
                    } else {
                        $pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                    }

                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                    $pagination .= "...";
                    $pagination .= '<li><li><a href="' . $targetpage . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= '<li><a href="' . $targetpage . 'page=1">1</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=2">2</a></li>';
                    $pagination .= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                    $pagination .= "...";
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
                }
                //close to end; only hide early pages
                else {
                    $pagination .= '<li><a href="' . $targetpage . 'page=1">1</a></li>';
                    $pagination .= '<li><a href="' . $targetpage . 'page=2">2</a></li>';
                    $pagination .= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
                        } else {
                            $pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
                        }

                    }
                }
            }

            //next button
            if ($page < $counter - 1) {
                $pagination .= '<li class="table-paging__next"><a href="' . $targetpage . 'page=' . $next . '">next &raquo;</a></li>';
            } else {
                $pagination .= '<li class="disabled"><span>next &raquo;</span></li>';
            }

            $pagination .= "</ul>\n";
        }

        $db = null;
        return array($pagination, $list);
    }

/* make withd
//$ttlBal = self::calcUserBal($uid, $percent);
//  if ($ttlBal >= $amt) {
$withd = Transactions::makeWithdr($uid, $amt);
$deposit = Transactions::makeDeposit($uid, $amt, $return, $plan, $btc_amt, $status);
return $deposit;

//}

('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return, plan_id, btc_amt) VALUES((2, :userid, :amt, NOW(), :status, :exp1, '', ''),(1, :userid, :amt, NOW(), :status, :exp2, :plan, :btc_amt))');
}

//getBTC equivalent  curl=> https://api.coindesk.com/v1/bpi/currentprice/USD.json

/**
 *
 * @var
 *

 * == result
 * {"time":{"updated":"Jan 15, 2019 17:06:00 UTC","updatedISO":"2019-01-15T17:06:00+00:00","updateduk":"Jan 15, 2019 at 17:06 GMT"},"disclaimer":"This data was produced from the CoinDesk Bitcoin Price Index (USD). Non-USD currency data converted using hourly conversion rate from openexchangerates.org","bpi":{"USD":{"code":"USD","rate":"3,662.3767","description":"United States Dollar","rate_float":3662.3767}}}
 *
 *
 * /
 */
/////////////////////////// Convert Timestamp to min, hrs, days
    ///  1
    public static function secondsToTime($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

///  2

/**
 * Convert number of seconds into hours, minutes and seconds
 * and return an array containing those values
 *
 * @param integer $inputSeconds Number of seconds to parse
 * @return array
 */

    public static function secondsToTime2($inputSeconds)
    {

        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj;
    }

    public static function secondsToTime3($inputSeconds)
    {
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // Extract days
        $days = floor($inputSeconds / $secondsInADay);

        // Extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // Extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // Extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // Format and return
        $timeParts = [];
        $sections = [
            'day' => (int) $days,
            'hour' => (int) $hours,
            'minute' => (int) $minutes,
            'second' => (int) $seconds,
        ];

        foreach ($sections as $name => $value) {
            if ($value > 0) {
                $timeParts[] = $value . ' ' . $name . ($value == 1 ? '' : 's');
            }
        }

        return implode(', ', $timeParts);
    }

    public static function izRand($length, $numeric = false)
    {
        // for random character generation
        $random_string = "";
        while (strlen($random_string) < $length && $length > 0) {
            if ($numeric === false) {
                $randnum = mt_rand(0, 61);
                $random_string .= ($randnum < 10) ?
                chr($randnum + 48) : ($randnum < 36 ?
                    chr($randnum + 55) : chr($randnum + 61));
            } else {
                $randnum = mt_rand(0, 9);
                $random_string .= chr($randnum + 48);
            }
        }

        return $random_string;
    }

    public static function getRandomRef()
    {
        do {
            $reflink = self::izRand(16);
            $ref_check = Users::getUserIdByRef($reflink);
        } while ($ref_check != null);

        return $reflink;
    }

    public static function authPage()
    {

        $token = isset($_SESSION['key']) ? $_SESSION['key'] : "";
        if (!isset($_SESSION['key']) && !isset($_SESSION['user_type']) && !isset($_SESSION['pid']) && $token !== 'FINE') {
            echo '<script type="text/javascript"> window.location = "../";</script>';
            die();
        }
    }

/*

$token = isset($_SESSION['token']) ? $_SESSION['token'] : "";

$ulevel = isset($_SESSION['ulevel']) ? $_SESSION['ulevel'] : "";

if(!isset($_SESSION['token']) && !isset($_SESSION['ulevel']) && !isset($_SESSION['pin']) && $token !== 'FINE'){
echo '<script type="text/javascript"> window.location = ".";</script>';die();
}elseif(isset($_SESSION['pin']) && ($ulevel != $type)){

if($_SESSION['ulevel'] == ADMIN){
echo '<script required type="text/javascript"> window.location = "?pg=admin_dash";</script>';
}else{
echo '<script required type="text/javascript"> window.location = "?pg=dash";</script>';
}

}
}

 */
    public static function stopRefresh()
    {
        if ($_POST['formToken'] != $_SESSION['pgToken']) {
            echo '<script type="text/javascript"> window.location = "' . basename($_SERVER['REQUEST_URI']) . '";</script>';
            die();
        }
    }

    public static function stopSignupRefresh()
    {
        if ($_POST['formToken'] != $_SESSION['pgToken']) {
            echo '<script type="text/javascript"> window.location = ".";</script>';
            die();
        }
    }

    public static function setToken()
    {
        $token = self::izRand(16);
        $_SESSION['pgToken'] = $token;
        //var_dump($token);
    }

    public static function setSessionCookie($cookiename, $value, $duratn)
    {
        $name = $cookiename;
        $value = $value;

        $cookie = array($name, $value, $duratn);

        $_SESSION['set_cookie'] = $cookie;
        //var_dump($_SESSION['set_cookie']);
        return true;
    }

    public static function getMonthNames()
    {
        return $months = array(
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
        );
    }

    public static function getDateTable($start_range)
    {

        $months = array();
        $months = self::getMonthNames();
        //var_dump($_SESSION);
        ?>


<label>From</label>
<div class="period-bl__row">
    <div class="select-wr select-wr--simple">
        <select name="month_from">
            <?php
$i = 0;
        foreach ($months as $month) {

            $i += 1;
            if ($i == (isset($_POST['month_from']) ? $_POST['month_from'] : date('m', $start_range))) {
                $selected = 'selected';
            } else {
                $selected = '';
            }

            echo '<option value="' . $i . '" ' . $selected . '> ' . $month . '</option>';
        }

        ?>


        </select>
    </div>
    <div class="select-wr select-wr--simple">
        <select name="day_from">
            <?php
for ($i = 1; $i <= 31; ++$i) {
            if ($i == (isset($_POST['day_from']) ? $_POST['day_from'] : date('d', $start_range))) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>
            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?> </option>
            <?php
}
        ?>
        </select>
    </div>
    <div class="select-wr select-wr--simple">
        <select name="year_from">
            <?php

        for ($i = date('Y', strtotime($start_range)); $i <= date('Y', strtotime('today')); ++$i) {
            $selected = ($i == (date('Y', strtotime($_SESSION['from'])))) ? 'selected' : '';
            ?>
            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?> </option>
            <?php
}

        ?>


        </select>
    </div>
</div>

<label>To</label>
<div class="period-bl__row">
    <div class="select-wr select-wr--simple">
        <select name="month_to">
            <?php
$i = 0;
        foreach ($months as $month) {

            $i += 1;
            if ($i == (isset($_POST['month_to']) ? $_POST['month_to'] : date('m', strtotime('today')))) {
                $selected = 'selected';
            } else {
                $selected = '';
            }

            echo '<option value="' . $i . '" ' . $selected . '> ' . $month . '</option>';
        }

        ?>
        </select>
    </div>
    <div class="select-wr select-wr--simple">
        <select name="day_to">
            <?php
for ($i = 1; $i <= 31; ++$i) {
            if ($i == (isset($_POST['day_to']) ? $_POST['day_to'] : date('d', strtotime('today')))) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>
            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?> </option>
            <?php
}
        ?></select>
    </div>
    <div class="select-wr select-wr--simple">
        <select name="year_to">
            <?php

        for ($i = date('Y', strtotime($start_range)); $i <= date('Y', strtotime('today')); ++$i) {
            $selected = ($i == (date('Y', strtotime($_SESSION['to'])))) ? 'selected' : '';
            ?>
            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?> </option>
            <?php
}
        ?>
        </select>
    </div>
</div>



<?php
}


public function force_https(){
    if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    echo '<script type="text/javascript"> window.location="https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'";</script>';
    //Prevent the rest of the script from executing.
    exit;

    // html format
    // < meta http-equiv=”Refresh” content=”0;URL=https://www.yourdomainname.com” />
}

}
}

/**
 * For cUrl Confi
 *
 * on I created:

function get_web_page( $url, $cookiesIn = '' ){
$options = array(
CURLOPT_RETURNTRANSFER => true,     // return web page
CURLOPT_HEADER         => true,     //return headers in addition to content
CURLOPT_FOLLOWLOCATION => true,     // follow redirects
CURLOPT_ENCODING       => "",       // handle all encodings
CURLOPT_AUTOREFERER    => true,     // set referer on redirect
CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
CURLOPT_TIMEOUT        => 120,      // timeout on response
CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
CURLINFO_HEADER_OUT    => true,
CURLOPT_SSL_VERIFYPEER => true,     // Validate SSL Cert
CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
CURLOPT_COOKIE         => $cookiesIn
);

$ch      = curl_init( $url );
curl_setopt_array( $ch, $options );
$rough_content = curl_exec( $ch );
$err     = curl_errno( $ch );
$errmsg  = curl_error( $ch );
$header  = curl_getinfo( $ch );
curl_close( $ch );

$header_content = substr($rough_content, 0, $header['header_size']);
$body_content = trim(str_replace($header_content, '', $rough_content));
$pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
preg_match_all($pattern, $header_content, $matches);
$cookiesOut = implode("; ", $matches['cookie']);

$header['errno']   = $err;
$header['errmsg']  = $errmsg;
$header['headers']  = $header_content;
$header['content'] = $body_content;
$header['cookies'] = $cookiesOut;
return $header;
}
 *
 *
 *
 * METHOD 2
 *
 * <?php
$url = "http://www.example.org/";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
echo curl_error($ch);
echo "\n<br />";
$contents = '';
} else {
curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

echo $contents;
?>
 */

/*
 * password reset()
authPage
stopRefresh
 */

?>