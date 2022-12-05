<?php
class Transaction extends Transactions{
	
	public static function getInvestmentPlans(){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->query('SELECT * FROM investment_plans');
		$list = array();
		
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = NULL;
		return($list);
	}
	
	public static function getInvestmentPlanById($id){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT * FROM investment_plans WHERE plan_id = :plan');
		$get->bindValue(':plan', $id, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
			$list = $row;
		
		$db = NULL;
		return($list);
	}
	
	public static function getPlanNameById($id){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT name FROM investment_plans WHERE plan_id = :plan');
		$get->bindValue(':plan', $id, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['name'];
		
		$db = NULL;
		return $name;
	}
	
	public static function getPlanDelayByPlanId($id){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT delay FROM investment_plans WHERE plan_id = :plan');
		$get->bindValue(':plan', $id, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['delay'];
		
		$db = NULL;
		return $name;
		
	}
	
	
	public static function getPlanIdByTransId($trans_id){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT plan_id FROM transaction WHERE trans_id = :tid');
		$get->bindValue(':tid', $trans_id, PDO::PARAM_INT);
		
		$get->execute();
		
		$list = array();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$list = $row['plan_id'];
		
		$db = NULL;
		return $list;
		
	}
	
	
	public static function makeDeposit($user, $amt, $return, $plan, $btc='', $status){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return, plan_id, btc_amt, category) VALUES(1, :userid, :amt, NOW(), :status, :return, :plan, :btc, 2)');
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
	
	
	public static function makeDepositFromAcctByUid($uid, $plan, $amt, $status, $return, $btc_amt){
		$exp1 = '-'.$amt;
		$sql = "INSERT INTO `transaction` (`trans_id`, `type`, `client_id`, `amount`, `reg_date`, `paymt_date`, `due_date`, `status`, `exp_return`, `plan_id`, `btc_amt`, category) VALUES (NULL, '2', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$exp1', '', '', '2'), (NULL, '1', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$return', '$plan', '$btc_amt', '2')";
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->query($sql); 
		
		$test = $db->lastInsertId();
		
		$db = NULL;
		return $test;
	
	}
	
	public static function getUserDepositByStatus($status, $uid, $date1, $date2, $target){
		$sql = "SELECT * FROM transaction WHERE client_id = '$uid' AND status = '$status' AND type = '1' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
		
		$table = 'transaction';
		$limit = 15;
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE client_id = '$uid' AND status = '$status' AND type = '1' AND reg_date BETWEEN '$date1' AND '$date2'";
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
	
	public static function getUserTotalDepositByStatus($uid, $status){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE client_id = :uid AND type = 1 AND status = :status');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->bindValue(':status', $status, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$amt = $row['Total'];
		
		$db = NULL;
		return $amt;
	}
	
	
	public static function getTotalExpReturnByUserId($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(exp_return) as "Total" FROM transaction WHERE client_id = :uid AND status = :status AND type = 1');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Total'];
		
		$db = NULL;
		return $result;
	}
	
	public static function getDepositsUntilDateByStatus($date1, $date2, $status, $target){
		$sql = "SELECT * FROM transaction WHERE type = '1' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
		$table = 'transaction';
		$limit = 15;
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '1' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2'";
		$result = array();
		list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql, $count);
		
		return array($paginate, $result);
	}
	
	public static function getUserLastDueInvestment($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT trans_id, amount, paymt_date, reg_date, due_date, exp_return FROM transaction WHERE client_id = :id AND type = 1 AND status = :status AND due_date >= NOW() ORDER BY due_date ASC LIMIT 1');
		$get->bindValue('id', $uid, PDO::PARAM_INT);
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$list = $row;
		
		$db = NULL;
		return $list;
		
	}
	
	public static function getTotalUndueDepositByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(`exp_return`) AS "Total" FROM transaction WHERE client_id = :uid AND type = 1 AND status = 2 AND due_date > NOW()');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$amt = $row['Total'];
		
		$db = NULL;
		return $amt;
	}
	
	
	public static function getLatestDeposits(){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT client_id,  amount, category, username FROM transaction WHERE type = 1 AND status = :status ORDER BY paymt_date DESC LIMIT 10');
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = null;
		return $list;
	}
	
	
	
	public static function confirmDeposit($list){
	
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE transaction SET status = 2, paymt_date = NOW() WHERE trans_id = :id");
		
		//foreach($list as $value){
		$upd->bindValue(':id', $list, PDO::PARAM_INT);
		$upd->execute();
		//}
		
		$test = $upd->rowCount();
		
		//var_dump($test);
		//UPDATE `transaction` SET paymt_date = NOW(), `status` = '2', `due_date` = '2019-02-01 21:51:05' WHERE `trans_id` = '4'
		// , due_date = '$due_date' 
		$db = NULL;
		return $test;
		
	}
	
	
	public static function addDueDateByTid($trans_id, $due_date){
		$due_date = date('Y-m-d H:i:s', $due_date);
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE transaction SET due_date = :date WHERE trans_id = :id");
		$upd->bindValue(':id', $trans_id,PDO::PARAM_INT);
		$upd->bindValue(':date', $due_date,PDO::PARAM_STR);
		$upd->execute();
		
		$test = $upd->rowCount();
		$db = NULL;
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
	
	public static function makeWithdr($uid, $amt){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$exp_return = '-'.$amt;  // added to suffix for automatic bal genration 
		$insert = $db->prepare('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return) VALUES(2, :userid, :amt, NOW(), :status, :exp)');
		$insert->bindValue(':userid', $uid, PDO::PARAM_INT);
		$insert->bindValue(':amt', $amt, PDO::PARAM_INT);
		$insert->bindValue(':status', PENDING, PDO::PARAM_INT);
		$insert->bindValue(':exp', $exp_return, PDO::PARAM_INT);
		$insert->execute();
		
		$test = $db->lastInsertId();
		$db = NULL;
		return $test;
		
	}
	
	
	
	public static function getWithdByUserIdPerStatus($status, $uid, $date1, $date2, $target){
		$sql = "SELECT * FROM transaction WHERE type = '2' AND status = '$status' AND client_id = '$uid' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY reg_date DESC";
		
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '2' AND status = '$status' AND client_id = '$uid' AND reg_date BETWEEN '$date1' AND '$date2'";
		$table = 'transaction';
		$limit = 15;
		$result = array();
		list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
		
		return array($paginate, $result);	
	}
	
	public static function getWithdrawalUntilDateByStatus($date1, $date2, $status, $target){
		$sql = "SELECT amt, reg_date, client_id FROM transaction WHERE type = '2' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
		$table = 'transaction';
		$limit = 25;
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '2' AND status = '$status'";
		$result = array();
		list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql, $count);
		
		return array($paginate, $result);
	}
		
	
	public static function getWithdrawsUntilDateByStatus($date1, $date2, $status, $target){
		$sql = "SELECT * FROM transaction WHERE type = '2' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
		$table = 'transaction';
		$limit = 15;
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '2' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2'";
		$result = array();
		list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql, $count);
		
		return array($paginate, $result);
	}
	
	
	
	
	//SELECT b.trans_id, b.amount FROM referral a, transaction b WHERE a.deposit_id = b.trans_id AND a.referer_id = b.client_id GROUP BY b.trans_id
	
	public static function getTotalWithdByStatus($uid, $status){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE client_id = :uid AND type = 2 AND status = :status');
		$get->bindValue('uid', $uid, PDO::PARAM_INT);
		$get->bindValue(':status', $status, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$amt = $row['Total'];
		
		$db = NULL;
		return $amt;
	}
	
	
	public static function getLatestWithdraw(){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT client_id, amount, category, username FROM transaction WHERE type = 2 AND status = :status ORDER BY reg_date DESC LIMIT 10');
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = null;
		return $list;
	}
	
	
	
	///////////////////////////////////////////////////////////////////
	public static function getRefererTotalCommissn($uid, $percent){
		
		/*getRefByUid ===  CheckRef());
		getDepositAmtById()=> amt deposited; thn 3% of the deposit
		*/
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(b.amount) as "Total" FROM referral a, transaction b WHERE a.deposit_id = b.trans_id AND a.referer_id = b.client_id AND a.status = 1 AND client_id = :uid GROUP BY b.trans_id');
		$get->bindValue('uid', $uid, PDO::PARAM_INT);
		$get->execute();
		
		$result = 0;
		
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$amt = $row['Total'];
			$commissn = $amt * ($percent / 100);
			$result += $commissn;
		}
		
		$db = NULL;
		return $result;
		
	}
		
		
	public static function getActiveRefByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT Count(*) as "Ref" FROM referral WHERE referer_id = :uid AND status = 1');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Ref'];
		
		$db = NULL;
		return $result;
	}
	
	public static function getPassiveRefByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT Count(*) as "Ref" FROM referral WHERE referer_id = :uid AND status = 0');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Ref'];
		
		$db = NULL;
		return $result;
	}
	
	public static function addReferer($referer, $new_user){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO referral (referer_id, new_cust_id, reg_date, status) VALUES(:ref, :uid, NOW(), 0)');
		$insert->bindValue(':ref', $referer, PDO::PARAM_INT);
		$insert->bindValue(':uid', $new_user, PDO::PARAM_INT);
		$insert->execute();
		
		$test = $db->lastInsertId();
		$db = NULL;
		
		return $test;
	}
	
	public static function updRefById($uid, $ref, $deposit_id){
		//used immediately after pledging to deposit
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE referral SET deposit_id = :dept WHERE referer_id = :ref AND new_cust_id = :uid LIMIT 1");
		$upd->bindValue(':dept', $deposit_id, PDO::PARAM_INT);
		$upd->bindValue(':ref', $ref, PDO::PARAM_INT);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		$upd->execute();
		
		$test = $upd->rowCount();
		$db = NULL;
		
		return $test;
	}
	
	
	public static function updRefByStatus($deposit_id){
		// Used after confirmation of deposit
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE referral SET status = 1 WHERE deposit_id = :dept");
		$upd->bindValue(':dept', $deposit_id, PDO::PARAM_INT);
		$upd->execute();
		
		$test = $upd->rowCount();
		$db = NULL;
		
		return $tset;
	}
	
public static function chkRefByUserId($uid){
		// This capture the deposit id used for the transaction if active ref
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT deposit_id FROM referral WHERE referer_id = :uid AND status = 1 ORDER BY table_id DESC');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row['deposit_id'];
			
		}
		
		$db = NULL;
		return $list;
		
	}
	
	// all deposit id of refferral which has this uid as referer;// getDeposit By Id

public static function chkRefByTransId($trans_id){
		// This capture the deposit id used for the transaction if active ref
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT new_cust_id FROM referral WHERE status = 0 AND deposit_id = :dept');
		$get->bindValue(':dept', $trans_id, PDO::PARAM_INT);
		$get->execute();
		
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$list = $row['new_cust_id'];
		
		$db = NULL;
		return $list;
		
	}
	
		public static function getAllMyRefereeByUid($uid){
			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT * FROM referral WHERE referer_id = :uid');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = NULL;
		return $list;
		
		}
	public static function getTransTotalByUserId($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT SUM(exp_return) as "Total" FROM transaction WHERE client_id = :uid AND status = :status');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Total'];
		
		$db = NULL;
		return $result;
	}
	
public static function addAdminTrans($urname, $amt, $trans_type){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO transaction(username, type, amount, paymt_date, category, status, reg_date) VALUES(:urn, :type, :amt, NOW(), 1, :status, NOW())');
		$insert->bindValue(':urn', ucwords($urname), PDO::PARAM_STR);
		$insert->bindValue(':amt', $amt, PDO::PARAM_INT);
		$insert->bindValue(':type', $trans_type, PDO::PARAM_INT);
		$insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$insert->execute();
		
		$test = $db->lastInsertId();
		
		$db = NULL;
		return $test;
		
}
	

public static function getLastDepositByUid($user){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT amount FROM transaction WHERE client_id = :user AND status = :status AND type = 1 ORDER BY trans_id DESC LIMIT 1');
		$get->bindValue(':user', $user, PDO::PARAM_INT);
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
			$list = $row['amount'];

		$db = null;
		return $list;
	}
	
	
	public static function getLastWithdByUid($user){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT amount FROM transaction WHERE client_id = :user AND status = :status AND type = 2 ORDER BY trans_id DESC LIMIT 1');
		$get->bindValue(':user', $user, PDO::PARAM_INT);
		$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$get->execute();
		
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
			$list = $row['amount'];

		$db = null;
		return $list;
	}
	
public static function getUserTransactionByTypeUntilDate($uid, $date1, $date2, $target){
	
	$sql = "SELECT * FROM transaction WHERE client_id = '$uid' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
		
		$table = 'transaction';
		$limit = 15;
		$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE client_id = '$uid' AND reg_date BETWEEN '$date1' AND '$date2'";
		$result = array();
		
		list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
		
		return array($paginate, $result);
		
		/*
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT * FROM transaction WHERE client_id = :uid AND category = 2 AND reg_date BETWEEN :date1 AND :date2 ORDER BY reg_date DESC');
		$get->bindValue(':uid', $user, PDO::PARAM_INT);
		$get->bindValue(':type', $type, PDO::PARAM_INT);
		$get->bindValue(':status', $status, PDO::PARAM_INT);
		$get->bindValue(':date1', date('Y-m-d', strtotime($date1)), PDO::PARAM_INT);
		$get->bindValue(':date2', date('Y-m-d', strtotime($date2)), PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = NULL;
		return $list;
		
		*/
}

public static function getTransactionByTrans_id($user){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT * FROM transaction WHERE trans_id = :user');
		$get->bindValue(':user', $user, PDO::PARAM_INT);
		
		$get->execute();
		
		$list = array();
		
		$row = $get->fetch(PDO::FETCH_ASSOC);
			$list = $row;

		$db = null;
		return $list;
	}
		

}

?>