

<style>
.foot-alert {
    position: fixed;
    bottom: 0;
    left: 0px;
    display: flex;
    border: none;
    justify-content: space-between;
    align-items: center;
display: none;
    width: 100%;
    box-sizing: border-box;
    z-index: 10000;
    background: linear-gradient(90deg, #3f5efb 0%, #fc466b 100%);
}

.foot-alert div {
    padding: 20px 10px;
    text-align: center;
    color: #fff;
    display: flex;
    flex-direction: column;
    cursor: pointer;
}
</style>

<div class="foot-alert hidden-lg hidden-md">
    <div onclick="return window.location='?pg=invest';">
        <i class="fa fa-dollar"></i>
        <span> Invest </span>
    </div>

    <div onclick="return window.location='?pg=accounts';">
        <i class="fa fa-bar-chart-o"></i>
        <span> Transactions </span>
    </div>

    <div onclick="return window.location='?pg=receive';">
        <i class="fa fa-suitcase"></i>
        <span> Acknowledge </span>
    </div>
</div>

<!-- END PAGE CONTAINER-->
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<!-- Bootstrap JS--
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $('.btn-modal').trigger('click');
    $('#staticModal1').on('shown.bs.modal', function(e) {
        $('.modal').css('padding-right', '0px')
    });


    $('input#select-all').on('checked', function() {
        $('.table input[type=checkbox]').checked();
    });
});
</script>

<?php
if (isset($_SESSION['result'])) {
$alert = ($_SESSION['result'][0] == 1) ? 'success' : 'danger';
    ?>

<script type="text/javascript">
var item = $('.overview-wrap').closest('div');
item.append().html(
    "<div class='alert alert-<?php echo $alert; ?>'> <?php echo ucwords($_SESSION['result'][1]); ?></div>");
$('.alert').addClass('show');
</script>
<?php
unset($_SESSION['result']);
}

?>

<script type="text/javascript">
function mark(id){
    $('#'+id).trigger('click');
    
}
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5cebe6d82135900bac12afa1/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

</html>
<!-- end document-->