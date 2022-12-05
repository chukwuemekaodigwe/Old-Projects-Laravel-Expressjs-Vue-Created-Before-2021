<?php

class Transactions
{

    public static function countRef()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT COUNT(table_id) AS refNo FROM referral WHERE referer_id = :id AND status = 1');
        $get->bindValue(':id', $_SESSION['uid'], PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['refNo'];

        $db = null;
        if ($result != null) {

            return ($result);
        } else {
            return ($result = 0);
        }
    }

    public static function activeReferee()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT COUNT(`table_id`) AS refNo2 FROM referral WHERE referer_id = :id AND status = 1 AND investment_plan != 0');
        $get->bindValue(':id', $_SESSION['uid'], PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['refNo2'];
        //var_dump($result);
        if ($result != null) {
            return ($result);
        } else {
            return ($result = 0);
        }
    }

    public static function addReferral($referer, $newCust)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO referral(referer_id, new_cust_id, reg_date, status) VALUES(:ref, :user, NOW(), 1)');
        $insert->bindValue(':ref', $referer, PDO::PARAM_INT);
        $insert->bindValue(':user', $newCust, PDO::PARAM_INT);
        $insert->execute();

        $result = $db->lastInsertId();

        $db = null;
        if ($result = '') {
            return ($result = 0);
        } else {
            return ($result);
        }
    }

    public static function updRef($newCust_id = '', $plan_id)
    {
        $user_id = (!empty($newCust_id)) ? $newCust_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE referral SET investment_plan = :plan WHERE new_cust_id = :uid AND status = 1');
        $upd->bindValue(':plan', $plan_id, PDO::PARAM_INT);
        $upd->bindValue(':uid', $user_id, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;

        return ($test);
    }

    public static function getRefInfoByUid($usr_id = '')
    {
        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT investment_plan FROM referral WHERE referer_id = :uid AND investment_plan != 0');
        $get->bindValue(':uid', $user_id, PDO::PARAM_INT);
        $get->execute();

        $plan = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $plan[] = $row['investment_plan'];
        }

        $db = null;
        return ($plan);
    }

    public static function getAllInvestmtPlans()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT * FROM investment_plans ORDER BY plan_id ASC');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return ($list);
    }

    public static function getInvestPlanById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM investment_plans WHERE plan_id = :id');
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);

        $list = $row;

        $db = null;
        if ($list != null) {

            return ($list);
        } else {
            return ($list = 0);
        }
    }

    public static function getPlanNameById($plan_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM investment_plans WHERE plan_id = :id LIMIT 1');
        $get->bindValue(':id', $plan_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $db = null;

        if ($name != null) {
            return ($name);
        } else {
            return ($name = '');
        }
    }

    public static function recordDepost($plan_type, $amt, $pay_type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $add = $db->prepare('INSERT INTO deposit(plan_id, customer_id, amount, reg_date, method)
		VALUES(:plan, :cust, :amt, NOW(), :method)');
        $add->bindValue(':plan', $plan_type, PDO::PARAM_INT);
        $add->bindValue(':cust', $_SESSION['uid'], PDO::PARAM_INT);
        $add->bindValue(':amt', $amt, PDO::PARAM_INT);
        $add->bindValue(':method', $pay_type, PDO::PARAM_STR);
        $add->execute();

        $result = $db->lastInsertId();
        $db = null;
        return ($result);
    }

    /**
     * BitCoin Payment create result
     * bitgold1487
     *
     * string(606) "{"data": {"address": "3MjjpHPBLXKQAdgr2bhbBMWrsDZFHGY3yz", "confirmations": -1, "create_time": "1537196281", "currency": "USD", "description": "", "item": "", "expected_amount": "0.00789900", "paid_amount": "", "paid_currency": "", "payment_id": "kV6tOeHvd88PsFuF", "payment_url": "https://bitcoinpay.com/en/sci/invoice/btc/kV6tOeHvd88PsFuF/", "price": "50.00", "reference": "{\"customer_id\": \"4\", \"order_number\": \"0\", \"customer_name\": \"Juliet Ros
     */
    public static function updDeposit($depo_id, $pay_id, $status, $time, $addr, $btc)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $add = $db->prepare('UPDATE deposit SET payment_id = :pay_id, status = :status, date_paid = NOW(), btc_address = :addr, btc_amt = :btc WHERE table_id = :deposit');
        $add->bindValue(':pay_id', $pay_id, PDO::PARAM_STR);
        $add->bindValue(':status', $status, PDO::PARAM_STR);
        $add->bindValue(':deposit', $depo_id, PDO::PARAM_INT);
        // $add->bindValue(':date', date('Y-m-d H:i:s', $time), PDO::PARAM_STR);
        $add->bindValue(':addr', $addr, PDO::PARAM_STR);
        $add->bindValue(':btc', $btc, PDO::PARAM_INT);
        $add->execute();

        $test = $add->rowCount();
        $db = null;
        return ($test);
    }

    public static function makePaymentApi($deposit_id, $amount, $plan)
    {
        $custName = Users::getUserNameById($_SESSION['uid']);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.bitcoinpay.com/api/v1/payment/btc");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "settled_currency": "BTC",
  "return_url": "http://' . $_SERVER['SERVER_NAME'] . '/admin/?a=invoice",
  "notify_url": "https://' . $_SERVER['SERVER_NAME'] . '/admin/?a=notify",
  "notify_email": "calipsomelodies@gmail.com",
  "price": "' . $amount . '",
  "currency": "USD",
  "reference": {
    "customer_name": "' . $custName . '",
    "invoice_number": "' . $deposit_id . '",
    "investment_plan": "' . $plan . '"
  }
}');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Token 5WVDn3sxb4c2GPhuQX7Sm85c",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        $obj = get_object_vars($data);

        $obj2 = get_object_vars($obj['data']);

        return ($obj2['payment_id']);
    }

    public static function getTransactionDetail($paymt_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.bitcoinpay.com/api/v1/transaction-history/$paymt_id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Token 5WVDn3sxb4c2GPhuQX7Sm85c",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        $obj = get_object_vars($data);

        $obj2 = get_object_vars($obj['data']);

        return ($obj2);
    }

    public static function addBitcoinAccNo($bit_acct, $uid = '')
    {
        $uid = !empty($uid) ? $uid : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $update = $db->prepare('UPDATE users SET user_acct_no = :acct WHERE user_id = :uid');
        $update->bindValue(':acct', $bit_acct, PDO::PARAM_STR);
        $update->bindValue(':uid', $uid, PDO::PARAM_INT);
        $update->execute();

        $test = $update->rowCount();

        $db = null;
        return ($test);
    }

    public static function getBitcoinAddrByUsId($usr_id = '')
    {

        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_acct_no FROM users WHERE user_id = :uid');
        $get->bindValue(':uid', $user_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_acct_no'];

        $db = null;
        return ($result);
    }

    private static function getStatusBypaymt($paymt_id)
    {
        $details = self::getTransactionDetail($paymt_id);

        if ($paymt_id == $details['payment_id']) {
            $result = $details['status'];

        } else {
            $result = '';
        }

        return ($result);
    }

    public static function getNortifications($data)
    {
        $obj = json_decode($data, true);
        $type = explode(',', $obj['reference']);
        $invoice = explode(':', $type[1]);
        $invoice = trim(str_replace('"', ' ', $invoice[1]));
        /*       $subj = 'New Support Message Received! @ '.$_SERVER['SERVER_NAME'];
        $type = ADMIN;
        $body = 'Dear Sir, you have a message from a visitor/customer. The details of the message is as follows:<br/>

        Data\'s Name: '.$data.'<br>
        Obj : '.$obj.'<br>
        Reference: <blockquote>'.$invoice.'</blockquote>

        ...Dated:
        '.date('D, dS F, Y', strtotime('today')).'
        From engine@.'.$_SERVER['SERVER_NAME'];

        $send = Misc::sendMail($body,$subj, $type);
         */
        //$obj = get_object_vars($response);

        //$obj2 = get_object_vars($obj['data']);
        //setcookie('Nortification_data', $obj2, time()*60*60*2);

        $test = self::getStatusByPaymt($obj['payment_id']);
        if ($test != '') {

            $upd = self::updDeposit($invoice, $obj['payment_id'], $obj['status'], date('Y-m-d H:i:s', strtotime('today')), $obj['address'], $obj['expected_amount']);
        }

        return $upd;
    }

    public static function getWithdrawByUserId($status, $usr_id = '')
    {
        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(`amount`) AS "total" FROM withdrawal WHERE user_id = :id AND status = :status');
        $get->bindValue(':id', $user_id, PDO::PARAM_INT);
        $get->bindValue(':status', $status, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['total'];

        $db = null;
        return ($result);
    }

    public static function getDepoTotalByUid($usr_id = '')
    {
        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(`amount`) AS "total" FROM deposit WHERE customer_id = :id AND status = "confirmed"');
        $get->bindValue(':id', $user_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];

        $db = null;
        return ($total);
    }

    public static function getDepoByPlanId($plan_id, $usr_id = '')
    {
        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(`amount`) AS "total" FROM deposit WHERE customer_id = :id AND status = "confirmed" AND plan_id = :pid');
        $get->bindValue(':pid', $plan_id, PDO::PARAM_INT);
        $get->bindValue(':id', $user_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];

        $db = null;
        return ($total);
    }

    public static function getPendingDepoByPlanId($plan_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM deposit WHERE customer_id = :uid AND status != "confirmed" AND plan_id = :pid');
        $get->bindValue(':pid', $plan_id, PDO::PARAM_INT);
        $get->bindValue(':uid', $_SESSION['uid'], PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        if ($list != null) {
            return ($list);
        } else {
            return ($list = null);
        }

    }

    public static function getUserBalance($result_type = '', $usr_id = '')
    {
        $user_id = (!empty($usr_id)) ? $usr_id : $_SESSION['uid'];

        $investmt_type = array();
        $refpecent = array();
        $investmt_type = self::getAllInvestmtPlans();
//$refpecent = self::getRefInfoByUid($user_id);
        $i = 0;
        $result = 0;

        foreach ($investmt_type as $value) {
            $depoByPlan = self::getDepoByPlanId($value['plan_id'], $user_id);
            $profit = ($depoByPlan * ($value['profit'] / 100));
            $result += $depoByPlan + $profit;
        }
        // ref add it  getRefInfoByUid
        $gain = $result;
        $withdrawn = self::getWithdrawByUserId(2, $user_id);
        $bal = $gain - $withdrawn;

        if (!empty($result_type)) {
            return ($bal);
        } else {
            return (number_format($bal, 2));
        }

    }

    public static function addWithdrawReq($amt)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO withdrawal(user_id, amount, date_req, status) VALUES(:user, :amt, NOW(), 1)');
        $insert->bindValue(':user', $_SESSION['uid'], PDO::PARAM_INT);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();

        $db = null;
        return ($test);

    }

    public static function getAllDeposits($target, $date1, $date2)
    {
        //$date1 = date('Y-m-d H:i:s', strtotime($date1));
        //$date2 = date('Y-m-d H:i:s', strtotime($date2));
        $sql = "SELECT * FROM deposit WHERE status != 'confirmed' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY reg_date DESC";

        $table = 'deposit';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    public static function getAllWithdrawReq($target, $date1, $date2)
    {
        $sql = "SELECT * FROM withdrawal WHERE status = 1 AND date_req BETWEEN '$date1' AND '$date2' ORDER BY date_req DESC";

        $table = 'withdrawal';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    public static function updWithdraw($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE withdrawal SET date_confirm = NOW(), status = 2 WHERE table_id = :id');
        $upd->bindValue(':id', $id, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();

        $db = null;
        return ($test);
    }

    public static function depositConfirm($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE deposit SET date_paid = NOW(), status = :conf WHERE table_id = :id');
        $upd->bindValue(':id', $id, PDO::PARAM_INT);
        $upd->bindValue(':conf', 'confirmed', PDO::PARAM_STR);
        $upd->execute();

        $test = $upd->rowCount();

        $db = null;
        return ($test);
    }

    public static function getLatestDeposits()
    {
        $db = $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);

        $list = array();
        $get = $db->query("SELECT customer_id, amount, admin, username FROM deposit WHERE status = 'confirmed' ORDER BY table_id DESC LIMIT 12");

        $list = array();
        
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return ($list);
    }

    public static function getLatestWithdrawal()
    {
        $db = $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);

        $get = $db->query("SELECT user_id, amount, admin, username FROM withdrawal WHERE status = 2 ORDER BY table_id DESC LIMIT 12");

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return ($list);
    }

    public static function addAdminDeposit($urname, $amt, $trans_type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO deposit(username, admin, amount, reg_date, date_paid, status) VALUES(:urn, :type, :amt, NOW(), NOW(), "confirmed")');
        $insert->bindValue(':urn', ucwords($urname), PDO::PARAM_STR);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->bindValue(':type', 1, PDO::PARAM_INT);

        $insert->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function addAdminWithdraw($urname, $amt, $trans_type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO withdrawal(username, admin, amount, date_req, status) VALUES(:urn, :type, :amt, NOW(), 2)');
        $insert->bindValue(':urn', ucwords($urname), PDO::PARAM_STR);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->bindValue(':type', 1, PDO::PARAM_INT);

        $insert->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

}
