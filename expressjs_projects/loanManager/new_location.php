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
                        <strong>New Company Location</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                            <div class="col-md-9">
                                <label class="form-label" for="validationCustom02">Branch Title</label>
                                <input class="form-control" id="validationCustom02" type="text" value="Otto" required="">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom02">Branch Unique ID</label>
                                <input class="form-control" id="validationCustom02" type="text" value="Otto" required="">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom08">Address</label>
                                <input class="form-control" id="validationCustom08" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid address.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom05">City</label>
                                <input class="form-control" id="validationCustom05" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid city.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06">State</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06">Country</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom03">Phonenumber</label>
                                <input class="form-control" id="validationCustom03" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid phonenumber.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid email.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06">Employee Incharge</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php
         include('footer.php');
        ?>
    </div>
</div>