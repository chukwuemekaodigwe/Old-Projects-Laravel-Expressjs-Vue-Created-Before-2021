<?php
session_start();
require('db_connect.php');
include('header1.php');

$user = $_SESSION['user_id'];
$get = $db->query("SELECT * FROM users WHERE id = $user");
$student = $get->fetch(PDO::FETCH_ASSOC);

?>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
      <form method="post" action="register_process.php" enctype="multipart/form-data">  
      <div class="card-group d-block d-md-flex row">
        
          <div class="card col-md-7 p-4 mb-0">
            <div class="card-body">
              <h1> Registration</h1>
              <p class="text-medium-emphasis">Please complete your registration</p>
              
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" readonly="readonly" type="text" value="<?php echo explode(' ', $student['name'])[0];?>" placeholder="First name" name="fname">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="Last Name" value="<?php echo (!empty(explode(' ', $student['name'])[1])) ? explode(' ', $student['name'])[1] : '';?>" name="lname">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></span>
                  <input class="form-control" readonly="readonly" value="<?php echo $_SESSION['useremail'];
                                                              ?>" type="email" placeholder="Email" name="email">
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-phone"></use>
                    </svg></span>
                  <input class="form-control" readonly="readonly" value="<?php echo $student['phone'];?>" type="text" placeholder="Phone No" name="phone">
                </div>

            </div>
          </div>
          <div class="card col-md-5 text-white bg-primary py-5">
            <div class="card-body text-center">
              <div>

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" max="<?php echo date('Y-m-d', (time() - 20*365*24*60*60));?>" name="dob" title="Your Date of Birth" type="date" placeholder="Date of Birth">
                </div>

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-upload"></use>
                    </svg></span>
                  <input class="form-control" type="file" name="passport" title="Choose a Passport Photograph" accept="image/*" placeholder="Upload Passport">
                </div>


                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                    </svg></span>
                  <select class="form-control" name="level">
                    <option value="0">Select Entry level</option>
                    <option value="100">100 Level</option>
                    <option value="200">200 Level</option>
                    <option value="300">300 Level</option>
                    <option value="400">400 Level</option>
                  </select>
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="Your Student N&otilde;" name="matric_no">
                </div>

                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-lg btn-outline-light mt-3">Submit</button>
                  </div>
                  <div class="col-6 text-end">
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<?php
include('footer1.php');
?>