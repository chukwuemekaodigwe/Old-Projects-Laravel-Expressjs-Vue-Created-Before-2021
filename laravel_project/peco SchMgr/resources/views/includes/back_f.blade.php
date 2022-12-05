</div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto" style="color: black">
            <span>Copyright &copy; {!! date('Y', strtotime('today')) . ' Pacesetters Educational Center, Onitsha &nbsp;
                &nbsp;' !!}</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form method="post" action="/logout"> {{csrf_field()}}
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Logout</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->

<script src="/js/vendor/datatables.min.js"></script>
<script src="/js/demo/datatables-demo.js"></script>


<!--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>-->
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript" src="{{asset('vendor\select2\js\jquery.select2.js')}}"></script>



<script type="text/javascript">
$(document).ready(function() {
    $('.multiple-select').select2();
});
</script>


<script type="text/javascript">
var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
};
</script>

<script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>

<script type="text/javascript">
$('#lfm').filemanager('image');
</script>
<script>
CKEDITOR.replace('editor', options);
</script>


<script>
$(document).ready(function() {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function() {
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
    });
});
</script>


</body>

</html>
