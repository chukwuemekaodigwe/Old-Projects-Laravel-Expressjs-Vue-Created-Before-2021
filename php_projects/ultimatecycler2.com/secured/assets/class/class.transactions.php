<?php

class transactions{

//////////////////////// REFERRAL PROGRAM ///////////////////////////////////////
public static function addReferer($referer, $new_user, $plan){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO referral (referer_id, new_cust_id, reg_date, status, ref_level) VALUES(:ref, :uid, NOW(), :status, :plan)');
		$insert->bindValue(':ref', $referer, PDO::PARAM_INT);
		$insert->bindValue(':uid', $new_user, PDO::PARAM_INT);
		$insert->bindValue(':plan', $plan, PDO::PARAM_INT);
		$insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$insert->execute();
		
		$test = $db->lastInsertId();
		$db = NULL;
		
		return $test;
	}
	
	public static function updRefByStatus($deposit_id){
		// Used after confirmation of deposit
		
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE referral SET status = :status WHERE deposit_id = :dept");
		$upd->bindValue(':dept', $deposit_id, PDO::PARAM_INT);
		$insert->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$upd->execute();
		
		$test = $upd->rowCount();
		$db = NULL;
		
		return $tset;
	}

	public static function getAllMyRefereeByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT * FROM users WHERE referer = :uid AND status < 3 AND spillover IS NULL');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		
		$list = array();
		while($row = $get->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		$db = NULL;
		return $list;
		
		}
	
	public static function getActiveRefByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT Count(*) as "Ref" FROM users WHERE referer = :uid AND status = 1 AND spillover IS NULL');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Ref'];
		
		$db = NULL;
		return $result;
	}
	
	public static function getPassiveRefByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT Count(*) as "Ref" FROM users WHERE referer = :uid AND status = 2 AND spillover IS NULL');
		$get->bindValue(':uid', $uid, PDO::PARAM_INT);
		$get->execute();
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['Ref'];
		
		$db = NULL;
		return $result;
	}


	public static function countRefByUid($uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT COUNT(`user_id`) as "num" FROM users WHERE referer = :ref AND status < 3 AND spillover = NULL');

	$get->bindValue(':ref', $uid, PDO::PARAM_INT);
	
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);

	$result = $row['num'];
	$db = null;

	return $result;

	}


public static function testRef($ref){
	$countRefd = self::countRefByUid($ref);
	
	if($countRefd >= 2){
		
		$child = self::getNewCustByRefId($ref);
		
		if(is_array($child)){
			foreach($child as $value){
				$countRefd = self::countRefByUid($value);
				if($countRefd >= 2){
					return 0;
				}else{
					return $value;
				}
			}
		}else{
			return $child;
		}
	}else{
		return $ref;
	}

}


public static function getFreeRef($plan_type){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);

	$get = $db->query("
	SELECT MIN(mycount), user_id FROM (SELECT user_id, referer, matrix_level, status, user_type, COUNT(referer) mycount
	FROM  users
	GROUP BY referer) as mu WHERE user_type = 1 AND matrix_level = '$plan_type' AND status = 1 GROUP BY referer ORDER BY mycount ASC LIMIT 1
	");

	$row = $get->fetch(PDO::FETCH_ASSOC);
$result = $row['user_id'];
$db = null;

return $result;


}


/*
SELECT MIN(mycount), referer_id
FROM (SELECT referer_id, COUNT(referer_id) mycount
FROM  referral
GROUP BY referer_id) as mu GROUP BY referer_id ORDER BY mycount ASC LIMIT 1
*/

//SELECT COUNT(`referer_id`) as 'num', new_cust_id, referer_id FROM referral GROUP BY referer_id ORDER BY table_id ASC

public static function assignReferer($refered){
$test = array(); $parent = array();
	$count_myref = self::countRefByUid($refered);
	if($count_myref < 2){
		return $refered;
	}elseif($count_myref >= 2){
		$children = array();
		$children = self::getNewCustByRefId($refered);
		foreach($children as $child){
			$count_ref = self::countRefByUid($child);
			if($count_ref < 2){
				return $child;
			}else{
				$test[] = $child;
			}
		}
	}

	if(count($test) > 0){
		foreach($test as $value){
			$test_children = self::getNewCustByRefId($value);
				foreach($test_children as $key){
					$count_ref = self::countRefByUid($key);
					if($count_ref < 2){
						return $key;
					}else{
						$parent[] = $key;
					}
				}
		}
	}


	if(count($parent) > 0){
		$user_plan = self::getUserPlanByUid($refered);
		$referer = Transactions::getFreeRef($user_plan);
    	return $referer;
	}

}


public static function getNewCustByRefId($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT user_id FROM users WHERE referer = :uid ORDER BY user_id ASC');
	$get->bindValue(':uid', $uid, PDO::PARAM_INT);
	$get->execute();

	$list = array();
	$row = $get->fetch(PDO::FETCH_ASSOC);

	$list = $row;
	$db = null;

	return $list;


	
}

//get help
//receive help
/*
public static function getTeamByUid($uid){
	$children = self::getNewCustByRefId($uid);
	while((count($first) != null) || (count($second) != null)){
for ($i=0; $i < 3; $i++1) { 
	foreach ($children as $value) {
		$result[] = $value;
	}
}
	$first = self::getNewCustByRefId($children[$i]);
	$second = self::getNewCustByRefId($children[$i]);
array_merge($first,$second);
}

}

	$result = array();
	
	do{
foreach($children as $child){
$result[] = 


}
$children = self::getNewCustByRefId($child);
$ttlChild = array_count_values($children);
	}while($ttlChild != null);
}


*/


/////////////////////////// TRANSACTIONS  ////////////////////////////////////////////////////

public static function makePledge($uid, $parent, $ref, $plan){
	// where to add transactions

$season = self::getUserLastDepositId($parent);

//var_dump($parent);
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$insert = $db->prepare('INSERT INTO pledger(user_id, ref_parent_id, referer, plan_id, reg_date, status, matched, season) VALUES (:uid, :pid, :ref, :plan, NOW(), :status, :match, :season)');
	$insert->bindValue(':uid', $uid, PDO::PARAM_INT);
	$insert->bindValue(':pid', $parent, PDO::PARAM_INT);
	$insert->bindValue(':ref', $ref, PDO::PARAM_INT);
	$insert->bindValue(':plan', $plan, PDO::PARAM_INT);
	$insert->bindValue(':match', CONFIRM, PDO::PARAM_INT);
	$insert->bindValue(':status', PENDING, PDO::PARAM_INT);
	$insert->bindValue(':season', $season, PDO::PARAM_INT);

	$insert->execute();

	$test = $db->lastInsertId();
//////////////////// Check for matching /////////////////////

/*
$count = self::countPledgesByType($plan, $parent);
if($count == 4){
	$users = self::getPledgersByParent($plan, $parent);
	$test = self::addTransDetail($parent, $plan, $users);
}

*/

	$db = null;
	return $test;
}

public static function getUserLastDepositId($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT id FROM pledger WHERE user_id = :parent ORDER BY id DESC LIMIT 1');
	$get->bindValue(':parent', $uid, PDO::PARAM_INT);
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);

	$result = $row['id'];
	$db = null;

	return $result;
	
}

public static function getUserLastConfirmDepositId($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT id FROM pledger WHERE user_id = :parent AND status = :status ORDER BY id DESC LIMIT 1');
	$get->bindValue(':parent', $uid, PDO::PARAM_INT);
	$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);

	$result = $row['id'];
	$db = null;

	return $result;
	
}


public static function getUserLastDepositStatus($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM pledger WHERE user_id = :parent ORDER BY id DESC LIMIT 1');
	$get->bindValue(':parent', $uid, PDO::PARAM_INT);
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);

	$result = $row;
	$db = null;

	return $result;
	
}


public static function countPledgesByType($type, $parent, $status = ''){
$season = self::getUserLastDepositId($parent);
$status = (!empty($status)) ? $status : PENDING;

	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT COUNT(*) as "num" FROM pledger WHERE ref_parent_id = :parent AND plan_id = :type AND status = :status AND season = :season GROUP BY season,  user_id');
	$get->bindValue(':parent', $parent, PDO::PARAM_INT);
	$get->bindValue(':type', $type, PDO::PARAM_INT);
	$get->bindValue(':status', 	$status, PDO::PARAM_INT);
	$get->bindValue(':season', $season, PDO::PARAM_INT);
	$get->execute();

$result = array();
	while($row = $get->fetch(PDO::FETCH_ASSOC)){
	$result[] = $row['num'];
	}

	return count($result);
}

public static function countConfirmPledgesByUid($type, $parent){
	$season = self::getUserLastConfirmDepositId($parent);
	
	//SELECT COUNT(*) as "num" FROM pledger WHERE ref_parent_id = 2 AND plan_id = 1 AND status = 1 AND season = 2

//var_dump($season);
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT COUNT(*) as "num" FROM pledger WHERE ref_parent_id = :parent AND plan_id = :type AND status = :status AND season = :season');
		$get->bindValue(':parent', $parent, PDO::PARAM_INT);
	$get->bindValue(':type', $type, PDO::PARAM_INT);
	$get->bindValue(':status', 	CONFIRM, PDO::PARAM_INT);
	$get->bindValue(':season', $season, PDO::PARAM_INT);
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);
	$result = $row['num'];

	return $result;
}

public static function getPledgersByParent($type, $parent){

	$season = self::getUserLastDepositId($parent);

	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT user_id FROM pledger WHERE ref_parent_id = :parent AND status = 1 AND plan_id = :type AND season = "$season"');
	$get->bindValue(':parent', $parent, PDO::PARAM_INT);
	$get->bindValue(':type', $type, PDO::PARAM_INT);
	
	$get->execute();

$result = array();

	while($row = $get->fetch(PDO::FETCH_ASSOC)){
	$result[] = $row;

	}

	return $result;
}

public static function getPledgeById($pledge){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM pledger WHERE id = :id');
	$get->bindValue(':id', $pledge, PDO::PARAM_INT);
	$get->execute();

	$row = $get->fetch(PDO::FETCH_ASSOC);
	$result = $row;

	$db = null;
	return $result;
}


public static function getPendingTransByUid($user){
	$pending = array();
	$season = self::getUserLastDepositId($user);

	list($pending, $paging) = self::getUserPendingReturns($user, $season);

$amount = 0;

foreach($pending as $value){
		$plan = $value['plan_id'];
			$amt = self::getInvestmentPlanById($plan);
			$amount +=  $amt['exp_return'];
		
	}

	$db = null;
	return $amount;
	
}


public static function countConfirmTransByUid($user, $type){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT COUNT(*) as "num" FROM pledger WHERE ref_parent_id = :parent AND status = :status AND plan_id = :type GROUP BY user_id');
	$get->bindValue(':parent', $user, PDO::PARAM_INT);
	$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
	$get->bindValue(':type', $type, PDO::PARAM_INT);
	$get->execute();

	$list = array();
	while($row = $get->fetch(PDO::FETCH_ASSOC)){
$list[] = $row['num'];
	}

$db = null;
return count($list);

}

public static function getTotalEarnedByUid($user){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT plan_id FROM pledger WHERE ref_parent_id = :parent AND status = :status GROUP BY season, user_id');
	$get->bindValue(':parent', $user, PDO::PARAM_INT);
	$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
	$get->execute();
$amount = 0;
	while($row = $get->fetch(PDO::FETCH_ASSOC)){
		$plan = $row['plan_id'];
		
			$amt = self::getInvestmentPlanById($plan);
			$amount +=  $amt['exp_return'];
		
	}

	$db = null;
	return $amount;
	
}


public static function matchClients($parent){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$upd = $db->prepare('UPDATE pledger SET matched = 1 WHERE ref_parent_id = :parent AND status = 0');
	$upd->bindValue(':parent', $parent, PDO::PARAM_INT);

	$upd->execute();

	$test = $upd->rowCount();

	$db = null;

}

public static function getUserPayoutByStatus($uid, $status, $target){
	$sql = "SELECT * FROM pledger WHERE user_id = '$uid' AND matched = 1 AND status = '$status'  ORDER BY reg_date DESC";
	
	$count = "SELECT COUNT(*) AS 'num' FROM pledger WHERE user_id = '$uid' AND matched = 1 AND status = '$status'";
	$table = 'pledger';
	$limit = 15;
	$result = array();
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	
	return array($paginate, $result);	

}

public static function addTransDetail($parent, $plan, $payee = array()){
$amt = array();
	$amt = self::getInvestmentPlanById($plan);

	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$insert = $db->prepare('INSERT INTO transaction(beneficiary, amount, reg_date, status, plan_id, payees) VALUES(:parent, :amt, NOW(), 1, :plan, :users)');
	$insert->bindValue(':parent', $parent, PDO::PARAM_INT);
	$insert->bindValue(':amt', $amt['exp_return'], PDO::PARAM_INT);
	$insert->bindValue(':plan', $plan, PDO::PARAM_INT);
	$insert->bindValue(':users', implode(';', $payee), PDO::PARAM_STR);
	$insert->execute();

	$test = $db->lastInsertId();

$db = null;
return $test;

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
	
public static function confirmPaymentByUid($uid, $season){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$upd = $db->prepare("UPDATE pledger SET status = :status WHERE user_id = :uid AND season = :season");
		
		$upd->bindValue(':status', CONFIRM, PDO::PARAM_INT);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		$upd->bindValue(':season', $season, PDO::PARAM_INT);		
		$upd->execute();

		$test = $upd->rowCount();
		$db = null;
		return $test;

}

public static function getUserPendingReturns($uid,  $season, $target= ''){
	$sql = "SELECT * FROM pledger WHERE ref_parent_id = '$uid' AND status = 0 AND season = '$season' GROUP BY user_id ORDER BY reg_date DESC";
	
	$count = "SELECT COUNT(*) AS 'num' FROM pledger WHERE ref_parent_id = '$uid' AND status = 0 AND season = '$season'";
	$table = 'pledger';
	$limit = 15;
	$result = array();
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	//var_dump($paginate);
	return array($paginate, $result);	

}

public static function countSpilloverByUid($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT count(`user_id`) as "num" FROM users WHERE spillover = :uid');
	$get->bindValue(':uid', $uid, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['num'];

		$db = null;
		return $result;

}

public static function getSpilloverByUid($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM users WHERE spillover = :uid');
	$get->bindValue(':uid', $uid, PDO::PARAM_INT);

		$get->execute();

		$result = array();

		while($row = $get->fetch(PDO::FETCH_ASSOC)){
		$result[] = $row;
		}

		$db = null;
		return $result;
		
}

public static function getUserReturn($uid, $target){
	$sql = "SELECT * FROM pledger WHERE ref_parent_id = '$uid' AND status = 1 GROUP BY season, user_id ORDER BY reg_date DESC";
	
	$count = "SELECT COUNT(*) AS 'num' FROM pledger WHERE ref_parent_id = '$uid' AND status = 1";
	$table = 'transaction';
	$limit = 15;
	$result = array();
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	
	return array($paginate, $result);	

}

public static function getAllOverduePledgers(){
	$time = time() - (48*60*60); 
	$time = date('Y-m-d H:i:s', $time);
	
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT user_id FROM pledger WHERE status = :status AND user_id != "" AND reg_date <= :time');
	$get->bindValue(':status', PENDING, PDO::PARAM_INT);
	$get->bindValue(':time', $time, PDO::PARAM_INT);
	$get->execute();
$list = array();

	while($row = $get->fetch(PDO::FETCH_ASSOC)){
		$list[] = $row['user_id'];
	}

	$db = null;

	return $list;
}

//all acts
// trans_status > 48hrs
//

	public static function confirmDeposit($list){
	
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare("UPDATE transaction SET status = CONFIRM, paymt_date = NOW() WHERE trans_id = :id");
		
		//foreach($list as $value){
		$upd->bindValue(':id', $list, PDO::PARAM_INT);
		$upd->execute();
		//}
		
		$test = $upd->rowCount();
		
		//var_dump($test);S
		//UPDATE `transaction` SET paymt_date = NOW(), `status` = '2', `due_date` = '2019-02-01 21:51:05' WHERE `trans_id` = '4'
		// , due_date = '$due_date' 
		$db = NULL;
		return $test;
		
	}
	
///////////////////////////////////////// OBSOLETE //////////////////////////////////////////////////


public static function getInvestmentPlans(){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->query('SELECT * FROM investment_plans ORDER BY min_deposit ASC');
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

public static function getPlanDetailById($id){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM investment_plans WHERE plan_id = :plan');
	$get->bindValue(':plan', $id, PDO::PARAM_INT);
	$get->execute();
	
	$name = array();
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$name = $row;
	
	$db = NULL;
	return $name;
}

public static function getPlanAmountById($id){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT min_deposit FROM investment_plans WHERE plan_id = :plan');
	$get->bindValue(':plan', $id, PDO::PARAM_INT);
	$get->execute();
	
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$name = $row['min_deposit'];
	
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


public static function getPlegdeByTransId($trans_id){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM pledger WHERE id = :tid');
	$get->bindValue(':tid', $trans_id, PDO::PARAM_INT);
	
	$get->execute();
	
	$list = array();
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$list = $row;
	
	$db = NULL;
	return $list;
	
}


public static function makeDeposit($user, $amt, $return, $plan, $btc='', $status){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$insert = $db->prepare('INSERT INTO transaction(type, beneficiary, amount, reg_date, status, exp_return, plan_id, btc_amt, category) VALUES(1, :userid, :amt, NOW(), :status, :return, :plan, :btc, 2)');
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
	$sql = "INSERT INTO `transaction` (`trans_id`, `type`, `beneficiary`, `amount`, `reg_date`, `paymt_date`, `due_date`, `status`, `exp_return`, `plan_id`, `btc_amt`, category) VALUES (NULL, '2', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$exp1', '', '', '2'), (NULL, '1', '$uid', '$amt', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2', '$return', '$plan', '$btc_amt', '2')";
	
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$insert = $db->query($sql); 
	
	$test = $db->lastInsertId();
	
	$db = NULL;
	return $test;

}

public static function getUserDepositByStatus($status, $uid, $date1, $date2, $target){
	$sql = "SELECT * FROM transaction WHERE beneficiary = '$uid' AND status = '$status' AND type = '1' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
	
	$table = 'transaction';
	$limit = 15;
	$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE beneficiary = '$uid' AND status = '$status' AND type = '1' AND reg_date BETWEEN '$date1' AND '$date2'";
	$result = array();
	
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	
	return array($paginate, $result);
	/*
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM transaction WHERE beneficiary = :uid AND status = :status AND type = :type ORDER BY trans_id DESC');
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
	$get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE beneficiary = :uid AND type = 1 AND status = :status');
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
	$get = $db->prepare('SELECT SUM(exp_return) as "Total" FROM transaction WHERE beneficiary = :uid AND status = :status AND type = 1');
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
	$get = $db->prepare('SELECT trans_id, amount, paymt_date, reg_date, due_date, exp_return FROM transaction WHERE beneficiary = :id AND type = 1 AND status = :status AND due_date >= NOW() ORDER BY due_date ASC LIMIT 1');
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
	$get = $db->prepare('SELECT SUM(`exp_return`) AS "Total" FROM transaction WHERE beneficiary = :uid AND type = 1 AND status = 2 AND due_date > NOW()');
	$get->bindValue(':uid', $uid, PDO::PARAM_INT);
	$get->execute();
	
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$amt = $row['Total'];
	
	$db = NULL;
	return $amt;
}


public static function getLatestDeposits(){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT a.plan_id, a.user_id, a.ref_parent_id FROM pledger a, users b WHERE a.status = :status AND a.user_id = b.user_id AND b.user_type != 1 ORDER BY a.id DESC LIMIT 10');
	$get->bindValue(':status', PENDING, PDO::PARAM_INT);
	$get->execute();
	
	$list = array();
	while($row = $get->fetch(PDO::FETCH_ASSOC)){
		$list[] = $row;
	}
	
	$db = null;
	return $list;
}

public static function getAdminTransByStatus($status){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT plan_id, username FROM pledger  WHERE status = :status AND category = 1 ORDER BY id DESC LIMIT 10');
	$get->bindValue(':status', $status, PDO::PARAM_INT);
	$get->execute();
	
	$list = array();
	while($row = $get->fetch(PDO::FETCH_ASSOC)){
		$list[] = $row;
	}
	
	$db = null;
	return $list;
}

	



public static function confirmDeosit($list){

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
	$insert = $db->prepare('INSERT INTO transaction(type, beneficiary, amount, reg_date, status, exp_return) VALUES(2, :userid, :amt, NOW(), :status, :exp)');
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
	$sql = "SELECT * FROM transaction WHERE type = '2' AND status = '$status' AND beneficiary = '$uid' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY reg_date DESC";
	
	$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE type = '2' AND status = '$status' AND beneficiary = '$uid' AND reg_date BETWEEN '$date1' AND '$date2'";
	$table = 'transaction';
	$limit = 15;
	$result = array();
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	
	return array($paginate, $result);	
}

public static function getWithdrawalUntilDateByStatus($date1, $date2, $status, $target){
	$sql = "SELECT amt, reg_date, beneficiary FROM transaction WHERE type = '2' AND status = '$status' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
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




//SELECT b.trans_id, b.amount FROM referral a, transaction b WHERE a.deposit_id = b.trans_id AND a.referer_id = b.beneficiary GROUP BY b.trans_id

public static function getTotalWithdByStatus($uid, $status){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT SUM(amount) AS "Total" FROM transaction WHERE beneficiary = :uid AND type = 2 AND status = :status');
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
	$get = $db->prepare('SELECT COUNT(a.ref_parent_id) as "num", a.plan_id, a.user_id, a.ref_parent_id, a.season FROM pledger a, users b WHERE a.status = 1 AND a.user_id = b.user_id AND b.user_type != 1 GROUP BY a.season ORDER BY a.id DESC LIMIT 10');

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
	$get = $db->prepare('SELECT SUM(b.amount) as "Total" FROM referral a, transaction b WHERE a.deposit_id = b.trans_id AND a.referer_id = b.beneficiary AND a.status = 1 AND beneficiary = :uid GROUP BY b.trans_id');
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


public static function updReBStatus($deposit_id){
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

	public static function getAllMyRefereeUid($uid){
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
	$get = $db->prepare('SELECT SUM(amount) as "Total" FROM transaction WHERE beneficiary = :uid AND status = :status');
	$get->bindValue(':uid', $uid, PDO::PARAM_INT);
	$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
	$get->execute();
	
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$result = $row['Total'];
	
	$db = NULL;
	return $result;
}


public static function addAdminTrans($urname, $plan, $status){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO pledger(username, plan_id, reg_date, category, status) VALUES(:urn, :plan, NOW(), 1, :status)');
		$insert->bindValue(':urn', $urname, PDO::PARAM_STR);
		$insert->bindValue(':plan', $plan, PDO::PARAM_INT);
		$insert->bindValue(':status', $status, PDO::PARAM_INT);
		$insert->execute();
		
		$test = $db->lastInsertId();
		
		$db = NULL;
		return $test;
		
	}
	

public static function getLastDepositByUid($user){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT amount FROM transaction WHERE beneficiary = :user AND status = :status AND type = 1 ORDER BY trans_id DESC LIMIT 1');
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
	$get = $db->prepare('SELECT amount FROM transaction WHERE beneficiary = :user AND status = :status AND type = 2 ORDER BY trans_id DESC LIMIT 1');
	$get->bindValue(':user', $user, PDO::PARAM_INT);
	$get->bindValue(':status', CONFIRM, PDO::PARAM_INT);
	$get->execute();
	
	
	$row = $get->fetch(PDO::FETCH_ASSOC);
		$list = $row['amount'];

	$db = null;
	return $list;
}

public static function getUserTransactionByTypeUntilDate($uid, $date1, $date2, $target){

$sql = "SELECT * FROM transaction WHERE beneficiary = '$uid' AND reg_date BETWEEN '$date1' AND '$date2' ORDER BY trans_id DESC";
	
	$table = 'transaction';
	$limit = 15;
	$count = "SELECT COUNT(*) AS 'num' FROM transaction WHERE beneficiary = '$uid' AND reg_date BETWEEN '$date1' AND '$date2'";
	$result = array();
	
	list($result, $paginate) = Misc::paginator($table, $target, $limit, $sql, $count);
	
	return array($paginate, $result);
	
	/*
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$get = $db->prepare('SELECT * FROM transaction WHERE beneficiary = :uid AND category = 2 AND reg_date BETWEEN :date1 AND :date2 ORDER BY reg_date DESC');
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

public static function getTransactionBrans_id($user){
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