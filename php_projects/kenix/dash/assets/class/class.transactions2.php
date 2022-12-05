<?php

class InvestmentPlan
{

    public static function getPlanById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT * FROM investment_plans WHERE id = :id');
        $insert->bindValue(':id', $id, PDO::PARAM_INT);
        $insert->execute();

        $row = $insert->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function getAll()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT * FROM investment_plans WHERE status = 1 ORDER BY min_deposit ASC');

        $insert->execute();
        $list = array();
        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }
}

class Pledge
{

    public static function makePledge($pleger, $receiver, $plan, $due_date)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO pledge(pledger_id, receiver_id, plan_id, reg_date, due_date, status) VALUES(:pledge, :receiver, :plan, NOW(), :due, :status)');
        $insert->bindValue(':pledge', $pleger, PDO::PARAM_INT);
        $insert->bindValue(':receiver', $receiver, PDO::PARAM_INT);

        $insert->bindValue(':plan', $plan, PDO::PARAM_INT);
        $insert->bindValue(':status', PENDING, PDO::PARAM_INT);
        $insert->bindValue(':due', date('Y-m-d H:i:s', strtotime($due_date)), PDO::PARAM_STR);

        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;

    }

    public static function countReceiverTrans($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT COUNT(`receiver_trans_id`) as num FROM pledge WHERE receiver_trans_id = :id');
        $get->bindValue(':id', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['num'];
        $db = null;
        return $result;
    }

    //SELECT trans as 'nxt' FROM (SELECT a.receiver_trans_id as 'prev', b.id as trans, a.plan_id FROM `pledge` a, transaction b WHERE a.plan_id = 1 AND b.plan_id AND (a.status = 1 OR a.due_date < NOW()) GROUP BY a.receiver_trans_id DESC) as sec WHERE trans > prev AND plan_id = 1

    public static function getNextReceiver($plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT num, receiver_id, pledger_id, id, reg_date, plan_id, receiver_trans_id, user_status from(SELECT COUNT(receiver_trans_id)as "num", a.receiver_id, a.pledger_id, a.id, a.reg_date, a.plan_id, b.user_id, b.status as "user_status", a.receiver_trans_id FROM pledge a, users b WHERE b.user_id = a.pledger_id AND b.status != 0 GROUP BY a.receiver_trans_id) as sec WHERE plan_id = :plan AND num < 2 ORDER BY num ASC, reg_date ASC LIMIT 1');
        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;

    }

    public static function getPledgeById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM pledge WHERE id = :id');
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function getExpiredPledges()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT DISTINCT a.pledger_id, a.receiver_id, a.plan_id FROM pledge a, users b WHERE a.due_date < NOW() AND a.status = 0 AND a.pledger_id = b.user_id AND b.user_type != 1 AND b.status != 0 ORDER BY id ASC');

        $get->execute();

        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;

    }

    public static function getExpiringTransactions()
    {
        $day = strtotime('today');
        $one = 24 * 60 * 60;
        $prev = $day - $one;
        $prev = date('Y-m-d', $prev);

        $nxt = $day + $one + $one;
        $nxt = date('Y-m-d', $nxt);

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query("SELECT a.id FROM transaction a, users b WHERE a.due_date BETWEEN '$prev' AND '$nxt' AND a.receiver_id = b.user_id AND b.user_type != 1 ");

        $result = array();

        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row['id'];

        }

        $db = null;

        return $result;
    }

    public static function getPledgeByTrans($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM pledge WHERE receiver_trans_id = :id AND due_date < NOW()');
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function getLatestPlegdeByPlan($plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT COUNT(*) as num, id, pledger_id, receiver_id, receiver_trans_id, plan_id, status FROM `pledge` WHERE plan_id = :plan  AND (due_date > NOW() OR status = 1) GROUP BY receiver_trans_id ORDER BY id DESC LIMIT 1');

        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $row;
    }

    /*
    SELECT DISTINCT a.id as pledge, b.id as trans, a.receiver_trans_id, a.due_date, b.due_date as trans_due FROM pledge a, transaction b WHERE a.receiver_trans_id = 1 AND b.due_date = '2019-09-06' AND a.due_date < NOW()
     */

    public static function getPendingReturnByReceiver($receiver)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM pledge WHERE receiver_id = :id AND status = 0 AND due_date > NOW()');
        $get->bindValue(':id', $receiver, PDO::PARAM_INT);
        $get->execute();

        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;
    }

    public static function countUserConfirmedReturns($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM pledge WHERE receiver_trans_id = :id AND status = 1');
        $get->bindValue(':id', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;
    }

    public static function ConfirmReturn($pledge_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $update = $db->prepare('UPDATE pledge SET status = :status WHERE id = :id');
        $update->bindValue(':id', $pledge_id, PDO::PARAM_INT);
        $update->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $update->execute();

        $test = $update->rowCount();
        $db = null;

        return $test;
    }

    public static function getPendingPledgeByPledger($pledger)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT id FROM pledge WHERE pledger_id = :id AND status = 0 ORDER BY id ASC');
        $get->bindValue(':id', $pledger, PDO::PARAM_INT);
        $get->execute();

        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row['id'];
        }
        $db = null;
        return $result;
    }

    public static function checkActiveTrans($transaction_id)
    {
        $day = strtotime('today') + (60 * 60 * 18);
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT * FROM pledge WHERE receiver_trans_id = :trans AND (due_date >= :date || status = 1) ORDER BY id DESC LIMIT 1');
        $insert->bindValue(':date', date('Y-m-d H:i:s', $day), PDO::PARAM_STR);
        $insert->bindValue(':trans', $transaction_id, PDO::PARAM_INT);
        $insert->execute();
        $result = '';
        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['id'];
        }

        $db = null;
        return $result;
    }

    public static function getUserPendingReturn($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT plan_id FROM pledge WHERE pledger_id = :trans AND status = 1');

        $insert->bindValue(':trans', $user, PDO::PARAM_INT);
        $insert->execute();
        $result = 0;
        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $result += InvestmentPlan::getPlanById($row['plan_id'])['min_deposit'];
        }

        $db = null;
        return $result;

    }

    public static function getUserTotalReturn($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT plan_id FROM pledge WHERE receiver_id = :trans AND status = 1');

        $insert->bindValue(':trans', $user, PDO::PARAM_INT);
        $insert->execute();
        $result = 0;
        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $result += InvestmentPlan::getPlanById($row['plan_id'])['min_deposit'];
        }

        $db = null;
        return $result;

    }

    public static function getLatestPayouts()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare("SELECT DISTINCT * FROM pledge WHERE status = 1  ORDER BY id DESC LIMIT 20");
        $insert->execute();

        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;

    }

    public static function getLatestPlegdes()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('SELECT DISTINCT * FROM pledge WHERE status = 0 AND due_date >= NOW() ORDER BY id DESC LIMIT 20');
        $insert->execute();

        $result = array();
        while ($row = $insert->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;
    }

    public static function addFakeTransaction($pldger, $receiver, $plan, $status)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO pledge (plan_id, reg_date, pledger, receiver, status, due_date) VALUES(:plan, NOW(), :pledge, :receiver, :status, :due)');
        $insert->bindValue(':plan', $plan, PDO::PARAM_INT);
        $insert->bindValue(':pledge', $pldger, PDO::PARAM_INT);
        $insert->bindValue(':receiver', $receiver, PDO::PARAM_INT);
        $insert->bindValue(':status', $status, PDO::PARAM_INT);
        $insert->bindValue(':due', date('Y-m-d H:i:s', (time() + (24 * 2 * 60 * 60))), PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

}

/*
SELECT num, receiver_id, pledger_id, id, reg_date, plan_id, user_id, user_status from(SELECT COUNT(receiver_id)as 'num', a.receiver_id, a.pledger_id, a.id, a.reg_date, a.plan_id, b.user_id, b.status as 'user_status' FROM pledge a, users b WHERE b.user_id = a.pledger_id AND b.status != 0 GROUP BY receiver_id) as sec WHERE plan_id = 1 ORDER BY num ASC, reg_date ASC LIMIT 1

 */
class Transaction
{
    public static function createTransaction($pledge, $due_date)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO transaction(pledger_id, receiver_id, plan_id, reg_date, due_date, status) VALUES(:pledger, :receiver, :plan, NOW(), :due, :status)');
        $insert->bindValue(':pledger', $pledge['pledger_id'], PDO::PARAM_INT);
        $insert->bindValue(':receiver', $pledge['receiver_id'], PDO::PARAM_INT);
        $insert->bindValue(':plan', $pledge['plan_id'], PDO::PARAM_INT);
        $insert->bindValue(':due', date('Y-m-d', strtotime($due_date)), PDO::PARAM_INT);
        $insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);

        $insert->execute();
        $test = $db->lastInsertId();

        $db = null;
        return $test;
    }

    public static function addAdminTransaction($pledge, $due_date)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO transaction(pledger_id, receiver_id, plan_id, reg_date, due_date, status) VALUES(:pledger, :receiver, :plan, NOW(), :due, :status)');
        $insert->bindValue(':pledger', $pledge[0], PDO::PARAM_INT);
        $insert->bindValue(':receiver', $pledge[1], PDO::PARAM_INT);
        $insert->bindValue(':plan', $pledge[2], PDO::PARAM_INT);
        $insert->bindValue(':due', date('Y-m-d H:i:s', strtotime($due_date)), PDO::PARAM_INT);
        $insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);

        $insert->execute();
        $test = $db->lastInsertId();

        $db = null;
        return $test;
    }

    public static function getTransactionById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM transaction WHERE id = :id');
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function getNextTransactionByPlan($plan, $id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM `transaction` WHERE plan_id = :plan AND id > :id LIMIT 1');
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $row;
    }

    public static function getUserTransactions($target, $uid)
    {
        $sql = "SELECT * FROM transaction WHERE receiver_id = $uid OR pledger_id = $uid ORDER BY id DESC";
        $table = 'transaction';
        $count = "SELECT COUNT(*) as 'num' FROM transaction WHERE receiver_id = $uid OR pledger_id = $uid";
        $limit = 30;
        $result = Misc::paginator($table, $target, $limit, $sql, $count);
        //$result = list($paging, $data);
        return $result;
    }

    public static function getUserPledges($target, $uid)
    {
        $sql = "SELECT * FROM transaction WHERE pledger_id = $uid ORDER BY id DESC";
        $table = 'transaction';
        $count = "SELECT COUNT(*) as 'num' FROM transaction WHERE pledger_id = $uid";
        $limit = 30;
        $result = Misc::paginator($table, $target, $limit, $sql, $count);
        //$result = list($paging, $data);
        return $result;
    }

    public static function getUserProfits($target, $uid)
    {
        $sql = "SELECT * FROM transaction WHERE receiver_id = $uid ORDER BY id DESC";
        $table = 'transaction';
        $count = "SELECT COUNT(*) as 'num' FROM transaction WHERE receiver_id = $uid";
        $limit = 30;
        $result = Misc::paginator($table, $target, $limit, $sql, $count);
        //$result = list($paging, $data);
        return $result;
    }

    public static function getAllTransactions()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT id FROM transaction');

        $result = array();

        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row['id'];
        }

        $db = null;
        return $result;
    }

    public static function getUserLastTransaction($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT id FROM transaction WHERE pledger_id = :pledge ORDER BY id DESC LIMIT 1');
        $get->bindValue(':pledge', $user, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['id'];

        $db = null;
        return $result;

    }

}

// this is the admin redirecting
class Redirect
{

    public static function getPendingRedirects()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM redirect WHERE status != 1');

        $get->execute();

        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $db = null;
        return $result;
    }

    public static function getRedirectByTransId($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM redirect WHERE id = :id');
        $get->bindValue(':id', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function addRedirect($trans, $type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('INSERT INTO redirect(reg_date, trans_id, type, status) VALUES(NOW(), :trans, :type, :status)');
        $get->bindValue(':trans', $trans, PDO::PARAM_INT);
        $get->bindValue(':type', $type, PDO::PARAM_INT);
        $get->bindValue(':status', PENDING, PDO::PARAM_INT);
        $get->execute();

        $text = $db->lastInsertId();

        $db = null;
        return $text;
    }

    public static function updRedirect($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('UPDATE redirect SET count = count + 2 WHERE trans_id = :trans');
        $get->bindValue(':trans', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $text = $get->rowCount();

        $db = null;
        return $text;
    }

    public static function changeRepaymetStatus($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('UPDATE redirect SET status = :status WHERE trans_id = :trans');
        $get->bindValue(':trans', $trans_id, PDO::PARAM_INT);
        $get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $get->execute();

        $text = $get->rowCount();

        $db = null;
        return $text;
    }

    public static function getNxtActiveRedirect($plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT b.* FROM redirect a, transaction b WHERE a.status = :status AND b.plan_id = :plan AND a.trans_id = b.id AND count < 2 ORDER BY id ASC LIMIT 1');

        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->bindValue(':status', PENDING, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row;
    }

    public static function checkAdminPause()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT trans_id FROM `redirect` WHERE type = 1 AND status = 0 ORDER by id DESC LIMIT 1');

        $get->bindValue(':status', PENDING, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $db = null;
        return $row['trans_id'];
    }

    public static function getRedirectByTrans($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM redirect WHERE trans_id = :trans ');

        $get->bindValue(':trans', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $row;
    }

}

// this is the redirect for clients,
class Repayment
{

    public static function addRepayment($receiver, $total, $plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('INSERT INTO repayment(receiver_id, plan_id, total, reg_date) VALUES(:receive, :plan, :total, NOW())');
        $get->bindValue(':receive', $receiver, PDO::PARAM_INT);
        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->bindValue(':total', $total, PDO::PARAM_INT);
        $get->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function incrementRepayment($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('UPDATE redirect SET count = count + 1 WHERE id = :id');
        $get->bindValue(':id', $id, PDO::PARAM_INT);

        $get->execute();

        $test = $get->rowCount();

        $db = null;
        return $test;
    }

    public static function getNxtRepayment($plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT a.* FROM redirect a, users b WHERE a.count < a.total AND a.plan_id = :plan AND a.receiver_id = b.user_id AND b.status = 1 ORDER BY a.id ASC LIMIT 1');
        $get->bindValue(':plan', $plan, PDO::PARAM_INT);
        $get->execute();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row;
        $db = null;
        return $result;
    }

}
