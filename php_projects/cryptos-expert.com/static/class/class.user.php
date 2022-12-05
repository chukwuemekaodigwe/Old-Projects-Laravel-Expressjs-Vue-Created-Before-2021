<?php

class Users {

    public static function createAcct($name, $email, $urname, $pwd, $acct = '') {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO users(name, email, username, password, user_level, reg_date, user_acct_no, status) VALUES(:name, :mail, :urname, :pwd, 2, NOW(), :ref, 1)');
        $insert->bindValue(':name', ucwords($name), PDO::PARAM_STR);
        $insert->bindValue(':mail', strtolower(trim($email)), PDO::PARAM_STR);
        $insert->bindValue(':urname', strtolower(trim($urname)), PDO::PARAM_STR);
        $insert->bindValue(':pwd', trim($pwd), PDO::PARAM_STR);
        $insert->bindValue(':ref', $acct, PDO::PARAM_STR);

        $insert->execute();

        $test = $db->lastInsertId();
        $db = NULL;
        return($test);
    }
    

    public static function getUserInfoByUrname($urname, $pwd) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id, user_level, reg_date FROM users WHERE username = :urn AND password = :pwd AND status = 1 LIMIT 1');
        $get->bindValue(':urn', strtolower(trim($urname)), PDO::PARAM_STR);
        $get->bindValue(':pwd', trim($pwd), PDO::PARAM_STR);
        $get->execute();

        $data = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $data = $row;

        $db = NULL;
        if ($data == NULL) {
            return($result = 0);
        } else {
            return($data);
        }
    }

    public static function getUserIdByUsername($usern) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE username = :urn LIMIT 1');
        $get->bindValue(':urn', $usern, PDO::PARAM_STR);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);

        $id = $row['user_id'];

        $db = NULL;

        if ($id != NULL) {
            return($id);
        } else {
            return($id = 0);
        }
    }

    public static function getUserEmailById($uid) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT email FROM users WHERE user_id = :id LIMIT 1');
        $get->bindValue(':id', $uid, PDO::PARAM_STR);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'];
        $db = NULL;

        if ($email != NULL) {
            return($email);
        } else {
            return($email = 0);
        }
    }
    
    public static function getUrnameById($uid) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT username FROM users WHERE user_id = :id LIMIT 1');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['username'];
        $db = NULL;

        if ($name != NULL) {
            return($name);
        } else {
            return($name = 0);
        }
    }

    public static function getUserNameById($uid) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT name FROM users WHERE user_id = :id LIMIT 1');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);
        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $db = NULL;

        if ($name != NULL) {
            return($name);
        } else {
            return($name = 0);
        }
    }
    
    public static function getUserInfoById($uid) {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM users WHERE user_id = :id LIMIT 1');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);
        $get->execute();
        
        $list = array();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;
        $db = NULL;

        return $list;
    }

    public static function updUserInfo($name, $email, $uid = '') {
    	$uid = !empty($uid) ? $uid : $_SESSION['uid'];
    	
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $update = $db->prepare('UPDATE users SET name = :name, email = :mail WHERE user_id = :id');
        $update->bindValue(':name', $name, PDO::PARAM_STR);
        $update->bindValue(':mail', $email, PDO::PARAM_STR);
        $update->bindValue(':id', $uid, PDO::PARAM_INT);
        $update->execute();

        $test = $update->rowCount();
        $db = NULL;
        return($test);
    }

    public static function modifyPassword($pwd, $uid = '') {
    	$uid = !empty($uid) ? $uid : $_SESSION['uid'];
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $update = $db->prepare('UPDATE users SET password = :pwd WHERE user_id = :id');
        $update->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $update->bindValue(':id', $uid, PDO::PARAM_INT);
        $update->execute();

        $test = $update->rowCount();
        $db = NULL;

        return($test);
    }
	
	
	public static function changeStatus($status, $uid = '') {
    	$uid = !empty($uid) ? $uid : $_SESSION['uid'];
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $update = $db->prepare('UPDATE users SET status = :pwd WHERE user_id = :id');
        $update->bindValue(':pwd', $status, PDO::PARAM_STR);
        $update->bindValue(':id', $uid, PDO::PARAM_INT);
        $update->execute();

        $test = $update->rowCount();
        $db = NULL;

        return($test);
    }
	
	
    public static function getAllUsers($target){
	$sql = "SELECT * FROM users WHERE user_level = 2 AND status = 1 ORDER BY reg_date DESC";
		
		$table = 'users';
		$limit = 25;
		$result = array();
		list($paginate, $result) = Misc::paginator($table, $target, $limit, $sql);
		
		return array($paginate, $result);
}

public static function countUsers(){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$count = $db->query('SELECT COUNT(`user_id`) AS "num" FROM users WHERE user_level = 2 AND status = 1');
	$row = $count->fetch(PDO::FETCH_ASSOC);
	
	$num = $row['num'];
	return($num);
}

}

class Misc {

    public static function generateToken() {
        $temp = gettimeofday();
        $usec = $temp['usec'];
        $id = md5('p' . time() . $usec . 'n'); // time seconds used to ensure always unique;
        $_SESSION['token'] = $id;
    }
    
    //sha1()
    public static function pgAuth() {
        $auth = isset($_SESSION['userAuth']) ? $_SESSION['userAuth'] : "";
        if (isset($auth) && isset($_SESSION['user_level']) && isset($_SESSION['uid']) && $auth == 'Fine' && $_SESSION['user_level'] != '' && $_SESSION['uid'] != '') {
            
        } else {
            // error
            echo ('<script type="text/javascript"> window.location = "../index.php"; </script>');
            die();
        }
    }


public static function sendMail($msg, $subj, $name, $email){
    
    $name = ucwords($name);
    $sender = CORP;
    $replyName = CORP;

    $from = 'admin@' . $_SERVER['SERVER_NAME'];
    //$from = 'mailer.digitalplazas@gmail.com';

    //$send = mailer::sendViaDefault(CORP, $name.' <'.$email.'>', $subj, $msg);
    $send = mailer::sendviaSwift($email, $name, $sender, $from, $subj, strip_tags($msg), $msg, $attachment = null);
    //$send = mailer::sendViaPhpmailer('', '', $subj, $msg, '', $from, $email, $name, $replyTo, 'DO NOT REPLY');
    if ($send) {
       return (true);
        //var_dump($send); die();
    } else {
        return $send;
    }
}


public static function paginator($tbl_name, $targetpage, $limit, $sql){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$adjacents = 1; 
		//$limit = 20;
		$query = $db->prepare("SELECT COUNT(*) AS 'num' FROM `$tbl_name`");
		//$query->bindValue(':table', $tbl_name, PDO::PARAM_STR);
		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$total_pages = $row['num'];
		
		$page = isset($_GET['page']) ? $_GET['page'] : "";
		if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;								//if no page var is given, set start to 0
		
		$list = array();
		$result = $db->query($sql ." LIMIT $start, $limit");
		
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$list[] = $row;
		}
		
		
		if($page == 0){
			$page = 1;
		}
		
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
	
		/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1){	
			$pagination .= '<ul class="pagination">';
			//previous button
			if($page > 1) 
			$pagination.= '<li><a href="'.$targetpage.'page='.$prev.'">&laquo; previous</a></li>';
			else
			$pagination.= '<li class="disabled"><span>&laquo; previous</span></li>';	
		
			//pages	
			if($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for($counter = 1; $counter <= $lastpage; $counter++){
					if($counter == $page)
					$pagination.= '<li class="active"><span>'.$counter.'</span></li>';
					else
					$pagination.= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>';
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2)){
					for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
						if($counter == $page)
						$pagination.= '<li class="active"><span>'.$counter.'</span></li>';
						else
						$pagination.= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>';					
					}
					$pagination.= "...";
					$pagination.= '<li><li><a href="'.$targetpage.'page='.$lpm1.'">'.$lpm1.'</a></li>';
					$pagination.= '<li><a href="'.$targetpage.'page='.$lastpage.'">'.$lastpage.'</a></li>';		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
					$pagination.= '<li><a href="'.$targetpage.'page=1">1</a></li>';
					$pagination.= '<li><a href="'.$targetpage.'page=2">2</a></li>';
					$pagination.= "...";
					for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
						if($counter == $page)
						$pagination.= '<li class="active"><span>'.$counter.'</span></li>';
						else
						$pagination.= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>';
					}
					$pagination.= "...";
					$pagination.= '<li><a href="'.$targetpage.'page='.$lpm1.'">'.$lpm1.'</a></li>';
					$pagination.= '<li><a href="'.$targetpage.'page='.$lastpage.'">'.$lastpage.'</a></li>';		
				}
				//close to end; only hide early pages
				else{
					$pagination.= '<li><a href="'.$targetpage.'page=1">1</a></li>';
					$pagination.= '<li><a href="'.$targetpage.'page=2">2</a></li>';
					$pagination.= "...";
					for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
						if($counter == $page)
						$pagination.= '<li class="active"><span>'.$counter.'</span></li>';
						else
						$pagination.= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>';					
					}
				}
			}
		
			//next button
			if($page < $counter - 1) 
			$pagination.= '<li><a href="'.$targetpage.'page='.$next.'">next &raquo;</a></li>';
			else
			$pagination.= '<li class="disabled"><span>next &raquo;</span></li>';
			$pagination.= "</ul>\n";		
		}
	
		$db = NULL;
		return array($pagination, $list);
	
	}
	
public static function getRealDate($date){
	$pcs = explode('-', date('Y-m-d', strtotime($date)));
	printf("%f \n", $pcs[0]); printf("%f \n", $pcs[1]); printf("%f \n", $pcs[2]);  // convet to int
	if(checkdate($pcs[2]*1, $pcs[1]*1, $pcs[0]*1) != TRUE){
		$day = '01';
		$month = $pcs[1] + 1;
		//var_dump($pcs);die();
		if($month > 12){
			$month = '01';
			$yr = $pcs[0] + 1;
			
		}else{
			$yr = $pcs[0];			
		}
		
		$date = implode('-', array($yr, $month, $day));
		
	}
	
	return(date('Y-m-d', strtotime($date)));
		
}


    public static function checkCookie() {
        if (!isset($_COOKIE['accessToken']) || $_COOKIE['accessToken'] != '1487') {
            $_SESSION['error'] = "You don't have an active session please re-login to continue";
            echo('<script type="text/javascript"> window.location = "../?a=login"; </script>');
            die();
        }
    }


}
?>