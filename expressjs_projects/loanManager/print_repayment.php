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
                        <strong>Print Repayment</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="">Select Client</label>
                                <div class="input-group">
                                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                        <option selected="">Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <label class="form-label" for=""> Client Account N&otilde;</label>
                                <input class="form-control" id="" type="text" required="">
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label" for="">Loan Package</label>
                                <div class="input-group">
                                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                        <option selected="">Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    
                                </div>

                            </div>

                            <div class="col-md-3 col-6">
                                <label class="form-label" for=""> From Date</label>
                                <input class="form-control" id="" type="date" required="">

                            </div>

                            <div class="col-md-3 col-6">
                                <label class="form-label" for=""> To Date</label>
                                <input class="form-control" id="" type="date" required="">
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

<?php
include('footer.php');
?>
</div>
</div>