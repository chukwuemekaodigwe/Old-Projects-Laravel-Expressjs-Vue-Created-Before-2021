<?php
if (isset($_SESSION['error'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var msg = "<center><p style='color:red'><strong><?php echo $_SESSION['error']; ?></strong></p></center>";
            $('#result').append(msg);
        });
    </script>

    <?php
}

if (isset($_SESSION['info'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var msg = "<center><p style='color:green'><strong><?php echo $_SESSION['info']; ?></strong></p></center>";
            $('#result').append(msg);
        });
    </script>

    <?php
}

?>
</div>
</div>
</div><!--PAGE CONTENT END-->

<div class="footer cabinet"><!--FOOTER-->
    <div class="colophon">
        <div class="container row">
            <div class="copy">Copyright © <?php echo date('Y', strtotime('today')); ?>  <a href="../index.php">expert-cryptos.com</a> All rights reserved. Developed by <a href="digitalplazas.000webhostapp.com"> . </a> </div>
            <div class="link"><a href="../index.php">Home Page</a></div>
        </div>
    </div>



</div><!--FOOTER END-->
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

<script type="text/javascript">

function add_field() {
    $('#addr_content').css('display', 'block');
    $('#more').css('display', 'inline');
    $('#addr_content').append(
        '<div class="form-wr__col"><label for="email-address[]"> Recipient Email</label><input value="" required type="email" class="input" placeholder="Enter the client email address" title="Enter the client email address" name="users[email][]" id="email-address[]"></div> <div class="form-wr__col"><label for="name[]"> Recipients Name</label><input value="" required type="text" class="input" placeholder="Enter the client name" title="Enter the client name" name="users[name][]" id="name[]"></div> '
        );
}

$('#message_type').change(function() {
    var item = $('#message_type').find('option:selected').val();
    var exists = $('form').find('#addr_content').html();
    
    if (item === '2') {
        add_field();
    } else {

            $('#addr_content').css('display', 'contents');
            $('#addr_content').html('');
            $('#more').html('');
        }

});
</script>
<script src="../static/vendor/cleditor/jquery.cleditor.min.js"></script>
<script type="text/javascript">

$("#message").cleditor({
    width: 520,
    height: 400
});

</script>


</body></html>
<?php
if (isset($_SESSION['info'])) {
    unset($_SESSION['info']);
}
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
?>