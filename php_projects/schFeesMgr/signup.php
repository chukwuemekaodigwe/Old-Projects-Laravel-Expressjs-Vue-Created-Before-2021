<?php
session_start();
include('header1.php');

if(isset($_SESSION['user_level'])){
  echo '<script>window.location="index.php";</script>';
  die();
}
?>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card-group d-block d-md-flex row">
          <div class="card col-md-7 p-4 mb-0">
            <div class="card-body">
              <h1>Create Profile</h1>
              <p class="text-medium-emphasis">New Student? Create your account</p>
              <form method="post" action="signup_process.php">
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="First name" name="fname">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="Last Name" name="lname">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelop"></use>
                    </svg></span>
                  <input class="form-control" type="email" placeholder="Email" name="email">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="Phone No" name="phone">
                </div>

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">SignUp</button>
                  </div>
                  <div class="col-6 text-end">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card col-md-5 text-white bg-primary py-5">
            <div class="card-body text-center">
              <div>
                <h2>Login</h2>
                <p>Already created an account, please login</p>
                <button class="btn btn-lg btn-outline-light mt-3" type="button" onclick="window.location='login.php';">Login Now!</button>
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