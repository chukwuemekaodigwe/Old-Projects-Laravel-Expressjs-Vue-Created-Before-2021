<?php
session_start();
require 'config.php';
include_once 'head.php';

$duty = isset($_GET['pg']) ? $_GET['pg'] : (isset($_POST['pg']) ? $_POST['pg'] : '');
if ($duty == '') {
    $duty = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');
}

if (isset($_GET['ref']) && !empty($_GET['ref'])) {
    $referer = Users::getUserIdByRef($_GET['ref']);
    $_SESSION['ref'] = $referer;
}

//Misc::authPage();
$ulevel = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : "";

switch ($duty) {

    case 'home':
        home();
        break;

    case 'about':
        about();
        break;

    case 'faq':
        faq();
        break;

    case 'rules':
        rules();
        break;

    case 'support':
        contact();
        break;

    case 'cust':
        descr();
        break;

    case 'login':
        login();
        break;

    case 'signup':
        signup();
        break;

    case 'forgot_password':
        pwd_reset();
        break;

    case 'acct':
        acct();
        break;

    case 'news':
        news();
        break;

    default:

        home();

        break;
}

include 'foot.php';

function home()
{
    ?>

<main class="page-main">

    <div class="index-bl">
        <div class="index-bl__header">
            <div class="container-sm">
                <div class="index-bl__title">Make earnings on the technologies of the future today</div>
                <p>We invite you to the world of digital currencies. With the company <?php echo CORP; ?> earnings on
                    cryptocurrency trading is available to everyone.</p>
                <a href="?p=login" class="btn btn--dark">Member Login</a>
                <a href="?p=signup" class="btn btn--highlight">Registration</a>
            </div>
        </div>
        <article class="index-bl__about about-bl about-bl--bg">
            <div class="container about-bl__container">
                <div class="about-bl__inner">
                    <div class="about-bl__title">
                        <span>about</span>
                        <?php echo CORP; ?>
                    </div>

                    <p>Crypto Benefit Inc is an association of a large number of professional traders into one group in
                        order to achieve a higher efficiency of cryptocurrency trading. In comparison with earlier
                        stages of development, the company has significantly expanded its activities by trading several
                        financial instruments. Simultaneous trading of multiple digital currencies allows Crypto Benefit Inc
                        to diversify risks by blocking the sagging rate of one of them with successful transactions with
                        another cryptocurrency.</p>
                    <p>The current goal of Crypto Benefit Inc is to stabilize the new, higher peaks of the profits by
                        expansion of working capital and proper allocation of available financial resources.</p>

                </div>
                <div class="about-bl__video">
                    <img src="assets/img/tmp-video.png" alt="" class="smooth">
                </div>
            </div>
        </article>
    </div>


    <div class="plan-wr">
        <div class="container plan-wr__container">
            <div class="js-slider owl-carousel" style="display: flex; justify-content: space-around;">
                <?php
$plans = array();
    $plans = Transactions::getInvestmentPlans();

    foreach ($plans as $plan) {
        ?>

                <div class="plan-card plan-card--simple">
                    <div class="plan-card__head">
                        <div class="plan-card__percent"><?php echo $plan['profit'] ?> %</div>
                        After <?php echo $plan['delay'];
        echo ($plan['plan_id'] == 1) ? ' Day' : ' Days'; ?>
                    </div>
                    <ul class="plan-card__list">
                        <li>
                            <span>Min:</span>
                            <b><?php echo number_format($plan['min_deposit']); ?> USD</b>
                        </li>
                        <li>
                            <span>Max:</span>
                            <b><?php echo ($plan['plan_id'] != 3) ? number_format($plan['max_deposit'], 2) . ' USD' : 'Unlimited' ?>
                            </b>
                        </li>
                    </ul>
                    <div class="plan-card__deposit">Deposit Included</div>

                    <a href="?p=signup" class="plan-card__btn plan-over__btn btn btn--bl">Invest now</a>

                </div>

                <?php
}

    ?>


            </div>

        </div>
    </div>


    <section class="referal">
        <div class="container-sm">
            <div class="referal__percent">5%</div>
            <div class="referal__title">REFERRAL COMMISSION PROGRAM</div>
            <div class="referal__txt">For participation in our partner program you don't need to have your own deposit.
                You earn referral commission is paid directly into you e-currency account instantly.</div>
            <a href="?p=signup" class="btn btn--default">Create an account</a>
        </div>
    </section>
    <section class="how-it-work">
        <div class="container">
            <div class="how-it-work__txt">
                <h3 class="how-it-work__title">How it Works?</h3>
                <p>Go through a simple registration procedure on the website. Choose the investment plan that suits you.
                    Make a deposit. Get profit and withdraw it at your convenience.</p>
            </div>
            <div class="how-it-work__steps">
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>registration</span>
                </div>
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>Make deposit</span>
                </div>
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>Get profit</span>
                </div>
            </div>
        </div>
    </section>
    <?php
$data = time();
    $acct_count = substr($data, 5, 4);
    $acct_count = $acct_count + 2042;
    $deposit = $data / 765;
    $withd = $data / 988;

    $latest_deposits = array();
    $latest_deposits = Transactions::getLatestDeposits();

    $latest_withd = array();
    $latest_withd = Transactions::getLatestWithdraw();

    ?>

    <div class="features">
        <div class="container">
            <div class="features__stat stat-row">
                <div class="stat-row__col">
                    <div class="stat-row__title">May 05, 2016</div>
                    <div>Started</div>
                </div>
                <div class="stat-row__col">
                    <div class="stat-row__title">
                        <?php echo number_format((strtotime('today') - strtotime('2016-05-05')) / (24 * 60 * 60)); ?>
                    </div>
                    <div>running days</div>
                </div>
                <div class="stat-row__col">
                    <div class="stat-row__title"> <?php echo number_format($acct_count); ?></div>
                    <div>total Accounts</div>
                </div>
                <div class="stat-row__col">
                    <div class="stat-row__title">$ <?php echo number_format($deposit, 2); ?></div>
                    <div>total Deposited</div>
                </div>
                <div class="stat-row__col">
                    <div class="stat-row__title">$ <?php echo number_format($withd, 2); ?></div>
                    <div>total withdrawal</div>
                </div>
            </div>
            <div class="features__inner">
                <div class="features__col">
                    <div class="features__title">Official UK Сompany</div>
                    <p>Crypto Benefit Inc is a legal company incorporated in the United Kingdom. <a
                            href="https://beta.companieshouse.gov.uk/company/11511637" target="_blank">Check>></a></p>
                    <p class="features__comment">Register Certificate no.: <span>11511637</span></p>
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
            </div>
        </div>
    </div>
    <div class="features" style="background: url(assets/img/test2.jpg) 0 0; background-size: cover;">
        <div class="container">
            <div class="table-wr__group">
                <div class="table-wr">
                    <div class="table-wr__title">Last Deposits</div>
                    <table>
                        <?php
foreach ($latest_deposits as $deposits) {

        ?>
                        <tr>
                            <td width="45%"
                                title="<?php echo ucwords(Users::getNicnameById($deposits['client_id'])); ?>">
                                <span><?php echo $deposits['category'] != 1 ? ucwords(Users::getNicnameById($deposits['client_id'])) : ucwords($deposits['username']); ?></span>
                            </td>
                            <td width="70"><span class="payment-ic payment-ic--48"></span></td>
                            <td class="text-center"><span>$ <?php echo number_format($deposits['amount'], 2); ?></span>
                            </td>
                        </tr>
                        <?php
}

    ?>

                    </table>
                </div>
                <div class="table-wr table-wr--light">
                    <div class="table-wr__title">Last Withdrawals</div>
                    <table class="table--deposit table--nowrap">
                        <?php

    foreach ($latest_withd as $deposits) {

        ?>
                        <tr>
                            <td width="45%"
                                title="<?php echo ucwords(Users::getNicnameById($deposits['client_id'])); ?>">
                                <span><?php echo $deposits['category'] != 1 ? ucwords(Users::getNicnameById($deposits['client_id'])) : ucwords($deposits['username']); ?></span>
                            </td>
                            <td width="70"><span class="payment-ic payment-ic--48"></span></td>
                            <td class="text-center"><span>$ <?php echo number_format($deposits['amount'], 2); ?></span>
                            </td>
                        </tr>
                        <?php
}

    ?>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="" style="width: 100%; background: url(assets/img/test1.png);">
        <div class="container payment-list">
            <img src="assets/img/payment-img-pm.png" alt="">
            <img src="assets/img/payment-img-py.png" alt="">
            <img src="assets/img/payment-img-adv.png" alt="">

            <div class="payment-list__icons">
                <img src="assets/img/payment-img-btc.png" alt="">

            </div>
        </div>
    </div>
</main>

</div>

<?php
}

function about()
{
    ?>



<main class="page-main">

    <div class="page-title">
        <div class="container">
            <h1>about us</h1>
        </div>
    </div>

    <article class="about-bl about-bl--bg">
        <div class="container about-bl__container">
            <div class="about-bl__inner">
                <div class="about-bl__title">
                    <span>our</span>
                    company
                </div>

                <p>The development and popularization of digital currencies reaches its climax — even now such monetary
                    units are massively used
                    for Internet payments, and in the near future will certainly qualify for the status of a
                    full-fledged global payment instrument.</p>

                <p>High volatility is an indicator of the ability of a currency to change its value sharply both upwards
                    and downwards in certain time
                    intervals. This contributes to the high investment attractiveness of cryptographic currencies,
                    respectively. The right approach to trade
                    cryptocurrencies on the international markets makes it possible to manipulate this statistic in
                    order to generate private profit.</p>

                <p><?php echo CORP; ?> is an association of a large number of professional traders into one group in
                    order to achieve a higher efficiency
                    of cryptocurrency trading. In comparison with earlier stages of development, the company has
                    significantly expanded its activities by trading
                    several financial instruments, which allows
                    <?php echo CORP; ?> to diversify risks by blocking the sagging rate of one of them with successful
                    transactions with another cryptocurrency.
                    Thus, random failures do not become a barrier to achieving legitimate success.</p>

            </div>
            <div class="about-bl__video">
                <img src="/assets/img/tmp-video.png" alt="" class="smooth">
            </div>
        </div>
    </article>

    <section class="how-it-work">
        <div class="container">
            <div class="how-it-work__txt">
                <h3 class="how-it-work__title">How it Works?</h3>
                <p>Go through a simple registration procedure on the website. Choose the investment plan that suits you.
                    Make a deposit. Get profit and withdraw it at your convenience.</p>
            </div>
            <div class="how-it-work__steps">
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>registration</span>
                </div>
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>Make deposit</span>
                </div>
                <div class="how-it-work__step">
                    <div class="how-it-work__icon"></div>
                    <span>Get profit</span>
                </div>
            </div>
        </div>
    </section>


    <div class="container txt-bl">
        <div class="row">
            <div class="col-5">
                <article class="about-bl">
                    <div class="about-bl__title">
                        <span>our</span>
                        mission
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
                    <div class="about-bl__title">
                        <span>our</span>
                        vision
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
                    <div class="features__title">Official UK Сompany</div>
                    <p><?php echo CORP; ?> is a legal company incorporated in the United Kingdom. <a
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
            </div>
        </div>
    </div>

</main>

</div>



<?php
}

function faq()
{
    ?>

<main class="page-main">


    <div class="page-title">
        <div class="container">
            <h1>frequently asked questions</h1>

        </div>
    </div>

    <div class="container faq-page">

        <nav class="side-nav faq-page__nav" id="faq-nav">
            <ul>
                <li class="side-nav__item side-nav__item--active"><a class="side-nav__link" href="#general">General</a>
                </li>
                <li class="side-nav__item"><a class="side-nav__link" href="#technical">Technical</a></li>
                <li class="side-nav__item"><a class="side-nav__link" href="#financial">Financial</a></li>
                <li class="side-nav__item"><a class="side-nav__link" href="#affiliate">Affiliate</a></li>
            </ul>
        </nav>

        <dl class="faq-list faq-page__list" id="general">

            <dt class="faq-list__title faq-list__title--open">What are the <?php echo CORP; ?> Company's activities?
            </dt>
            <dd class="faq-list__body">
                <p><?php echo CORP; ?> is engaged in trading activities on the on the crypto-currency market. The
                    company's income is generated by
                    successfully executed trades on the currency market.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Why does the company attract additional investments from
                private individuals?</dt>
            <dd class="faq-list__body">
                <p>Additional investments will allow to increase the number of transactions executed on the currency
                    market, and thus will increase the overall profitability of the company. Investors in turn will
                    receive certain percentage of profit depending on the amount of funds invested.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What are the advantages of the <?php echo CORP; ?> Company
                over competitors?</dt>
            <dd class="faq-list__body">
                <p>Our goal is not to conduct the tough competition, but to receive a stable profit on the
                    crypto-currency market using our own strategy. We have developed special investment packages with
                    optimum service plans and affiliate program for passive income for investors.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What are the risks for <?php echo CORP; ?> company's
                investors?</dt>
            <dd class="faq-list__body">
                <p>The risks for our investors are minimized due to the professional team and our experience. Each
                    company's investor will receive a daily profit according to the terms of the investment plan that
                    was chosen.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What do I need in order to start?</dt>
            <dd class="faq-list__body">
                <p>First, you should register on our web-site. The registration procedure is simple and will take just a
                    few minutes. Fill all required fields in registration form, login to account, choose an optimum
                    investment plan and deposit your account. After that you'll become an official investor of the
                    <?php echo CORP; ?> Company and will receive a profit according to the service plan chosen.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Am I able to create multiple accounts on the web-site?
            </dt>
            <dd class="faq-list__body">
                <p>No, the multiple registrations on the web-site are forbidden. A single user can create only one
                    account.</p>
            </dd>
        </dl>

        <dl class="faq-list faq-page__list" id="technical">
            <dt class="faq-list__title faq-list__title--open">Do I need to pass the identity authentication procedure
                after the registration on the web-site?</dt>
            <dd class="faq-list__body">
                <p>No, the identity authentication is not required. However, we are looking for you consciousness and
                    believe that you will provide authentic information about yourself.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Can I change my personal data (login, password, e-mail
                etc.)?</dt>
            <dd class="faq-list__body">
                <p>Yes, you can change some of your personal data through the personal account by yourself.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">I forgot my account's password. What do I need to do?</dt>
            <dd class="faq-list__body">
                <p>You can recover a password using the automatic password recovery. You can also contact support.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What is the security level of the company's web-site?</dt>
            <dd class="faq-list__body">
                <p>We use an expensive dedicated server of the ddos-guard.net company which protects our web-site from
                    any DDoS attack. Web-site is also provided with SSL Comodo - the high reliability certificate that
                    provides the higher level of protection and security accreditation.</p>
            </dd>
        </dl>

        <dl class="faq-list faq-page__list" id="financial">
            <dt class="faq-list__title faq-list__title--open">How to deposit an account?</dt>
            <dd class="faq-list__body">
                <p>Once you make a decision about deposit amount, please, use one of the payment systems which cooperate
                    with the company.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What payment systems cooperate with the company?</dt>
            <dd class="faq-list__body">
                <p>We cooperate with Perfect Money, Payeer, AdvCash, Bitcoin, Litecoin, Ethereum, Bitcoin Cash and Dash.
                </p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What is the basis of profit charging?</dt>
            <dd class="faq-list__body">
                <p>Profit will be charged on your personal account according to the investment plan that was chosen.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What is the minimum and maximum deposit amount?</dt>
            <dd class="faq-list__body">
                <p>The minimum deposit amount is $25. Maximum - $100,000.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Am I able to create several deposits at a time and make
                profit from two investment plans simultaneously?</dt>
            <dd class="faq-list__body">
                <p>Yes, you can place money on any number of deposits with a single account and make profit from
                    multiple investment plans.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Is it possible to place money using one payment system and
                withdraw them using another?</dt>
            <dd class="faq-list__body">
                <p>No, you can withdraw money only with the payment system that was used to place them on deposit.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Am I able to request the deposit withdrawal before the end
                of investment period?</dt>
            <dd class="faq-list__body">
                <p>No. The deposit can be withdrawn only after the end of investment period which is specified in the
                    investment plan that was chosen.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">How quickly can the request of the money withdrawal be
                processed?</dt>
            <dd class="faq-list__body">
                <p>The request is processed in manual mode for 24 business hours.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Do you have any hidden fees for money deposit/withdrawal?
            </dt>
            <dd class="faq-list__body">
                <p>No, we don't have any hidden fees. Withdraw fee Bitcoin - 0.0005 BTC ($5)</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">What are the characteristics of the deposits crediting in
                the crypto-currency system?</dt>
            <dd class="faq-list__body">
                <p>Bitcoin, Litecoin, Ethereum, Bitcoin Cash and Dash, being a decentralized system, carries out
                    transactions on the basis of a certain number of confirmations in the blockchain network, which are
                    required so that the transaction was considered complete. Deposits in the <?php echo CORP; ?> made
                    via crypto-currency system, require a minimum of 2 confirmations before being recorded in the
                    personal account of the investor.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Is the fixed rate of Bitcoin against the dollar being used
                by the <?php echo CORP; ?> company?</dt>
            <dd class="faq-list__body">
                <p>Yes, to minimize effects from the volatility of the exchange rate of Bitcoin for our clients, we use
                    a fixed rate determined at $10000/BTC. All deposits in Bitcoin by the clients <?php echo CORP; ?>,
                    are automatically converted at this rate.</p>
            </dd>
        </dl>

        <dl class="faq-list faq-page__list" id="affiliate">
            <dt class="faq-list__title faq-list__title--open">Do you have an affiliate program?</dt>
            <dd class="faq-list__body">
                <p>Yes, we developed a single-level affiliate program according to which a program beneficiary will be
                    charged with 5% of commission charge from the each of his/her partner deposit amounts.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Is it possible to make profit from the affiliate program
                without placing a deposit?</dt>
            <dd class="faq-list__body">
                <p>Yes, you can gain a passive income with no direct investments.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">How can I use money which was gained via the affiliate
                program participation?</dt>
            <dd class="faq-list__body">
                <p>You can withdraw them or use to invest in a project.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">How can I attract new partners?</dt>
            <dd class="faq-list__body">
                <p>You can use special promotional materials to attract partners.</p>
            </dd>
            <dt class="faq-list__title faq-list__title--open">Do you pay a referral commission for a deposit from a
                balance account?</dt>
            <dd class="faq-list__body">
                <p>No. You receive referral commission only for deposits from payment systems.</p>
            </dd>

        </dl>

    </div>

</main>

</div>

<?php

}

function rules()
{

    ?>

<main class="page-main">


    <div class="page-title">
        <div class="container">
            <h1>Rules & Agreements</h1>
        </div>
    </div>

    <div class="txt-page">

        <div class="container-sm">
            We strongly recommend to read the terms and conditions of the convention before registration on the website
            and becoming the company's investor.
            <p>The rules, General terms and conditions of cooperation of the company <?php echo CORP; ?> (the "Company")
                and
                the investor (hereinafter - the Investor) are prescribed in this section.
                This document alludes to the fact that both parties accept all regulations, which are spelled out in the
                document and agree to abide by them.
                The document comes into force once the registration on the website of the Company is completed by the
                Investor.

                <h3>1. <span>GENERAL PROVISIONS</span></h3>
                <p>1.1. In order to register on the website of the Company and to become the Investor, the person must
                    be at least 18 years old at the moment of the registration.
                    <br>1.2. The user automatically receives the status of the Investor immediately after registration
                    on the website and accepting all the terms of the agreement.
                    <br>1.3. If the user disagrees with any of the provisions of this agreement or if they have any
                    doubts on certain items - the registration should be terminated.
                    <br>1.4. All financial transactions carried out through the Company's website, are confidential and
                    are not disclosed to third parties. The Investor has an opportunity to carry out financial
                    transactions and to use other services of the Company only after registration on the website.</p>

                <h3>2. <span>THE RIGHTS AND OBLIGATIONS OF THE COMPANY</h3>

                <p>2.1. The Company undertakes to use funds from investors for its intended purpose and to conduct real
                    activity on the Forex market.
                    <br>2.2. The company guarantees the safety of the Investor's funds and undertakes to perform deposit
                    and withdrawal of profit timely.
                    <br>2.3. The company is not responsible for any technical malfunctions of electronic payment
                    systems. Financial transactions that are associated with deposit and withdrawal of funds to the
                    account of electronic payment systems are irreversible and final.
                    <br>2.4. The company shall not be personally liable for incorrectly executed transactions with
                    monetary funds and for incorrectly issued financial account.
                    <br>2.5. The company is responsible for
                    maintaining the confidentiality of personal information that has been provided by the Investor.</p>

                <h3>3. <span>THE RIGHTS AND OBLIGATIONS OF THE INVESTOR</h3>

                <p>3.1. The investor, while filling in the registration form, is personally responsible for the accuracy
                    of the information provided.
                    <br>3.2. The Investor is obliged to review each transaction on their financial account. In case of
                    detecting any inaccuracies or discrepancies, the Investor can seek help from support services.
                    <br>3.3. All services provided by the Company, shall be used by the Investor only in order to
                    conduct investment activities.
                    <br>3.4. The investor consents to the processing of personal information in accordance with the
                    provisions stated in the legislation.</p>

                <h3>4. <span>RISK DISCLOSURE</h3>

                <p>4.1. The company minimizes the risks that may arise during the conduct of activities in the currency
                    market. In addition, there are risks which are related to the use of an Internet-based deal
                    execution trading system and include risks connected with possible hardware or software
                    failures.</p>

                <h3>5. <span>COPYRIGHT NOTICE</h3>

                <p>5.1. www.<?php echo CORP; ?> website, all the information and services hosted are the private
                    property of
                    the Company and are protected by copyright law.
                    <br>5.2. In the case of copyright infringement (harming website, copy materials, and so on.) the
                    Investor will be prosecuted; his account will be blocked, along with funds that were on his personal
                    account.</p>

                <h3>6. <span>CIRCUMSTANCES OF INSEPARABLE FORCE</h3>

                <p>6.1. For the duration of circumstances of inseparable force (changes in legislation, natural
                    disasters, military situation, etc.); the Company shall be entitled to suspend its activities
                    indefinitely. Such circumstances can not be subject of influence from both the Company and the
                    Investor.
                    <br>6.2. The circumstances of inseparable force imply the impossibility to carry out any
                    transactions and financial transactions in standard mode.</p>

                <h3>7. <span>INTRODUCTION OF AMENDMENTS AND ADDITIONS</h3>

                <p>7.1. Applicable rules and the terms of the agreement can be reviewed by the project administration.
                    <br>7.2. The administration has the right to make changes and additions at any time. Additions and
                    changes are published in this section and shall take effect immediately after their announcement.
                    <br>7.3. In order to be aware of possible changes, we encourage you to periodically review this
                    section.</p>

                <h3>8. <span>TERMINATION OF THE COOPERATION</h3>

                <p>8.1. Termination of the cooperation between the Company and the Investor may be initiated by either
                    side.
                    <br>8.2. The Company has the right to unilaterally terminate the cooperation with the Investor in
                    case of violation of terms and conditions of the agreement.
                    <br>8.3. The Investor can terminate the agreement if they decide to cease their investment
                    activities in the Company.</p>

                <h3>9. <span>THE SCHEME OF ARRANGEMENT</h3>

                <p>9.1 Conflict resolution between the Company and the Investor shall be held in the format of
                    negotiations or in accordance with applicable law.</p>
        </div>

    </div>

</main>

</div>

<?php

}

function contact()
{
    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {
        //var_dump($_POST); die();
        Misc::stopRefresh();
        $name = strip_tags($_POST['name']);
        $email = strip_tags(strtolower($_POST['email']));

        $msg = strip_tags($_POST['message']);
        $req = isset($_POST['req']) ? 'Order' : '';
        if (!empty($name) && !empty($email) && !empty($msg)) {
            $subj1 = $req . ' Message Received From a visitor @' . $_SERVER['SERVER_NAME'];
            $msgs = '';
            $msgs .= '
			The details is as follows:<br>
			<ul>
			<li> Name: ' . ucwords($name) . '</li>
			<li> Email Address: ' . strtolower($email) . '</li>

			<li style="text-align: justify; padding: 10px 20px;"> Message: ' . $msg . '</li>

			</ul>

			<p> Dated: ' . date('Y-m-d', strtotime('today')) . '</p>
			';

            $send = Misc::sendMail($msgs, $subj1, 'admin@' . $_SERVER['SERVER_NAME'], 'Director');
            if ($send) {
                //var_dump($send);
                $_SESSION['result'] = array('1', 'Message Successfully sent!. You will receive your response shortly');
            } else {
                echo $send;
                $_SESSION['result'] = array('2', 'Oops! There seems to be an error; It will ratified in shortly.');
            }
        }
    }

    Misc::setToken();

    ?>
<main class="page-main">


    <div class="page-title">
        <div class="container">
            <h1><?php echo isset($_GET['item']) ? 'Request' : 'Contact Us'; ?></h1>
            <p>We are always ready to help you. There are many ways to contact us. You may drop us a line, give us a
                call or send an email, choose what suits you most.</p>
        </div>
    </div>

    <div class="container">

        <div class="info-bl">
            <div class="info-bl__col">
                <div class="info-bl__icon"><img src="assets/img/ic-info-1.png" alt=""></div>
                <div class="info-bl__txt">
                    48 Warwick Street, London <br>
                    United Kingdom, W1B 5AW
                </div>
            </div>
            <div class="info-bl__col">
                <div class="info-bl__icon"><img src="assets/img/ic-info-2.png" alt=""></div>
                <div class="info-bl__txt"><a
                        href="mailto:support@<?php echo $_SERVER['SERVER_NAME']; ?>">support@<?php echo $_SERVER['SERVER_NAME']; ?></a>
                </div>
            </div>
            <div class="info-bl__col">
                <div class="info-bl__icon"><img src="assets/img/ic-info-3.png" alt=""></div>
                <div class="info-bl__txt">+442039368123</a></div>

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


            <form method="post" action="" name="mainform" id="support-form" class="form-wr"><input required
                    type="hidden" name="pg_lvl" value="1"><input required type="hidden" name="formToken"
                    value="<?php echo $_SESSION['pgToken']; ?>">
                <div class="form-wr__col">
                    <label for="username">Full Name</label>
                    <input value="" required type="text" class="input" placeholder="Your name" name="name"
                        data-label="Username" id="username"> </div>

                <div class="form-wr__col">
                    <label for="email-address">Email Address</label>

                    <input required type="email" class="input" name="email" id="email-address" data-label="Email"
                        value="" placeholder="Your email">
                </div>

                <label for="message">Message</label>
                <textarea name="message" data-label="Message" id="message"
                    placeholder="Briefly describe the issue"></textarea>

                <input required type="hidden" name="p" value="support">
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

function descr()
{
    ?>

<div id="main-other">
    <div id="sub-other">

        <div class="other-head">
            <p> Meet Our Clients</p>

        </div>
        <br>
        <style>
        .owl-carousel {

            padding: 40px 20px;
            //margin: 70px 30px;
            //border: #fff 1px solid;
            max-height: auto !important;
            //overflow: hidden;
        }

        .owl-carousel .item {
            float: left;
            display: list-item;
            text-align: center;
            padding: 20px 10px;
            list-style-type: none;
            position: relative;
            margin-bottom: 20px !important;

        }

        .owl-carousel .item #i {

            animation: slider 3s 3s linear;
        }


        .owl-carousel .item #ii {

            animation: slider 3s 6s linear;
        }


        .owl-carousel .item #iii {

            animation: slider 3s 9s linear;
        }



        @keyframes slider {
            0% {
                left: 0%;
            }

            100% {
                left: -100%;
            }
        }

        .owl-carousel .item h4 {
            color: black !important;
        }

        .owl-carousel .item img {
            border-radius: 100%;
            height: 70px;
            width: 70px;
        }
        </style>
        <div class="col-md-6 col-sm-7 bg-dark-transparent-7">

            <div class="owl-carousel" data-dots="true">
                <div class="item">
                    <div class="testimonial-wrapper text-center">
                        <div class="content" id="">

                            <a class="mt-20 mb-15 display-block" href="#">
                                <img alt="" src="images/testimonials/2.jpg" class="img-circle">
                            </a>
                            <p class="mb-sm-10 ">Just wanted to say that the program is wonderful and keep doing the
                                great work. I get the withdrawals daily very quick, that's another amazing thing. Thanks
                                again. </p><br />
                            <h4 class="service-box-title font-weight-800 ">Robin Bush</h4>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper text-center">
                        <div class="content" id="">
                            <i class="text-theme-colored2 font-42 mt-15 mb-10 mb-sm-0"></i>
                            <a class="mt-20 mb-15 display-block" href="#">
                                <img alt="" src="images/testimonials/5.jpg" class="img-circle">
                            </a>
                            <p class="mb-sm-10 "> I have been investing with investment programs for quite a long time
                                but in my whole experience l've never met AN EXCELLENT PROGRAM like Crypto Benefit Inc. </p>
                            <h4 class="service-box-title font-weight-800 ">Jhon Doe</h4>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper text-center">
                        <div class="content" id="">
                            <i class="text-theme-colored2 font-42 mt-15 mb-10 mb-sm-0"></i>
                            <a class="mt-20 mb-15 display-block" href="#">
                                <img alt="" src="images/testimonials/1.jpg" class="img-circle">
                            </a>
                            <p class="mb-sm-10 ">I am customer of company Crypto Benefit Inc since 15 months. I can say that
                                this company inspires confidence and is worth your attention. Customer support at the
                                highest level! They do great job! My deposit is 500$ and i withdraw profit every day
                                instantly. Good Luck! </p>
                            <h4 class="service-box-title font-weight-800 ">Corvin Abel</h4>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper text-center">
                        <div class="content" id="">
                            <i class="text-theme-colored2 font-42 mt-15 mb-10 mb-sm-0"></i>
                            <a class="mt-20 mb-15 display-block" href="#">
                                <img alt="" src="images/testimonials/4.jpg" class="img-circle">
                            </a>
                            <p class="mb-sm-10 ">I am satisfied with Crypto Benefit Inc . I registered a month ago and I got
                                very good results. The company's site is pretty nice and very simple to use. I recommend
                                you to join as soon as possible and enjoy the daily income. Good Luck!
                            </p>
                            <h4 class="service-box-title font-weight-800 ">Jane Magrette</h4>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper text-center">
                        <div class="content" id="">
                            <i class="text-theme-colored2 font-42 mt-15 mb-10 mb-sm-0"></i>
                            <a class="mt-20 mb-15 display-block" href="#">
                                <img alt="" src="images/testimonials/3.jpg" class="img-circle">
                            </a>
                            <p class="mb-sm-10 ">I am constantly getting paid immediately after requesting a withdrawal
                                order. Crypto Benefit Inc is the best Program to trust and invest in. Lets join and invest
                                with this honest program.
                            </p>
                            <h4 class="service-box-title font-weight-800 ">Adams Zuma</h4>

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

function news()
{
    ?>


<div id="main-other">
    <div id="sub-other">

        <div class="other-head">
            <p> Latest News</p>

        </div>
        <br>
        <p> We currently do not have any news here; please check later!</p>
    </div>
</div>
</div>
<?php
}

function acct()
{

    $duty = $_POST['duty'];

    if ($duty == 'login') {
        $email = trim($_POST['username']);
        $pwd = trim($_POST['password']);

        $test = Users::authAcct($email, $pwd);

        if ($test != null) {
            $_SESSION['pid'] = $test['user_id'];
            $_SESSION['user_type'] = $test['user_level'];
            $_SESSION['key'] = 'FINE';

            if ($_SESSION['user_type'] == ADMIN) {
                echo '<script required type="text/javascript"> window.location = "secured/?pg=admin_dash";</script>';
            } else {
                echo '<script required type="text/javascript"> window.location = "secured/?pg=dash";</script>';
            }
        } else {
            $_SESSION['result'] = array(2, 'Incorrect Username/Password, please crosscheck');

            login();
        }
        /**
         * display: inline;

         */
    } elseif ($duty == 'signup') {

        $name = $_POST['fullname'];
        $email = trim(strtolower($_POST['email']));
        $pwd = trim($_POST['password']);
        $cpwd = trim($_POST['password2']);
        $btc = $_POST['btc_addr'];
        $pet = $_POST['username'];

        if ($pwd != $cpwd) {
            $_SESSION['result'] = array('2', 'Please crosscheck the passwords fields');
            signup();
        }

        if (!empty($name) && !empty($email) && !empty($pwd) && !empty($pet) && empty($_SESSION['result'])) {

            Misc::stopSignupRefresh();
            //var_dump($_SESSION); die();
            $test = Users::getUserIdByEmail($email);
            if ($test == null) {
                $reflink = Misc::getRandomRef(16);
                $create = Users::createAcct(ucwords($name), $email, $pet, $pwd, $pet);

                if ($create != null) {
                    $addBtc = Users::addBitcoinAddrByUid($create, $btc);
                    $_SESSION['pid'] = $create;
                    $_SESSION['user_type'] = CLIENT;
                    $_SESSION['key'] = 'FINE';

                    $_SESSION['result'] = array(1, 'Congrats!, Account successfully created<br> You are welcomed to Crypto Benefit Inc . <br><br> You are being redirected to your dashboard');
                    if (isset($_SESSION['ref']) && !empty($_SESSION['ref'])) {
                        $addReferer = Transactions::addReferer($_SESSION['ref'], $create);
                    }

                    /////////////////////////// WELCOME MAIL //////////////////////////////////////

                    $subj1 = 'Thanks for Joining Us @ ' . CORP;
                    $msgs = '';
                    $msgs .= '

  <style>
*{
padding: 0;
margin: 0;
background-color: antiquewhite;
}

.expert-body{
position: relative;
margin: 5%;
padding: 2%;
//border: 1px solid #000;
text-align: justify;
}

.expert-body p{
padding: auto 5%;
margin: 0 auto;
}

.logo img{
display: flex;
  margin: 0 auto;
  padding: 30px;
}

}
</style>

<div class="expert-body">
<div class="logo"> <img src="' . $_SERVER['SERVER_NAME'] . '/assets/img/logo.jpg" alt="Crypto Benefit Inc "  height="100px" width="300px" />

<div style="
  margin: 0 auto;
  left: 20%;
  display: block;">
  <p>Hello investor</p>

  <p>' . $_SERVER['SERVER_NAME'] . ' is a UK-Based Company with over 7years experience in the art of binary trading and investment management. We have top UK companies strongly partnering with us to ensure smooth drift of transaction and stable flow of Bitcoin. We assure you constant flow in of instant withdrawals and bonus accreditation.<br />
  NO delay in withdrawals, and interesting packages.</p>

  <p>Thank you for signing up to Expert-Options.com!</p>

  <p><br />
  Best regards,</p>

  <p>Expert-Options Team</p>


  <p> Dated: ' . date('d M, Y', strtotime('today')) . ' </p>
  </div></div>

';

                    //var_dump($_POST);
                    $send = Misc::sendMail($msgs, $subj1, $email, Users::getUserFullNameByEmail($email));

                    //echo '<script required type="text/javascript"> window.location = "secured/?pg=dash";</script>';
                    signup();
                    echo '<script required type="text/javascript"> setTimeout(function(){window.location = "secured/?pg=dash"}, 5000);</script>';
                } else {
                    $_SESSION['result'] = array(2, 'An error Occurred!, please try again later');
                    signup();
                    //echo '<script required type="text/javascript"> window.location = "./";</script>';
                }
            } else {
                $_SESSION['result'] = array(2, 'Email already in use; Please login Instead');
                signup();
                //echo '<script required type="text/javascript"> window.location = "./";</script>';

            }
        } else {
            echo '<script required type="text/javascript"> window.location = ".";</script>';
        }
    } else {
        signup();
    }
}

function signup()
{
    Misc::setToken();
    ?>
<script type="text/javascript">
$('button).on('
submit ', function(){
$('body').removeClass('loaded');
});
</script>

<main class="page-main">

    <div class="page-title">
        <div class="container">
            <h1>New account creation</h1>
            <p>When filling out the registration form, we recommend that you specify reliable data. This will allow us
                to
                quickly solve the problem with restoring access to your account in case you have problems logging into
                your
                account.</p>
        </div>
    </div>





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
        if (document.regform.password.value == '') {
            alert("Please enter your password!");
            document.regform.password.focus();
            return false;
        }

        if (document.regform.password.length < 8) {
            window.alert('Your password must be more than 7 characters')
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
        if (sText == '') return false;
        for (i = 0; i < sText.length && IsNumber == true; i++) {
            Char = sText.charAt(i);
            if (ValidChars.indexOf(Char) == -1) {
                IsNumber = false;
            }
        }
        return IsNumber;
    }
    </script>




    <form class="container-sm" method="post" name="regform" id="signup-form" action="?p=acct"><input required
            type="hidden" name="pg_lvl" value="1"><input required type="hidden" name="formToken"
            value="<?php echo $_SESSION['pgToken']; ?>">

        <input required type="hidden" name="p" value="acct">
        <input required type="hidden" name="duty" value="signup">


        <div class="form-wr">

        </div>

        <div class="bl-title"><span>Personal Information</span></div>

        <div class="form-wr">
            <div class="form-wr__col">
                <label for="FullName">Full Name</label>
                <input name="fullname" id="fullname" data-label="Full name" value="" required type="text"
                    placeholder="Full name">
            </div>
            <div class="form-wr__col">
                <label for="username">Username</label>
                <input name="username" id="username" data-label="Username" value="" required type="text"
                    placeholder="Username">
            </div>
            <div class="form-wr__col">
                <label for="email">Email Address</label>
                <input name="email" value="" id="email" data-label="E-mail" required type="email"
                    placeholder="Valid E-mail">
            </div>
            <div class="form-wr__col">
                <label for="email1">Re-type Email Address</label>
                <input name="email1" value="" id="email1" data-label="E-mail" required type="email"
                    placeholder="Re-type Email Address">
            </div>
            <div class="form-wr__col">
                <label for="password">Password</label>
                <input name="password" id="password" value="" required type="password" placeholder="Password"
                    data-label="Password">
            </div>
            <div class="form-wr__col">
                <label for="password2">Re-type Password</label>
                <input name="password2" id="password2" value="" required type="password" placeholder="Re-type password"
                    data-label="Re-type password">
            </div>
        </div>

        <div class="bl-title"><span>Payment Information</span></div>

        <div class="form-wr">

            <div class="form-wr__col" title="Bitcoin">
                <label>Bitcoin</label>
                <input name=btc_addr value="" type="text" placeholder="Your Bitcoin">
            </div>


        </div>

        <div class="bl-title"><span>TERMS & CONDITIONS</span></div>
        <div class="form-wr">


            <div class="check-item">
                <input required type="checkbox" id="terms" name="agree" value="1">
                <label for="terms">I have read and agree with <a href="?p=rules" target="_blank">Terms and
                        conditions</a>
                </label>
            </div>


            <div class="form-wr__btn-bl">
                <button class="btn" style="min-width: 200px;">submit</button>
            </div>
        </div>

    </form>

</main>

</div>

<?php
}

function login()
{
    Misc::setToken();
    ?>

<script type="text/javascript">
$('button).on('
submit ', function(){
$('body').removeClass('loaded');
});
</script>

<main class="page-main">


    <div class="page-title">
        <div class="container">
            <h1>account access</h1>
            <p>In this section you can enter your personal account.</p>
        </div>
    </div>

    <div class="container-sm">

        <div class="alert alert--info alert--secure">
            In order to log in to your personal account, enter the nickname you specified during registration, password
            and captcha. After confirmation of this procedure, you will automatically go to your personal account.
        </div>

        <div class="bl-title"><span>login credentials</span></div>



        <form class="form-wr" method="post" name="mainform" id="login-form" action="?p=acct"><input required
                type="hidden" name="duty" value="login"><input required type="hidden" name="formToken"
                value="<?php echo $_SESSION['pgToken']; ?>">


            <div class="form-wr__col">
                <label for="username">Username</label>
                <input required type="text" placeholder="Enter your username" name="username" value='' id="username">
            </div>

            <div class="form-wr__col">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password" placeholder="Enter your password">

                <a href="?p=forgot_password" class="form-link">forgot your password?</a>

            </div>
            <div class="form-wr__btn-bl">
                <button class="btn" style="min-width: 200px;">submit</button>
            </div>

        </form>
    </div>

</main>

</div>


<?php
}

function pwd_reset()
{

    if (isset($_POST['pg_lvl']) && $_POST['pg_lvl'] == 1) {

        Misc::stopRefresh();
        $email = strtolower($_POST['email']);

        if (!empty($email)) {
            $check = Users::getUserIdByEmail($email);
            if ($check > 0) {
                $urname = Users::getNicnameById($check);
                $genPwd = Misc::izRand(10);
                $upd = Users::updUserAcct($urname, $genPwd, $check);
                $subj1 = 'Password Reset@' . $_SERVER['SERVER_NAME'];
                $msgs = '';
                $msgs .= '
			This is ' . CORP . '. <br> A password reset was recently received from your account. Please kindly use ' . $genPwd . ' for your password reset.<p> Please endeavour to change your password when you login to your dashoard </p>

			<p> Dated: ' . date('Y-m-d', strtotime('today')) . '<br><br> Yours <br>' . CORP . '</p>
			';
                //var_dump($_POST);
                $send = Misc::sendMail($msgs, $subj1, $email, Users::getUserFullNameByEmail($email));
                if ($send) {
                    //var_dump($send); die();
                    $_SESSION['result'] = array('1', 'A new password have been sent to your mail. Kindly login with the new password!');
                } else {
                    $_SESSION['result'] = array('2', 'An error Occurred,');
                }
            }
        }
    }

    Misc::setToken();

    ?>



<main class="page-main">


    <div class="page-title">
        <div class="container">
            <h1>Restore access</h1>
        </div>
    </div>

    <div class="container-sm">
        <div class="alert alert--info alert--secure">
            If you need help resetting your password, we can help by sending you a link to reset it.
            <br>
            <br>
            <ol>
                <li>Enter either the email address on the account</li>
                <li>Submit form</li>
                <li>Check your inbox for a password reset email</li>
                <li> This email will contain a new password assigned to you.</li>
                <li>Login with this new password and then reset your password </li>
            </ol>
        </div>

        <div class="bl-title"><span>Submit your data</span></div>



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





        <form method="post" action="" name="forgotform" style="width: 400px; margin: 0 auto 100px auto; "><input
                required type="hidden" name="pg_lvl" value="1"><input required type="hidden" name="formToken"
                value="<?php echo $_SESSION['pgToken']; ?>">
            <input required type="hidden" name="p" value="forgot_password">
            <input required type="hidden" name="action" value="forgot_password">

            <div class="frm-grp" style="margin-top: 15px;">
                <input class="input" placeholder="user@example.com" style="text-align: center" required type="email"
                    name='email' value="" id="email">
            </div>

            <br>

            <div style="text-align: center;">
                <button class="btn" required type="submit" style="width: 200px;">Restore</button>
            </div>
        </form>
    </div>


</main>

</div>


<?php
}

/**
 * SYSTEM DASHBOARD FILES
 */

?>