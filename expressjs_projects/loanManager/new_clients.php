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
                        <strong>New Clients</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom02">First name</label>
                                <input class="form-control" id="validationCustom02" type="text" value="Otto" required="">

                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Last name</label>
                                <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustomUsername">Username</label>
                                <div class="input-group has-validation"><span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input class="form-control" id="validationCustomUsername" type="text" aria-describedby="inputGroupPrepend" required="">
                                </div>
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
                            <div class="col-md-2">
                                <label class="form-label" for="">ID TYPE</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                <div class="invalid-feedback">Please provide a valid zip.</div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="">ID Number</label>
                                <input class="form-control" id="" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid ID No.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom08">Occupation</label>
                                <input class="form-control" id="validationCustom08" type="text" required="">
                                <div class="invalid-feedback">Please tell us your work.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom08">Address</label>
                                <input class="form-control" id="validationCustom08" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid address.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom06">Branch</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                <div class="invalid-feedback">Please select your branch.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom09">Password</label>
                                <input class="form-control" id="validationCustom09" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid password.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom10">Confirm Password</label>
                                <input class="form-control" id="validationCustom10" type="text" required="">
                                <div class="invalid-feedback">Please confirm your password.</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="upload">Upload Passport</label>
                                <input class="form-control" type="file" accept="images/*" aria-label="file example" required="">
                                <div class="invalid-feedback">Select an image file</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="upload">Upload ID CARD</label>
                                <input class="form-control" type="file" accept="images/*" aria-label="file example" required="">
                                <div class="invalid-feedback">Upload id card</div>
                            </div>
                            <div class="progress progress-thin mt-2">
                                <div class="progress-bar bg-priamary" role="progressbar" style="width: 100%" aria-valuenow="1000" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <strong class="">Next of Kin</strong>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom02">First name</label>
                                <input class="form-control" id="validationCustom02" type="text" value="Otto" required="">

                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="validationCustom01">Last name</label>
                                <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">

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

                            <div class="col-md-2">
                                <label class="form-label" for="">ID TYPE</label>
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option>Onitsha</option>
                                    <option>Ikeja</option>
                                    <option>Warri</option>
                                    <option>Wuse</option>
                                </select>
                                <div class="invalid-feedback">Please provide a valid zip.</div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="">ID Number</label>
                                <input class="form-control" id="" type="text" required="">
                                <div class="invalid-feedback">Please provide a valid ID No.</div>
                            </div>

                            <div class="col-md-4">
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
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="upload">Upload Passport</label>
                                <input class="form-control" type="file" accept="images/*" aria-label="file example" required="">
                                <div class="invalid-feedback">Select an image file</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="upload">Upload ID CARD</label>
                                <input class="form-control" type="file" accept="images/*" aria-label="file example" required="">
                                <div class="invalid-feedback">Upload id card</div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                                    <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                </div>
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
