<?php
session_start();
require 'config.php';
include_once 'head.php';

$duty = isset($_GET['a']) ? $_GET['a'] : (isset($_POST['a']) ? $_POST['a'] : '');

switch ($duty) {

    case 'home':
        home();
        break;

    case 'about':
        home();
        break;

    case 'signup':
        signup();
        break;

    case 'signin':
        login();
        break;

    case 'contact':
        home();
        break;

case 'payouts':
        receivers();
        break;
    default:
        home();
        break;

}

include 'foot.php';

function home()
{
    ?>


<!-- Header -->
<header id="head">
    <div class="container">
        <div class="heading-text">
            <h1 class="animated flipInY delay1">Welcome to <?php echo CORP; ?>....</h1>
            <p><i> <b> We grow </b> Together</i></p>
            <a class="btn btn-lg danger btn-danger" href="?a=signup"> Get Started! </a>
        </div>

        <div class="fluid_container">
            <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">


                <div data-thumb="assets/images/slides/thumbs/img2.jpg" data-src="assets/images/slide3.jpg">

                </div>
                <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slide5.jpg">
                </div>
                <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slide4.jpg">
                </div>
                <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slide2.jpg">
                </div>
                <div data-thumb="assets/images/slides/thumbs/img3.jpg"
                    data-src="assets/images/slide6 be celebrated.jpg">
                </div>
            </div>
            <!-- #camera_wrap_3 -->
        </div>
        <!-- .fluid_container -->
    </div>
</header>
<!-- /Header -->


<section class="container" id="about">
    <div class="row">
        <div class="col-md-8">
            <div class="title-box clearfix ">
                <h2 class="title-box_primary">About Us</h2>
            </div>
            <p><span> Community Gifting Cycle is community that helps each other.
            It is A Gift Given Voluntarily. You only need to make the initial registration fee of #2000 and refer two persons into the sysytem, then your money grows on its own.

Introducing Your Two Is A Must, And Encouraging Your Two To Invite Their Two Is Also Compulsory.

            </p>
            <p> <strong> You are guaranteed <strong>200%</strong> money back within 2 days </strong></p>
<p> <strong> Additional you gain a BONUS for every investment made!</strong></p>
            <p>

                To become a member, you have to register and  make a donation to one of the existing members to complete the registration.</p>
                 <div>  <p> For List of those to be paid this weekend >> <a href="?a=payouts" class="btn btn--highlight"> VIEW NOW</a></p></div>
        </div>


        <div class="col-md-4">
            <img src="assets/images/ad1.jpg" alt="" />
        </div>
    </div>
</section>

<section class="container" id="plan">
    <div class="row">
        <div class="col-md-12">
            <div class="title-box clearfix ">
                <h2 class="title-box_primary"> Investment Plans</h2>
            </div>

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
                bottom: -26px
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

            <div class="m-t-20">
                <h4 style="color:#fff;"> We have quality investment packages that would savours you needs. Make your
                    selection from below to get started
            </div>
            <div class="row m-t-0">
                <div class="plan-wr">
                    <div class="container plan-wr__container">
                        <div class="js-slider owl-carousel"
                            style="display: flex; flex-flow: row wrap; justify-content: center; align-items: center">


                            <?php
$plans = Transactions::getInvestmentPlans();

    foreach ($plans as $plan) {
        ?>

                            <div class="col-sm-4 col-md-4 col-lg-4">


                                <div class="plan-card plan-card--simple"
                                    onclick="return window.location='dash/user.php?a=signup&plan=<?php echo $plan['id']; ?>';"
                                    title="Click to get started">
                                    <form method="post" action="" id="<?php echo $plan['id']; ?>">
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
                                            <span>Amount Gifted:</span>
                                            <b>&#8358;<?php echo number_format($plan['amount_deposited']); ?></b>
                                        </li>
                                        <li>
                                            <span><b> Total Earned:</b></span>
                                            
                                        </li>
                                    </ul>
                                  <div class="plan-card__deposit" style="color: blue; font-size: 2.1em;"><b>
                                  &#8358;<?php echo number_format($plan['total_earned']); ?></b><br>
                                        <span
                                            style="color: darkred; font-size: .7em!important; clear: both!important; text-transform: lowercase; font-style: italic;">
                                             </span>
                                    </div>
    
                                    <a href="dash/user.php?a=signup"
                                        class="plan-card__btn plan-over__btn btn btn--bl">Get Started
                                    </a>

                                </div>
                            </div>

                            <?php
}
    ?>

                        </div>
                    </div>
                </div>
            </div>
</section>
<style>
.how-it-work {
    padding: 35px 0;
    /*! background:url(assets/images/bg-how-it-works.jpg) center repeat-x; */
    color: #fff;
    font-size: 17px;
    line-height: 1.2;
    background: #AA0003;
}

.how-it-work .container {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center
}

.how-it-work__txt {
    width: 495px
}

.how-it-work__title {
    font-size: 42px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 10px
}

.how-it-work__img {
    -ms-flex-positive: 1;
    flex-grow: 1;
    text-align: right
}

.how-it-work__steps {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start
}

.how-it-work__step {
    padding-top: 15px;
    margin-left: 50px;
    text-align: center;
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase;
    position: relative
}

.how-it-work__step::before {
    /*! opacity:.11; */
    color: #000;
    font-size: 80px;
    font-weight: 700;
    text-transform: uppercase;
    z-index: 10;
    position: absolute;
    top: -20px;
    left: -15px
}

.how-it-work__step::after {
    content: '';
    display: block;
    width: 33px;
    height: 9px;
    background: url(assets/images/bg-hiw-dots.png) center no-repeat;
    position: absolute;
    left: -42px;
    top: 85px
}

.how-it-work__step:nth-child(1) {
    padding-left: 0
}

.how-it-work__step:nth-child(1)::before {
    content: '1'
}

.how-it-work__step:nth-child(1)::after {
    display: none
}

.how-it-work__step:nth-child(1) .how-it-work__icon::before {
    background-image: url(assets/images/ic-hiw-1.png)
}

.how-it-work__step:nth-child(2)::before {
    content: '2'
}

.how-it-work__step:nth-child(2) .how-it-work__icon::before {
    background-image: url(assets/images/ic-stat-5.png);
    background-size: 100px;
}

.how-it-work__step:nth-child(3)::before {
    content: '3'
}

.how-it-work__step:nth-child(3) .how-it-work__icon::before {
    background-image: url(assets/images/ic-hiw-3.png)
}

.how-it-work__icon {
    width: 147px;
    height: 147px;
    margin-bottom: 15px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, .4), inset 0 0 8px #e3aa52;
    border: 4px solid #ffc464;
    background-color: #e8f1ff;
    background-image: radial-gradient(circle 70px at center, #e8f1ff 0, #e1e1e1 100%);
    border-radius: 50%;
    position: relative;
    z-index: 11
}

.how-it-work__icon::before {
    content: '';
    display: block;
    width: 100%;
    height: 100%;
    background: center no-repeat;
    position: absolute;
    left: 0;
    top: 0
}

.table-wr__group {
    display: -ms-flexbox;
    display: flex;
    padding: 40px 0;
    -ms-flex-pack: justify;
    justify-content: space-between
}

.table-wr__title {
    padding-bottom: 20px;
    border-bottom: 2px solid #217297;
    color: #217297;
    font-size: 26px;
    line-height: 1;
    font-weight: 700;
    text-transform: uppercase
}

.table-wr--light table {
    box-shadow: inset 0 35px 50px -45px #feb251
}

.table-wr--light .table-wr__title {
    border-bottom-color: #feb251;
    color: #feb251
}

.table-wr th,
.table-wr td {
    padding: 25px 20px;
    text-transform: uppercase;
    border-bottom: 1px solid black;
}

.table-wr table {
    width: 100%;
    color: #fff;
}

.table-wr {
    border-right: 2px groove goldenrod;
    margin-top: 30px;
}

. {
    cursor: pointer;
}

@media(max-width: 600px) {
    .table-wr__group {
        flex-flow: column nowrap;
    }

    .how-it-work .container {
        flex-flow: row wrap !important;
    }


    .how-it-work__txt {
        margin-bottom: 20px;
    }

    ..table-wr {
        border: none;
    }

    .table-responsive {
        border: none !important;
    }
}

.box h5 {
    text-align: center;
    font-weight: bold;
    font-size: 20px;
}

.box p {
    text-align: center;
    font-style: oblique;
}
</style>

<section class="how-it-work">
    <div class="container" style="display: flex; justify-content: space-around; align-items: stretch;">
        <div class="how-it-work__txt">
            <h3 class="how-it-work__title">How it Works?</h3>
            <p>
After Paying A Non-Refundable Fee Of #2000,
And Inviting Your Two(2) 
</p><p>
From Feeder Board, 
4 Persons  Will Gift You #8000, <br>
You Keep #3,000 
Regift #5,000
</p><p>
<b>Stage1,</b> 4 Persons Pay You Back #5,000 =#20,000
You Keep #5,000 Regift #15,000
</p><p>
<b>Stage2,</b> 4 Persons Pay You #15,000= 60,000
You Keep #20,000 Regift#40,000
</p><p>
<b>Stage3,</b> 4 Persons Pay You #40,000 = 160,000, You Keep #60,000 Regift #100,000.00
</p><p>
<b>Stage4,</b>  4 Persons Pay You 100,000=#400,000, 
You Keep 350,000 And Drop 50,000 For Maintenance And I.T Fee.
</p>
            <p> <a href="?a=signup" class="btn btn--highlight">Join Now</a></p>
        </div>


        <div class="how-it-work__steps"
            style="display: flex; flex-flow: row wrap; justify-content: space-around; align-items: stretch;">
            <div class="how-it-work__step">
                <div class="how-it-work__icon"></div>
                <span>registration</span>
            </div>


            <div class="col-lg-3 how-it-work__step">
                <div class="how-it-work__icon"></div>
                <span>Make deposit</span>
            </div>


            <div class="how-it-work__step">
                <div class="how-it-work__icon"></div>
                <span>Get profit <b style="color: gold;"> 400% </b></span>

            </div>
        </div>
    </div>
    </div>
</section>
<?php
/*
$payouts = Pledge::getLatestPayouts();
    $pledges = Pledge::getLatestPlegdes();

//var_dump($pledges);
    ?>
<section>
    <div class="features" style="background: url(assets/images/back1.jpg) 0 0; background-size: content;">
        <div class="container">
            <div class="table-wr__group row" display: flex;>
                <div class="table-wr table-responsive col-lg-6">
                    <div class="table-wr__title">Lastest Plegdes</div>
                    <table class="">
                        <tbody>

                            <tr>
                                <th title=""><span>Pledger</span></th>
                                <th><span> Amount</span></th>
                                <th class="text-center"><span> Recipient</span></th>
                            </tr>

                            <?php

    if (!empty($pledges)) {
        foreach ($pledges as $value) {
            $amt = InvestmentPlan::getPlanById($value['plan_id'])['min_deposit'];
if($value['receiver_id'] == 1) continue;
            ?>
            
                            <tr>
                                <td width=""><span> <?php echo (!empty($value['pledger_id'])) ? Users::getNicnameById($value['pledger_id']) : ucwords($value['pledger']); ?></span>
                                </td>
                                <td><span>&#8358; <?php echo number_format($amt, 2); ?></span></td>
                                <td class="text-center">
                                    <span><?php echo (!empty($value['receiver_id'])) ? Users::getNicnameById($value['receiver_id']) : ucwords($value['receiver']); ?></span></td>
                            </tr>

                            <?php
}
    }

    ?>

                        </tbody>
                    </table>
                </div>

                <div class="table-wr table-wr--light table-responsive col-lg-6">
                    <div class="table-wr__title">Latest Payouts</div>
                    <table class="table--deposit ">
                        <tbody>
                            <tr>
                                <th title="" width=""><span>Username</span></th>
                                <th class="text-center"><span> Amount</span></th>
                                <th class="text-center"><span> Date/Time</span></th>
                            </tr>
                            <?php
if (!empty($payouts)) {
        foreach ($payouts as $value) {
            $date = time() - (2 * 24 * 60 * 60);
            
            if($value['receiver_id'] == 1) continue;

            $date = strtotime($value['reg_date']);

            $amt = InvestmentPlan::getPlanById($value['plan_id'])['min_deposit'];
            ?>
                            <tr>
                                <td title=""><span>  <?php echo (!empty($value['receiver_id'])) ? Users::getNicnameById($value['receiver_id']) : ucwords($value['receiver']); ?></span>
                                </td>
                                <td class="text-center"><span> &#8358;
                                        <?php echo !empty($amt) ? number_format($amt, 2) : '0.00'; ?>
                                    </span></td>
                                <td class="text-center"><span> <?php echo date('M, d H:i', $date); ?></span></td>
                            </tr>


                            <?php
}
    }
    ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
*/
?>

<section class="news-box" style="margin: 50px auto;">
    <div class="container">
        <div class="title-box clearfix">
            <h2> Testimonials</h2>
        </div>
        <div class="row">
<div class="col-lg-2 col-md-2 col-sm-2">
    
</div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="newsBox">
                    <div class="thumbnail">
                        <figure><img src="assets/images/photo-3.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5> Frances U</h5>
                                    </p>
                                    <p>
                                        I was afraid before but made up my mind to give a trial and
                                        it paid off. Today, I've registered many people down my line and they weren't
                                        disappointed. <br> Thanks To <?php echo CORP; ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="newsBox">
                    <div class="thumbnail">
                        <figure><img src="assets/images/photo-1.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5>Frank Wilson </h5>
                                    </p>
                                    <p>
                                        <?php echo CORP; ?> have cleared the fears and fradulency accured to these investment
                                        platforms by decentralizing the whole system.
                                        Your profit is handled by a co-client without the interference of any form of
                                        controllers who are usaually fradulent!!
                                        <br> Thank God for <?php echo CORP; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="newsBox">
                    <div class="thumbnail">
                        <figure><img src="assets/images/about.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5> Jacobs </h5>
                                    </p>
                                    <p>
                                        I kept getting paid every single day as I keep refreshing my account
                                        by reinvesting. This is really good
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div>  <p class=:text-center"> For List of those to be paid this weekend  <a href="?a=payouts" class="btn btn--highlight"> VIEW NOW</a></p></div>
    </div>
</section>


<?php
}

function about()
{
    ?>

<header id="head" class="secondary">
    <div class="container">
        <h1>About Us</h1>
        <p> <?php echo CORP; ?>.... We Grow Together!!!</p>
    </div>
</header>


<!-- container -->
<section class="container">
    <div class="row">
        <!-- main content -->
        <section class="col-lg-8 maincontent">
            <div class="title-box clearfix ">
                <h2 class="title-box_primary"> Our Company</h2>
            </div>
            <p>
                kinex is one of
                the hottest online
                business networks in world today. In kinex members will donate money to members, which means that you do
                not pay
                money to the site system. It is a mutual community in which members help other member

            </p>
            <br>
            <div class="title-box clearfix ">
                <h2 class="title-box_primary"> Our Business: How it Works</h2>
            </div>
            <h4> Investing </h4>
            <p>

                To become a member, you have to register and make a donation to one of the existing members to complete the registration. The
                receipient then confirms your donation.
            </p>
            <br>
            <h4> Profits</h4>
            <hr>

            <p> In <?php echo CORP; ?>, you receive 200% of your every deposit. How is this possible? Whenever you make a
                deposit, on the confirmation of your deposit our merging system merges two other members to pay you the
                exact amount you deposited. Thereby ensuring you receive 200% of your deposit within the shortest period
                of time ever! </p>

            <p>
                Please note you are to receive the payments on the bank details you specified in your profile page.
                Therefore ensure the details you are providing during registration are correct
            </p>
            <br>
            <h4> Bonuses!</h4>
            <hr>
            <p>
            Our bonus is to motivate our investors to invest more into the lives of other investors.For every investment plan an investor chooses, he or she gets a 20% of his investment. However, this would not be witdrawable until it gets to 100% of your investments. This means that the investor will have to invest on a particular plan for 5 times in order to gain the priviledge of withdrawing the bonuses!
            </p>

        </section>
        <!-- /main --
        <section classs="col-lg-4">
            <img src="assets/images/kinex/about.jpg" alt="" class="img-rounded pull-right" width="400"
                >
</section>
    <!-- Sidebar -->

    </div>
</section>
<!-- /container -->
<div class="container txt-bl">
    <div class="row">
        <div class="col-5">
            <article class="about-bl">
                <div class="title-box clearfix ">
                    <h2 class="title-box_primary"> Mission</h2>
                </div>

                <p>During all the time of its active activity on cryptocurrency exchanges, we have steadily
                    increased and continue to work on increasing
                    the volume of trade transactions and the level of liquidity of each of them. But for
                    larger-scale cryptographic trading, additional capital
                    is required, which will be used to expand our network of traders, increase the number of
                    transactions and process automation. In addition,
                    additional financial resources will contribute to the modernization of our trading instruments,
                    the development of new strategies and business
                    plans, and the introduction of innovative technologies to improve the quality of services.</p>
                <p>We plan to increase working capital through cooperation with private investors. We invite
                    everyone who wants to become our financial
                    partner â€” to invest their own funds in a highly profitable cryptocurrency trading, carried out
                    by top experts in their field of activity.</p>
            </article>
        </div>
        <div class="col-7 padding-col-2">
            <article class="about-bl">
                <div class="title-box clearfix ">
                    <h2 class="title-box_primary"> Vision</h2>
                </div>

                <p>In the process of trading cryptocurrencies, an important role is assigned to outsourcing
                    companies that provide us with the results
                    of an in-depth analysis of invaluable information about market changes that have arisen as a
                    result of certain economic and political events.
                    Preparation and use of extremely accurate forecasts regarding the fluctuations of different
                    currencies in crypto trading allows us to minimize
                    risks and ensure stable profitability of the company.</p>
                <p>The current goal of <?php echo CORP; ?> is to stabilize the new, higher peaks of the profits by
                    expansion of working capital and proper
                    allocation of available financial resources. Thatâ€™s why; we are open to promising and mutually
                    beneficial cooperation with each of you â€” take
                    a direct part in the creation of the future financial industry right now.</p>
            </article>
        </div>
    </div>
</div>

<div class="features">
    <div class="container">
        <div class="features__inner">
            <div class="features__col">
                <div class="title-box clearfix ">
                    <h2 class="title-box_primary"> Official UK Ð¡ompany</h2>
                </div>

                <p> <?php echo CORP; ?> is a legal company incorporated in the United Kingdom. <a
                        href="/images/Crypto_Boom_Limited.pdf" target="_blank">Check>></a></p>
                <p class="features__comment">Register Certificate no.: <span>11327202</span></p>
            </div>
            <div class="features__col">
                <div class="features__title">SSL Certificate Comodo</div>
                <p>The high reliability certificate that provides the higher level of protection and security of
                    your personal data.</p>
            </div>
            <div class="features__col">
                <div class="features__title">Dedicated server DDOS-guard</div>
                <p>We use dedicated server of the ddos-guard company which protects our web-site from any DDoS
                    attack.</p>
            </div>

            <p style="text-align: center; "> <a href="?p=signup&plan=1" class="btn btn--highlight"> INVEST
                    NOW!!!</a> </p>
        </div>
    </div>

    <?php
}

function faq()
{
    ?>

    <?php
}

function contact()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //var_dump($_POST); die();
        Misc::stopRefresh();
        $name = strip_tags($_POST['name']);
        $email = strip_tags(strtolower($_POST['username']));
        $phone = strip_tags($_POST['phone']);
        $subj = strip_tags($_POST['subj']);

        $msg = ucfirst(strip_tags($_POST['msg']));

        if (!empty($name) && !empty($phone) && !empty($msg)) {
            $subj1 = 'Message Received From a visitor @' . $_SERVER['SERVER_NAME'];
            $msgs = '';
            $msgs .= '
        The details is as follows:<br>
        <ul style="list-style-type: none;">
        <li> <b>Name: </b>' . ucwords($name) . '</li>
        <li> <b>Username: </b>' . strtolower($email) . '</li>
        <li> <b>Phone: </b>' . $phone . '</li>
        <li> <b>Subject: </b>' . ucwords($subj) . '</li>
        <li><b> Message: </b> <br><br><i>' . $msg . '</i></li>

        </ul>

        <p> Dated: ' . date('Y-m-d', strtotime('today')) . '</p>
        ';

            $send = Misc::sendMail($msgs, $subj1, 'admin@' . $_SERVER['SERVER_NAME'], 'Director');
            if ($send) {
                //var_dump($send);
                //die();
                $_SESSION['result'] = array('1', 'Message Successfully sent!. You will receive your response shortly');
            } else {
                echo $send;
                $_SESSION['result'] = array('2', 'Oops! There seems to be an error; It will ratified in shortly.');
            }
        }
    }

    Misc::setToken();
    ?>

    <header id="head" class="secondary">
        <div class="container">
            <h1>Contact Us</h1>
            <p> We are available 24/7</p>
        </div>
    </header>
    <!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="section-title">Your Message</h3>
                <p>
                    We are always ready to help you. There are many ways to contact us. You may drop us a line, give
                    us a
                    call or send an email, choose what suits you most. <br> Your invited to join our telegram group
                    <a href="https://t.me/joinchat/MdcrKhOtYPemMzunJsX6Pg" target="_blank"
                        style="color: red; font-size: 1.2em"> here </a>
                </p>

                <form class="form-light mt-20" role="form" action="" method="POST">
                    <input type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                    <input type="hidden" name="pg_lvl" value="1" />
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" required name="name" class="form-control" placeholder="Your name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Enter your username if already a partner of the company"
                                    title="Enter your username if already a partner of the company">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" required name="phone" class="form-control"
                                    placeholder="Phone number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" required name="subj" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea required name="msg" class="form-control" id="message" maxlenght="1000"
                            placeholder="Write you message here..." style="height:100px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-two">Send message</button>
                    <p><br /></p>
                </form>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="section-title">Office Address</h3>
                        <div class="contact-info">
                            <h5>Address</h5>
                            <p>Kerniles 416 - United Kingdom, <br> Greater London, <br>United Kingdom, WC2H 9JQ </p>

                            <h5>Email</h5>
                            <p>info@<?php echo $_SERVER['SERVER_NAME']; ?></p>

                            <h5>Phone</h5>
                            <p>+44 123 1234 123</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div></div></div></div>
    <br><br>
    <!-- /container -->


    <?php
}

function login()
{
    if(isset($_POST['formToken'])){

        $username = $_POST['username'];
        $pwd = $_POST['password'];
    
    
        $auth = Users::authAcct($username, $pwd);
        
        if((!empty($auth)) && (count($auth) > 0)){
    $_SESSION['pin'] = $auth['user_id'];
    $_SESSION['ulevel'] = $auth['user_level'];
    $_SESSION['token'] = 'FINE';

    //var_dump($auth);die();
    echo '<script type="text/javascript"> window.location="admin/"; </script>';
    
        }else{
            echo '<script type="text/javascript"> window.location="?a=signin&error=Invalid Credentials"; </script>';
            
        }
    }
    
    
    
?>

<style>
    input[type=text],
    input[type=email],
    input[type=password] {
        background-color: #eee;
        
    }

    input[attr:placeholder] {
        color: black;

    }

.input-group-addon{
	border: none!important;
	background-color: darkblue!important;
	color: #fff!important;
}

    .card-header {
        background-color: darkred !important;
        font-weight: bold !important;
        color: #fff;
    }

    .login-content {
        background-color: #fff;
        margin: initial auto;
    }

    #info{
        display: flex;
        justify-content: space-between;
    }

    #info a {
        color: black;
    }

    .input-group {
        //display: block !important;
        //border: 1px solid darkblue;
    }
    
    input{
    	overflow: hidden!important;
    }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container" style="overflow: visible;">
            
            <h1> Login</h1>
            
        </div>
    </header>
    <!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-md-4" style="margin: 0 auto !important">
<!--
                
                    <style>
                    .login-logo {
                        //position: absolute;
                        //left: 0;
                        margin: 0px;
                    }

                    .login-logo a img {
                        height: 50px !important;

                    }

                    .login-form {
                        padding: 50px 30px;
                        background: #fff;
                        //width: 310px;
                        margin: 20px auto;
                        border-radius: 20px;
                    }

                    .page-content--bge5 {
                        background-color:darkblue!important;
                    }

                    .login-content {
                        background: transparent;
                    }

                    </style>-->
            <?php
            if(isset($_GET['error'])){
                echo '<div class="alert alert-danger">'.$_GET['error'].'</div>';
            }
            ?>
                            <div class="login-form">
                                <form action="?a=signin" method="post">
                                    <input required type="hidden" name="formToken"
                                        value="<?php echo $_SESSION['pgToken']; ?>" />
                                    <div class="form-group">


                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input required class="form-control required au-input--full" type="text"
                                                name="username" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input required class="form-control required au-input--full" type="password"
                                                name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <button class="btn btn--block btn-danger m-b-20" type="submit">sign
                                        in <i class="fa fa-sign-in"></i></button>
                                    <p id="info">
                                        <a href="?a=reset">Forgotten Password?</a>
                                        &nbsp;| &nbsp;
                                        <a href="?a=signup">Sign Up Here</a>
                                    </p>

                                </form>
                                <div class="register-link">
                                    <p>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                                </div>
                                </div>
        </div>
    </div>
</div>

<?php
}


function signup(){

    if (isset($_POST['pg_lvl'])) {
      
//var_dump($_POST);
Misc::stopRefresh();
      

        $name = ucwords($_POST['client_name']);
        $phone = $_POST['client_phone'];
        //$email = $_POST['email'];
        $acct_no = $_POST['acct_no'];
        $bank = $_POST['bank'];
        //$username = $_POST['urname'];
        //$pwd = $_POST['pwd'];
        //$cpwd = $_POST['cpwd'];
        $referer = $_POST['referer'];

        if (!empty($name)){
            
            $main_ref = Transactions::assignReferer($referer);
            //var_dump($_POST['referer']); var_dump($main_ref);    ; die();
                $member_id = rand(2350, 9999);
                if (isset($_SESSION['ulevel']) && $_SESSION['ulevel'] == 1) {
                    $status = 1;
                } else {
                    $status = 2;
                }

            /* $auth = Users::authAcct($username, $pwd);
                //var_dump($auth); die();
                if (empty($auth)) {
*/

                    $save_acct = Users::createAcct($name, '', $phone, '', '', $bank, $acct_no, $main_ref, $member_id, $status);
                    if (!empty($save_acct)) {
                        $ref_detail = Transactions::getRefByUser($main_ref);
                        $tree = (!empty($ref_detail['ref_tree'])) ? ($ref_detail['ref_tree'].','.$main_ref) : ('1'.','.$main_ref);
                        $save_referer = Transactions::addNewReferer($save_acct, $main_ref, $ref_detail['hierarchy'], ($ref_detail['tree_level'] + 1), $tree);
                     $updateDownliner = Transactions::updDownliners($tree);

                   
                   $_SESSION['result'] = array('1', 'Welcome to '.CORP.'. Your memebership id is :' . $member_id . '; Please complete your registration by contacting the admin on +2348038685075 (whatsapp or call) for further details');

                    } else {
                        $_SESSION['result'] = array(2, 'An error occurred, please retry');
                    }
/*
                } else {
                    $_SESSION['result'] = array(2, 'Username already in use, please use another');
                }
            }

            */

        } else {
            $_SESSION['result'] = array(2, 'Fill in all fields');
        }
    }

    Misc::setToken();
    
    ?>

<div class="container">
<div class="row justify-content-center">
        <!-- Column -->

        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title"> New Client Account</h3><br />
                    <form class="form-horizontal form-maerial" method="post" action=""><input type="hidden"
                            name="pg_lvl" value="1" /><input type="hidden" name="duty" value="acct" /><input
                            type="hidden" name="formToken" value="<?php echo $_SESSION['pgToken']; ?>" />
                            <?php
if(isset($_SESSION['result'])){
    ?>
        <div class="alert alert-info">

<b><?php echo $_SESSION['result'][1];?></b>
        </div>

<?php unset($_SESSION['result']); } ?>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12"> Referrer's Name</label>
                            <div class="col-md-12">
                                   <select class="form-control" id="select2" name="referer">

                                    <?php
$members = Users::getAllUsersforList();

    foreach ($members as $value) {
        echo '<option value="' . $value["user_id"] . '" accesskey="' . $value["name"] . '"> ' . ucwords($value["name"]) . ' (' . $value["member_id"] . ')</option>';
    }
    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">

<div class="form-group col-md-6">
    <label class="col-md-12"> Client Fullname</label>
    <div class="col-md-12">
        <input type="text" value="" required=""
            placeholder="Name as it appears on your bank account"
            class="form-control form-control-line" name="client_name" maxlength="">
    </div>
</div>

<div class="form-group col-md-6">
    <label class="col-md-12"> Phone No</label>
    <div class="col-md-12">
        <input type="text" value="" name="client_phone" placeholder=""
            class="form-control form-control-line" maxlength="">
    </div>
</div>
</div>

<!--
<div class="form-group col-md-6">
    <label class="col-md-12"> Email Address</label>
    <div class="col-md-12">
        <input type="text" value="" required="" name="email" placeholder=""
            class="form-control form-control-line" maxlength="">
    </div>
</div>

</div>
<div class="row">

-->
<div class="row">
<div class="form-group col-md-6">
    <label class="col-md-12"> Bank Name</label>
    <div class="col-md-12">
        <input type="text" value="" placeholder="Banker's Name"
            class="form-control form-control-line" name="bank" maxlength="50">
    </div>
</div>

<div class="form-group col-md-6">
    <label class="col-md-12">Account No</label>
    <div class="col-md-12">
        <input type="text" placeholder="Enter bank aaccount no"
            class="form-control form-control-line" name="acct_no" maxlength="32">
    </div>
</div>
</div>

<!--
<div class="form-group">
<label class="col-md-12"> Username</label>
<div class="col-md-12">
    <input type="text" value="" required="" placeholder="Your Pet Name"
        class="form-control form-control-line" name="urname" maxlength="25">
</div>
</div>

<div class="form-group">
<label class="col-md-12">Password</label>
<div class="col-md-12">
    <input type="password" placeholder="Enter New Passord" required=""
        class="form-control form-control-line" name="pwd" maxlength="32">
</div>
</div>

<div class="form-group">
<label class="col-md-12"> Repeat Password</label>
<div class="col-md-12">
    <input type="password" class="form-control form-control-line" required="" name="cpwd"
        placeholder="Confirm Password" maxlength="32">
</div>
</div>
-->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>
</div>  
<?php
}

function receivers(){

?>
    <header id="head" class="secondary">
        <div class="container">
            <h1> Those Eligible to be Gifted  this Weekend</h1>
     
        </div>
    </header>
    <!-- container -->

    <div class="container">

    <div class="row">
                        <div class="col-sm-12">
<br>
                                                           <div class="table-responsive">
                                    <table class="table stylish-table table-bordered  table-striped"
                                        id="dataTable-example">
                                        <thead>
                                            <tr>

                                                <th> S/N&otilde;</th>


                                                <th> Client Name</th>
                                                <th> Amount</th>
                                                                                             <th> Gifting Stage</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$plans = Transactions::getInvestmentPlans();

    $i = 0;
    foreach ($plans as $p) {

        ?>

                                            <tr>

                                                <th colspan="7">
                                                    <?php echo ucwords($p['name']); ?>
                                                </th>
                                            </tr>
                                            <?php

$eligible = Transactions::getDueReceiversByPlan($p['plan_id'], $p['no_of_downliner']);

foreach($eligible as $j){

/*$all_clients = Users::getUsersByPlan($p['plan_id']);
        foreach ($all_clients as $j) {
            $count = Transactions::updateMyUpliner($j['user_id']);
        }
*/
    
    ?>

                                            <tr onclick="mark(<?php echo $j['user_id']; ?>)" style="cursor: pointer;"
                                                id="p<?php echo $j['user_id']; ?>">

                                                <td> <?php echo ++$i; ?></td>
                                               
                                                <td> <?php echo ucwords($j['name']); ?></td>
                                                <td> <?php echo number_format($p['amount_withdrawn'], 2); ?> </td>
                                                
<td> <?php echo ucwords($p['name']); ?></td>
                                            </tr>

<?php

}}
?>
                                        </tbody>
                                                                           </table>
                                </div>
                        </div>

  </div></div>                  </div>




<?php
}

?>