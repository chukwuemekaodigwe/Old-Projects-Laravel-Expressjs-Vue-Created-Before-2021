<?php
session_start();
require('control.php');


Misc::authPage();

$duty = isset($_GET['pg']) ? $_GET['pg'] : "";
if ($duty == "") {
  $duty = isset($_POST['pg']) ? $_POST['pg'] : "";
}

$ulevel = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : "";

include('head.php');



//if ($ulevel == CLIENT) {
  
  Misc::testActivation($_SESSION['status']);
  
  switch ($duty) {

    case "dash":
      dash();
      break;

      case 'exit':
      logout();
      break;
      
    case "credit":
      credit();
      break;

      case "pledge":
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
case 'team':
sponsors();
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


    case 'exit':
      logout();
      break;



    case "dash":
      dash();
      break;

    case "clients":
      clients();
      break;

    case "mails":
      email();
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

    
    case "user":
      user();
      break;

    case 'generate':
      addTransaction();
      break;

    case "edit_account":
      user();
      break;

case 'invoice':
credit();
break;

    default:
      dash();
      break;
  }
//}


include('foot.php');

function dash()
{

  //var_dump($_REQUEST);
  $user = array();
  $user = Users::getUserById($_SESSION['pid']);

  $total_earning = Transactions::getTotalEarnedByUid($_SESSION['pid']);
  //var_dump($total_earning);
  ?>


  <div class="container">
    <div class="acc-title">
      <h1 class="acc-title__txt">Your Dashboard</h1>
      
      
<?php

$check_deposit = Transactions::getUserLastDepositStatus($_SESSION['pid']);
      if(($check_deposit['status'] == 1) && ($_SESSION['status'] == UN_ACTIVATED)){
        $change_status = Users::changeUserStatus($_SESSION['pid'], ACTIVE);
        unset($_SESSION['status']);
        
        $_SESSION['status'] = ACTIVE;
        
        $_SESSION['result'] = array(1, '<b> ACCOUNT ACTIVATED!!! <br> Welcome!!!</b>');
      }
      

if(isset($_SESSION['status']) && ($_SESSION['status'] == UN_ACTIVATED) && ($check_deposit == null) && ($check_deposit['status'] !== 0)){
  
  ?>
  <div style="clear: both">
<center><h1 style="text-transform: uppercase; font-size: 3em; color: red;"> Please activate your account! </h1></center>
</div>
<div class="" style="width: 50%;
    padding: 5px 15px;
    font-style: italic;
    position: static;
    left: 25%;
    top: 30%;">
      <div class="alert alert--warning alert--secure">
<h3> Please note you need to plegde in order to have full access to this system</h3>

      </div>
      </div>

      <div style="float: right; margin: auto 10px">
<a href="?pg=pledge" class="btn btn--highlight"> Pledge</a>
      </div>
   
  <?php

}

$count = Transactions::countPledgesByType((Users::getUserPlanByUid($_SESSION['pid'])), $_SESSION['pid']);
$count2 = Transactions::countPledgesByType((Users::getUserPlanByUid($_SESSION['pid'])), $_SESSION['pid'], CONFIRM);
$last_depo_status = Transactions::getUserLastDepositStatus($_SESSION['pid']);


if($count != 0){

  ?>

<div class="" style="width: 50%;
    padding: 5px 15px;
    font-style: italic;
    position: static;
    left: 25%;
    top: 30%;">
      <div class="alert alert--success alert--secure">
<h3> Please confirm your returns! </h3>

      </div>
      </div>

      <div style="float: right; margin: auto 10px">
<a href="?pg=withdraws" class="btn btn--highlight"> Confirm </a>
      </div>
  
  <?php
}elseif(($count2 >= 4) && ($last_depo_status['status'] != 0)){

  ?>

<div class="" style="width: 50%;
    padding: 5px 15px;
    font-style: italic;
    position: static;
    left: 25%;
    top: 30%;">
      <div class="alert alert--info alert--secure">
<h3> You've been matched!<br> Please make payment within the next 24 hours to aviod being suspended</h3>

      </div>
      </div>

      <div style="float: right; margin: auto 10px">
<a href="?pg=pledge&recycle=2" class="btn btn--highlight"> View </a>
      </div>
  

  <?php
}elseif($last_depo_status['status'] == 0 && $last_depo_status != null){
	
	
	
?>
<div class="" style="width: 50%;
    padding: 5px 15px;
    font-style: italic;
    position: static;
    left: 25%;
    top: 30%;">
      <div class="alert alert--warning alert--secure">
<h3> YOU HAVE UNPAID INVOICE! <br>Please redeem immediately to aviod been suspended!</h3>

      </div>
      </div>

      <div style="float: right; margin: auto 10px">
<a href="?pg=invoice" class="btn btn--highlight "> View </a>
      </div>
  
<?php

}
  

$upgrade = Transactions::countConfirmTransByUid($_SESSION['pid'], (Users::getUserPlanByUid($_SESSION['pid'])));
$plan = Users::getUserPlanByUid($_SESSION['pid']);
if($upgrade >= 8 && $plan == 1){
$_SESSION['upgrade'] = 1;

?>

<div class="" style="width: 50%;
    padding: 5px 15px;
    font-style: italic;
    position: static;
    left: 25%;
    top: 30%;">
      <div class="alert alert--success alert--secure">
<h3> You are now eligible to upgrade to the next level!<br> </h3>

      </div>
      </div>

      <div style="float: right; margin: auto 10px">
<a href="?pg=pledge&upgrade=1" class="btn btn--highlight"> Upgrade </a>
      </div>
<?php
}
?>

      
<!--
      <div class="acc-title__btn">
        <a href="?pg=credit" class="btn">Recycle</a>
      </div>

      <div class="acc-title__btn">
        <a href="?pg=credit" class="btn">Set Matrix</a>
      </div>

      
      <div class="acc-title__btn">      
        <a href="?pg=withdraws" class="btn">Confirm</a>
      </div>
-->
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
            <div class="referal__percent" style="margin-left:0px!important;"> 400%</div>
            <div class="referal__title">REFERRAL  PROGRAM</div><div style="clear:both"></div>
          </div>
          <div class="share-bl__title">Click to copy your referral link to clipboard</div>
          <a style="height: 44px;" href="<?php echo $_SERVER['SERVER_NAME'] . '/?u=' . $user['username']; ?>" id="ref-copy" data-clipboard-text="<?php echo $_SERVER['SERVER_NAME'] . '/?u=' . $user['username']; ?>" class="btn btn--major btn--bl">Copy referral link</a>

          <br>

          <textarea style="height: 80px; font-size: 14px;" class="input" onfocus="this.select();" onmouseup="return false;"><?php echo $_SERVER['SERVER_NAME'] . '/?u=' . $user['username']; ?></textarea>
        </div>
      </div>
      <div class="side-wr__mid">
        <div class="profit-bl">
        <div class="profit-bl__item profit-bl__item--earned">
            <div class="profit-bl__img"><img src="../assets/img/ic-profit-earned.png" alt=""></div>
            <div class="profit-bl__txt">
              <span>Total Earned</span>
              <b>$ <?php echo !empty($total_earning) ? number_format($total_earning, 2) : '0.00'; ?></b>
            </div>
          </div>

          <div class="profit-bl__item profit-bl__item--balance">
            <div class="profit-bl__img"><img src="../assets/img/ic-profit-balance.png" alt=""></div>
            <div class="profit-bl__txt">
              <span>Pending Returns</span>
              <b>$ <?php echo number_format(Transactions::getPendingTransByUid($_SESSION['pid']), 2); ?></b>

              <div class="profit-bl__list">
              </div>

            </div>
          </div>
          
        </div>

        <div class="status-bl">
          <div class="status-bl__item">
            <div class="status-bl__title">investment status</div>
            <div class="status-bl__top">
              <div class="status-bl__img"><img src="../assets/img/ic-hiw-3.png" alt=""></div>
              <div class="status-bl__total-wr">
                <div class="status-bl__total">$ <?php echo  number_format(Transactions::getPlanAmountById($user['matrix_level']), 2); ?></div>
                <p>Carrier Level</p>
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
            <div class="status-bl__title"> Sponsors status</div>
            <div class="status-bl__top">
              <div class="status-bl__img"><img src="../assets/img/ic-stat-3.png" alt=""></div>
              <div class="status-bl__total-wr">
                <div class="status-bl__total">$ <?php echo !empty($ttlWithd) ? number_format($ttlWithd, 2) : '0.00'; ?></div>
                <p>Total Team Members</p>
              </div>
            </div>
            <ul class="status-bl__list">
              <li>
                <span>Personally Sponsored</span>
                <b>$ <?php echo !empty($pend_withd) ? number_format($pend_withd, 2) : '0.00'; ?></b>
              </li>
              <li title="">
                <span>Last Team</span>
                <b>$ <?php echo !empty($lastWithd) ? number_format($lastWithd, 2) : '0.00'; ?></b>
              </li>
            </ul>
          </div>
        </div>

      </div>
    
<div class="adv">

<h2 style="color: orange"> We've impacted the lives of <br> over 50,000 people worldwide!</h2>
<p> Instant pay, 100% payout. Member to member, incredible product </p>
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
          <form class="banners-form" onsubmit="return false;"><input type="hidden" name="form_id" value="15539630869986"><input type="hidden" name="form_token" value="23834ba6e4b3cadb4d7bbdb3bcb0e93c">
            <label>Banner code: </label>

            <div class="banner-item" id="banner-728x90" style="display: none;">
              <textarea class="banner-item-code" rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/logo.jpg" width="728" height="90" alt=""&gt;&lt;/a&gt;</textarea>
              <div class="banner-item-image"><a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"><img src="../assets/img/logo.jpg" width="728" height="90" alt=""></a></div>
            </div>

            <div class="banner-item" id="banner-468x60" style="">
              <textarea class="banner-item-code" rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/logo.jpg" width="468" height="60" alt=""&gt;&lt;/a&gt;</textarea>
              <div class="banner-item-image"><a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"><img src="../assets/img/logo.jpg" width="468" height="60" alt=""></a></div>
            </div>

            <div class="banner-item" id="banner-125x125" style="display: none;">
              <textarea class="banner-item-code" rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/logo.jpg" width="125" height="125" alt=""&gt;&lt;/a&gt;</textarea>
              <div class="banner-item-image"><a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"><img src="../assets/img/logo.jpg" width="125" height="125" alt=""></a></div>
            </div>

            <div class="banner-item" id="banner-120x120" style="display: none;">
              <textarea class=" banner-item-code">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/logo.jpg" width="120" height="120" alt=""&gt;&lt;/a&gt;</textarea>
              <div class="banner-item-image"><a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"><img src="../assets/img/logo.jpg" width="120" height="120" alt=""></a></div>
            </div>

            <div class="banner-item" id="banner-160x600" style="display: none;">
              <textarea class="banner-item-code" rows="1">&lt;a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"&gt;&lt;img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/160x600.gif" width="160" height="600" alt=""&gt;&lt;/a&gt;</textarea>
              <div class="banner-item-image"><a target="_blank" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/?u=<?php echo $ref; ?>"><img src="../assets/img/160x600.gif" width="160" height="600" alt=""></a></div>
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

function sponsors(){

  ?>
  <div class="container">
    <div class="acc-title" style="display: block">
      <h1 class="acc-title__txt">Your Team</h1><span style="font-size: 16px; font-style: italic; float:left!important"> This shows diagramatically your cycling </span>

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
              <span>Total Team Members</span>
              <b><?php $sum = $active_ref + $passive;
                  echo number_format($sum); ?></b>
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
          </div>
        </div>

        <div class="bl-bg share-bl">
          <div class="share-bl__referal referal referal--simple">
            <div class="referal__percent" style="margin-left: auto;">400%</div>
            <div class="referal__title">REFERRAL PROGRAM</div>
          </div><div style="clear:both"></div>
          <div class="share-bl__title">Click to copy your referral link to clipboard</div>
          <a style="height: 44px;" href="https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?>" id="ref-copy" data-clipboard-text="https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?>" class="btn btn--major btn--bl">Copy referral link</a>

          <br>

          <textarea style="height: 80px" class="input" onfocus="this.select();" onmouseup="return false;">https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?></textarea>
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


function credit()
{

	if($_GET['pg'] == 'invoice'){
    $trans_id = Transactions::getUserLastDepositId($_SESSION['pid']);
		Misc::generateInvoice($_SESSION['pid'], $trans_id);
	  die();
	}else{
  
  
  $depo_status =  Transactions::getUserLastDepositStatus($_SESSION['pid']);   
  if((($depo_status['status'] == 0) && ($_SESSION['status'] != UN_ACTIVATED)) || (isset($_SESSION['pledged']))){

//dash(); include_once('foot.php'); die();

  }

if(!isset($_GET['upgrade'])){

  if(isset($_SESSION['upgrade']) && isset($_GET['plan'])){
    $plan = $_GET['plan'];
    
    $new_ref = Transactions::getFreeRef($plan);
    $new_parent = Users::getUserParentByUid($new_ref);
    $user = Users::getUserById($_SESSION['pid']);
    
    if($plan != $user['matrix_level']){
    $deactivate_acct = Users::changeUserStatus($_SESSION['pid'], 0);
    
    $new_acct = Users::createAcct($user['name'], $user['email'], $user['username'], $user['password'], $new_ref, $new_parent, $user['phone'], $plan);

    $_SESSION['pid'] = $new_acct;
    $_SESSION['result'] = array(1, 'Account Upgraded Successfully');
    }
  }

    
  $user_plan = Users::getUserById($_SESSION['pid']);  
  // check for status and if spillover adv
  
      if(!isset($_SESSION['dep'])){
  
        $parent_status = Transactions::getUserLastDepositStatus($user_plan['ref_parent_id']);
        $count_parent_pledge = Transactions::countPledgesByType($user_plan['matrix_level'], $user_plan['ref_parent_id'], CONFIRM);
        
        if(($parent_status['status'] == 0) || ($count_parent_pledge >= 4) && $user_plan['user_type'] != 3){
          
          $user_plan['referer'] = Transactions::getFreeRef($user_plan['matrix_level']);
          $user_plan['ref_parent_id'] = Users::getUserParentByUid($user_plan['referer']);
        }

        //////////////////////// if a spillove rwishes to plege the 2nd ++ he should pay the parent if the refereral of that parent are already active
        $countRefererRef = Transactions::getActiveRefByUid($user_plan['referer']);

        if((!empty($user_plan['spillover'])) && ($user_plan['status'] == 1) && ($countRefererRef != 0)){
          
          $user_plan['referer'] = Transactions::getFreeRef($user_plan['matrix_level']);
          $user_plan['ref_parent_id'] = Users::getUserParentByUid($user_plan['referer']);
        }

  $name = Users::getUserFullnameById($user_plan['ref_parent_id']);
        
        if($name == 'Emmanuel Ejiofor'){
        	$user_plan['ref_parent_id'] = 18;
        	$user_plan['referer'] = 12;
        }
        
        
      $depo = Transactions::makePledge($_SESSION['pid'], $user_plan['ref_parent_id'], $user_plan['referer'],  $user_plan['matrix_level']);
      $_SESSION['depo'] = $depo;
  
      }
  

      if($_SESSION['depo'] > 0){
        $_SESSION['pledged'] = 1;
        $_SESSION['result'] = array(1, 'Successfully, please endeavour to redeem the pledge immediately to avoid being suspended!');
     
        Misc::generateInvoice($_SESSION['pid'], $_SESSION['depo']);

      }else{
      $_SESSION['result'] = array(2, 'An error occurred!');
      dash(); include_once('foot.php'); die();
      }
  
}




  ?>

  <div class="container">
    <div class="acc-title">
      <h1 class="acc-title__txt">Pledge</h1>
    </div>


    <div class="side-wr">
      <div class="side-wr__side">


        <?php
        $invest_plans = array();
        $invest_plans = Transactions::getInvestmentPlans();


        ?>

      </div>
      <div class="side-wr__mid">
        <div class="bl-title bl-title--lg"><span>Investment Plans</span></div>
        <div class="plan-wr">
          <div class="plan-wr__container">
            <div class="js-slider" style="display: flex!important; flex-flow: row wrap; justify-content: space-around; align-items: stretch;">
              <?php
              foreach ($invest_plans as $value) {

                  ?>
<div class="plan-card plan-card--simple">
                                      <div class="plan-card__head">
                                        <div class="plan-card__percent">$ <?php echo $value['min_deposit']; ?></div><br>
                                        <span style="font-size: .7em; color: blue"> <?php echo $value['plan_id'] == 1 ? 'N 12,500' : 'N 25, 000';?></span>
                                      </div>
                                      <ul class="plan-card__list">
                                        <li>
                                          <span>Pledge:</span>
                                          <b><?php echo number_format($value['min_deposit'], 2); ?> $</b>
                                        </li>
                                        <li>
                                        
                                          <span>Gain:</span>
                                          <b><?php echo ($value['plan_id'] != 3) ? number_format($value['exp_return'], 2) . ' $' : 'Unlimited' ?> </b>
                                        </li>
                                      </ul>
                                      <div class="plan-card__deposit" style="margin-bottom: 20px!important;"><a class="btn" href="?pg=pledge&plan=<?php echo $value['plan_id'];?>"> Pledge </a></div>

                                      </div>
                    <br>
                    

                  <?php
                }
                
                ?>
              
            </div>

          </div>
        </div>

      


    </div>
  </div>
  </main>
  </div>


<?php

          }
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






    <form method="post" action=""><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
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
                <input type="text" name="btc_addr" required="" placeholder="Please enter your bitcoin address" />
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
            <td><input type="number" name="amount" value="10.00" class="inpts" size="15" min="1" max="<?php echo $bal; ?>"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <button class="btn new-deposit__btn" onclick="window.confirm('Do you really want to perform this transaction?')">Request</button>
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
    //Misc::stopRefresh();
 if($_POST['action'] == 'acct'){
  $urname = $_POST['username'];
  $pwd = trim($_POST['password']);
  $cpwd = trim($_POST['password2']);
  $bank = ucwords($_POST['bank']);
  $acct_no = $_POST['acct_no'];
$btc = !empty($_POST['btc']) ? $_POST['btc'] : '';
  if (!empty($urname) && !empty($pwd) && !empty($cpwd) && !empty($bank) && !empty($acct_no)) {

    if ($pwd == $cpwd) {
      $upd = Users::updUserAcct($urname, $pwd, $_SESSION['pid'], $bank, $acct_no, $btc);
      $_SESSION['result'] = array('1', 'Update Completed Successfully!');

    }else{
      $_SESSION['result'] = array('2', 'Please crosscheck your password fields; They are different');
    }

  }

}elseif($_POST['action'] == 'person'){
  //var_dump($_POST);
  $name = ucwords($_POST['fname'].' '.$_POST['lname']);
  $phone = $_POST['phone'];
  
if (!empty($name) && !empty($phone)) {

  $upd_user = Users::updUserInfo($name, $phone, $_SESSION['pid']);
  if($upd_user > 0){
      $_SESSION['result'] = array('1', 'Update Completed Successfully!');
  }else{
    //var_dump($upd_user);
  }
    }
    }
    
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
      <!--<div class="side-wr__side">
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

      </div>-->
      <div class="side-wr__side" style="width: auto;">
        <div class="bl-bg acc-info">

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


        <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
          <input type="hidden" name="pg" value="edit_account">
          <input type="hidden" name="action" value="person">


          <div class="bl-title"><span>Update Personal Information</span></div>

          <div class="form-">
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
                <?php
$name = explode(' ', ($user_details['name']));
                ?>
                <tr>
                  <td>Your First Name:</td>
                  <td><input type="text" name="fname" value="<?php echo ucwords($name[0]); ?>" class="inpts" size="30" required="">
                  </td>
                </tr>

                <tr>
                  <td>Your Last Name:</td>
                  <td><input type="text" name="lname" value="<?php echo end($name); ?>" class="inpts" size="30" required="">
                  </td>
                </tr>

                <tr>
                  <td>Your Phone No:</td>
                  <td><input type="text" name="phone" value="<?php echo strtolower($user_details['phone']); ?>" class="inpts" size="30" required=""></td>
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
<style>
.side-wr__side{
  display: flex!important;
  flex-flow: row nowrap;
  justify-content: space-between!important;
  float:none;

}

.bl-bg acc-info{
  margin-left: 4px;
}
</style>
      <div class="side-wr__side" style="width: auto;">
        <div class="bl-bg acc-info">

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


        <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
          <input type="hidden" name="pg" value="edit_account">
          <input type="hidden" name="action" value="acct">


          <div class="bl-title"><span>Update Account Information</span></div>

          <div class="">
            <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
              <tbody>
                
                <tr>
                  <td>Your Username:</td>
                  <td><input type="text" readonly name="username" value="<?php echo strtolower($user_details['username']); ?>" class="inpts" size="30" required=""></td>
                </tr>


                <tr>
                  <td>New Password:</td>
                  <td><input type="password" name="password" value="" class="inpts" size="30" required=""></td>
                </tr>
                <tr>
                  <td>Retype Password:</td>
                  <td><input type="password" name="password2" value="" class="inpts" size="30" required=""></td>
                </tr>
                <tr>
                  <td>Your Bank :</td>
                  <td><input type="text" class="inpts" size="30" name="bank" value="<?php echo ($user_details['user_bank_name']); ?>"></td>
                </tr>

                <tr>
                  <td> Your Account No</td>
                  <td><input type="text" class="inpts" size="30" name="acct_no" value="<?php echo $user_details['user_bank_no'];?>"></td>
                </tr>
                <tr>
                  <td> Bitcoin Address :</td>
                  <td><input type="text" class="inpts" size="30" name="btc" value="<?php echo ($user_details['btc_addr']); ?>"></td>
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
  
  switch ($get_type) {
    case '1':
      $records = Transactions::getUserPayoutByStatus($_SESSION['pid'], CONFIRM, '?pg=transactions&trans_type=' . $get_type . '&');
      
      break;

    case '2':
      $records = Transactions::getUserReturn($_SESSION['pid'], '?pg=transactions&trans_type=' . $get_type . '&');
      
      break;

    case '4':
    $season = Transactions::getUserLastDepositId($_SESSION['pid']);
    
      $records = Transactions::getUserPendingReturns($_SESSION['pid'], $season, '?pg=transactions&trans_type=' . $get_type . '&');
      
      break;

      default:
// Pending payouts

$records = Transactions::getUserPayoutByStatus($_SESSION['pid'], PENDING, '?pg=transactions&trans_type=' . $get_type . '&');
      break;

  }

  $trans_type = array('Confirmed Pledges', 'returns', 'pending Pledges', 'pending returns');
  $months = Misc::getMonthNames();
  
  ?>

  <div class="container">
    <div class="acc-title">
      <h1 class="acc-title__txt">Earnings History</h1>

    </div>

    <div class="side-wr">
      <div class="side-wr__side">

        <form class="period-bl bl-bg" method="post" name="opts" action="?pg=transactions&page=1"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
          <div class="period-bl__title">Search Transaction</div>

          <input type="hidden" name="pg" value="transactions">

          <?php
//          Misc::getDateTable(Users::getUserRegDateById($_SESSION['pid']));
          ?>
          <label>Select transaction type</label>
          <div class="select-wr">
            <select name="trans_type" onchange="document.opts.submit();">
              <?php
              $v = 0;
              foreach ($trans_type as $value) {
                $v += 1;
                if ($v == $get_type) {
                  $selected =  'selected';
                  $_SESSION['type'] = $value;
                } else {
                  $selected = '';
                }
                ?>
                <option value="<?php echo $v; ?>" <?php echo $selected; ?>> <?php echo ucwords($value); ?></option>
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
<?php
if($get_type == 3){
  ?>
<th class="inheader" width=""><b>User Phone</b></th>
  <?php
}
?>
                  <th class="inheader" width=""><b>Transaction Type</b></th>
                
              </tr>
            
              <?php
            
$total = 0;
              foreach ($records[0] as $value) {
$amount = Transactions::getPlanAmountById($value['plan_id']);

if($get_type == 1 || $get_type == 4){
  $amount * 4;
}
$total += $amount;
                ?>
                  <tr>

                    <td align="center" valign="bottom"><b><small><?php echo date('M-d-Y', strtotime($value['reg_date'])); ?> </small></b></td>

                    <td align="right"><b>$ <?php echo number_format($amount, 2); ?></b> </td>
                    <?php
if($get_type == 3){
  ?>
                   <td> <?php echo Users::getUserById($value['user_id'])['phone']; ?> </td>
  <?php
}
?>
                    <td> <?php echo ucwords($_SESSION['type']); ?> </td>
                  </tr>

                <?php

            
            }
            ?>



              <tr>
                <td colspan="2">Total (for this period):</td>
                <td align="right"><b>$ <?php echo !empty($total) ? number_format($total, 2) : '0.00'; ?></b></td>
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

        <form class="period-bl bl-bg" method="post" name="opts" action="?pg=deposits&page=1"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
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
              <input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
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
                    <td style="text-align: center"><input type="checkbox" value="<?php echo $value['trans_id']; ?>" name="approve[]" /></td>
                  </tr>

                <?php
              }
              ?>


                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td style="text-align: right;" colspan="4"><button style="float: right; margin-right: 10px;" type="submit" value="Approve" class="period-bl__btn btn">Approve</button></td>
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

function withd(){

if(isset($_POST['user']) && !empty($_POST['user'])){
  $user = $_POST['user'];
  $season = $_POST['season'];
  $confirm = Transactions::confirmPaymentByUid($user, $season);
if($confirm > 0){
  $_SESSION['result'] = array(1, 'Payment Confirmed Successfully');
}else{
  $_SESSION['result'] = array(2, 'An error occurred, please retry');
}
}

$season = Transactions::getUserLastDepositId($_SESSION['pid']);
$receivable = array();
list($receivable, $paging) = Transactions::getUserPendingReturns($_SESSION['pid'], $season);

//var_dump($receivable);
  ?>
  <div class="container">

    <div class="acc-title" style="display: block">
      <h1 class="acc-title__txt"> Confirm Receivables</h1><span style="font-size: 16px; font-style: italic; float:left!important"> Please confirm your receivables here! </span>

    </div>

    
    <div class="side-wr">
      <div class="side-wr__mid" style="width:1150px;">
      <div class="alert alert--success alert--secure">
       Please if you have issues or contradictions with the payment, contact our support team for immediate response.
      </div>
        <div class="bl-bg">
       
          <table class="table--lg">
            <tbody>
              <tr>
              <th>S/No</th>
                <th>Username</th>
                <th>Name</th>
                <th> Phone No</th>
                <th> Amount</th>
                <th> Operation</th>
                
              </tr>

              <?php
              $i = 0;
              foreach ($receivable as $value) {
//var_dump($receivable);
$user = Users::getUserById($value['user_id']);

$amount = Transactions::getPlanAmountById($value['plan_id'])
                ?>
                <tr>
                <td>
<?php echo ++$i;?>
                </td>
                <td>
                    <?php echo ucwords($user['username']); ?>
                  </td>
                  <td>
                    <?php echo ucwords($user['name']); ?>
                  </td>
                  <td>
                    <?php echo $user['phone']; ?>
                  </td>

                  <td>
                    <?php echo number_format($amount, 2); ?>
                  </td>

                  <td>
                    <form method="post"> <input type="hidden" name="user" value="<?php echo $value['user_id']; ?> ">
      <input type="hidden" name="season" value="<?php echo $value['season']; ?> ">
                    <input type="submit" value="Confirm" name="confirm" class="btn" /> </form>
                  </td>

                  
                </tr>

              <?php
            }

          
            ?>
            </tbody>
          </table>

        </div>
        
      </div>
<?php
$user = Users::getUserById(2);
?>
<!--
      <style> li, span{font-size: 1em!important;} </style>  
      <div class="side-wr__side"  style="margin-left: 19px!important; margin-right:0px!important" >
        <div class="bl-bg acc-info">
          <div class="acc-info__icon"><img src="../assets/img/ic-account.png" alt=""></div>
          <div class="acc-info__name"> User Details</div>
          <div class="acc-info__email">&larr;Select user from the table</div>
          <ul class="acc-info__details">

          <li>
              <span> Username</span>
              <b><span id="username"></span></b>
            </li>
            <li>
              <span> Name</span>
              <b><span id="name"></span></b>
            </li>
            
            <li>
              <span> Account No</span>
              <b><span id="acct_no"></span></b>
            </li>
            <li>
              <span> Bank </span>
              <b><span id="bank"></span></b>
            </li>


          </ul>
        </div>
</div>
-->




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
                          <input type="date" value="<?php echo $_SESSION['from']; ?>" min="2015-01-01" name="from" required="" onchange="return $('#date_form').trigger('submit');" max="<?php echo date('Y-m-d', strtotime('today')); ?>" title="Change this to submit">

                        </div>
                      </div>

                      <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>-->
                      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                        <div class="form-group" style="float: right;" class="date">
                          <label class=""> To</label>
                          <input type="date" min="2015-01-01" value="<?php echo $_SESSION['to']; ?>" name="to" required="" max="<?php echo date('Y-m-d', strtotime('today')); ?>">

                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <h3 class="card-title text-center"><?php if ($_SESSION['status'] == CONFIRM) echo 'Confirmed';
                                                  else echo 'Pending'; ?> Deposits<br> As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></h3>
              <style>
                td {
                  text-align: center;
                }
              </style>

              <div class="row">
                <div class="col-sm-12" style="margin: 0 auto;">
                  <form action="?pg=config" method="post"><input type="hidden" name="approval" value="1" /><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                    <div class="table-responsive">
                      <table class=" table stylish-table table-bordered  table-striped" id="dataTables-example">
                        <thead>
                          <tr>
                            <th> S/N&otilde;</th>
                            <th> Username</th>
                            <th> Email Address</th>
                            <th> Investment Plan</th>
                            <th> <?php if ($_SESSION['status'] == CONFIRM) echo 'Payment Date';
                                  else echo 'Invoice Date'; ?></th>
                            <th> Amount</th>
                            <th title="BTC Equiv As From Invoice date"> BTC Amount</th>

                            <th> <?php if ($_SESSION['status'] == CONFIRM) echo 'PayOut Time';
                                  else echo 'Confirm'; ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          //payment date, delay  ==> for confirmed persons
                          if ($depo != NULL) {
                            $i = 0;
                            foreach ($depo as $value) {

                              $payout = (strtotime($value['due_date'])) - time();
                              $payout = Misc::secondsToTime3($payout);
                              ?>
                              <tr>
                                <td> <?php echo ++$i; ?></td>
                                <td> <?php echo Users::getNicnameById($value['client_id']) ?></td>
                                <td> <?php echo Users::getUserEmailById($value['client_id']) ?></td>
                                <td> <?php echo ucwords(Transactions::getPlanNameById($value['plan_id'])); ?></td>
                                <td> <?php if ($_SESSION['status'] == CONFIRM) {
                                        $date = 'paymt_date';
                                      } else {
                                        $date = 'reg_date';
                                      }
                                      echo date('Y/m/d', strtotime($value["$date"])); ?></td>
                                <td>$ <?php echo number_format($value['amount'], 2); ?></td>
                                <td> <?php echo $value['btc_amt']; ?></td>
                                <td> <?php if ($_SESSION['status'] != CONFIRM) { ?> <input type="checkbox" name="approve[]" value="<?php echo $value['trans_id']; ?>" /><?php } else {
                                                                                                                                                                        echo $payout;
                                                                                                                                                                      } ?> </td>
                                <td>&nbsp;</td>
                              </tr>

                            <?php
                          }
                          ?>
                            <tr>
                              <td colspan="8" class="text-right"><?php if ($_SESSION['status'] == PENDING) { ?> <input type="submit" value="Confirm" class="btn btn-primary" /><?php } ?> </td>
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
                <select class="custom-select pull-right" name="status" onchange="return $('#form1').trigger('submit');">
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
                        <input type="date" value="<?php echo $_SESSION['from']; ?>" min="2015-01-01" name="from" required="" onchange="return $('#date_form').trigger('submit');" max="<?php echo date('Y-m-d', strtotime('today')); ?>" title="Change this to submit">

                      </div>
                    </div>

                    <!-- <label for="date1" class="" > From: &nbsp;<input type="date" class="" id="date1"/></label>-->
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

                      <div class="form-group" style="float: right;" class="date">
                        <label class=""> To</label>
                        <input type="date" min="2015-01-01" value="<?php echo $_SESSION['to']; ?>" name="to" required="" max="<?php echo date('Y-m-d', strtotime('today')); ?>">

                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <h3 class="card-title text-center"><?php if ($_SESSION['status'] == CONFIRM) echo 'Confirmed';
                                                else echo 'Pending'; ?> Withdrawals<br> As From <?php echo date('F d, Y', strtotime($_SESSION['from'])); ?> To <?php echo date('F d, Y', strtotime($_SESSION['to'])); ?></h3>
            <style>
              td {
                text-align: center;
              }
            </style>

            <div class="row">
              <div class="col-sm-12" style="margin: 0 auto;">
                <form action="?pg=config" method="post"><input type="hidden" name="approval" value="1" /><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                  <div class="table-responsive">
                    <table class="table stylish-table table-bordered  table-striped" id="dataTables-example">
                      <thead>
                        <tr>
                          <th> S/N&otilde;</th>
                          <th> Username</th>
                          <th> Email Address</th>

                          <th> <?php if ($_SESSION['status'] == CONFIRM) echo 'Confirmation Date';
                                else echo 'Request Date'; ?></th>
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
                        if ($depo != NULL) {
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
                                    echo date('Y/m/d', strtotime($value["$date"])); ?></td>
                              <td>$ <?php echo number_format($value['amount'], 2); ?></td>

                              <?php if ($_SESSION['status'] != CONFIRM) {
                                ?>
                                <td>$<?php echo number_format(Misc::calcUserBal($value['client_id'], 3), 2); ?></td>
                                <td> <?php echo Users::getBitcoinByUid($value['client_id']); ?></td>
                                <td> <input type="checkbox" name="approve[]" value="<?php echo $value['trans_id']; ?>" /> </td>


                              <?php
                            }
                            ?>
                              <td>&nbsp;</td>
                            </tr>

                          <?php
                        }
                        ?>
                          <tr>
                            <td colspan="9" class="text-right"> <?php if ($_SESSION['status'] == PENDING) { ?> <input type="submit" value="Confirm" class="btn btn-primary" /><?php } ?> </td>
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
              <select class="custom-select pull-right" name="status" onchange="return $('#form1').trigger('submit');">
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
                  <th> Phone No</th>
                  <th> Payee</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($depo != NULL) {
                  $i = 0;
                  foreach ($depo as $value) {
                    
                    ?>
                    <tr>
                      <td> <?php echo ++$i; ?></td>
                      <td> <?php echo $value['username']; ?></td>
                      <td> <?php echo ucwords($value['name']); ?></td>
                      <td> <?php echo $value['email']; ?></td>
                      <td> <?php echo $value['phone']; ?></td>
                      <td> <?php echo ucwords(Users::getNicnameById($value['ref_parent_id'])); ?></td>
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

function email()
{

  if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
    //Misc::stopRefresh();
    $subj = $_POST['subj'];
    $msg = $_POST['message'];
    $type = $_POST['type'];

    if (!empty($subj) && !empty($msg) && !empty($type)) {
      $name = array();
      $addr = array();
      if ($_POST['type'] != 1) {

        $addrs = $_POST['addr'];
        $savedAddr = $addrs;
        $all = 0;
        $addr = explode(';', $addrs);

        foreach ($addr as $value) {
          $name[] = Users::getUserFullNameByEmail($value);
        }
      } else {
        $addr = Users::getAllUserEmail();
        $usr = Users::getAllUserFullName();
        foreach ($usr as $value) {
          $name[] = $value['name'];
        }
        $savedAddr = '';
        $all = 1;
      }

      $send = Misc::sendMail($msg, $subj, $addr, $name);

      if ($send) {
        $save = Misc::recordMail($subj, $msg, $savedAddr, $all);
        $_SESSION['result'] = array('1', 'Mail Successfully Sent!');
      } else {

        $_SESSION['result'] = array('2', 'An error occurred!, Mail Not Sent!');
      }
    }
  } // getUserFullNameByEmail($addr)

  Misc::setToken();
  ?>
  <link rel="stylesheet" href="../assets/vendor/cleditor/jquery.cleditor.css" />
  <link rel="stylesheet" href="../css/vendor/cleditor/jquery.cleditor-hack.css" />

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

      <form method="post" action="" name="mainform" id="support-form" class="form-wr"><input required type="hidden" name="pg_lvl" value="1"><input required type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
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
        <div style="clear: both"></div>
        <div id="addr_content" style="margin: -15px;">
          <div class="form-wr" id="address">

          </div>
        </div>

        <label for="message" style="clear: both;">Message</label>
        <textarea name="message" data-label="Message" required="" id="message" placeholder="Enter the message here"></textarea>

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

    $name =  $_POST['fullname'];
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
                  <option value="<?php echo $value['user_id'] ?>" accesskey="<?php echo substr($value['name'], 0, 1) . '"' . $selected; ?> title=" <?php echo $value['email']; ?>"> <?php echo $value['username']; ?></option>
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

        <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
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
                  <td><input type="email" name="email" readonly="" value="<?php echo $user_details['email']; ?>" class="inpts" size="30" required=""></td>
                </tr>
                <tr>
                  <td>Full Name:</td>
                  <td><input type="text" name="fullname" value="<?php echo ucwords($user_details['name']); ?>" class="inpts" size="30" required="">
                  </td>
                </tr>

                <tr>
                  <td>Account Name:</td>
                  <td><input type="text" name="username" value="<?php echo strtolower($user_details['username']); ?>" class="inpts" size="30" required=""></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="text" name="password2" value="<?php echo $user_details['password']; ?>" class="inpts" size="30"></td>
                </tr>
                <tr>
                  <td> Bitcoin address:</td>
                  <td><input type="text" class="inpts" size="30" name="btc_addr" value="<?php echo ($user_details['btc_no']); ?>"></td>
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
  $my_spills = array();
  $spill = Transactions::countSpilloverByUid($_SESSION['pid']);
  
  $my_refs = array();
  $my_refs = Transactions::getAllMyRefereeByUid($_SESSION['pid']);
  $my_spills = Transactions::getSpilloverByUid($_SESSION['pid']);

  ?>

  <div class="container">
    <div class="acc-title" style="display: block">
      <h1 class="acc-title__txt">Your Referrals</h1><span style="font-size: 16px; font-style: italic; float:left!important"> This contains the list of your direct referrals</span>

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
                  echo number_format($sum); ?></b>
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
          <div class="ref-stat__img"><img src="../assets/img/ic-ref-3.png" alt=""></div>
            <div>
              <span> Spillovers</span>
              <b> <?php echo number_format($spill); ?></b>
            </div>
          </div>
        </div>

        <div class="bl-bg share-bl">
          <div class="share-bl__referal referal referal--simple">
            <div class="referal__percent" style="margin-left: auto;">400%</div>
            <div class="referal__title">REFERRAL PROGRAM</div>
          </div><div style="clear:both"></div>
          <div class="share-bl__title">Click to copy your referral link to clipboard</div>
          <a style="height: 44px;" href="https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?>" id="ref-copy" data-clipboard-text="https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?>" class="btn btn--major btn--bl">Copy referral link</a>

          <br>

          <textarea style="height: 80px" class="input" onfocus="this.select();" onmouseup="return false;">https://<?php echo $_SERVER['SERVER_NAME'] . '?u=' . Users::getRefLinkByUid($_SESSION['pid']); ?></textarea>
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
                    <?php echo ucwords($value['username']); ?>
                  </td>
                  <td>
                    <?php echo strtolower($value['email']); ?>
                  </td>
                  <td>
                    <?php echo strtoupper(($value['status'] == 1) ? 'Active' : 'Un-activated'); ?>
                  </td>
                </tr>

              <?php
            }
            
            foreach ($my_spills as $value) {

              ?>
              <tr>
                <td>
                  <?php echo ucwords($value['username']); ?>
                </td>
                <td>
                  <?php echo strtolower($value['email']); ?>
                </td>
                <td>
                  Spill Over
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

    $name =  $_POST['plegder'].'|'.$_POST['recip'];
    $plan = $_POST['plan'];
    $type = $_POST['type'];
if($type == 1){
  
  $generate = Transactions::addAdminTrans($name, $plan, PENDING);
  //var_dump($generate); die();
}else{
  $generate = Transactions::addAdminTrans($name, $plan, CONFIRM);
}
    

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
      <h1 class="acc-title__txt"> Generate Transaction</h1>

    </div>

    <div class="side-wr">
      <div class="side-wr__side" style="width: auto;">
        <div class="bl-bg profit-bl__item profit-bl__item--earned" style="display: flex; float: left; flex-flow: row; align-items: center; justify-content: center;">
          <div class="acc-info__icon"><img src="../assets/img/ic-account.png" height="50px" width="50px" alt=""></div>
        </div>
      </div>
      <div class="side-wr__mid" style="width: 700px; ">
        <div class="support-form">

          <form method="post" name="editform" class="cabinet-form"><input type="hidden" name="pg_lvl" value="1"><input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>">
            <input type="hidden" name="pg" value="generate">

            <div class="form-wr">
              <table cellspacing="0" cellpadding="2" border="0" class="table--lg">
                <tbody>

                  <tr>
                    <td> Username:</td>
                    <td><input type="text" name="plegder" class="inpts" size="30" required=""></td>
                  </tr>

                  <tr>
                    <td> Recipient:</td>
                    <td><input type="text" name="recip" class="inpts" size="30" required=""></td>
                  </tr>

                  <tr>
                    <td> Matrix Level</td>
                    <?php
$plans = Transactions::getInvestmentPlans();

                    ?>
                    <td>
                      <select name="plan" class="inpts">
                      <?php
                      foreach($plans as $value){
?>
<option value="<?php echo $value['plan_id'];?>"> <?php echo $value['name'];?> &nbsp;($<?php echo $value['min_deposit'];?>)</option>
<?php
                      }
                      ?>
                        
                      </select>

                    </td>
                  </tr>

                  <tr>
                    <td> Transaction Type</td>
                    <td>
                      <select name="type" class="inpts">
                        <option value="1">Pledge</option>
                        <option value="2">Payout</option>
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
