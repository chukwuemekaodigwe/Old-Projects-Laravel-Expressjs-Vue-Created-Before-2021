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
                        <strong>New Lending</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                            <div class="col-md-8">
                            <label class="form-label" for="validationCustom01">Select Client</label>
                            <div class="input-group">
                          <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                          <a href="new_clients.php"  class="btn btn-warning">+ New</a>
                        </div>
                    </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom01"> Client Account N&otilde;</label>
                                <input class="form-control" id="validationCustom01" type="text" required="">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06">Loan Package</label>
                                <div class="input-group">
                          <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                          <a href="new_package.php"  class="btn btn-warning">Add New</a>
                        </div>
                                
                            </div>

                            <!-- <div class="col-md-4">
                                <label class="form-label" for=""> Repayment Method</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                
                            </div>
                             -->

                             <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Loan Duration</label>
                                <div class="input-group">
                          <select class="form-select" id="" aria-label="Example select with button addon">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                                <input class="form-control" id="validationCustom01" type="text" placeholder="Number" required="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for=""> Repayment Sequence</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06"> Client Branch</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                <div class="invalid-feedback">Please select your branch.</div>
                            </div>
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                                    <label class="form-check-label" for="invalidCheck">Any colleatral</label>
                                    <textarea class="form-control" id="validationCustom01" rows="3" placeholder="Details of colleatral" required=""></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                                    <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                </div>
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