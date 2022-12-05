<meta name="robots" content="noindex,nofollow,noodp,noydir"/>
<meta name="googlebot" content="noindex, nofollow">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=1280">
  <title><?php echo CORP; ?></title>

  <link rel="stylesheet" href="../assets/styles/main.css">
  <link rel="stylesheet" href="../assets/vendor/vendor.css">

  
  <link rel="shortcut icon" href="../assets/favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="msapplication-config" content="../assets/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<style>
		
		form{
			transition: all .5s ease;
			padding: 20px;
		}
		
		
		.form-area form, .form-area input, .form-area select, .form-area textarea{
			
			background: #0002!important;
		}
			.form-area{
				position: relative;
				z-index: 5;
			}
			

.form-area .lds-roller {
  display: inline-block;
    position: absolute;
    width: 64px;
    height: 64px;
        //margin: 0 30% 50px;
    top: 50%;
    left: 50%;
    z-index: 30;
    
}
.form-area .lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 32px 32px;
}
.form-area .lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #000;
  margin: -3px 0 0 -3px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 50px;
  left: 50px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 54px;
  left: 45px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 57px;
  left: 39px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 58px;
  left: 32px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 57px;
  left: 25px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 54px;
  left: 19px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 50px;
  left: 14px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 45px;
  left: 10px;
}


@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


.adv{
  box-shawdow: 2px 3px 1px #000;
  padding: 20px 5px 10px 10px;
text-align: center;
}

.adv h2{
  color: lightgreen;
  font-size: 2em;
}

.adv p{
  font-style: italic;

}


		</style>
  
</head>
<body class="loaded">

<div id="loader-wrapper">
			<div id="loader">
					<div></div>	<div></div><div></div><div></div>
			</div>
			
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		
		

<script type="text/javascript">
$(document).ready(function() {

		$('.accordion>dl>dt>a').click(function() 
		{
			$(this).toggleClass("rotate0");
		});
			/*------- parse price --------*/
			function parsePriceCrypto()
			{
				returnString = "";
				
				$.post( "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,LTC,ETH&tsyms=USD", function( data )
				{
					$('#price_btc').text('$'+data['BTC']['USD']);
					$('#price_ltc').text('$'+data['LTC']['USD']);
					$('#price_eth').text('$'+data['ETH']['USD']);
				});
			}
			parsePriceCrypto();
			
			setInterval(function()
			{
				parsePriceCrypto();
			}
			, 5000);
		});
		
		$('.language').click(function() {
			$(this).toggleClass('active');
		});
		
		$('.mobileMenu').click(function() {
			$('.menu').toggleClass('mobile');
			$(this).toggleClass('rotate');
		});


	</script> 
	

<div class="wrapper a-cust-plans">
  
  <header class="page-header">
  <!--<div class="page-header__bar">

    <div class="container flex-wr">
      <div class="flex-wr__col h-rate">
        <i class="ic-sm ic-sm--time"></i>
        <span>Server Time :</span>
        <b><?php echo date('M d, Y', strtotime('today'));?></b>
      </div>

      <div class="flex-wr__col flex-wr__col--stretch h-rate">
        
      </div>

    </div>
  </div>
  -->
  <div class="container page-header__main">
    <a href=../?p=home class="page-header__logo">
      <img src="../assets/img/logo.jpg" alt="LOGO">
    </a>

    <nav class="page-header__nav page-nav">
  <ul>
    <li class="page-nav__item"><a href="../?p=home">Home</a></li>
    <li class="page-nav__item"><a href="../?p=about">About Us</a></li>
    <!--<li class="page-nav__item"><a href="../?p=faq">FAQ</a></li>-->
    <li class="page-nav__item"><a href="../?p=support">Support</a></li>
          <li class="page-nav__item page-nav__item--sign"><a href="?pg=dash" class="btn btn--highlight"><i class="ic-sign ic-sign--up"></i> Dashboard</a></li>
      <li class="page-nav__item page-nav__item--sign"><a href="?pg=exit"><i class="ic-sign ic-sign--in"></i>Logout&nbsp;&nbsp;</a></li>
	        </ul>
</nav>

  </div>
</header>

<main class="page-main">

<nav class="acc-nav" id="cabinet-nav">
<?php

?>
<ul class="acc-nav__container">
<li class="acc-nav__item"><a href="?pg=dash">Dashboard</a></li>
<!--<li class="acc-nav__item"><a href="?pg=credit"> Pledge</a></li>-->
<li class="acc-nav__item"><a href="?pg=withdraws" title="Confirm payments"> Confirm Returns</a></li>
<li class="acc-nav__item"><a href="?pg=transactions">Earnings</a></li>

<!--<li class="acc-nav__item"><a href="?pg=referrals"> Overdue Receivables</a></li>
<li class="acc-nav__item"><a href="?pg=referrals"> Earning Statistics</a></li>-->

<li class="acc-nav__item"><a href="?pg=referrals"> Referrals</a></li>
<!--<li class="acc-nav__item"><a href="?pg=team"> My Team</a></li>-->

<!--<li class="acc-nav__item"><a href="?pg=debit"> Refill Rules</a></li>-->
<li class="acc-nav__item"><a href="?pg=referallinks">Promo Banners</a></li>
<li class="acc-nav__item acc-nav__item--active"><a href="?pg=edit_account">My Profile</a></li>


<?php
$utype = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
if($utype == 1){
?>
  <li class="acc-nav__item"><a href="?pg=clients">User Accounts</a></li>
  
  <li class="acc-nav__item"><a href="?pg=generate">Generate Transactions</a></li>
  
  
  
  <?php
  }

?>
</ul>

</nav>

<?php

?>
