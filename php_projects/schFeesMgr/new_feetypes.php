<?php
session_start();
include('header.php');
include('top-header.php');
//include('func');

?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-8 offset-2" >
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>New Fee Type</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3" method="post" action="new_feetype_process.php">
                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom02">Title of Fee</label>
                                <input class="form-control" id="validationCustom02" type="text" name="feename" required="">

                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom01">Amount</label>
                                <input class="form-control" id="validationCustom01" type="number" name="amount" required="">

                            </div>
                      <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div></div>

        <?php
         include('footer.php');
        ?>
    </div>
</div>