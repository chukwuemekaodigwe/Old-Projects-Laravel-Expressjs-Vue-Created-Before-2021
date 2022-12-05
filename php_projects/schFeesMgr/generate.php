<?php
session_start();
include('header.php');
include('top-header.php');
require_once('db_connect.php');
?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>New Fee Payment</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3" method="POST" action="generate_process.php">
                            <div class="col-md-12">
                                <label class="form-label" >Fee Type</label>
                                <select onchange="updAmt()" class="form-select" name="feetype" id="feetype" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                  <?php
                                  $get = $db->query('SELECT * FROM feetypes WHERE status = 1 ORDER BY title ASC');
                                  while($row = $get->fetch(PDO::FETCH_ASSOC)){
                                    echo '<option data-amt="'.$row['amount'].'" value="'.$row['id'].'" accesskey="'.$row['title'].' "> '.ucwords($row['title']).' </option>';
                                  }
                                  ?>
                                </select>
                            </div>
                            <input type="hidden" name="amount" value="" id="amt">
                            <div class="col-md-12">
                                <label class="form-label">School Session</label>
                                <select class="form-select" name="session" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                 
                                    <?php
                                   $start = date('Y') + 2;
                                   $check = $start - 10;
                                  //echo $start; echo $check;
                                   for ($i = ($check); $i < $start ; $i++) { 
                                    $end = $i + 1;
                                    echo $start;
echo "<option>$i / $end</option>";
                                   }

?>
                                </select>
                              
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updAmt(){
        let amtInput = document.getElementById('amt');
        //let feetype = document.getElementById('feetype').selectedIndex.dataset;
         a = event.target.options[event.target.selectedIndex].dataset.amt;
         amtInput.value = a;

    }
</script>
<?php
include('footer.php');
?>
</div>
</div>