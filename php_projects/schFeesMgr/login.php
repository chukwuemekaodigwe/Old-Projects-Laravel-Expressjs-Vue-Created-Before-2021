<?php

include('header1.php');

?>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Already created profile, Login now</p>
                <form method="post" action="login_process.php">
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelop"></use>
                    </svg></span>
                  <input class="form-control" type="email" placeholder="Email" name="email">
                </div>
                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" type="password" name="pwd" placeholder="Password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">Login</button>
                  </div>
                  <div class="col-6 text-end">
                    <a href="forgot_pass.php" class="btn btn-link px-0">Forgot password?</a>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="card col-md-5 text-white bg-primary py-5">
              <div class="card-body text-center">
                <div>
                  <h2>Sign Up</h2>
                  <p>Are you a new student? Please create your profile to continue</p>
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

