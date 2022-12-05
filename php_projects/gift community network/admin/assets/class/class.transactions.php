<?php
class Transactions
{

    public static function getInvestmentPlans()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT * FROM investment_plans WHERE status = 1');
        $list = array();

        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return ($list);
    }

    public static function getInvestmentPlanById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM investment_plans WHERE plan_id = :plan');
        $get->bindValue(':plan', $id, PDO::PARAM_INT);
        $get->execute();

        $list = array();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return ($list);
    }

    public static function getPlanNameById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM investment_plans WHERE plan_id = :plan');
        $get->bindValue(':plan', $id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];

        $db = null;
        return $name;
    }
    
    public static function getDueReceiversByPlan($plan, $downliners)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT a.* FROM users a, referral b WHERE b.total_downliners >= :down AND a.plan = :plan AND a.user_id = b.user_id AND a.status = 1 GROUP BY b.user_id ORDER BY b.id ASC');
                $get->bindValue(':plan', $plan, PDO::PARAM_INT);
                        $get->bindValue(':down', $downliners, PDO::PARAM_INT);
   $get->execute();
$name = array();
        while($row = $get->fetch(PDO::FETCH_ASSOC)){
        $name[] = $row;
}
        $db = null;
        return $name;
    }
    

    public static function getPlanDelayByPlanId($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT delay FROM investment_plans WHERE plan_id = :plan');
        $get->bindValue(':plan', $id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['delay'];

        $db = null;
        return $name;

    }

    public static function getPlanIdByTransId($trans_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT plan_id FROM transaction WHERE trans_id = :tid');
        $get->bindValue(':tid', $trans_id, PDO::PARAM_INT);

        $get->execute();

        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row['plan_id'];

        $db = null;
        return $list;

    }

    public static function makeDeposit($user, $amt, $return, $plan, $btc = '', $status)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return, plan_id, btc_amt) VALUES(1, :userid, :amt, NOW(), :status, :return, :plan, :btc)');
        $insert->bindValue(':userid', $user, PDO::PARAM_INT);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->bindValue(':status', $status, PDO::PARAM_INT);
        $insert->bindValue(':return', $return, PDO::PARAM_INT);
        $insert->bindValue(':plan', $plan, PDO::PARAM_INT);
        $insert->bindValue(':btc', $btc, PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();

        return $test;
    }

    public static function makeDepositFromAcctByUid($uid, $plan, $amt, $status, $return, $btc_amt)
    {
        $exp1 = '-' . $amt;
        $sql = "INSERT INTO `transaction` (`trans_id`, `type`, `client_id`, `amount`, `reg_date`, `paymt_date`, `due_date`, `status`, `exp_return`, `plan_id`, `btc_amt`) VALUES (NULL, '2', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$exp1', '', ''), (NULL, '1', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$return', '$plan', '$btc_amt')";

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->query($sql);

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function getUserDepositByStatus($uid, $status, $target)
    {
        $sql = "SELECT * FROM transaction WHERE client_id = '$uid' AND status = '$status' AND type = '1' ORDER BY trans_id DESC";

        $table = 'transaction';
        $limit = 15;
        $count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE client_id = '$uid' AND status = '$status' AND type = '1'";
        $result = array();

        list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);

        return array($paginate, $result);
        /*
    $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
    $get = $db->prepare('SELECT * FROM transaction WHERE client_id = :uid AND status = :status AND type = :type ORDER BY trans_id DESC');
    $get->bindValue(':uid', $uid, PDO::PARAM_INT);
    $get->bindValue(':status', $status, PDO::PARAM_INT);
    $get->bindValue(':type', DEPOSIT, PDO::PARAM_INT);
    $get->execute();

    $list = array();
    while($row = $get->fetch(PDO::FETCH_ASSOC)){
    $list[] = $row;
    }

    $db = NULL;
    return $list;
     */
    }

    public static function getUserTotalWithdrawal($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE client_id = :uid');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $amt = $row['Total'];

        $db = null;
        return $amt;
    }

    public static function getDepositsUntilDateByStatus($date1, $date2, $status, $target)
    {
        $sql = "SELECT * FROM transaction WHERE type = '1' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
        $table = 'transaction';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    public static function getUserLastDueInvestment($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT trans_id, amount, paymt_date, reg_date, due_date, exp_return FROM transaction WHERE client_id = :id AND type = 1 AND status = :status AND due_date >= NOW() ORDER BY due_date ASC LIMIT 1');
        $get->bindValue('id', $uid, PDO::PARAM_INT);
        $get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;

    }

    public static function getTotalUndueDepositByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(`exp_return`) AS "Total" FROM transaction WHERE client_id = :uid AND type = 1 AND status = 2 AND due_date > NOW()');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $amt = $row['Total'];

        $db = null;
        return $amt;
    }

    public static function getLatestDeposits()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT client_id,  amount, category, username FROM transaction WHERE type = 1 AND status = :status ORDER BY paymt_date DESC LIMIT 8');
        $get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }

    public static function confirmWithdrawal($client, $amt, $plan, $acct_no, $bank)
    {

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("INSERT INTO transaction (client_id, plan_id, reg_date, client_acct_no, bank, amount) VALUE(:user, :plan, NOW(), :acct_no, :bank, :amt)");
        $upd->bindValue(':user', $client, PDO::PARAM_INT);
        $upd->bindValue(':plan', $plan, PDO::PARAM_INT);
        $upd->bindValue(':amt', $amt, PDO::PARAM_INT);
        $upd->bindValue(':acct_no', $acct_no, PDO::PARAM_STR);
        $upd->bindValue(':bank', $bank, PDO::PARAM_STR);
        $upd->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function addDueDateByTid($trans_id, $due_date)
    {
        $due_date = date('Y-m-d H:i:s', $due_date);
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE transaction SET due_date = :date WHERE trans_id = :id");
        $upd->bindValue(':id', $trans_id, PDO::PARAM_INT);
        $upd->bindValue(':date', $due_date, PDO::PARAM_STR);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;
        return $test;

    }

    /**
     * WITHDRAW
     *
     * @param undefined $uid
     * @param undefined $amt
     *
     * @return
     */

    public static function makeWithdr($uid, $amt)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $exp_return = '-' . $amt; // added to suffix for automatic bal genration
        $insert = $db->prepare('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return) VALUES(2, :userid, :amt, NOW(), :status, :exp)');
        $insert->bindValue(':userid', $uid, PDO::PARAM_INT);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->bindValue(':status', PENDING, PDO::PARAM_INT);
        $insert->bindValue(':exp', $exp_return, PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;

    }

    public static function getWithdByUserIdPerStatus($uid, $status, $target)
    {
        $sql = "SELECT amount, reg_date, paymt_date FROM transaction WHERE type = '2' AND status = '$status' AND client_id = '$uid' ORDER BY reg_date DESC";

        $count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '2' AND status = '$status' AND client_id = '$uid'";
        $table = 'transaction';
        $limit = 15;
        $result = array();
        list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);

        return array($paginate, $result);
    }

    public static function getWithdrawalUsingDataTable($date1, $date2)
    {

        $table = 'transaction';
        $primaryKey = 'trans_id';
        $columns = array(
            array('db' => 'trans_id', 'dt' => '0'),
            array('db' => 'reg_date', 'dt' => 1, 'formatter' => function ($d, $row) {
                return date('d - M - y', strtotime($d));
            },
            ),
            array('db' => 'client_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return ucwords(Users::getUserFullNameById($d));
                },
            ),
            array('db' => 'amount', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($d, 4);
                },
            ),
            array('db' => 'bank', 'dt' => 4),
            array('db' => 'client_acct_no', 'dt' => 5),
            array(
                'db' => 'plan_id',
                'dt' => 6,
                'formatter' => function ($d, $row) {
                    return self::getInvestmentPlanById($d)['name'];
                },
            ),

        );

        $where = "reg_date BETWEEN '$date1' AND '$date2'";

        // SQL server connection information
        $sql_details = array(
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'db' => DB_NAME,
            'host' => 'localhost',
        );

        $test = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, '', $where);
        return json_encode($test);

    }

    public static function getWithdrawsUntilDateByStatus($date1, $date2, $status, $target)
    {
        $sql = "SELECT * FROM transaction WHERE type = '2' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
        $table = 'transaction';
        $limit = 15;
        $result = array();
        list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);

        return array($paginate, $result);
    }

    //SELECT b.trans_id, b.amount FROM referral a, transaction b WHERE a.deposit_id = b.trans_id AND a.referer_id = b.client_id GROUP BY b.trans_id

    public static function getTotalWithdByStatus($uid, $status)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE client_id = :uid AND type = 2 AND status = :status');
        $get->bindValue('uid', $uid, PDO::PARAM_INT);
        $get->bindValue(':status', $status, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $amt = $row['Total'];

        $db = null;
        return $amt;
    }

    public static function getLatestWithdraw()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT client_id, amount, category, username FROM transaction WHERE type = 2 AND status = :status ORDER BY reg_date DESC LIMIT 8');
        $get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }

    /**
     * REFERER TABLE
     */

    ///////////////////////////////////////////////////////////////////

    public static function addNewReferer($user_id, $referer_id, $hierarchy, $tree_level, $ref_tree)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare("INSERT INTO `referral` (`referer_id`, `user_id`, `reg_date`, `tree_level`, `hierarchy`, `ref_tree`) VALUES(:ref, :user, NOW(), :tree, :hierarchy, :ref_tree)");
        $insert->bindValue(':ref', $referer_id, PDO::PARAM_STR);
        $insert->bindValue(':user', $user_id, PDO::PARAM_INT);
        $insert->bindValue(':tree', $tree_level, PDO::PARAM_INT);
        $insert->bindValue(':hierarchy', $hierarchy, PDO::PARAM_INT);
        $insert->bindValue(':ref_tree', $ref_tree, PDO::PARAM_STR);
        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;

    }

    public static function countUserReferees($user)
    {
// those the user had referered
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $count = $db->prepare('SELECT COUNT(`user_id`) AS "count" FROM users WHERE referer = :ref GROUP BY referer');
        $count->bindValue(':ref', $user, PDO::PARAM_INT);
        $count->execute();

        $row = $count->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];

        $db = null;
        return $count;
    }


    public static function updateMyUpliner($ref_tree){
       // here we use the ref_tree to get the current users upliners and then increment their downliner by 1
       $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
       $count = $db->exec("UPDATE referral SET total_downliners = total_downliners + 1 WHERE user_id IN ($ref_tree)");
      // $test = $count->rowCount();

       $db = null;
       return $count;

       
       /**
        * OLD ITERATION METHOD
        */
        /* ignore_user_abort(true); 
       //set_time_limit(0);

        $count = 0;
        do{
            
        $count += self::updDownliners($new_users_refer);
        $ref = self::getRefByUser($new_users_refer)['referer_id'];

        //var_dump($ref); var_dump($new_users_refer); die();
        
        $new_users_refer = $ref;
    }while($ref != 0);

    return($new_users_refer);

    */
}


public static function miscUpdateReferrals($ref_tree, $uid){
    $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
    $count = $db->exec("UPDATE referral SET ref_tree = '$ref_tree' WHERE user_id = '$uid' LIMIT 1");
    
    
       $db = NULL;
        return $count;
}

    public static function assignUserReferer($user)
    {
        $parent = self::countUserReferees($user);
        if ($parent >= 2) {

            for ($i = 0; $i < 3; $i++) {

                $children = self::getRefByRef($user);
                foreach ($children as $value) {
                    if ($value == 1) {
                        return 1;
                    }
                    $count_child = self::countUserReferees($value);
                    if ($count_child < 2) {

                        return $value;
                    } else {
                        $new_child[] = $value;
                    }
                }

                foreach ($new_child as $value) {
                    $count_child = self::countUserReferees($value);
                    if ($count_child < 2) {

                        return $value;
                    }

                    $container[] = $value;
                }
                $children = $container;
            }

            return 1;
        } else {
            return $user;
        }
    }


    public static function getRefByUser($user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM referral WHERE user_id = :ref ORDER BY id DESC LIMIT 1');
        $get->bindValue(':ref', $user, PDO::PARAM_INT);
        $get->execute();
        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list = $row;
        }

        $db = null;
        return $list;

    }


    //ALTER TABLE `users` ADD `user_id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`user_id`);

    public static function getRefByRef($ref)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM referral WHERE referer_id = :ref');
        $get->bindValue(':ref', $ref, PDO::PARAM_INT);
        $get->execute();
        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['user_id'];
        }

        $db = null;
        return $list;
    }

    /*
    SELECT MIN(mycount), referer_id
    FROM (SELECT referer_id, COUNT(referer_id) mycount
    FROM  referral
    GROUP BY referer_id) as mu GROUP BY referer_id ORDER BY mycount ASC LIMIT 1
     */

    //SELECT COUNT(`referer_id`) as 'num', new_cust_id, referer_id FROM referral GROUP BY referer_id ORDER BY table_id ASC

    public static function assignReferer($refered)
    {
        $test = array();
        $parent = array();
        $count_myref = self::countUserReferees($refered);
        if ($count_myref < 2) {
            return $refered;
        } elseif ($count_myref >= 2) {
            $children = array();
            $children = self::getNewCustByRefId($refered);
            foreach ($children as $child) {
                $count_ref = self::countUserReferees($child);
                
                if ($count_ref < 2) {
                    return $child;
                } else {
                    $test[] = $child;
                }
            }
        }

        if (count($test) > 0) {
            foreach ($test as $value) {
                $test_children = self::getNewCustByRefId($value);
                foreach ($test_children as $key) {
                    $count_ref = self::countUserReferees($key);
                    if ($count_ref < 2) {
                        return $key;
                    } else {
                        $parent[] = $key;
                    }
                }
            }
        }

        if (count($parent) > 0) {
            //$user_plan = self::getUserPlanByUid($refered);
            $referer = Transactions::getFreeRef();
            return $referer;
        }

    }

    public static function getNewCustByRefId($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE referer = :uid AND status = 1 ORDER BY user_id ASC');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {

            $list[] = $row['user_id'];

        }

        $db = null;

        return $list;

    }

    public static function getFreeRef()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);

        $get = $db->query("
        SELECT MIN(mycount), user_id FROM (SELECT user_id, referer, status, COUNT(referer) mycount
        FROM  users
        GROUP BY referer) as mu WHERE status = 1 AND mycount < 2 GROUP BY referer ORDER BY mycount DESC LIMIT 1
        ");

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];
        $db = null;

        return $result;

    }

    public static function countDownliner($user)
    {
        $total = 0;
        $new = array();
        $children = self::getNewCustByRefId($user);
       // var_dump($children);
        if (is_array($children) && count($children) > 0) {
            $total += count($children);
            //print_r($children); die();
            do {
                foreach ($children as $child) {
                    $t = self::getNewCustByRefId($child);
                    
                    $total += is_array($t) ? count($t) : 0 ;
                    $new = array_merge($new, $t);
                    
                    var_dump($child);
                    echo '<br>';
                    var_dump($t);
                    echo '<br>';
                    var_dump($new); 
                    echo '<br>';
                    var_dump($total);
                    echo '<br>';echo '<br>';
                }
                $children = $new;

                
                unset($new);
                $new = array();
                
            } while (count($children) > 0);
//var_dump($total);die();
            return $total;
        }
        return 0;

    }
/*
    public static function createRefTree($ref_user_id){

    // select my ref row from his user id
    // update mine by adding the ref user id to his ref_tree
    // then update total downliner using IN sttsement
    
    UPDATE referral SET ref_tree = (
        SELECT tree FROM (
            SELECT CONCAT(ref_tree, ',', user_id) as 'tree'
            FROM referral 
            WHERE user_id = '$ref_user_id' 
            LIMIT 1
        ) AS innerTable
        ) 
    }

*/

    public static function updDownliners($referer)
    {
        // this method is deprecated as its resource consuming. I select updateMyUpliner method
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE referral SET total_downliners = total_downliners + 1 WHERE user_id = :ref ORDER BY referer_id');
        $upd->bindValue(':ref', $referer, PDO::PARAM_INT);
        $upd->execute();

        $res = $upd->rowCount();

        $db = null;
        return $res;
    }

    public static function getNumberofPayouts()
    {
        $total = 0;
        $plan = self::getInvestmentPlans();
        foreach($plan as $value){
            $total += self::getNumberofPayoutsByPlan($value['plan_id'], $value['no_of_downliner']);
            
        }
        
        return $total;
    }
        
        public static function getNumberofPayoutsByPlan($plan_id, $total){

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare("SELECT COUNT('a.id') as 'count' FROM referral a, users b WHERE a.total_downliners >= :down AND b.plan = :plan AND b.status = 1 AND a.user_id = b.user_id");
        $get->bindValue(':down', $total, PDO::PARAM_INT);
        $get->bindValue(':plan', $plan_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        //SELECT count, user_id FROM (SELECT COUNT('a.id') as 'count', a.user_id, FROM referral a, users b WHERE b.status = 1 AND a.user_id = b.user_id) as first WHERE count IN(6, 10, 18, 34, 66)

        //SELECT COUNT('a.id') as 'count', b.user_id FROM referral a, users b WHERE a.total_downliners IN(6, 10, 18, 34, 66) AND b.status = 1 AND a.user_id = b.user_id GROUP BY user_id

        $result = $row['count'];
        $db = null;

        return $result;
    }

    public static function getActiveRefByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT Count(*) as "Ref" FROM referral WHERE referer_id = :uid AND status = 1');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['Ref'];

        $db = null;
        return $result;
    }

    public static function getPassiveRefByUid($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT Count(*) as "Ref" FROM referral WHERE referer_id = :uid AND status = 0');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['Ref'];

        $db = null;
        return $result;
    }

    public static function addReferer($referer, $new_user)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO referral (referer_id, new_cust_id, reg_date, status) VALUES(:ref, :uid, NOW(), 0)');
        $insert->bindValue(':ref', $referer, PDO::PARAM_INT);
        $insert->bindValue(':uid', $new_user, PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;

        return $test;
    }

    public static function updRefById($uid, $ref, $deposit_id)
    {
        //used immediately after pledging to deposit

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE referral SET deposit_id = :dept WHERE referer_id = :ref AND new_cust_id = :uid LIMIT 1");
        $upd->bindValue(':dept', $deposit_id, PDO::PARAM_INT);
        $upd->bindValue(':ref', $ref, PDO::PARAM_INT);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();
        $db = null;

        return $test;
    }

    public static function updRefByStatus($deposit_id)
    {
        // Used after confirmation of deposit

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare("UPDATE referral SET status = 1 WHERE deposit_id = :dept");
        $upd->bindValue(':dept', $deposit_id, PDO::PARAM_INT);
        $upd->execute();

        $tset = $upd->rowCouunt();
        $db = null;

        return $tset;
    }

    public static function chkRefByUserId($uid)
    {
        // This capture the deposit id used for the transaction if active ref

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT deposit_id FROM referral WHERE referer_id = :uid AND status = 1 ORDER BY table_id');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row['deposit_id'];

        }

        $db = null;
        return $list;

    }

    public static function chkRefByTransId($trans_id)
    {
        // This capture the deposit id used for the transaction if active ref

        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT new_cust_id FROM referral WHERE status = 0 AND deposit_id = :dept');
        $get->bindValue(':dept', $trans_id, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row['new_cust_id'];

        $db = null;
        return $list;

    }

    public static function getTransTotalByUserId($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT SUM(exp_return) as "Total" FROM transaction WHERE client_id = :uid AND status = :status');
        $get->bindValue(':uid', $uid, PDO::PARAM_INT);
        $get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['Total'];

        $db = null;
        return $result;
    }

    public static function addAdminTrans($urname, $amt, $trans_type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO transaction(username, type, amount, paymt_date, category, status, reg_date) VALUES(:urn, :type, :amt, NOW(), 1, :status, NOW())');
        $insert->bindValue(':urn', ucwords($urname), PDO::PARAM_STR);
        $insert->bindValue(':amt', $amt, PDO::PARAM_INT);
        $insert->bindValue(':type', $trans_type, PDO::PARAM_INT);
        $insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);
        $insert->execute();

        $test = $db->lastInsertId();

        $db = null;
        return $test;

    }

    public static function getAdminTransByType($type)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM admin_trans WHERE type = :type ORDER BY paymt_date DESC LIMIT 12');
        $get->bindValue(':type', $type, PDO::PARAM_INT);
        $get->execute();

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }


    public static function createReferralTree(){
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->query('SELECT * FROM users WHERE status = 1 GROUP BY user_id');
        $result = '';
$ids = ''; $i = 1;
        while($row = $get->fetch(PDO::FETCH_ASSOC)){
            
            if($i == 1){
           $result .= 'c_'.$row['user_id'].' = {
                text: {
                    name: "'.$row['name'].'",
                    
                    contact: "Tel: '.$row['phone'].'",
                },
                
                HTMLid: "c_'.$i.'",
        
            },
            ';
            
            $ids .= 'c_'.$row['user_id'].',';

            }/*elseif((count($row)) == $i){
            $result .= 'c_'.$row['user_id'].' = {
                parent: c_'.$row['referer'].',
                text: {
                    name: "'.$row['name'].'",
                    
                    contact: "Tel: '.$row['phone'].'",
                },
                
                HTMLid: "c_'.$i.'",
        
            }
            ';
            $ids .= 'c_'.$row['user_id'].',';
        }*/else{
            $result .= 'c_'.$row['user_id'].' = {
                parent: c_'.$row['referer'].',
                text: {
                    name: "'.$row['name'].'",
                    
                    contact: "Tel: '.$row['phone'].'",
                },
                
                //HTMLid: "c_'.$row['user_id'].'",
                HTMLid: "c_'.$i.'",
                collapsed: true,
        
            },
            ';

            $ids .= 'c_'.$row['user_id'].',';
        }
        $i++;
        }

        $db = null;
        return array($result, $ids);
        
    }

}
