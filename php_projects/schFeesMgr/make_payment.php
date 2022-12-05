<?php
require('db_connect.php');
include('header1.php');

?>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card-group d-block d-md-flex row">

              <form method="post" action="makepay.php" enctype="multipart/form-data">
              
          <div class="card col-md-12 text-white bg-primary py-5">
            <div class="text-center"><h5>Make Payment</h5></div>
            <div class="card-body text-center">

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" name="pin" title="Your Date of Birth" type="text" placeholder="XXXX-XXXX-XXXX">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-lg btn-outline-light mt-3">Submit</button>
                  </div>
                  <div class="col-6 text-end">
                  </div>
                </div>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('footer1.php');
?>