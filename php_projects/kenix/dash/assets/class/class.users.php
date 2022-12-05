<?php
class Users
{

    public static function createAcct($name, $email, $pet, $pwd, $phone, $plan)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO users (name, email, username, password, user_type, reg_date, status, phone,  matrix_level) VALUES(:name, :mail, :urname, :pwd, :ulevel, NOW(), :status, :phone, :plan)');
        $insert->bindValue(':name', $name, PDO::PARAM_STR);
        $insert->bindValue(':mail', $email, PDO::PARAM_STR);
        $insert->bindValue(':urname', $pet, PDO::PARAM_STR);
        $insert->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $insert->bindValue(':ulevel', CLIENT, PDO::PARAM_INT);
        $insert->bindValue(':phone', $phone, PDO::PARAM_STR);

        $insert->bindValue(':plan', $plan, PDO::PARAM_INT);
        $insert->bindValue(':status', 2, PDO::PARAM_STR);

        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;
    }

    public static function authAcct($urname, $pwd)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id, user_type, status FROM users WHERE username = :mail AND password = :pwd AND status != 0');
        $get->bindValue(':mail', $urname, PDO::PARAM_STR);
        $get->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $get->execute();

        $list = array();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $list = $row;

        $db = null;
        return $list;
    }

    public static function getUserById($id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM users WHERE user_id = :uid');
        $get->bindValue(':uid', $id, PDO::PARAM_INT);

        $get->execute();
        $result = array();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row;

        $db = null;
        return $result;
    }

    public static function getUserIdByEmail($email)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE email = :mail');
        $get->bindValue(':mail', $email, PDO::PARAM_STR);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $result = $row['user_id'];

        $db = null;
        return $result;
    }
    public static function getAdminAccts()
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT * FROM users WHERE user_type = :level ORDER BY name ASC ');

        $get->bindValue(':level', ADMIN, PDO::PARAM_INT);

        $get->execute();
        $result = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

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

    public static function getUidByNicname($pet)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT user_id FROM users WHERE username = :id');
        $get->bindValue(':id', $pet, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['user_id'];

        $db = null;
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

        $db = null;
        return $name;
    }

    public static function changeUserPlanById($plan, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET matrix_level = :plan WHERE user_id = :uid');
        $upd->bindValue(':plan', $plan, PDO::PARAM_INT);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();

        $db = null;
        return $test;
    }

    public static function changeUserTypeById($type, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET user_type = :plan WHERE user_id = :uid');
        $upd->bindValue(':plan', $type, PDO::PARAM_INT);
        $upd->bindValue(':uid', $uid, PDO::PARAM_INT);
        $upd->execute();

        $test = $upd->rowCount();

        $db = null;
        return $test;
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
        $sql = "SELECT * FROM users WHERE user_type = 2 AND status = 1 ORDER BY user_id DESC";
        $table = 'users';
        $limit = 50;
        $count = 'SELECT COUNT(*)AS "num" FROM users WHERE user_type = 2 AND status = 1';
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
        $get = $db->query('SELECT name, user_id, email, username FROM users WHERE user_level = 2');

        $list = array();
        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        $db = null;
        return $list;
    }

    public static function updateUserAcct($pet, $pwd, $uid)
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

    public static function updateUser($name, $email, $phone, $bank, $acctno, $uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE users SET name = :urn, phone = :phone, email = :mail, bank = :bank, acct_no = :acctno WHERE user_id = :uid');
        $upd->bindValue(':urn', $name, PDO::PARAM_STR);
        $upd->bindValue(':phone', $phone, PDO::PARAM_STR);
        $upd->bindValue(':mail', $email, PDO::PARAM_STR);
        $upd->bindValue(':bank', $bank, PDO::PARAM_STR);
        $upd->bindValue(':acctno', $acctno, PDO::PARAM_STR);
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

    public static function getUserStatusById($uid)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $get = $db->prepare('SELECT status FROM users WHERE user_id = :id');
        $get->bindValue(':id', $uid, PDO::PARAM_INT);

        $get->execute();

        $row = $get->fetch(PDO::FETCH_ASSOC);
        $name = $row['status'];

        $db = null;
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

        $db = null;
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

}

class Misc
{

    

    public static function generateInvoice($pledge_id)
    {
        $matched = Pledge::getPledgeById($pledge_id);

        $details = Users::getUserById($matched['receiver_id']);
        $plan_details = InvestmentPlan::getPlanById($matched['plan_id']);
        $day = date('Y/m/d', strtotime('today'));

        ?>
<style>
header,
.menu-sidebar,
.foot-alert,
.header-mobile {
    display: none !important;
}

.modal-title {
    text-transform: uppercase;
    font-size: 3em;
    color: red;
    //text-align: right !important;
    display: flex;
    flex-flow: nowrap row;
    justify-content: center;
    align-items: center;
}

.modal-body {

    padding: 20px;
}

.login-content {
    background: skyblue;
    margin: -5px -10px;

}
}

label,
input {
    color: black !important;
}

@media(print) {
    .login-logo {
        display: block;
    }
}
</style>

<button type="button" style="display: none;" class="btn btn-secondary mb-1 btn-modal" data-toggle="modal"
    data-target="#staticModal1">
    Static
</button>


<div class="modal fade" style="margin: 0 auto!important; font-weight: normal;" id="staticModal1" tabindex="-1"
    role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document" /*style="margin: 0 auto!important;
        */font-weight: bold;">
        <div class="modal-content"
            style="background-image: linear-gradient('to top right, #adba, #fffa'), url('images/slide4.jpg');">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticModalLabel"> <i class="fa fa-lock fa-2x"></i>
                    <span>Account Locked!</span></h5>
                <a href="?pg=exit" class="close danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-power-off" style="color: red"></i></span>
                </a>

            </div>

            <div class="modal-body" id="printable">
                <div class="login-content">
                    <div class="login-logo">

                        <b style="clear: both; display: block;"> Please fulfil this pledge to unlock your account </b>
                    </div>
                    <div class="login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Name </label>
                                <p class="au-input au-input--full form-control-static"><?php echo $details['name']; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label> Phone No</label>

                                <p class="au-input au-input--full form-control-static"><?php echo $details['phone']; ?>
                                </p>

                            </div>
                            <div class="form-group">
                                <label>Bank Account No</label>

                                <p class="au-input au-input--full form-control-static">
                                    <?php echo !empty($details['acct_no']) ? ($details['acct_no']) : '<i> Not Specified</i>' ?>
                                </p>
                            </div>

                            <div class="form-group">
                                <label>Bank Name</label>

                                <p class="au-input au-input--full form-control-static">
                                    <?php echo !empty($details['bank']) ? ucwords($details['bank']) : '<i> Not Specified</i>'; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label> Amount (&#8358;) </label>

                                <p class="au-input au-input--full form-control-static">
                                    <?php echo number_format($plan_details['min_deposit'], 2); ?></p>
                            </div>
                            <div class="login-checkbox">
                                <label style="text-align:center; color: red; margin: 0 auto;">
                                    <strong> Make this payment on or before <br>
                                        <?php echo date('M d, Y', strtotime($matched['due_date'])); ?><br>to aviod being
                                        suspended
                                </label>
                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer flex justify-content-around">
                <a href="?pg=exit" type="button" class="btn btn-secondary btn-danger"><i class="fa fa-power-off"
                        style="color: #fff;"></i></a>
                <button type="button" class="btn btn-success" title="Download as pdf"><i class="fa fa-download"
                        onclick="Export();"></i></button>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>
<script type="text/javascript">
function Export() {
    html2canvas(document.getElementById('printable'), {
        onrendered: function(canvas) {
            var data = canvas.toDataURL();
            var docDefinition = {
                content: [{
                    image: data,
                    width: 500
                }]
            };
            pdfMake.createPdf(docDefinition).download("kinex_deposit_order_<?php echo $day; ?>.pdf");
        }
    });
}
</script>
<?php

        include 'foot.php';
        die();
    }

    public static function invest_req()
    {
        ?>

<style>
header,
.menu-sidebar,
.foot-alert,
.header-mobile {
    display: none !important;
}

.acct_expire span {
    font-size: 2.8em;

    display: flex;
    flex-flow: nowrap column;
    align-items: center;
    font-weight: bolder;
    text-transform: uppercase;
    color: red;
}

#activate {
    background-image: url('../assets/images/kinex/logo1.jpg') !important;
    background-size: content;
}
</style>
<button type="button" style="display: none;" class="btn btn-secondary mb-1 btn-modal" data-toggle="modal"
    data-target="#staticModal1">
    Static
</button>


<div class="modal fade" style="margin: 0 auto!important; font-weight: normal;" id="staticModal1" tabindex="-1"
    role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document" /*style="margin: 0 auto!important;
        */font-weight: normal;">
        <div class="modal-content" id="activate">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticModalLabel"> <i class="fa fa-lock fa-3x"
                        style="color: red;"></i>
                </h5>
                <a href="?pg=exit" class="close danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-power-off" style="color: red" title="Log Out"></i></span>
                </a>

            </div>

            <div class="modal-body" id="printable">
                <div class="login-content" style="background: none;">
                    <div class="login-logo acct_expire">

                        <span>

                            Account</span><span>
                            <?php echo ($_SESSION['status'] == ACTIVE) ? 'Deactivated!' : 'Not Activated!'; ?>
                        </span>
                        <br>

                    </div>

                </div>
            </div>
            <div class="modal-footer flex justify-content-around">
                <p style="font-size: 1.3em; font-style: italic;"> Please invest to activate</p>
                <form method="post" action=""> <input type="hidden" name="invest" value="1" />
                    <button type="submit" class="btn btn-secondary btn-danger"><i class="fa fa-reply"
                            style="color: #fff;"></i>
                        Invest</button></form>

            </div>

        </div>
    </div>
</div>
<?php

        include 'foot.php';
        die();

    }

    public static function makeInvest($user)
    {

        if (isset($_SESSION['pledged'])) {
            echo '<script type="text/javascript"> window.location="?pg=exit"; </script>';
            die();
        }

        if (isset($_POST['plan']) && !empty($_POST['plan'])) {
            $plan = $_POST['plan'];

            $delay = InvestmentPlan::getPlanById($plan)['delay'];
            $due_date = time() + 2 * 24 * 60 * 60;

            if ($_SESSION['user_level'] == ADMIN) {

                $old_plan = Users::getUserPlanByUid($user);
                if ($old_plan != $plan) {
                    Users::changeUserPlanById($plan, $user);
                }

                $pledge = array($user, 1, 1, $plan, date('Y-m-d H:i:s', $due_date));

                $trans_id = Transaction::addAdminTransaction($pledge, date('Y-m-d H:i:s', $due_date));
                $type = ($_SESSION['user'] == 1) ? 1 : 2;
                $add_repay = Repayment::addRepayment($trans_id, $type);

                $_SESSION['result'] = array(1, 'Account Recycled successfully');
                $_SESSION['pledged'] = true;
                home();
                include_once 'foot.php';die();
            }

            $admin_pause = Repayment::checkAdminPause();
            $repayment = Repayment::getNxtActiveRepayment($plan);
            
            if (!empty($admin_pause)) {
                $trans = Transaction::getTransactionById($admin_pause);
                $receiver_trans_id = $trans['id'];
                $recipient = $trans['receiver_id'];

            } elseif (!empty($repayment) && count($repayment) > 0) {
                $receiver_trans_id = $repayment['id'];
                $recipient = $repayment['pledger_id'];
                $add_count = Repayment::updRepayment($repayment['id']);

                $count = Repayment::getRepaymentByTrans($repayment['id']);
                if (($count['count'] > 1) && ($count['type'] != 1)) {
                    $end = Repayment::changeRepaymetStatus($repayment['id']);
                }

            } else {
                // get unfinished rpaymnet
                
                $receiver = Redirect::getNxtRedirect($plan);
                $recipient = $receiver['receiver_id'];

                
                if ($recipient == null) {
                    $recipient = 1;
                } else {
                    $increment = Redirect::incrementRedirect($receiver['id']);
                    
                }
            }

            $add_credit = Pledge::makePledge($user, $recipient, $plan, date('Y-m-d H:i:s', $due_date));

            if ($add_credit > 0) {
                $_SESSION['pledged'] = 1;
                $old_plan = Users::getUserPlanByUid($user);
                if ($old_plan != $plan) {
                    Users::changeUserPlanById($plan, $user);
                }

                $_SESSION['result'] = array(1, 'successful');
                Misc::generateInvoice($add_credit);

            }
        }
        ?>
<style>
.au-card {
    background: none;

}

.au-card .au-task {
    border-top: 1px dashed blue;
    background: #fff;
    text-align: center;
}

.task-title {
    color: rgba(122, 132, 104, .5);
    text-shadow: 2px 2px 8px #ff000;
    font-size-adjust: .8;
}


.au-task__footer {
    padding-top: 0px;
    margin-top: -10px;
}

.bg-overlay {
    background: black !important;
}

.plan-wr {
    padding: 50px 0;
    /*! background:#dee9f9 */
}

.plan-card {
    float: left;
    width: 250px;
    height: 320px;
    padding: 20px 22px;
    margin: 0 15px 26px;
    box-shadow: 0 0 7px rgba(221, 222, 223, .5);
    border: 1px solid #dce6f7;
    background-color: #fff;
    border-radius: 4px;
    position: relative;
    z-index: 20;
    margin-bottom: 50px;
}

.plan-card ul {
    list-style-type: none;
    font-size: 18px
}

.plan-card ul li {
    width: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center
}

.plan-card__row .col-6:nth-child(2n+1) {
    clear: both
}

.plan-card:hover .plan-card__head {
    background-color: #238dd1;
    box-shadow: 0 14px 10px -10px rgba(49, 54, 230, .89)
}

.plan-card__head {
    padding: 13px 15px 12px;
    margin-bottom: 25px;
    background-color: orange;
    border-radius: 4px;
    box-shadow: 0 14px 10px -10px rgba(254, 18, 81, .89);
    text-align: center;
    text-transform: uppercase;
    transition: .5s background-color;
    color: #724f1e;
    line-height: .8;
    font-family: "Bebas Neue", sans-serif;
    font-size: 32px;
    color: #fff;
}

.plan-card__percent {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, .25);
    color: #fff;
    font-family: "Bebas Neue", sans-serif;
    font-size: 30px;
    line-height: 2;
    margin-top: -50px;
    border-radius: 2px;
    border: 2px groove goldenrod;
    color: yellow;
    background: black;
}

.plan-card__deposit {
    padding: 16px 0;
    margin-top: 16px;
    border-top: 1px solid #ccc;
    text-align: center;
    text-transform: uppercase;
    color: #5d5d5c;
    font-size: 16px
}

.plan-card__btn {
    height: 52px;
    padding: 15px 20px;
    border: none;
    font-size: 15px;
    font-weight: 400;
    position: absolute;
    left: 22px;
    right: 22px;
    bottom: -26px;
    width: 80%;
}

.plan-card__body {
    width: 250px;
    min-height: 290px;
    position: relative;
    -ms-flex: none;
    flex: none
}

.plan-card__details {
    display: none;
    -ms-flex: auto;
    flex: auto;
    margin: 0 0 0 20px
}

.plan-card--large,
.plan-over {
    display: -ms-flexbox;
    display: flex
}

.plan-card--large {
    float: none;
    width: 100%;
    max-width: 100%;
    height: auto;
    margin: 0 0 50px
}

.plan-card--large .plan-card__body {
    width: 200px;
    min-height: 270px
}

.plan-card--large .plan-card__details {
    display: block
}

.plan-card--large .plan-card__btn {
    bottom: -43px
}

.plan-card--simple:hover .plan-card__overlay {
    display: none;
    cursor: pointer !important
}

.plan-over {
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    padding: 20px 22px;
    border-radius: 4px;
    background: #fff url(assets/images/bg-plan-overlay.jpg) center no-repeat;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 21
}

.plan-over__percent,
.plan-over__txt {
    font-family: "Bebas Neue", sans-serif;
    color: #9b9b9b
}

.plan-over__percent {
    line-height: .8;
    font-size: 74px
}

.plan-over__txt {
    font-size: 32px
}

.plan-over__btn {
    background-color: #9b9b9b;
    border: none;
    color: #fff
}

.plan-details__title {
    color: #4c4c4c;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase
}

.plan-details__table {
    margin-top: 15px;
    color: #5d5d5c;
    font-size: 14px;
    font-weight: 600;
    width: 100%
}

.plan-details__table td {
    height: 39px;
    padding: 0 10px;
    white-space: nowrap;
    color: #5d5d5c
}

.plan-details__table td:last-child {
    color: #5d5d5c
}

.plan-over__btn {
    background: #2CCC00;
    font-size: 1.2em;
    transition: all .6s ease-in;
}

.plan-over__btn:hover,
.plan-over__btn:focus {
    background: darkred;
    color: goldenrod;
}

.m1 {
    background: #3B5889;
}

.m2 {
    background: #CC6800;
}

.m3 {
    background: #6B1213;
}

.m4 {
    background: red;
}

.m5 {
    background-color: black;
}
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Invest</h2>

                    </div>
                </div>
            </div>
            <div class="m-t-20">
                <p> Select an investment platform </p>
            </div>
            <div class="row m-t-0">
                <div class="plan-wr">
                    <div class="container plan-wr__container">
                        <div class="js-slider owl-carousel"
                            style="display: flex; flex-flow: row wrap; justify-content: center; align-items: center">


                            <?php
$plans = InvestmentPlan::getAll();

        foreach ($plans as $plan) {
            ?>

                            <div class="col-sm-4 col-lg-4 col-md-4">


                                <div class="plan-card plan-card--simple" title="Click to get started">
                                    <form method="post" action="" id="<?php echo $plan['id']; ?>">
                                        <input type="hidden" name="invest" value="<?php echo $plan['id']; ?>" />

                                        <input type="hidden" name="plan" value="<?php echo $plan['id']; ?>" />
                                    </form>

                                    <div id="" class="plan-card__head m<?php echo $plan['id']; ?>">
                                        <div style="padding: 20px 10px; background: gray  ;">
                                            <div class="plan-card__percent m<?php echo $plan['id']; ?>">
                                                <?php echo strtoupper($plan['name']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="plan-card__list">
                                        <li>
                                            <span>Deposit:</span>
                                            <b>&#8358;
                                                <?php echo number_format($plan['min_deposit']); ?></b>
                                        </li>
                                        <li>
                                            <span><b> Profit</b></span>
                                            <b> &#8358;
                                                <?php echo number_format($plan['min_deposit'] * 2); ?></b>
                                        </li>
                                    </ul>
                                    <div class="plan-card__deposit" style="color: blue; font-size: 2.1em;"><b>
                                            &#8358; <?php echo number_format($plan['min_deposit']); ?></b>
                                        <span
                                            style="color: darkred; display: block; margin-top: -5px; font-size: .7em!important; clear: both!important; text-transform: lowercase; font-style: italic;">
                                            @ 200% Profit </span>
                                    </div>



                                    <button onclick="return $('#<?php echo $plan['id']; ?>').trigger('submit');"
                                        class="plan-card__btn plan-over__btn btn btn--bl">Invest
                                        now</button>

                                </div>
                            </div>
                            <?php
}
        ?>

                        </div>
                    </div>



                    <?php
include_once 'foot.php';die();
    }


    public static function getDueTransaction(){

    $actives = Pledge::getExpiringTransactions();
    $compare = array();
    $a = 0;
    if (!empty($actives)) {
        foreach ($actives as $trans) {
            $test_pledge = Pledge::checkActiveTrans($trans);
            if (count($test_pledge) <= 0) {
                $compare[] = $trans;
            }
        }
    }

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
        if (is_array($to)) {
            foreach ($to as $person) {

                $send = mailer::sendViaDefault(CORP, $name[$i] . ' <' . $person . '>', $subj, $msg);
                $i += 1;
            }
        } else {
            $send = mailer::sendViaDefault(CORP, $name . ' <' . $to . '>', $subj, $msg);
        }
        //$send = mailer::sendviaSwift($to, $from, $subj, '', $msg, '');
        if ($send) {
            return (true);
        } else {
            return $send;
        }
    }

    public static function paginator($tbl_name, $targetpage, $limit, $sql, $count = '')
    {
        ?>
<style>

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px
}

.pagination>li {
    display: inline
}

.pagination>li>a,
.pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd
}

.pagination>li:first-child>a,
.pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px
}

.pagination>li:last-child>a,
.pagination>li:last-child>span {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px
}

.pagination>li>a:focus,
.pagination>li>a:hover,
.pagination>li>span:focus,
.pagination>li>span:hover {
    z-index: 2;
    color: #23527c;
    background-color: #eee;
    border-color: #ddd
}

.pagination>.active>a,
.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span,
.pagination>.active>span:focus,
.pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7
}

.pagination>.disabled>a,
.pagination>.disabled>a:focus,
.pagination>.disabled>a:hover,
.pagination>.disabled>span,
.pagination>.disabled>span:focus,
.pagination>.disabled>span:hover {
    color: #777;
    cursor: not-allowed;
    background-color: #fff;
    border-color: #ddd
}

.pagination-lg>li>a,
.pagination-lg>li>span {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333
}

.pagination-lg>li:first-child>a,
.pagination-lg>li:first-child>span {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px
}

.pagination-lg>li:last-child>a,
.pagination-lg>li:last-child>span {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px
}

.pagination-sm>li>a,
.pagination-sm>li>span {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5
}

.pagination-sm>li:first-child>a,
.pagination-sm>li:first-child>span {
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px
}

.pagination-sm>li:last-child>a,
.pagination-sm>li:last-child>span {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px
}

.pager {
    padding-left: 0;
    margin: 20px 0;
    text-align: center;
    list-style: none
}

</style>

<?php
        
            $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
            $adjacents = 1; 
            //$limit = 20;
            
            if($count == ''){
                $query = $db->prepare("SELECT COUNT(*) AS 'num' FROM `$tbl_name`");
            }else{
                $query = $db->prepare($count); //SELECT COUNT(*) AS 'num' FROM transaction WHERE type = 1 AND plan_id = 3 AND status = 1
            }
            
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
            
        /* make withd
            //$ttlBal = self::calcUserBal($uid, $percent);
              //  if ($ttlBal >= $amt) {
                $withd = Transactions::makeWithdr($uid, $amt);
                $deposit = Transactions::makeDeposit($uid, $amt, $return, $plan, $btc_amt, $status);
                   return $deposit;
                   
        //}
        
        ('INSERT INTO transaction(type, client_id, amount, reg_date, status, exp_return, plan_id, btc_amt) VALUES((2, :userid, :amt, NOW(), :status, :exp1, '', ''),(1, :userid, :amt, NOW(), :status, :exp2, :plan, :btc_amt))');
    }
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

    public static function getRandomRef($no)
    {
        do {
            $reflink = self::izRand($no);
            $test = self::getVerifLink($reflink);
        } while ($test != '');

        return $reflink;
    }

    public static function addVerificationLink($uid, $link_id)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $insert = $db->prepare('INSERT INTO verify (user_id, link, status) VALUES(:uid, :link, 0)');
        $insert->bindValue(':uid', $uid, PDO::PARAM_INT);
        $insert->bindValue(':link', $link_id, PDO::PARAM_STR);
        $insert->execute();

        $test = $db->lastInsertId();
        $db = null;
        return $test;
    }

    public static function updVerificationLink($link)
    {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $_SESSION['dbErr']);
        $upd = $db->prepare('UPDATE verify SET status = 1 WHERE link = :link');
        $upd->bindValue(':link', $link, PDO::PARAM_STR);
        $upd->execute();

    }

    public static function getVerifLink($link)
    {
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
        if (!isset($_SESSION['key']) && !isset($_SESSION['user_level']) && !isset($_SESSION['user']) && $token !== CORP . '_Ok') {
            echo '<script type="text/javascript"> window.location = "user.php";</script>';
            die();
        }
    }

    public static function match($parent, $type)
    {

        $clients = array();
        $getClients = Transactions::getPledgersByParent($type, $parent);

        foreach ($getClients as $value) {
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
        if (isset($_POST) && ($_POST['formToken'] != $_SESSION['pgToken'])) {
            echo '<script type="text/javascript"> window.location = "' . basename($_SERVER['REQUEST_URI']) . '";</script>';
            die();
        }
    }

    public static function stopSignupRefresh()
    {
        if ($_POST['formToken'] != $_SESSION['pgToken']) {
            echo '<script type="text/javascript"> window.location = "?a=login";</script>';
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

    public static function verifyRef($referer = '')
    {
        $ref = isset($_GET['u']) ? $_GET['u'] : '';
        if (!empty($ref)) {
            $referer = Users::getUidByNicname($ref);
            if (!empty($referer)) {
                $_SESSION['ref'] = $referer;

                echo '<script required type="text/javascript"> window.location = "?p=signup";</script>';die();
            }

        }

    }
    public static function confirmEmail($confirm)
    {
        if (!empty($confirm)) {
            $uid = self::getVerifLink($confirm);
            if ($uid > 0) {
                $email_confirm = Users::changeUserStatus($uid, 2);
                $check = self::updVerificationLink($confirm);
                $_SESSION['result'] = array(1, 'Verification Successful! <br> Please login to start enjoying the full benefits of joining us');

                login();

            }

        }

    }

    public static function loginAuth($status)
    {

        switch ($status) {
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
                if ($status == 4) {
                    $_SESSION['result'] = array('2', 'Please verify your email in order to access the system; <br><b>Visit your mail inbox/spambox for more!');
                }
                login();die();
                break;

        }

    }

    public static function testActivation($status)
    {

        if ($status != ACTIVE) {

            if ($_GET['pg'] == 'exit') {
                logout();
            } elseif ($_GET['pg'] == 'pledge') {
                credit();

            } elseif ($_GET['pg'] == 'invoice') {
                //var_dump($_GET); die();
                credit();

            } elseif ($_GET['pg'] == 'edit_account') {
                user();
            } else {

                $_SESSION['result'] = array('2', 'Please activate your account to have full access to the system');
                dash();

            }

            include 'foot.php';die();
        }
    }

    public static function getAnotherRef($ref, $uid)
    {
        $reffer = Transactions::assignReferer($ref);
        while ($ref != $reffer) {
            $reffer = Transactions::assignReferer($ref);

        }
        $parent = Users::getUserParentByUid($ref);
        $updRef = Users::updUserRefById($uid, $ref, $parent);

        return array($reffer, $parent);
    }

    public static function addSlideshow()
    {
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
                        height: 450px !important;
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
                        background-color: rgba(0, 0, 0, .5);
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

                    .next,
                    .prev,
                    .dot {
                        display: none;
                    }

                    .text span {
                        color: gold !important;
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
                            <div class="text"><span style="color:gold;">Join The World's Best</span><br> Investment
                                Platform<br></div>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">3 / 4</div>
                            <img src="assets/img/slide2.jpg" style="width:100%">
                            <div class="text"> Welcome to <br><span> Ultimate Cycler 2</span></div>
                        </div>
                        <div class="mySlides fade">
                            <div class="numbertext">4 / 4</div>
                            <img src="assets/img/slide3.jpg" style="width:100%">
                            <div class="text" style="font-size: 3em!important;"><span> 100% Instant Direct
                                    Pay</span><br> No Admin Fees!!!
                            </div>
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