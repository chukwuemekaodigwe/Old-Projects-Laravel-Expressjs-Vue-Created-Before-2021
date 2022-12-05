<?php
/*if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    echo '<script type="text/javascript"> window.location="https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'";</script>';
    //Prevent the rest of the script from executing.
    exit;
}*/

session_start();


if (isset($_SESSION['set_cookie'])) {
    $data = array();
    $data = $_SESSION['set_cookie'];
    list($name, $value, $duratn) = $data;

    setcookie($name, $value, $duratn);
}

require 'control.php';
include 'head.php';

if (isset($_GET['ref'])) {

    addRef();

}

$action = isset($_GET['a']) ? $_GET['a'] : "";

switch ($action) {
    case 'faq':
        faq();
        break;

    case 'forgot_password':
        forgotPwd();
        break;

    case 'investors':
        investors();
        break;

    case 'login':
        userAcct();
        break;

    case 'news':
        news();
        break;

    case 'rules':
        rules();
        break;

    case 'signup':
        userAcct();
        break;

    case 'support':
        support();
        break;

    case 'cust':
        about();
        break;

    default:
        home();
        break;
}

function home()
{
    ?>
<div class="info-block">
    <div class="investors">
        <div class="title">for Investors</div>
        <div class="list">
            <ul>
                <li>
                    <i><img src="static/img/header/inv-ic1.png"></i>
                    <span>24/7 online support</span>
                </li>
                <li>
                    <i><img src="static/img/header/inv-ic2.png"></i>
                    <span>Instant payments 24/7 </span>
                </li>
                <li>
                    <i><img src="static/img/header/inv-ic3.png"></i>
                    <span>Minimum investment 50$</span>
                </li>
            </ul>
        </div>
        <div class="link"><a href="?a=signup">Become an investor</a></div>
    </div>
    <div class="statistic">
        <div class="title">Statistics</div>
        <div class="list">
            <ul>
                <?php
/* $onDays = gmmktime() - gmmktime();
    (date('Y-m-d', strtotime('today'))) - (date('Y-m-d', strtotime('2015-03-13')));
    //sept 18, 2015

    unixtojd(strtotime('today')) - unixtojd(strtotime('2015-09-01'))

     */
    $unixTimeStamp1 = strtotime('today');
    $unixTimeStamp2 = strtotime('2015-09-01');

    $first = $unixTimeStamp1 / 86400 + 2440587.5;

    $end = $unixTimeStamp2 / 86400 + 2440587.5;
    $bal_date = $first - $end;
    ?>
                <li><span>Days Online</span><b><?php echo $bal_date; //idate($onDays)   ?></b></li>
                <li><span>Visitors online</span><b>16201</b></li>
                <li><span>Deposited</span><b>$ 22522849.02</b></li>
                <li><span>Withdrawn</span><b>$ 867355.43</b></li>
                <li><span>Last Deposit</span><b>$ 1850.41 (Victor)</b></li>
                <li><span>Last withdrawal</span><b>$ 6,400.00.00 (Chris49)</b></li>
            </ul>
        </div>
        <div class="link"><a href="?a=signup">Quick registration</a></div>
    </div>
    <div class="partners">
        <div class="title">For partners</div>
        <div class="list">
            <ul>
                <li>
                    <span>3 levels - Multi-level affiliate program.</span>
                    <i><img src="static/img/header/part-ic1.png"></i>
                </li>
                <li>
                    <p>
                        Earn <b>up to 3%</b> extra with a affiliate program of Expert Cryptos Ltd  Club
                    </p>
                </li>
                <li><a href="?a=investors">affiliate program</a></li>
            </ul>
        </div>
        <div class="link"><a href="?a=signup">Become a partner</a></div>
    </div>
</div>
</div>
</div>
<!--HEADER END-->



<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="splash-content">
        <!--SPLASH CONTENT-->
        <div class="splash-calculator">
            <div class="container row">
                <div class="invest-type">
                    <div class="list">
                        <ul>

                            <li class="invest-1" data-id="plan_1" data-min="10" data-percent="20">
                                <input id="f1" type="radio" name="ff" checked />
                                <label for="f1"><i
                                        style="background-image: url('static/img/splash/calc-ic1.png')"></i><b>20%</b><span>Starter</span></label>
                            </li>

                            <li class="invest-2" data-id="plan_2" data-min="100" data-percent="25">
                                <input id="f2" type="radio" name="ff" />
                                <label for="f2"><i
                                        style="background-image: url('static/img/splash/calc-ic2.png')"></i><b>25%</b><span>Amateur</span></label>
                            </li>


                            <li class="invest-3" data-id="plan_3" data-min="1000" data-percent="30">
                                <input id="f3" type="radio" name="ff" />
                                <label for="f3"><i
                                        style="background-image: url('static/img/splash/calc-ic3.png')"></i><b>30%</b><span>Professional</span></label>
                            </li>


                            <li class="invest-4" data-id="plan_4" data-min="5000" data-percent="35">
                                <input id="f4" type="radio" name="ff" />
                                <label for="f4"><i
                                        style="background-image: url('static/img/splash/calc-ic4.png')"></i><b>35%</b><span>Expert</span></label>
                            </li>


                            <li class="invest-5" data-id="plan_5" data-min="50000" data-percent="40">
                                <input id="f5" type="radio" name="ff" />
                                <label for="f5"><i
                                        style="background-image: url('static/img/splash/calc-ic5.png')"></i><b>40%</b><span>Investor</span></label>
                            </li>
                        </ul>
                    </div>
                    <div class="invest-type-info block-1">
                        <div class="title">Investment <br />Portfolios</div>
                        <div class="subtitle">STARTER</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Minimum deposit</span><i>$10</i></p>
                                </li>
                                <li>
                                    <p><span>Maximum deposit</span><i>$250</i></p>
                                </li>
                                <li>
                                    <p><span>Term of deposit</span><i>1 day</i></p>
                                </li>
                                <li>
                                    <p><span>Daily earnings</span><i>20%</i></p>
                                </li>
                                <li>
                                    <p><span>Profit</span><i>20%</i></p>
                                </li>
                            </ul>
                        </div>
                        <div class="result"><b>20%</b><span>for 1<br />day</span></div>
                    </div>
                    <div class="invest-type-info block-2">
                        <div class="title">Investment <br />Portfolios</div>
                        <div class="subtitle">AMATEUR</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Minimum deposit</span><i>$100</i></p>
                                </li>
                                <li>
                                    <p><span>Maximum deposit</span><i>$1000</i></p>
                                </li>
                                <li>
                                    <p><span>Term of deposit</span><i>2 days</i></p>
                                </li>
                                <li>
                                    <p><span>Daily earnings</span><i>25%</i></p>
                                </li>
                                <li>
                                    <p><span>Profit</span><i>25%</i></p>
                                </li>
                            </ul>
                        </div>
                        <div class="result"><b>25%</b><span>for 2<br />days</span></div>
                    </div>
                    <div class="invest-type-info block-3">
                        <div class="title">Investment <br />Portfolios</div>
                        <div class="subtitle">PROFESSIONAL</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Minimum deposit</span><i>1000$</i></p>
                                </li>
                                <li>
                                    <p><span>Maximum deposit</span><i>$5,000</i></p>
                                </li>
                                <li>
                                    <p><span>Term of deposit</span><i>2 days</i></p>
                                </li>
                                <li>
                                    <p><span>Profit</span><i>30%</i></p>
                                </li>
                            </ul>
                        </div>
                        <div class="result"><b>30%</b><span>for 2<br />days</span></div>
                    </div>
                    <div class="invest-type-info block-4">
                        <div class="title">Investment <br />Portfolios</div>
                        <div class="subtitle">EXPERT</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Minimum deposit</span><i>$5,000</i></p>
                                </li>
                                <li>
                                    <p><span>Maximum deposit</span><i>$50,000</i></p>
                                </li>
                                <li>
                                    <p><span>Term of deposit</span><i>4 days</i></p>
                                </li>
                                <li>
                                    <p><span>Profit</span><i>35%</i></p>
                                </li>
                            </ul>
                        </div>
                        <div class="result"><b>35%</b><span>for 4<br />days</span></div>
                    </div>
                    <div class="invest-type-info block-5">
                        <div class="title">Investment <br />Portfolios</div>
                        <div class="subtitle">INVESTOR</div>
                        <div class="info">
                            <ul>
                                <li>
                                    <p><span>Minimum deposit</span><i>$50,000</i></p>
                                </li>
                                <li>
                                    <p><span>Maximum deposit</span><i> Infinity</i></p>
                                </li>
                                <li>
                                    <p><span>Term of deposit</span><i>5 days</i></p>
                                </li>
                                <li>
                                    <p><span>Profit</span><i>40%</i></p>
                                </li>
                            </ul>
                        </div>
                        <div class="result"><b>40%</b><span>for 5<br />days</span></div>
                    </div>
                </div>
                <div class="calculation">
                    <div class="title">Calculate<br />profit</div>
                    <div class="area">
                        <label>Investment amount</label>
                        <input type="text" name="" value="10" id="amount" />
                    </div>
                    <div class="period">
                        <div class="title">Period / days:</div>
                        <div class="list">
                            <ul>
                                <li>
                                    <input type="radio" name="fff" checked onclick="return false;" id="plan_1" />
                                    <label for="f11">1</label>
                                </li>
                                <li>
                                    <input type="radio" name="fff" onclick="return false;" id="plan_2" />
                                    <label for="f12">2</label>
                                </li>
                                <li>
                                    <input type="radio" name="fff" onclick="return false;" id="plan_4" />
                                    <label for="f14">4</label>
                                </li>
                                <li>
                                    <input type="radio" name="fff" onclick="return false;" id="plan_5" />
                                    <label for="f15">5</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="profit">
                        <div class="title">Total Profit:</div>
                        <div class="result" id="result2"></div>
                    </div>
                    <div class="button"><a href="?a=signup"><button type="submit">make an invest</button></a></div>

                </div>
            </div>
        </div>

        <script>
        jQuery(document).ready(function() {
            jQuery('.invest-type li').on('click', function() {
                jQuery('#amount').val(jQuery(this).data('min'));
                jQuery('#' + jQuery(this).data('id')).prop("checked", true);
                jQuery('#amount').change();
            });
            jQuery('#amount').on('change keyup', function() {
                jQuery('#result2').html('$' + (jQuery('#amount').val() * jQuery(
                        'input[name=ff]:checked').parent().data('percent') /
                    100).toFixed(2));
            });

            jQuery('#amount').change();
        });
        </script>


        <div class="splash-about">
            <div class="container row">
                <div class="page-large-title">
                    <h1>Expert Cryptos Ltd  <br />RELIABLE INVESTMENTS</h1>
                </div>
                <div class="splash-about-text">
                    <ul>
                        <li>
                            <div class="page-text">
                                <p>
                                    We welcome you to the digital world of crypto investment. Expert Cryptos Ltd  - where our
                                    clients will receive stable and risk-free
                                    long-term returns by placing their Bitcoin asset in our online profound asset
                                    management program. Expert Cryptos Ltd  is an active trading participant, venture
                                    crypto-currency fund raiser, which is built on many years of experience and
                                    depth market knowledge. After Bitcoin fork, popularity and practical application
                                    on blockchain network are growing by great numbers. Strongly Followed by
                                    different ICOs left the world with two major crypto-coins like Bitcoin and
                                    Ether.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="page-text">
                                <p>
                                    The immensely Increasing rates have opened up many opportunities especially for who
                                    typically seek high-density space with
                                    low power consumption. Expert Cryptos Ltd  company work with modern hardware network
                                    pools that provide accumulating power and steady profit ratio that we share
                                    with our clients. The high profitability is due to the availability of its
                                    own production house for Bitcoin and Ethereum mining at our data center,
                                    which is globally mined cryptocurrency in the current marketplace.Expert Cryptos Ltd 
                                    ensures high safety and security of your investments and major gains in profits.


                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="splash-about-media">
                    <div class="official">
                        <div class="page-title">
                            <h1>Certificate<br /> of registration</h1>
                        </div>
                        <div class="link">
                            <a href="images/application.pdf" target="_blank"><img src="static/img/splash/sert.png"></a>
                        </div>
                    </div>
                    <div class="video">
                        <div class="move">

                            <iframe width="100%" height="370" src="https://www.youtube.com/embed/Gc2en3nHxA4"
                                frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>


                            <!--- <iframe width="100%" height="370" src="#" frameborder="0" allowfullscreen></iframe>----->
                        </div>
                    </div>
                    <div class="address">
                        <div class="page-title">
                            <h1>company<br /> address</h1>
                        </div>
                        <div class="info">
                            <p>

                                7802 Valle Vista Dr. <br>Rancho Cucamonga,
                                California, USA<br><br>
                                Company NO.:<br /><b>10986349</b>
                            </p>
                            <a href="https://beta.companieshouse.gov.uk/company/10986349" target="_blank">Verify</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="splash-media">
            <div class="container row">
                <div class="review">
                    <div class="page-title">
                        <h1>Testimonials</h1>
                    </div>
                    <div class="list">
                        <ul id="splash-media-review">

                            <li>

                            </li>
                            <li>
                                <div class="text">
                                    <i>
                                        Just wanted to tell that the program is wonderful and keep doing the great work.
                                        I get the withdrawals daily very quick, that's another amazing thing. Thanks
                                        again.



                                    </i>
                                </div>
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Roshan Back</b>
                                        <p>Investor</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <i>
                                        Without seeking for please any stranger but telling the truth as it is. I have
                                        been investing with investment programs for quite a long time but in my whole
                                        experience l've never met AN EXCELLENT PROGRAM like Brason Invests. I am
                                        constantly getting paid immediately after requesting a withdrawal order. BRASON
                                        INVEST is the best Program to trust and invest in. Lets join and invest with
                                        this honest program.



                                    </i>
                                </div>
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Chrizola </b>
                                        <p>Investor</p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="text">
                                    <i>
                                        I am customer of company Expert Cryptos Ltd  since 5 months.
                                        I can to say that this company inspires confidence and is worth your attention.
                                        Customer support at the highest level! They do great job!
                                        My deposit is 500$ and i withdraw profit every day instantly.
                                        Good Luck!




                                    </i>
                                </div>
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Naha</b>
                                        <p>Investor</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <i>
                                        I am satisfy with Expert Cryptos Ltd  company. I registered a month ago and I got
                                        very good results. The company's site is pretty nice and very simple to use. I
                                        recommend you to join as soon as possible and enjoy the daily income. Good Luck!


                                    </i>
                                </div>
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Muhanji Binra</b>
                                        <p>Investor</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="video">
                    <div class="page-title">
                        <h1>Video Testimonials</h1>
                    </div>
                    <div class="list">
                        <ul id="splash-media-video">
                            <li>
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Gc2en3nHxA4"
                                    frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="page-link"><a href="?a=support">Leave your Testimonial</a></div>
            </div>
        </div>

        <div class="splash-balance">
            <div class="container row">
                <div class="splash-balance-in">
                    <div class="indrawn">
                        <div class="icon"><img src="static/img/splash/bal-big-ic1.png"></div>
                        <div class="page-title">
                            <h1>Last deposits</h1>
                        </div>
                        <div class="table">
                            <table>
                                <tr>

                                    <th>Login</th>
                                    <th>Amount</th>
                                    <th>EPS</th>
                                </tr>
                                <?php
$depositors = array();
    $depositors = Transactions::getLatestDeposits();

    foreach ($depositors as $value) {
        $name = (empty($value['admin'])) ? Users::getUrnameById($value['customer_id']) : $value['username'];

        ?>
                                <tr>

                                    <td><?php echo ucwords($name); ?></td>
                                    <td><b><?php echo '$' . number_format($value['amount'], 2); ?></b></td>
                                    <td><i><img src="static/img/ps_black/48.png"></i></td>
                                </tr>

                                <?php
}

    ?>


                            </table>
                        </div>


                    </div>
                    <div class="outdrawn">
                        <div class="icon"><img src="static/img/splash/bal-big-ic2.png"></div>
                        <div class="page-title">
                            <h1>Last withdrawals</h1>
                        </div>
                        <div class="table">
                            <table>
                                <tr>

                                    <th>Login</th>
                                    <th>Amount</th>
                                    <th>EPS</th>
                                </tr>

                                <?php
$withdraws = array();
    $withdraws = Transactions::getLatestWithdrawal();
    foreach ($withdraws as $value) {

        $name = (empty($value['admin'])) ? Users::getUrnameById($value['user_id']) : $value['username'];

        ?>
                                <tr>

                                    <td><?php echo ucwords($name); ?></td>
                                    <td><b><?php echo '$' . number_format($value['amount'], 2); ?></b></td>
                                    <td><i><img src="static/img/ps_black/48.png"></i></td>
                                </tr>

                                <?php
}

    ?>
                                <!--<tr>

                                        <td>Chalie2</td>
                                        <td><b>$3,600.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>George</td>
                                        <td><b>$1,820.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Saikhinlaw</td>
                                        <td><b>$1,660.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Kofi</td>
                                        <td><b>$1,400.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Eledu200</td>
                                        <td><b>$360.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Rodriguez</td>
                                        <td><b>$2,600.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Federico</td>
                                        <td><b>$11,000.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Anabel</td>
                                        <td><b>$1,600.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Julie</td>
                                        <td><b>$7,000.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>
                                    <tr>

                                        <td>Chris49</td>
                                        <td><b>$6,400.00</b></td>
                                        <td><i><img src="static/img/ps_black/48.png"></i></td>
                                    </tr>-->

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--SPLASH CONTENT END-->
</div>
<!--MAIN CONTENT END-->



<?php
}

function faq()
{
    ?>


<div class="banner">
    <div class="title"><b>FAQ</b><span>Answers to frequently asked questions</span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->



        <div class="faq-inner">
            <div class="container row">
                <div class="faq-inner-block">
                    <div class="box">
                        <div class="title">Main questions</div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>1</i><b>What does company Expert Cryptos Ltd  occupy with?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    The company Expert Cryptos Ltd  invests in European real estate. By attracting private
                                    investment, our company is able to increase working capital.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>2</i><b>How does the company achieve a high profit?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Experienced employees of the company constantly monitor the European real estate
                                    market, which allows us to be aware of all the events.

                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>3</i><b>Anyone can become an investor of company?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    The only restriction is age: our investors can only be adult.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="box">
                        <div class="title">Technical questions</div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>1</i><b>How to start investing?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    If you want to start to work with the company Expert Cryptos Ltd  , you need to pass a
                                    simple registration procedure, choose investment plan and make deposit. The rest of
                                    the job will be done by our staff.

                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>2</i><b>Can I open multiple accounts?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    No, each investor can have only one account. All user accounts will be blocked
                                    together with placed on them in cash for violations of this requirement.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>3</i><b>I forgot the password. How can I restore it?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Click on the "Recover password" and fill in a special form. Instructions will be
                                    sent on your e-mail box specified at registration, following which you will be able
                                    to recover your account password.

                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>4</i><b>How can I change the password?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    To change the password, log in to your account on the company website, go to "Edit
                                    account" and enter the new password.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>4</i><b>How can I change my email or the number of my e- Wallet?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    If you want to change your e-mail or the number of your e-Wallet, write in technical
                                    support of the company.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">Financial questions</div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>1</i><b>How many deposits can I make at the same time? </b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    We have no restrictions on the number of deposits.
                                </p>
                            </div>
                        </div>

                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>2</i><b>How to make a contribution?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    You can use the following payment systems for financial transactions: PerfectMoney,
                                    Payeer, BitCoin and AdvCAsh.

                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>3</i><b>Can I make a reinvestment with the balance of my personal account?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Yes, you can do it.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>4</i><b>I made a mistake with the chosen investment plan. Can I change it after my
                                    contribution has already started to work?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Unfortunately, this is impossible. You can wait until the end of the investment
                                    period and you can make a reinvestment contribution under new conditions.
                                </p>
                            </div>
                        </div>

                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>5</i><b>I don't have an e-Wallet in the electronic payment system. What should I
                                    do?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Visit the official site of your chosen EPS, fill out the registration form and open
                                    an account. Then you will be able to use the payment system for deposit and withdraw
                                    of funds.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>6</i><b>How often is profit calculated?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    The profit is calculated daily, every 24 hours starting from the beginning of your
                                    contribution.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>7</i><b>Do you have any fees for depositing and withdrawal of funds?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    No, there are not any hidden fees.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>8</i><b>How fast is the request processed for withdrawal of profit?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    All applications of investors are processed instantly.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>9</i><b>Can I use different payment systems to deposit and withdraw of funds?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    No, you can order the withdrawal of funds only through the payment system, which was
                                    used for funding your account.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>10</i><b>What is the minimum amount of deposit and withdrawal of funds?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Minimum deposit amount — 10 $.<br>
                                    The minimal amount available for withdrawal for PerfectMoney and Payeer is 0.01
                                    $.<br>
                                    The minimal amount available for withdrawal for AdvCash is 0.10 $<br>
                                    The minimal amount available for withdrawal for BitCoin is 1 $

                                </p>
                            </div>
                        </div>

                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>11</i><b>Do you have an affiliate program?</b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Yes, you can find the details in the corresponding section on the website.
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordion-box">
                            <div class="faq-accordion-title">
                                <i>12</i><b>I have not found the answer to my question. What should I do? </b>
                            </div>
                            <div class="faq-accordion-text">
                                <p>
                                    Contact investors’ service or visit the "Support" section and contact us in any
                                    convenient way.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="faq-inner-sidebar">
                    <div class="block">
                        <div class="title">Rules</div>
                        <div class="image">
                            <i style="background-image: url('static/img/partner/img.jpg')"></i>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="?a=rules">Resource rules</a></li>
                                <li><a href="?a=rules">Terms of investment</a></li>
                                <li><a href="?a=rules">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
<!--PAGE CONTENT END-->

<?php
}

function investors()
{
    ?>
<div class="banner">
    <div class="title"><b>Investor / Affiliate</b><span>We have formed a package of proposals for real estate in
            Europe</span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->





        <div class="partners-program-inner">
            <div class="container row">

                <div class="top-block">
                    <div class="box blue">
                        <div class="big-men">
                            <i><img src="static/img/partner/men-ic1.png"></i>
                            <p><span>1 level</span><b>5%</b></p>
                        </div>
                        <div class="small-men">
                            <i><img src="static/img/partner/men-ic2.png"></i>
                            <p><span>2 level</span><b>2%</b></p>
                        </div>
                    </div>
                    <div class="box green">
                        <div class="text">
                            <span>PROGRAM OF REPRESENTATIVES</span>
                            <p>Earn more with the Program of Representatives</p>
                        </div>
                        <div class="list">
                            <ul>
                                <li><b>10%</b><i><img src="static/img/partner/men-ic3.png"></i></li>
                                <li><b>5%</b><i><img src="static/img/partner/men-ic4.png"></i></li>
                                <li><b>3%</b><i><img src="static/img/partner/men-ic5.png"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-block">
                    <a href="?a=support">Send request</a>
                    through the support form. The application will be considered within 24 hours.
                </div>

                <div class="bottom-block">
                    <div class="box">
                        <div class="follow">
                            <div class="title">Becoming an partner of Expert Cryptos Ltd  <br> you get the following:</div>
                            <div class="list">
                                <ul>
                                    <li>
                                        <i>1</i>
                                        <span>The possibility of obtaining increased commissions</span>
                                    </li>
                                    <li>
                                        <i>2</i>
                                        <span>Own business card on the company's website</span>
                                    </li>
                                    <li>
                                        <i>3</i>
                                        <span>
                                            You do not need to look for partners and invite them, they come by
                                            themselves on the company's website, find the right partner in their region
                                            reside and turn to you.
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Accordingly, in the company
                                            Expert Cryptos Ltd  website they pass on your
                                            Affiliate link.
                                            Accordingly, in the company<br />
                                            Expert Cryptos Ltd  they came also from your<br /> affiliate link.
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="needs">
                            <div class="title">In order to become a partner, it is necessary:</div>
                            <div class="list">
                                <ul>
                                    <li><i>1</i><span>Specify your name</span></li>
                                    <li><i>2</i><span>Country of residence </span></li>
                                    <li><i>3</i><span>Expert Cryptos Ltd  login</span></li>
                                    <li><i>4</i><span>Skype login</span></li>
                                    <li><i>5</i><span>E-mail </span></li>
                                    <li>
                                        <i>6</i>
                                        <span>The size of the personal investment package in the project at the time of
                                            application should be equal to or greater than the amount <b>5000$</b>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="partners-people-inner">
            <div class="container row">
                <div class="page-large-title">
                    <h1>Our partners</h1>
                </div>
                <div class="list">
                    <ul id="partners-people-list">







                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Giovanni<br />Gambaretto</b>
                                        <span>Trento, Italia</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+3486105363</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: giovanni_gambaretto</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>infogenerazionedigitale@gmail.com</span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Kamil<br />Smiechowski</b>
                                        <span>Poland</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+48508248361</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: Smiechu21</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>hyipoholik@ProtonMail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Samuel<br />Olusegun Daniel</b>
                                        <span>Republic Of Nigeria</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+234(0)8036226332</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: exceedng</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>ensignhours@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Yohan <br />Park</b>
                                        <span>South Korea</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+821025402319</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: john12pkj@gmail.com</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>pyh2319a@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Saeed<br />Naqshi</b>
                                        <span>Pakistan</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+923037517170</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: EvoLogs</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>naqshimalik@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>плекѿандр<br /></b>
                                        <span>Ukraine</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+380978581628</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: stalex31</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>sanek.stalex@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Jose G R<br />Sobrinho</b>
                                        <span>Brazil</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+5511971149467</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: ---------</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>josegrsobrinho@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>IS RK<br /></b>
                                        <span>India</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+00000000000</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: ONLINE.BUSINESS2207</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>mlmexpert290@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Kamper
                                            <br /></b>
                                        <span>Poland</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+00000000000</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: live:szczes01</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>szczes01@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>VISHAL
                                            <br />SINGH</b>
                                        <span>INDIA</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+918077121282</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: vsr66465</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>rajputvishalonwear@gmail.com
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="avatar">
                                    <div class="icon">
                                        <i style="background-image: url('static/img/splash/ava.png')"></i>
                                    </div>
                                    <div class="info">
                                        <b>Beata
                                            <br />Golab</b>
                                        <span>Poland</span>
                                    </div>
                                </div>
                                <div class="text">
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic2.png"></i>
                                        <b>+48603124766</b>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic3.png"></i>
                                        <span>Skype: kwiatuszek2262</span>
                                    </p>
                                    <p>
                                        <i><img src="static/img/partner/peopl-ic4.png"></i>
                                        <span>beatagolab@onet.com.pl
                                        </span>
                                    </p>

                                </div>
                                <div class="info">
                                    <div class="box">
                                        <div class="left"></div>
                                    </div>
                                    <div class="box">
                                        <div class="right"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!--PAGE CONTENT END-->

<?php
}

function about()
{
    if (isset($_GET['page']) && $_GET['page'] == 'investors') {
        return investors();
        //exit();
    } else {
        ?>
<div class="banner">
    <div class="title"><b>About Us</b><span>Who we are and what we do for our customers</span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->



        <div class="about-inner-info">
            <div class="container row">
                <div class="left">
                    <div class="contact">
                        <div class="image">
                            <i style="background-image: url('static/img/about/img.jpg')"></i>
                        </div>
                        <div class="data">
                            <div class="address">
                                <i><img src="static/img/about/ic1.png"></i>
                                <p>7802 Valle Vista Dr. Rancho Cucamonga, <br /> California, USA</p>
                            </div>
                            <div class="list">
                                <ul>
                                    <li>
                                        <a href="">
                                            <i><img src="static/img/about/ic2.png"></i>
                                            <span>+12134302389</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i><img src="static/img/about/ic3.png"></i>
                                            <span>admin@expert-cryptos.com </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i><img src="static/img/about/ic4.png"></i>
                                            <span>admin@expert-cryptos.com </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i><img src="static/img/about/ic5.png"></i>
                                            <span>admin@expert-cryptos.com </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="page-text">
                        <p>
                            <b>Investing in European real property</b>
                            <br><br>

                            We welcome you to the digital world of crypto investment. Expert Cryptos Ltd  - where our clients
                            will receive stable and risk-free long-term returns by placing their Bitcoin asset in our
                            online profound asset management program.Expert Cryptos Ltd  is an active trading participant,
                            venture crypto-currency fund raiser, which is built on many years of experience and depth
                            market knowledge. After Bitcoin fork, popularity and practical application on blockchain
                            network are growing by great numbers. Strongly Followed by different ICOs left the world
                            with two major crypto-coins like Bitcoin and Ether.
                            <br>
                            The immensely Increasing rates have opened up many opportunities especially for who
                            typically seek high-density space with low power consumption. Expert Cryptos Ltd  company work
                            with modern hardware network pools that provide accumulating power and steady profit ratio
                            that we share with our clients. The high profitability is due to the availability of its own
                            production house for Bitcoin and Ethereum mining at our data center, which is globally mined
                            cryptocurrency in the current marketplace.Expert Cryptos Ltd  ensures high safety and security of
                            your investments and major gains in profits.


                        </p>
                    </div>
                </div>
                <div class="right">
                    <div class="docs">
                        <div class="title">Certificate of registration </div>
                        <div class="image"><i><a href="images/certificate.jpg" target="_blank"><img
                                        src="static/img/about/sert.jpg" /></a></i></div>
                        <div class="text">Certificate: <b>№ 10657639</b><br />UNITED KINGDOM</div>
                        <div class="page-link"><a href="https://beta.companieshouse.gov.uk/company/10657639"
                                target="_blank">Verify</a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-inner-plus">
            <div class="container row">
                <div class="page-title">
                    <h1>Our advantages</h1>
                </div>
                <div class="list">
                    <ul>
                        <li>
                            <i><img src="static/img/about/big-ic1.png"></i>
                            <b>Stable income</b>
                            <p>
                                The main activity of our company is to profit at the expense of rent (putting the
                                property in rent).
                            </p>
                        </li>
                        <li>
                            <i><img src="static/img/about/big-ic2.png"></i>
                            <b>Independent Business</b>
                            <p>
                                We specialize only in liquid types and classes of real estate funds from housing to
                                commercial properties located in stable and emerging European regions.
                            </p>
                        </li>
                        <li>
                            <i><img src="static/img/about/big-ic3.png"></i>
                            <b>Our mission</b>
                            <p>
                                The mission of our company is to create strong investment cooperation with every
                                partner!
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="page-link"><a href="?a=signup">Make an invest</a></div>
            </div>
        </div>

        <div class="about-inner-outlook">
            <div class="container row">
                <div class="info">
                    <div class="info-block">
                        <div class="page-title">
                            <h1>PERSPECTIVENESS<br />
                                INVESTMENTS IN THE REAL ESTATE OF THE EUROPEAN COUNTRIES</h1>
                        </div>
                        <div class="page-text">
                            <p>
                                Now, the company gives everyone the opportunity to get the passive income regardless of
                                the level of capital and to become its full partner. In turn, we will be able to
                                increase the investment portfolio and to cover a larger number of properties.

                                The main activity of our company is to profit at the expense of rent (putting the
                                property in rent). We specialize only in liquid types and classes of real estate funds
                                from housing to commercial properties located in stable and emerging European regions.
                                <br><br>

                                Now you can become an investor of Expert Cryptos Ltd  to save your time in learning all the
                                details and overcome all the difficulties that exist in the investment activity.
                            </p>
                        </div>
                        <div class="list">
                            <ul>
                                <li><i><img src="static/img/about/map-ic1.png"></i><span>Good</span></li>
                                <li><i><img src="static/img/about/map-ic2.png"></i><span>Normal</span></li>
                                <li><i><img src="static/img/about/map-ic3.png"></i><span>Bad</span></li>
                                <li><i><img src="static/img/about/map-ic4.png"></i><span>Compared with 2016 year</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!--PAGE CONTENT END-->
<?php
}
}

function userAcct()
{
    ?>
<div class="banner">
    <div class="title"><b>Sign Up / Sign In</b><span></span></div>

</div>

</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->

        <div class="registration-inner">
            <div class="container row">
                <div class="registration-inner-block">
                    <div>
                        <p style="font-weight: bold; font-style: italic; color: red!important">Errors</p>
                    </div>
                    <div class="box">
                        <div class="reg">

                            <script language=javascript>
                            function checkform() {
                                if (document.regform.fullname.value == '') {
                                    alert("Please enter your full name!");
                                    document.regform.fullname.focus();
                                    return false;
                                }


                                if (document.regform.username.value == '') {
                                    alert("Please enter your username!");
                                    document.regform.username.focus();
                                    return false;
                                }
                                if (!document.regform.username.value.match(/^[A-Za-z0-9_\-]+$/)) {
                                    alert("For username you should use English letters and digits only!");
                                    document.regform.username.focus();
                                    return false;
                                }
                                if (document.regform.password.value == '') {
                                    alert("Please enter your password!");
                                    document.regform.password.focus();
                                    return false;
                                }
                                if (document.regform.password.value != document.regform.password2.value) {
                                    alert("Please check your password!");
                                    document.regform.password2.focus();
                                    return false;
                                }


                                if (document.regform.email.value == '') {
                                    alert("Please enter your e-mail address!");
                                    document.regform.email.focus();
                                    return false;
                                }
                                if (document.regform.email.value != document.regform.email1.value) {
                                    alert("Please retupe your e-mail!");
                                    document.regform.email.focus();
                                    return false;
                                }

                                for (i in document.regform.elements) {
                                    f = document.regform.elements[i];
                                    if (f.name && f.name.match(/^pay_account/)) {
                                        if (f.value == '')
                                            continue;
                                        var notice = f.getAttribute('data-validate-notice');
                                        var invalid = 0;
                                        if (f.getAttribute('data-validate') == 'regexp') {
                                            var re = new RegExp(f.getAttribute('data-validate-regexp'));
                                            if (!f.value.match(re)) {
                                                invalid = 1;
                                            }
                                        } else if (f.getAttribute('data-validate') == 'email') {
                                            var re = /^[^\@]+\@[^\@]+\.\w{2,4}$/;
                                            if (!f.value.match(re)) {
                                                invalid = 1;
                                            }
                                        }
                                        if (invalid) {
                                            alert('Invalid account format. Expected ' + notice);
                                            f.focus();
                                            return false;
                                        }
                                    }
                                }

                                if (document.regform.agree.checked == false) {
                                    alert("You have to agree with the Terms and Conditions!");
                                    return false;
                                }

                                return true;
                            }

                            function IsNumeric(sText) {
                                var ValidChars = "0123456789";
                                var IsNumber = true;
                                var Char;
                                if (sText == '')
                                    return false;
                                for (i = 0; i < sText.length && IsNumber == true; i++) {
                                    Char = sText.charAt(i);
                                    if (ValidChars.indexOf(Char) == -1) {
                                        IsNumber = false;
                                    }
                                }
                                return IsNumber;
                            }
                            </script>



                            <div class="page-title">
                                <h1>Registration</h1>
                            </div>
                            <div class="form">
                                <form method=post action="admin/" onsubmit="return checkform()" name="regform"><input
                                        required type="hidden" name="form_id" value="15366086877149"><input required
                                        type="hidden" name="form_token" value="<?php echo time(); ?>">
                                    <input required type=hidden name=a value="signup">
                                    <input required type=hidden name=action value="signup">
                                    <ul>
                                        <li class="part">
                                            <label>Name: * </label>
                                            <input required type=text name=fullname value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>Login: *</label>
                                            <input required type=text name=username value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>E-mail: * </label>
                                            <input required type=text name=email value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>Confirm E-Mail: * </label>
                                            <input required type=text name=email1 value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>Password: </label>
                                            <input required type=password name=password value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>Confirm password: * </label>
                                            <input required type=password name=password2 value="" class=inpts size=30>
                                        </li>
                                        <li>
                                            <label>UpLine:</label>
                                            <input required type="text" name="f9"
                                                value="<?php echo isset($_COOKIE['crypto_reffer']) ? $_COOKIE['crypto_reffer'] : 'N/A'; ?>"
                                                disabled="" />
                                        </li>
                                    </ul>
                                    <div class="check">
                                        <input id="f1" required type="checkbox" name=agree value=1 />
                                        <label for="f1"><i></i>Agree with the <a href="?a=rules"> rules </a> of the
                                            company</label>
                                    </div>

                                    <div class="button"><button required type=submit value="Register" class=sbmt>Sign
                                            Up</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="log">

                            <script language=javascript>
                            function checklogin() {
                                if (document.loginform.username.value == '') {
                                    alert("Please enter your username!");
                                    document.loginform.username.focus();
                                    return false;
                                }
                                if (document.loginform.password.value == '') {
                                    alert("Please enter your password!");
                                    document.loginform.password.focus();
                                    return false;
                                }
                                return true;
                            }
                            </script>


                            <div class="page-title">
                                <h1>Sign In</h1>
                            </div>
                            <div class="form">
                                <form method=post action="admin/" name=loginform onsubmit="return checklogin()"><input
                                        required type="hidden" name="form_id" value="15366086877149"><input required
                                        type="hidden" name="form_token" value="<?php echo time(); ?>">
                                    <input required type=hidden name=a value='login'>
                                    <input required type=hidden name=follow value=''>
                                    <ul>
                                        <li>
                                            <label>Login: * </label>
                                            <input required type=text name=username class=inpts>
                                        </li>
                                        <li>
                                            <label>Password: *</label>
                                            <input required type=password name=password class=inpts>
                                        </li>
                                    </ul>
                                    <div class="link"><a href="?a=forgot_password">Restore password</a></div>
                                    <div class="button"><button required type=submit value="Login" class=sbmt>Sign
                                            In</button></div>
                                </form>
                            </div>

                            <div class="social">

                                <div class="text">
                                    The company guarantees the protection of confidentiality to its customers and
                                    undertakes to process personal data in accordance with personal rights, basic
                                    freedoms and dignity of a person, without transferring data to third parties.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
</div>
<!--PAGE CONTENT END-->

<?php
}

function rules()
{
    ?>
<div class="banner">
    <div class="title"><b>Rules</b><span>Read first <a href="?a=faq"> Questions and Answers</a></span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->



        <div class="rules-inner">
            <div class="container row">
                <div class="rules-inner-block">
                    <div class="top-box">

                        <div class="title">READ THE FOLLOWING RESERVATION RULES BEFORE REGISTRATION</div>
                        <div class="text">
                            <p>



                                This agreement governs the relationship between the company Expert Cryptos Ltd , Located
                                at:<br> 7802 Valle Vista Dr. Rancho Cucamonga,
                                California, USA
                                Certificate: № 10657639, (hereinafter the Company) and the investor (hereinafter the
                                Investor).<br><br> Both parties are obliged to abide by it during the entire period of
                                cooperation. The document comes into effect immediately after Investor's registration on
                                the website of the Company.








                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">1. General Terms</div>
                        <div class="text">
                            <p>

                                <br>
                                1.1. Only the user aged 18 and older at the time of the registration can register on the
                                website of the Company and become an Investor in the future.
                                <br><br>
                                1.2. The user is granted the status of Investor immediately after registration and
                                acceptance of the terms of this agreement. Investor is empowered to carry out financial
                                transactions and use other services of the Company only after completing the
                                registration procedure.
                                <br><br>
                                1.3. If the user does not accept any one of the articles in this Agreement or doubts
                                that (s)he will fulfill all the conditions, the user has to terminate the registration.
                                <br><br>

                                1.4. All financial transactions carried out by the Company are not disclosed to third
                                parties. This information is strictly confidential.
                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">2. The terms of the current Agreement</div>
                        <div class="text">
                            <p>
                                2.1. The use of all resources and services of the Company is possible only if all the
                                articles of this agreement are accepted. Investor automatically confirms his direct
                                responsibility for the observance and fulfillment of every article of this Agreement.
                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">3. The rights, duties and guarantees of the Company</div>
                        <div class="text">
                            <p>
                                3.1. Use invested funds of the Investor for the intended purpose.
                                <br><br>
                                3.2. Carry out payments of profits in accordance with the terms of the investment plans.
                                The Company guarantees the payment even in case of unforeseen circumstances.
                                <br><br>
                                3.3. Make on-time payments in accordance with the agreed terms, which are provided in
                                this agreement.
                                <br><br>
                                3.4. The Company is not responsible for the possible technical malfunctions of
                                electronic payment systems. Financial transactions that are associated with the deposit
                                and withdrawal of funds to the account of the electronic payment system are irreversible
                                and final.
                                <br><br>
                                3.5. The Company does not bear personal responsibility for operations executed
                                incorrectly, as well as for financial accounts improperly prepared personally by the
                                Investor.

                                <br><br>
                                3.6. The Company is responsible for the Investor's personal information integrity and
                                guarantees absolute confidentiality.

                                <br><br>
                                3.7. The website, all information it contains and technical tools are privately owned by
                                the Company and protected by copyright law.

                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">4. The rights and duties of the Investor</div>
                        <div class="text">
                            <p>
                                4.1. The Investor while filling in the registration form is personally responsible for
                                the accuracy of the information provided.
                                <br><br>
                                4.2. The Investor is obliged to check each transaction via his/her financial account. In
                                case of detecting some inaccuracies and discrepancies the Investor has the right ask for
                                assistance of support team.
                                <br><br>
                                4.3. All resourѿes and services provided by the Company are to be used only for
                                investment activities. In case of copyright infringement (damage to the website, copying
                                of materials, etc.) the Investor will be prosecuted and his/her account will be blocked
                                together with the money, that was on his/her personal account.

                                <br><br>

                                4.4. The Investor gives his/her consent to personal data processing in accordance with
                                current legislation. This validation will be carried out after Investor’s registration.


                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">5. Force majeure</div>
                        <div class="text">
                            <p>
                                5.1. In case of force majeure (legislative change, natural disasters, military
                                situation, etc.) the Company is empowered to suspend its activities for an indefinite
                                period. Such circumstances can not be subject of influence from both the Company and the
                                Investor. Force majeure implies impossibility to carry out any deals and financial
                                transactions as usual.


                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="title">6. Introduction of amendments and additions</div>
                        <div class="text">
                            <p>
                                6.1. This Agreement may be reviewed by the Company administration at any time.
                                Amendments and additions may be introduced in this Agreement, which will be published in
                                this section.

                            </p>
                        </div>

                    </div>
                    <div class="box">
                        <div class="title">7. Termination of the Contract and Account deleting.</div>
                        <div class="text">
                            <p>
                                7.1. Termination of the Contract between the Company and Investor may be initiated by
                                either party. The Company is empowered to terminate the Contract on cooperation with the
                                Investor in case of his/her violation of the rules and terms of the existing Agreement,
                                which includes account blocking.
                                <br><br>
                                7.2. The Investor may terminate the Contract, if he/she makes a decision to suspend
                                his/her investment in the Company.
                            </p>
                        </div>

                    </div>
                    <div class="box">
                        <div class="title">8. Procedure of settling disputes</div>
                        <div class="text">
                            <p>
                                8.1. Settlement of conflicts between the Company and the Investor involves both parties,
                                taking part in it in accordance with the law.

                            </p>
                        </div>

                    </div>
                </div>
                <div class="rules-inner-sidebar">
                    <div class="block">
                        <div class="title">Rules</div>
                        <div class="image">
                            <i style="background-image: url('static/img/partner/img.jpg')"></i>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="?a=rules">Terms of investment</a></li>
                                <li><a href="?a=rules">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!--PAGE CONTENT END-->


<?php
}

function support()
{
    ?>

<div class="banner">
    <div class="title"><b>Support</b><span></span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->
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
        <div class="contact-inner">
            <div class="container row">
                <div class="interactive">

                    <div class="data">
                        <div class="address">
                            <i><img src="static/img/about/ic1.png"></i>
                            <p style="text-transform: uppercase;">7802 Valle Vista Dr. Rancho Cucamonga,
                                California, USA, Company No. 10657639</p>
                        </div>
                    </div>
                </div>
                <div class="info" id="withdraw">
                    <div class="block">
                        <div class="info-list">
                            <div class="page-title">
                                <h1>CUSTOMER SUPPORT</h1>
                            </div>
                            <ul class="info-list-mail">
                                <li>
                                    <i><img src="static/img/contact/ic1.png"></i>
                                    <p><b>CUSTOMER SUPPORT:</b><a href="#">admin@expert-cryptos.com </a></p>
                                </li>
                                <li>
                                    <i class="finance"><img src="static/img/contact/ic2.png"></i>
                                    <p><b>Financial department:</b><span>+12134302389<br><br>8:00 AM / 8:00
                                            PM<br />(GMT)</span></p>
                                </li>
                                <li>
                                    <i><img src="static/img/contact/ic1.png"></i>
                                    <p><b>Financial department:</b><a href="#">finance@expert-cryptos.com </a></p>
                                </li>

                                <li>
                                    <i><img src="static/img/contact/ic1.png"></i>
                                    <p><b>PARTNERS:</b><a href="#">affiliate@expert-cryptos.com </a></p>
                                </li>
                                <li>
                                    <i><img src="static/img/contact/ic1.png"></i>
                                    <p><b>ADVERTISING AND MARKETING:</b><a href="#">marketing@expert-cryptos.com </a></p>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="block">
                        <div class="info-form">
                            <div class="page-title">
                                <h1><?php
if (isset($_GET['item'])) {
        unset($_SESSION['userAuth']);
        echo 'Place Your Request ';
    } else {echo 'Write a message';}
    ?>
                                </h1>
                            </div>
                            <div class="list">


                                <form method=post action="admin/?a=support" name=mainform onsubmit="return checkform()">
                                    <input required type="hidden" name="form_id" value="15366086741692"><input required
                                        type="hidden" name="form_token" value="7d68e884f0b43c37e49e227435fec355">
                                    <input required type=hidden name=a value=support>
                                    <input required type=hidden name=action value=send>
                                    <ul>
                                        <li>
                                            <label><?php if (isset($_GET['item'])) {echo 'Username';} else {echo 'Name:';}?></label>
                                            <input required type="text" name="name" value="" size=30 class=inpts>
                                        </li>
                                        <li>
                                            <label>Your E-mail:</label>
                                            <input required type="email" name="email" value="" size=30 class=inpts>
                                        </li>
                                        <?php
if (isset($_GET['item'])) {
        ?>
                                        <li>
                                            <label> Amount:</label>
                                            <input required type="number" name="withd_amt" value="" size=30 class=inpts
                                                max="<?php echo $_GET['m']; ?>" min="10">
                                        </li>
                                        <input required type=hidden name=withdraw value=1>

                                        <?php
} else {
        ?>
                                        <li>
                                            <label>Message:</label>
                                            <textarea required="" name=message class=inpts cols=45 rows=4></textarea>
                                        </li>

                                        <?php
}

    ?>


                                    </ul>
                                    <div class="button"><button required type=submit value="Send"
                                            class=sbmt>Send</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
<!--PAGE CONTENT END-->


<?php
}

function forgotPwd()
{
    ?>

<div class="banner">
    <div class="title"><b>Expert Cryptos Ltd  </b><span></span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->



        <div class="faq-inner">
            <div class="container row">
                <div class="faq-inner-block">
                    <div class="box">
                        <div class="text">
                            <font color="#000000">


                                <script language=javascript>
                                function checkform() {
                                    if (document.forgotform.email.value == '') {
                                        alert("Please type your username or email!");
                                        document.forgotform.email.focus();
                                        return false;
                                    }
                                    return true;
                                }
                                </script>

                                <h3>Forgot your password:</h3><br>





                                <form method=post action="admin/" name=forgotform onsubmit="return checkform();"><input
                                        required type="hidden" name="form_id" value="15366087144406"><input required
                                        type="hidden" name="form_token" value="f8d9a816ce66c40b4af0eee0870e0e4d">
                                    <input required type=hidden name=a value="forgot_password">
                                    <input required type=hidden name=action value="forgot_password">
                                    <table cellspacing=0 cellpadding=2 border=0>
                                        <tr>
                                            <td>Type your username or e-mail:</td>
                                            <td><input required type=text name='email' value="" class=inpts size=30>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input required type=submit value="Forgot" class=sbmt></td>
                                        </tr>
                                    </table>
                                </form><br><br>

                            </font>
                        </div>
                    </div>
                </div>
                <div class="faq-inner-sidebar">
                    <div class="block">
                        <div class="title">Rules</div>
                        <div class="image">
                            <i style="background-image: url('static/img/partner/img.jpg')"></i>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="?a=rules">Resource rules</a></li>
                                <li><a href="?a=rules">Terms of investment</a></li>
                                <li><a href="?a=rules">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
<!--PAGE CONTENT END-->


<?php
}

function news()
{
    ?>
<div class="banner">
    <div class="title"><b>News</b><span>Company and world finance news</span></div>
</div>
</div>
</div>
<!--HEADER END-->
<div class="main-content">
    <!--MAIN CONTENT-->
    <div class="inner-content">
        <!--INNER CONTENT-->



        <div class="news-inner">

            <div class="container row">
                <div class="full-news">
                    <div class="image"><i style="background-image: url('static/img/news/img9.jpg')"></i></div>
                    <div class="text">
                        <b>No news found!</b>
                        <span>N/A</span>
                        <p>
                            Visit this page regularly to keep yourself updated about latest company news & updates.
                        </p>
                    </div>
                </div>

            </div>


        </div>



        <script src="static/js/jquery.isotope.min.js" type="text/javascript"></script>
        <script src="static/js/isotope-script.js" type="text/javascript"></script>


    </div>
</div>
</div>
<!--PAGE CONTENT END-->
<?php
}

function addRef()
{

    $name = 'crypto_reffer';
    $value = $_GET['ref'];
    $duratn = time() + 60 * 60 * 24 * 90;
    $cookie = array($name, $value, $duratn);

    $_SESSION['set_cookie'] = $cookie;

    echo ('<script type=""> window.location = ".";</script>');

}

include 'foot.php';