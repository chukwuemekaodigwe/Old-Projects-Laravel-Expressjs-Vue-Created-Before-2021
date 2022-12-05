<?php
class Users
{


	public static function createAcct($name, $email, $pet, $pwd, $referer_id, $referer_parent, $phone, $plan, $spillover, $btc)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO users (name, email, username, password, user_type, reg_date, status, referer, phone, ref_parent_id, matrix_level, spillover, btc_addr) VALUES(:name, :mail, :urname, :pwd, :ulevel, NOW(), :status, :ref, :phone, :parent, :plan, :spill, :btc)');
		$insert->bindValue(':name', $name, PDO::PARAM_STR);
		$insert->bindValue(':mail', $email, PDO::PARAM_STR);
		$insert->bindValue(':urname', $pet, PDO::PARAM_STR);
		$insert->bindValue(':pwd', $pwd, PDO::PARAM_STR);
		$insert->bindValue(':ulevel', CLIENT, PDO::PARAM_INT);
		$insert->bindValue(':phone', $phone, PDO::PARAM_STR);
		$insert->bindValue(':parent', $referer_parent, PDO::PARAM_INT);
		$insert->bindValue(':ref', $referer_id, PDO::PARAM_INT);
		$insert->bindValue(':plan', $plan, PDO::PARAM_INT);
		$insert->bindValue(':status', 2, PDO::PARAM_STR);
		$insert->bindValue(':spill', $spillover, PDO::PARAM_INT);
		$insert->bindValue(':btc', $btc, PDO::PARAM_STR);
		$insert->execute();

		$test = $db->lastInsertId();
		$db = null;
		return $test;
	}

	
	public static function authAcct($urname, $pwd)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT user_id, user_type, status FROM users WHERE username = :mail AND password = :pwd');
		$get->bindValue(':mail', $urname, PDO::PARAM_STR);
		$get->bindValue(':pwd', $pwd, PDO::PARAM_STR);
		$get->execute();

		$list = array();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$list = $row;

		$db = NULL;
		return $list;
	}

	public static function getUserIdByEmail($email)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT user_id FROM users WHERE email = :mail');
		$get->bindValue(':mail', $email, PDO::PARAM_STR);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['user_id'];

		$db = NULL;
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

		$db = NULL;
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

		$db = NULL;
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

		$db = NULL;
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

		$db = NULL;
		return $name;
	}

	public static function getUidByNicname($pet)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT user_id FROM users WHERE username = :id');
		$get->bindValue(':id', $pet, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['user_id'];

		$db = NULL;
		return $name;
	}
	
	public static function getUserPlanByUid($pet)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT matrix_level FROM users WHERE user_id = :id');
		$get->bindValue(':id', $pet, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['matrix_level'];

		$db = NULL;
		return $name;
	}
	
	public static function changeUserPlanById($plan, $uid){
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare('UPDATE users SET matrix_level = :plan WHERE user_id = :uid');
		$upd->bindValue(':plan', $plan, PDO::PARAM_INT);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		$upd->execute();

		$test = $upd->rowCount();

		$db = null;
		return $test;
	}

	public static function getUserParentByUid($uid)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT referer FROM users WHERE user_id = :id');
		$get->bindValue(':id', $uid, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['referer'];

		$db = NULL;
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

		$db = NULL;
		return $name;
	}



	public static function getAllUsers($target)
	{

		$sql = "SELECT * FROM users WHERE user_type = 2 ORDER BY username ASC";
		$table = 'users';
		$limit = 20;
		$count = 'SELECT COUNT(*)AS "num" FROM users WHERE user_type = 2';
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


		$db = NULL;
		return $list;
	}

	public static function getAllUserFullName()
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->query('SELECT name, user_id, email, username FROM users WHERE user_level = 2');

		$list = array();
		while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
			$list[] = $row;
		}


		$db = NULL;
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


		$db = NULL;
		return $list;
	}


	public static function updUserAcct($pet, $pwd, $uid, $bank, $acct_no, $btc)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare('UPDATE users SET username = :urn, password = :pwd, user_bank_name = :bname, user_bank_no = :no, btc_addr = :btc WHERE user_id = :uid');
		$upd->bindValue(':urn', $pet, PDO::PARAM_STR);
		$upd->bindValue(':pwd', $pwd, PDO::PARAM_STR);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		$upd->bindValue(':bname', $bank, PDO::PARAM_STR);
		$upd->bindValue(':no', $acct_no, PDO::PARAM_STR);
		$upd->bindValue(':btc', $btc, PDO::PARAM_STR);

		$upd->execute();
		$test = $upd->rowCount();
		$db = NULL;

		return $test;
	}

	public static function updUserInfo($name, $phone, $uid)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare('UPDATE users SET name = :urn, phone = :pwd WHERE user_id = :uid');
		$upd->bindValue(':urn', $name, PDO::PARAM_STR);
		$upd->bindValue(':pwd', $phone, PDO::PARAM_STR);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		

		$upd->execute();
		$test = $upd->rowCount();
		$db = NULL;

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
		$db = NULL;

		return $test;
	}

public static function updUserRefById($uid, $ref, $parent){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$upd = $db->prepare('UPDATE users SET referer = :ref, ref_parent_id = :parent WHERE user_id = :uid');
		$upd->bindValue(':ref', $ref, PDO::PARAM_INT);
		$upd->bindValue(':uid', $uid, PDO::PARAM_INT);
		$upd->bindValue(':parent', $parent, PDO::PARAM_INT);

		$upd->execute();

		$test = $upd->rowCount();
$db = null;
		return $test;
}

public static function getUserStatusById($uid){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT status FROM users WHERE user_id = :id');
		$get->bindValue(':id', $uid, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['status'];

		$db = NULL;
		return $name;
}


	public static function getRefLinkByUid($uid)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT username FROM users WHERE user_id = :id');
		$get->bindValue(':id', $uid, PDO::PARAM_INT);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$name = $row['username'];

		$db = NULL;
		return $name;
	}

	public static function getUserIdByRef($ref)
	{
		// For verifying refLinks

		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('SELECT user_id FROM users WHERE username = :mail');
		$get->bindValue(':mail', $ref, PDO::PARAM_STR);

		$get->execute();

		$row = $get->fetch(PDO::FETCH_ASSOC);
		$result = $row['user_id'];

		$db = NULL;
		return $result;
	}


	public static function changeUserStatus($user, $status)
	{
		$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$get = $db->prepare('UPDATE users SET status = :status WHERE user_id = :uid');
		$get->bindValue(':uid', $user, PDO::PARAM_INT);
		$get->bindValue(':status', $status, PDO::PARAM_INT);

		$get->execute();

		$test = $get->rowCount();
		$db = NULL;

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
		$db = NULL;

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

		$db = NULL;
		return $btc_addr;
	}

}


class Misc
{

	public static function generateInvoice($uid, $trans_id)
	{
		$matched = Transactions::getPlegdeByTransId($trans_id);
$details = Users::getUserById($matched['ref_parent_id']);
$plan_details = Transactions::getPlanDetailById($matched['plan_id']);
//var_dump($uid);
		?>


	<style>
		@media print {
			.page-main, .acc-nav, footer {
				display: none;
			}

			.paage-foooter {
				display: none;
			}

			.acc-nav {
				display: none;
			}

			.container-fluid {
display: block;
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
			
			box-shadow: 0 3px 3px rgba(10, 40, 200, .5);
}


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

		<div class="container-fluid" id="invoice">


		<div class="holder">
			<div class="acc-title">
				<h1 class="acc-title__txt"> You've been matched!</h1><p style="clear: both;"></p>
			</div>
				<div class="img-responsive">
					<img src="../assets/img/logo.jpg" alt="LOGO" height="80px" />
				</div>

				</div>

			<!-- Row -->
			<style>
				td:odd {
					text-align: right !important;
					font-weight: bold;
				}
			</style>
						<div class="" style="margin: 20px auto;">
				<div class="table-responsive m-t-20 m-b-30">

					<table class="table table-condensed table-striped -table">

						<tr>
							<th colspan="2">
								<h3>The details is follows:</h3>
							</th>
						</tr>
						</thead>
						<tr>
							<td>
								User Fullname
							</td>

							<td>
								<?php echo ucwords($details['name']); ?>
							</td>

						</tr>
						<tr>
							<td>
								Bank

							</td>

							<td>
							<?php echo ucwords($details['user_bank_name']); ?>
							</td>

						</tr>

						<tr>
							<td>
								Account Number

							</td>

							<td>
							<?php echo ucwords($details['user_bank_no']); ?>
							</td>

						</tr>
						<tr>
							<td>
								Bitcoin Address

							</td>

							<td>
							<?php echo ucwords($details['btc_addr']); ?>
							</td>

						</tr>

						<tr>
							<td>
								Amount Payable

							</td>

							<td>
							$ <?php echo number_format($plan_details['min_deposit'], 2); ?>
							</td>

						</tr>

						<tr>
							<td>
								Phone number

							</td>

							<td>
							<?php echo ucwords($details['phone']); ?>
							</td>

						</tr>

						
						<tr>
							<td>
								Email Address

							</td>

							<td>
							<?php echo ucwords($details['email']); ?>
							</td>

						</tr>
					</table>
				</div>
			</div>


			<div class="holder">
				<div class="">
							<b>Due Date: </b><?php echo date('d-m-Y', strtotime('tomorrow')); ?></p>
				</div>
				<div>
					<h3 class="card-title"> Invoiced To:</h4>
						<p> <?php echo  Users::getUserFullNameById($uid); ?></p>
				</div>
				<div class="">
					<h2 class="h2" style="transform: rotate(-20deg); margin-left: -10px; color: red"> NOT YET PAID</h2>
				</div>
			</div>


			<div class="alert alert__warning">
				<div class="text-left">

					<span class="info"> <strong>NB: Pay in the funds within the next 24hours to aviod being suspended from using this system</strong> 
				</div>

			</div>
			<div style="display: block; padding:20px; margin-top:10px;">
			<button style="float: right;" class="btn btn--bl" onclick="Export()"> Download</button>
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('invoice'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("cycler.pdf");
                }
            });
        }
    </script>
	<?php

	unset($_SESSION['bal']);
	include('foot.php');
	die();
}

public static function sendMail($msg, $subj, $addr, $userName)
{
	$to = array();
	$name = array();
	$to = $addr;
	//$replyTo = 'do-not-reply@' . $_SERVER['SERVER_NAME'];
	$replyTo = 'do-not-reply@legit-cryptos.com';
	$name = $userName;
	$sender = CORP;
	$replyName = CORP;

	$from = 'admin@' . $_SERVER['SERVER_NAME'];
	//$from = 'mailer.digitalplazas.com';

	//$send = mailer::sendViaPhpmailer(0, '', $subj, $msg, '', CORP, $to, $name, $replyTo, $replyName);
	$i = 0;
	if(is_array($to)){
	foreach ($to as $person) {

		$send = mailer::sendViaDefault(CORP, $name[$i] . ' <' . $person . '>', $subj, $msg);
		$i += 1;
	}
}else{
	$send = mailer::sendViaDefault(CORP, $name . ' <' . $to . '>', $subj, $msg);
}
	//$send = mailer::sendviaSwift($to, $from, $subj, '', $msg, '');
	if ($send) {
		return (True);
	} else {
		return $send;
	}
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
	if ($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	$list = array();
	$result = $db->query($sql . " LIMIT $start, $limit");

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		$list[] = $row;
	}


	if ($page == 0) {
		$page = 1;
	}

	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages / $limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
		*/
	$pagination = "";
	if ($lastpage > 1) {
		$pagination .= '<ul class="table-paging">';
		//previous button
		if ($page > 1)
			$pagination .= '<li class="table-paging__prev"><a href="' . $targetpage . 'page=' . $prev . '">&laquo; previous</a></li>';
		else
			$pagination .= '<li class="disabled"><span>&laquo; previous</span></li>';

		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
				else
					$pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
			}
		} elseif ($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if ($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page)
						$pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
					else
						$pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
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
					if ($counter == $page)
						$pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
					else
						$pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
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
					if ($counter == $page)
						$pagination .= '<li class="table-paging__page--current"><span>' . $counter . '</span></li>';
					else
						$pagination .= '<li class="table-paging__page"><a href="' . $targetpage . 'page=' . $counter . '">' . $counter . '</a></li>';
				}
			}
		}

		//next button
		if ($page < $counter - 1)
			$pagination .= '<li class="table-paging__next"><a href="' . $targetpage . 'page=' . $next . '">next &raquo;</a></li>';
		else
			$pagination .= '<li class="disabled"><span>next &raquo;</span></li>';
		$pagination .= "</ul>\n";
	}

	$db = NULL;
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
	$secondsInAnHour  = 60 * $secondsInAMinute;
	$secondsInADay    = 24 * $secondsInAnHour;

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
		'd' => (int)$days,
		'h' => (int)$hours,
		'm' => (int)$minutes,
		's' => (int)$seconds,
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
		'day' => (int)$days,
		'hour' => (int)$hours,
		'minute' => (int)$minutes,
		'second' => (int)$seconds,
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

public static function getRandomRef($no)
{
	do{
		$reflink = self::izRand($no);
$test = self::getVerifLink($reflink);
	}while($test != '');
		
	return $reflink;
}

public static function addVerificationLink($uid, $link_id){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
		$insert = $db->prepare('INSERT INTO verify (user_id, link, status) VALUES(:uid, :link, 0)');
		$insert->bindValue(':uid', $uid, PDO::PARAM_INT);
		$insert->bindValue(':link', $link_id, PDO::PARAM_STR);
		$insert->execute();

		$test = $db->lastInsertId();
		$db = null;
		return $test;
}

public static function updVerificationLink($link){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$upd = $db->prepare('UPDATE verify SET status = 1 WHERE link = :link');
	$upd->bindValue(':link', $link, PDO::PARAM_STR);
	$upd->execute();

}

public static function getVerifLink($link){
	$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
	$upd = $db->prepare('SELECT user_id FROM verify WHERE link = :link AND status = 0');
	$upd->bindValue(':link', $link, PDO::PARAM_STR);
	$upd->execute();

	
	$row = $upd->fetch(PDO::FETCH_ASSOC);
	$list = $row['user_id'];

	$db = null;
	return $list;

}



public static function authPage()
{

	$token = isset($_SESSION['key']) ? $_SESSION['key'] : "";
	if (!isset($_SESSION['key']) && !isset($_SESSION['user_type']) && !isset($_SESSION['pid']) && $token !== CORP.'_DONE') {
		echo '<script type="text/javascript"> window.location = "../";</script>';
		die();
	}
}



public static function match($parent, $type){

	$clients = array();
	$getClients = Transactions::getPledgersByParent($type, $parent);

	foreach($getClients as $value){
		$clients[] = $value['id'];
	}

	$match_parent = Transactions::matchClients($parent);
	$test = $addTrans = Transactions::addTransDetail($parent, $type, $clients);
return $test;
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
	return TRUE;
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
		'Dec'
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
						$selected =  'selected';
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
						$selected =  'selected';
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
						$selected =  'selected';
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
						$selected =  'selected';
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

public static function verifyRef($referer = ''){
	$ref = isset($_GET['u']) ? $_GET['u'] : '';
if (!empty($ref)) {
  $referer = Users::getUidByNicname($ref);
  if(!empty($referer)){
  $_SESSION['ref'] = $referer; 
  
  echo '<script required type="text/javascript"> window.location = "?p=signup";</script>';die();
  }
  
}

}
public static function confirmEmail($confirm){
	if(!empty($confirm)){
		$uid = self::getVerifLink($confirm);
		if($uid > 0){
			$email_confirm = Users::changeUserStatus($uid, 2);
		$check = self::updVerificationLink($confirm);
	$_SESSION['result'] = array(1, 'Verification Successful! <br> Please login to start enjoying the full benefits of joining us');
	
	
	login();
	
	}
	
}

}


public static function loginAuth($status){

	switch($status){
		case UN_ACTIVATED:
$_SESSION['result'] = array(2, '<h2>PLEASE ACTIVATE YOUR ACCOUNT!</h2>');
$_SESSION['status'] = UN_ACTIVATED;
return UN_ACTIVATED;
		break;

		case SUSPENDED:
		$_SESSION['result'] = array(2, '<b> You have suspended from using this service for not complying with our terms and conditions</b>');
		$_SESSION['status'] = SUSPENDED;
		login();
		return SUSPENDED;
		break;

		case ACTIVE:
		$_SESSION['result'] = array(1, '<h2>WELCOME BACK!</h2>');
		$_SESSION['status'] = ACTIVE;
		return ACTIVE;
		break;

		default:
		if($status == 4){
			$_SESSION['result'] = array('2', 'Please verify your email in order to access the system; <br><b>Visit your mail inbox/spambox for more!');
		}
login(); die();
		break;


	}

}

public static function testActivation($status){
	
	if($status != ACTIVE){
		
		if($_GET['pg'] == 'exit'){
			logout();
		}elseif($_GET['pg'] == 'pledge'){
			credit();

		}elseif($_GET['pg'] == 'invoice'){
			//var_dump($_GET); die();
			credit(); 
			
		}elseif($_GET['pg'] == 'edit_account'){
		user();
		}else{

		$_SESSION['result'] = array('2', 'Please activate your account to have full access to the system');
		dash(); 

		}

		include('foot.php');die();
	}
}

public static function getAnotherRef($ref, $uid){
	$reffer = Transactions::assignReferer($ref);
	while($ref != $reffer){
		$reffer = Transactions::assignReferer($ref);
	
	}
	$parent = Users::getUserParentByUid($ref);
	$updRef = Users::updUserRefById($uid, $ref, $parent);

		return array($reffer, $parent);
}

public static function addSlideshow(){
	?>

    <style>
        * {
            box-sizing: border-box
        }
        /* Slideshow container */
        
        .slideshow-container {
            //max-width: 1000px;
            position: relative;
			margin: auto;
			
        }
        /* Hide the images by default */
        
        .mySlides {
			display: none;
			
        }
        
        .mySlides img {
            height: 450px!important;
        }
        /* Next & previous buttons */
        
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
			user-select: none;
			
        }
        /* Position the "next button" to the right */
        
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        /* On hover, add a black background color with a little bit see-through */
        
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        /* Caption text */
        
		.text {
    color: #fff;
    font-size: 4em;
    padding: 250px 12px 10px 12px;
    position: absolute;
    bottom: 0px;
    width: 100%;
    text-align: center;
    font-weight: bolder;
    font-family: elephant;
    background-color: rgba(0,0,0,.5);
    height: 100%;
 }
        /* Number text (1/3 etc) */
        
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }
        /* The dots/bullets/indicators */
        
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }
      /*  
        .active,
        .dot:hover {
            background-color: #717171;
		}
		*/
        /* Fading animation */
        
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }
        
        @-webkit-keyframes fade {
            from {
                opacity: .4
            }
            to {
                opacity: 1
            }
        }
        
        @keyframes fade {
            from {
                opacity: .4
            }
            to {
                opacity: 1
            }
		}
		.next,.prev, .dot{
			display: none;
		}
		
		.text span{
		    color: gold!important;
		}
    </style>


        <!-- Slideshow container -->
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            
            <div class="mySlides fade">
                <div class="numbertext">1 / 4</div>
                <img src="assets/img/slider4.jpg" style="width:100%">
                <div class="text"> Are you ready to move with<br> <span>Champions</span></div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 4</div>
                <img src="assets/img/slide1.jpg" style="width:100%">
                <div class="text"><span style="color:gold;" >Join The World's Best</span><br> Investment Platform<br></div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 4</div>
                <img src="assets/img/slide2.jpg" style="width:100%">
                <div class="text"> Welcome to <br><span> Ultimate Cycler 2</span></div>
            </div>
<div class="mySlides fade">
                <div class="numbertext">4 / 4</div>
                <img src="assets/img/slide3.jpg" style="width:100%">
                <div class="text" style="font-size: 3em!important;"><span> 100% Instant Direct Pay</span><br> No Admin Fees!!!</div>
            </div>
            
            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    

    <script type="text/javascript">
        var slideIndex = 0;
        showSlides();

        function showSlides(n = '') {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5500); // Change image every 2 seconds
        }
    </script>

	<?php
}
}

?>