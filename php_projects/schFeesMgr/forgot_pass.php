<?php
session_start();
include('header1.php');

?>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h5>Forgotten Password</h5>
                <p class="text-medium-emphasis">Please enter your email</p>
                <form method="post" action="forget_process.php">
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></span>
                  <input class="form-control" type="email" placeholder="Email" name="email">
                </div>
                
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">Verify</button>
                  </div>
                  <div class="col-6 text-end">
                    
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="card col-md-5 text-white bg-info py-5">
              <div class="card-body text-center">
                <div>
                  
                <button class="btn btn-lg btn-outline-light mt-3" type="button" onclick="window.location='login.php';">Login Now!</button>
                  <button class="btn btn-lg btn-outline-light mt-3" type="button" onclick="window.location='signup.php';">Sign Up Now!</button>
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

