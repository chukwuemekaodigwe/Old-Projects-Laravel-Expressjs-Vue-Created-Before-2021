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
                        <strong>New Mail (to Customers)</strong><span class="small ms-1">Fill in the field</span>
                    </div>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom01"> Subject</label>
                                <input class="form-control" id="validationCustom01" type="text" required="">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for=""> Recipients</label>
                                <div class="input-group">
                                    <label for="all" type="button" class="btn btn-success" title="Click to send to all">
                                        Send to all <input type="checkbox" name="" id="all" class="form-checkbo" >
                                    </label>
                                    <input class="form-control" id="" type="text" placeholder="" required="">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom01"> Body of Message</label>
                                <textarea class="form-control" id="editor" required="" ></textarea>
                            </div>
                            

                            <div class=" col-12">
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