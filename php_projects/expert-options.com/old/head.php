<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <meta name="keywords" content="" />
    <meta name="description" content="" />
      <meta name="viewport" content="width=1280">
  <title><?php echo CORP; ?></title>

  <link rel="stylesheet" href="assets/styles/main.css">
  <link rel="stylesheet" href="assets/vendor/vendor.css">

  
  <link rel="shortcut icon" href="assets/favicon/favicon.ico">
  

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
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

		</style>
		
		
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
  <div class="page-header__bar">

    <div class="container flex-wr">
      <div class="flex-wr__col h-rate">
        <i class="ic-sm ic-sm--time"></i>
        <span>Server Time :</span>
        <b><?php echo date('M d, Y', strtotime('today'));?></b>
      </div>

      <div class="flex-wr__col flex-wr__col--stretch h-rate">
        
      </div>
    
      
      <div class="flex-wr__col">
        <a href="?p=support&item=exchange" style="padding: 1px; " class="rate-btn"><img src="assets/img/ic-hiw-3.png" height="25px" width="30px" style="margin-bottom: -5px; margin-right: -10px;"> Exchange</a>
      </div>
      <div class="flex-wr__col">
        <a href="?p=support&item=buy" class="rate-btn">Buy </a>
      </div>
      <div class="flex-wr__col">
        <a href="?p=support&item=sell" class="rate-btn"> Sell </a>
      </div>
      <div class="flex-wr__col">
        <a href="?p=support&item=loan" class="rate-btn"> Borrow</a>
      </div>
    </div>
  </div>
  <div class="container page-header__main">
    <a href=?p=home class="page-header__logo">
      <img src="assets/img/logo.jpg" alt="legitcryptos">
    </a>

    

    <nav class="page-header__nav page-nav">
  <ul>
    <li class="page-nav__item"><a href="?p=home">Home</a></li>
    <li class="page-nav__item"><a href="?p=about">About Us</a></li>
    <li class="page-nav__item"><a href="?p=faq">FAQ</a></li>
    <li class="page-nav__item"><a href="?p=support">Support</a></li>
    
    <?php
    if(isset($_SESSION['key']) && !empty($_SESSION['key'])){
		?>
		
		
          <li class="page-nav__item page-nav__item--sign"><a href="secured/?pg=dash" class="btn btn--highlight"><i class="ic-sign ic-sign--up"></i> Dashboard</a></li>
      <li class="page-nav__item page-nav__item--sign"><a href="secured/?pg=exit"><i class="ic-sign ic-sign--in"></i>Logout&nbsp;&nbsp;</a></li>
      
      <?php
	}else{
		?>
	    <li class="page-nav__item page-nav__item--sign"><a href="?p=signup" class="btn btn--highlight"><i class="ic-sign ic-sign--up"></i>Sign Up</a></li>
      <li class="page-nav__item page-nav__item--sign"><a href="?p=login"><i class="ic-sign ic-sign--in"></i>Login&nbsp;&nbsp;</a></li>
	  	
		<?php
	}
	
	?>
      
            </ul>
</nav>
<div class="page-header__lang">
      <nav class="lang">
        <div class="lang__current" style="padding: 10px 10px 20px 20px; ">
          <div class="lang__item" style="padding: none;">
          <img src="assets/img/ic-hiw-3.png" height="25px" width="30px" style="margin-bottom: -5px; margin-right: -10px;">
            <span style="vertical-align: super!important;"> Exchange</span>
          </div>
        </div>
        <ul class="lang__list">
          <li>
            <a href="?p=support&item=buy" class="lang__item">
              
              <span> Buy Bitcoin</span>
            </a>
          </li>
          <li>
            <a href="?p=support&item=sell" class="lang__item">
              
              <span> Sell Bitcoin</span>
            </a>
          </li>
          <li>
            <a href="?p=support&item=loan" class="lang__item">
              
              <span> Borrow Bitcoin</span>
            </a>
          </li>
          
        </ul>
      </nav>
    </div>
  </div>
</header>

