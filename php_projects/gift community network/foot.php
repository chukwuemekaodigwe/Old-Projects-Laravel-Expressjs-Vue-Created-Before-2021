

    <footer id="footer">

        <div class="container">
            <div class="row">
                <div class="footerbottom">
                    <div class="col-md-4 col-sm-6">
                        <div class="footerwidget">
                            <h4>
                                Quick Links Categories
                            </h4>
                            <div class="menu-course">
                                <ul class="menu">
                                    <li><a href="?a=faq">
                FAQ
              </a>
              
                                    </li>
                                    <li><a href="?a=about">
                About the Company
              </a>
                                    </li>
                                    <li><a href="?a=contact">
                Contact
              </a>
                                    </li>
                                    <li><a href="?a=home">
               Home
              </a>
                                    </li>

                                    <li><a href="user.php">
               Login
              </a>
                                    </li>

                                    <li><a href="user.php?a=signup">
               SignUp
              </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footerwidget">
                            <h4>
                                Our Partners 
                            </h4>
                            <div class="menu-course">
                                <ul class="menu">
                                    
                                    <li><a href="#">
                                    <img src="assets/images/house.png" style="" />
              </a>
                                    </li>
                                    <li><a href="#">
                                    <img src="assets/images/comodo.png" style="" />
              </a>
                                    </li>
                                    <li><a href="#">
                                    <img src="assets/images/ddos.png" style="" />
              </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footerwidget">
                            <h4>Contact</h4>
                            <p> You can always reach us via chat box on this website or via our telegram page. Use the link in your dashboard to join the group</p>
                            <div class="contact-info">
                                <i class="fa fa-map-marker"></i> Kerniles 416 - United Kingdom<br>
                                <i class="fa fa-phone"></i>+44 123 1234 123 <br>
                                <i class="fa fa-envelope-o"></i> info@<?php echo $_SERVER['SERVER_NAME'];?>
                            </div>
                        </div>
                        <!-- end widget -->
                    </div>
                </div>
            </div>
            <div class="social text-center">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-flickr"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
            </div>

            <div class="clear"></div>
            <!--CLEAR FLOATS-->
        </div>
        <div class="footer2">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 panel">
                        <div class="panel-body">
                            <p class="simplenav">
                                <a href="?a=home">Home</a> |
                                <a href="?a=about">About</a> |
                                <a href="?a=faq">FAQ</a> |
                                <a href="?a=rules">Rules</a> |
                            
                                <a href="contact">Contact</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 panel">
                        <div class="panel-body">
                            <p class="text-right">
                                Copyright &copy; <?php echo date("Y", strtotime('today')); ?>. 
                            </p>
                        </div>
                    </div>

                </div>
                <!-- /row of panels -->
            </div>
        </div>
    </footer>

    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="admin/assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/js/modernizr-latest.js"></script>
    <script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>

    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script>
    <script type='text/javascript' src='assets/js/camera.min.js'></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
<!--select2-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script></script>

    <script src="assets/js/custom.js"></script>
    <script>
        jQuery(function() {

            jQuery('#camera_wrap_4').camera({
                transPeriod: 500,
                time: 3000,
                height: '600',
                loader: 'false',
                pagination: true,
                thumbnails: false,
                hover: false,
                playPause: false,
                navigation: false,
                opacityOnGrid: false,
                imagePath: 'assets/images/'
            });

        });
    </script>

<script>
jQuery('#dataTable-example').DataTable();
    </script><script>
jQuery('#select22').select2({
   placeholder: 'Select an option'
});

</script>
</body>

</html>