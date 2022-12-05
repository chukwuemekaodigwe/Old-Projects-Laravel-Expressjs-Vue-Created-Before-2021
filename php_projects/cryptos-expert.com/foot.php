<div class="footer">
            <!--FOOTER-->
            <div class="info-block">
                <div class="container row">
                    <div class="logo system-list">
                        <a href="index.html"style="text-align: center;"><!--<img src="static/img/header/logo.gif" alt="LOGO EXPERT CRYPTOS LLC">--></a>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li><a href="?a=home">Home</a></li>
                            <li><a href="?a=cust&page=about">About us</a></li>
                            <li><a href="?a=cust&page=investors">investor / Affiliate</a></li>

                            <li><a href="?a=news">Last News</a></li>
                            <li><a href="?a=faq">FAQ</a></li>
                            <li><a href="?a=rules">AGREEMENT AND RULES</a></li>
                            <li><a href="?a=support">Support</a></li>
                        </ul>
                    </div>
                    <div class="foot-area">
                        <div class="support">
                            <div class="title">Support:</div>
                            <div class="support-list">
                                <ul>
                                    <li><span>Support:</span> <a href="mailto:admin@expert-cryptos.com">admin@expert-cryptos.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chat">

                            <div class="chat-list">


                            </div>
                        </div>
                        <div class="system">
                            <div class="title">We accept:</div>
                            <div class="system-list">
                                <ul>
                                    <li>
                                        <a href="https://perfectmoney.is" target="_blank"><img src="static/img/footer/sys-ic1.png"></a>
                                    </li>
                                    <li>
                                        <a href="https://payeer.com" target="_blank"><img src="static/img/footer/sys-ic2.png"></a>
                                    </li>
                                    <li>
                                        <a href="https://advcash.com" target="_blank"><img src="static/img/footer/sys-ic3.png"></a>
                                    </li>
                                    <li>
                                        <a href="https://www.coinpayments.net" target="_blank"><img src="static/img/footer/sys-ic4.png"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="security">
                            <div class="title">Protected:</div>
                            <div class="security-list">
                                <ul>
                                    <li>
                                        <a href="#"><img src="static/img/footer/sec-ic1.png"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="static/img/footer/sec-ic2.png"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="colophon">
                <div class="container row">
                    <div class="copy">Copyright © <?php echo date('Y', strtotime('today'));?>  All rights reserved. <span style="text-align: center; padding: auto 10px!important;" ></span><a href="?a=home">expert-cryptos.com</a> </div>
                    <div class="list">
                        <ul>
                            <li><a href="?a=rules">Privacy policy</a></li>
                            <li><a href="?a=rules">Rules</a></li>
                            <li><a href="?a=rules">Terms of investment</a></li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
        <!--FOOTER END-->
<?php
if(isset($_SESSION['error'])){
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			var msg = "<center><p style='color:red'><strong><?php echo $_SESSION['error'];?></strong></p></center>";
			$('#result').append(msg);
		});
	</script>

<?php
}

if(isset($_SESSION['info'])){
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			var msg = "<center><p style='color:green'><strong><?php echo $_SESSION['info'];?></strong></p></center>";
			$('#result').append(msg);
		});
	</script>
	
<?php
}
?>


    </div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f4b6f6acc6a6a5947b011a1/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

</html>

<?php

if(isset($_SESSION['info'])){
	unset($_SESSION['info']);	
	}
	if(isset($_SESSION['error'])){
unset($_SESSION['error']); 
}

?>