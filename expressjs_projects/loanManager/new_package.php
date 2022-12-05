<?php
include('header.php');
include('top-header.php');
?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>New Savings Package</strong><span class="small ms-1">Fill in the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                        <div class="col-md-4">
                                <label class="form-label" for="validationCustom01"> Name of Package</label>
                                <input class="form-control" id="validationCustom01" type="text" required="">
                            </div>
                            
                        <div class="col-md-4">
                            <label class="form-label" for="validationCustom01">Sequence</label>
                            <div class="input-group">
                          <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option selected="">Choose...</option>
                            <option value="1">Daily</option>
                            <option value="2">Weekly</option>
                            <option value="2">Monthly</option>
                            <option value="2">Quaterly (4 Monthly)</option>
                            <option value="3">Yearly</option>
                            <option value="3">As the Client Wishes</option>
                            <option value="3">Other</option>
                          </select>
                          
                        </div>
                    </div>

                    <div class="col-md-4">
                                <label class="form-label" for="validationCustom01"><i>Type in the sequence </i></label>
                                <input class="form-control" id="validationCustom01" type="text" placeholder="if other, please fill in" >
                            </div>

                    <div class="col-md-4">
                                <label class="form-label" for="validationCustom01"> Amount</label>
                                <input class="form-control" id="validationCustom01" type="number" required="">
                            </div>

                    <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Duration in months <em>optional</em></label>
                                <input class="form-control" id="validationCustom01" type="text" required="">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Commission <em>optional</em></label>
                                <input class="form-control" id="validationCustom01" placeholder="Amount in %" type="text" required="">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Interest Rate <em>optional</em></label>
                                <input class="form-control" id="validationCustom01" placeholder="Amount in %" type="text" required="">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label" for="">Savings Features <em>if any</em></label>
                                <textarea class="form-control" rows="3" id="" placeholder="Items: comma separated list of items" type="text"></textarea>
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