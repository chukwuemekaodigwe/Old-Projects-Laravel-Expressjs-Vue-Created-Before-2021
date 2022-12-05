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
        about();
        break;

    case 'faq':
        home();
        break;

    case 'rules':
        home();
        break;

    case 'contact':
        contact();
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
            <h1 class="animated flipInY delay1">Welcome to Kinex Global....</h1>
            <p><i> <b> We grow </b> Together</i></p>
            <a class="btn btn-lg btn-danger" href="#plan"> Get Started! </a>
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
            <p><span>kinex globals is one of the hottest online business networks in world today. In kinex members
                    donate money to members without any intermidary or administartor. You are matching automatically by
                    the computer which completely eliminates fradulence or scam. We operates as a mutual community in
                    which members help other members.</p>
            <p> <strong> You are guaranteed <strong>200%</strong> money back within 2 days </strong></p>
<p> <strong> Additional you gain a BONUS of 20% for every investment made!</strong></p>
            <p>

                To become a member, you have to register and  make a donation to one of the existing members to complete the registration.</p>
            <a href="#" title="read more" class="btn-inline " target="_self">read more</a>
        </div>


        <div class="col-md-4">
            <img src="assets/images/kinex/feature.jpg" alt="Kinex Globals Ltd" />
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
$plans = InvestmentPlan::getAll();

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
                                            &#8358; <?php echo number_format($plan['min_deposit']); ?></b><br>
                                        <span
                                            style="color: darkred; font-size: .7em!important; clear: both!important; text-transform: lowercase; font-style: italic;">
                                            @ 200% Profit </span>
                                    </div>

                                    <a href="dash/user.php?a=signup&plan=<?php echo $plan['id']; ?>"
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
            <p>Get a referral link use for the registration. Go through a simple registration procedure on the
                website. Choose the investment plan that suits you.
                Make a deposit. Get your 200% profit by within hours.</p>
            <p> <a href="dash/user.php?a=signup" class="btn btn--highlight">Join Now</a></p>
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
                <span>Get profit <b style="color: gold;"> 200% </b></span>

            </div>
        </div>
    </div>
    </div>
</section>
<?php
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
<section class="news-box" style="margin: 50px auto;">
    <div class="container">
        <div class="title-box clearfix">
            <h2> Testimonials</h2>
        </div>
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="newsBox">
                    <div class="thumbnail">
                        <figure><img src="dash/images/lady1.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5> Frances U</h5>
                                    </p>
                                    <p>
                                        I was afraid before but made up my mind to give a trial and
                                        it paid off. Today, I've registered many people down my line and they weren't
                                        disappointed. <br> Thanks To Kinex Global

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
                        <figure><img src="dash/images/men3.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5>Frank Wilson </h5>
                                    </p>
                                    <p>
                                        Kinex Global have cleared the fears and fradulency accured to these investment
                                        platforms by decentralizing the whole system.
                                        Your profit is handled by a co-client without the interference of any form of
                                        controllers who are usaually fradulent!!
                                        <br> Thank God for Kinex Global
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
                        <figure><img src="dash/images/lady2.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5> Cynthia Fred</h5>
                                    </p>
                                    <p>This is the first fraud free investment plan I have witnessed in history. I
                                        always get my 200% returns each time I make a deposit therefore I encourage you
                                        to join</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="newsBox">
                    <div class="thumbnail">
                        <figure><img src="dash/images/men6.jpg" alt=""></figure>
                        <div class="caption maxheight2">
                            <div class="box_inner">
                                <div class="box">
                                    <p class="title">
                                        <h5> Jacob Okey </h5>
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
        <p> Kinex Global.... We Grow Together!!!</p>
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

            <p> In Kinex Global, you receive 200% of your every deposit. How is this possible? Whenever you make a
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
                    partner — to invest their own funds in a highly profitable cryptocurrency trading, carried out
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
                    allocation of available financial resources. That’s why; we are open to promising and mutually
                    beneficial cooperation with each of you — take
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
                    <h2 class="title-box_primary"> Official UK Сompany</h2>
                </div>

                <p> Kinex Global is a legal company incorporated in the United Kingdom. <a
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

function rules()
{

}

?>