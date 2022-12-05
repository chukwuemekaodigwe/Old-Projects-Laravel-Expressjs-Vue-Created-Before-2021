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
                        <strong>Company Details</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                            <div class="col-md-9">
                                <label class="form-label" for="validationCustom02">Company Formal Name</label>
                                <input class="form-control" id="validationCustom02" type="text" value="Otto" required="">

                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom01">Company Unique ID</label>
                                <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">

                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom03">Phone N&otilde;</label>
                                <input class="form-control" id="validationCustom03" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid phonenumber.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom03">Phone N&otilde; 2</label>
                                <input class="form-control" id="validationCustom03" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid phonenumber.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Company Email</label>
                                <input class="form-control" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid email.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Company Email 2</label>
                                <input class="form-control" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid email.</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="upload">Upload Logo</label>
                                <input class="form-control" type="file" accept="images/*" aria-label="file example" required="">
                                <div class="invalid-feedback">Select an image file</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Company Default Currency</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Company Timezone</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>

                            <p class="btn btn-sm btn-light"><b>Company Address </b> <span class="small ms-1">This will be featured in all your documents generated from this system</span></p>

                            <div class="col-md-9">
                                <label class="form-label" for="validationCustom08">Company Address</label>
                                <input class="form-control" id="validationCustom08" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid address.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom05">City</label>
                                <input class="form-control" id="validationCustom05" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid city.</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom06">State</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="validationCustom08">Country</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">Please provide a valid country.</div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="">Zip Code</label>
                                <input class="form-control" id="" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid ID No.</div>
                            </div>


                            <div class="col-md-3">
                                <label class="form-label" for="">Contact Email</label>
                                <input class="form-control" id="" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid ID No.</div>
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