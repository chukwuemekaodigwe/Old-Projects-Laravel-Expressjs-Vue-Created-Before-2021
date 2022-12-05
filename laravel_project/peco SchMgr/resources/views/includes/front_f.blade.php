<!-- Start cta-two Area -->
<section class="cta-two-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 cta-left">
                <h1>Not Yet Satisfied with our Trend?</h1>
            </div>
            <div class="col-lg-4 cta-right">
                <a class="primary-btn wh" href="/blogs/">view our blog</a>
            </div>
        </div>
    </div>
</section>
<!-- End cta-two Area -->

<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Top Post Category</h4>
                    <ul>
                        <?php $categories = App\Category::orderby('id', 'desc')->get(); ?>
                        @foreach($categories as $category)
                        <li><a href="/blogs/categories/{{$category->name}}">{{ucwords($category->name)}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Quick links</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/terms">Terms of Service</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="/quiz">CBT Quiz</a></li>
                        <li><a href="/testimony"> Evidences</a></li>
                        <li><a href="/privacy"> Privacy Statement</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Newsletter</h4>
                    <p>Stay update with our latest</p>
                    <div class="" id="mc_embed_signup">
                        <form target="_blank" action="#" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="EMAIL" placeholder="Enter Email Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address '"
                                    required="" type="email">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <span class="lnr lnr-arrow-right"></span>
                                    </button>
                                </div>
                                <div class="info"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom row align-items-center justify-content-between">
            <p class="footer-text m-0 col-lg-6 col-md-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                    aria-hidden="true"></i> by <a href="" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="col-lg-6 col-sm-12 footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">

                    </h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <p style="text-align: right; font-style: italic">
                        Source: <span class="source"> </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End footer Area -->
<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>

<script src="/js/easing.min.js"></script>
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>
<script src="/js/jquery.ajaxchimp.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/jquery.tabs.min.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/mail-script.js"></script>
<script src="/js/main.js"></script>
<script src="/vendor/select2//js/jquery.select2.js">
< script type = "text/javascript" >
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script type="text/javascript">
$('.updModal').click(function(event) {
    var e = $(this);
    var title = e.data('title');
    var body = e.data('body');
    var source = e.data('source');
    var mymodal = $('#updateModal');

    mymodal.find('.modal-title').html(title);
    mymodal.find('.modal-body').html(body);
    mymodal.find('.source').html(source);
    mymodal.modal('show');
});
</script>
</body>

</html>