<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5cb3cb47c1fe2560f3fed0d1/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<footer class="page-footer">

  <div class="container">
    <div class="page-footer__main">
      <div class="page-footer__col">
        <img src="assets/img/logo.jpg" width="169" alt="">
      </div>

      <div class="page-footer__col page-footer__nav-wr">
        <ul class="page-footer__nav">
          <li><a href="?p=home">Home</a></li>
          <li><a href="?p=about">About us</a></li>
          <li><a href="?p=rules">Rules</a></li>
        </ul>
        <ul class="page-footer__nav">
          <li><a href="?p=rate">Rate Us</a></li>
          <li><a href="?p=faq">FAQ</a></li>
          <li><a href="?p=support">Support</a></li>
        </ul>
        <ul class="page-footer__nav">
          <li><a href="?p=signup">Sign Up</a></li>
          <li><a href="?p=login">Login</a></li>
        </ul>
      </div>

      <div class="page-footer__col">
        <div class="page-footer__title">Social Media</div>
        <a href="https://www.facebook.com" target="_blank" class="ic-lg ic-lg--fb ic-lg--soc"></a>
        <a href="https://twitter.com" target="_blank" class="ic-lg ic-lg--tw ic-lg--soc"></a>
      </div>

      <div class="page-footer__col">
        <div class="page-footer__title">Company Address</div>
        <div>
          71-75 Shelton Street, London, Greater London, United Kingdom, WC2H 9JQ
        </div>
      </div>

      <div class="page-footer__col">
        <div class="page-footer__title">Phone and mail</div>
        <div>+442039368123</div>
        <a href="mailto:support@<?php echo $_SERVER['SERVER_NAME'];?>">support@<?php echo $_SERVER['SERVER_NAME'];?></a>

      </div>
    </div>
  </div>

  <div class="page-footer__btm">
    Copyright © <?php echo date('Y', strtotime('today')).' '.CORP; ?> All Rights Reserved
  </div>
</footer>
<script src="assets/vendor/vendor.js"></script>
<script src="assets/js/script.min.js"></script>


  <script type="text/javascript">
    _js.HomePage();
    _js.calc();
  </script>
  
   <script type="text/javascript">
    _js.FaqPage();
  </script>
  
  
   <script>
    _js.banners();
  </script>

 
  <script type="text/javascript">
    _js.navCabinet();
  </script>
  
  <script>
    _js.accountMain();
  </script>
 

  <script>
    _js.banners();
  </script>
 
<script type="text/javascript">
	$('form').submit(function(){
		var item = $(this).closest('div');
		item.prepend('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
		item.addClass('form-area');
	
	});
</script>

  
<?php
if(isset($_SESSION['result']) && !empty($_SESSION['result'])){
	if($_SESSION['result'][0] == 1){
		$type = 'success';
	}else{
		$type = 'warning';
	}
	?>
	<style>
		.response{
			position: absolute;
top: 400px;
right: 8%;
height: auto;
width: 300px;
transition: display 1s slideInLeft;
margin: 0 auto !important;
		}
		
		.response .alert{
			
			width: 400px!important;
			font-size: 14px;
			text-align: center;
			box-shadow: 10px 1px 10px #aaa;
		}
	</style>
		<div class="response">
	<div class="" onclick="return $(this).fadeOut();">
        <div class="alert alert--<?php echo $type;?>" onclick="return $(this).slideOut();">
        <?php echo $_SESSION['result'][1]; ?>
        </div>
        
        </div></div>

	<?php
	
	unset($_SESSION['result']);
}


?>  



<style>
	@media only screen and (min-width:768px) and (max-width:990px){
 	
		iframe{
			width: 100vw!important;
			height: 100vh!important;
		}
		
}
</style>
 
</body>
</html>

