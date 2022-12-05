<?php
session_start();
require('db_connect.php');
include('header.php');
include('top-header.php');

?>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="row">
      <div class="col-8 offset-2">
        <div class="card mb-4">
          <div class="card-header">
            <strong>Profile </strong><span class="small ms-1">Fill in all the field</span>
          </div>
          <div class="card-body">
            <?php
            $student_id = $_SESSION['student_id'];
            $get = $db->query("SELECT * FROM students WHERE id = $student_id");
            $row = $get->fetch(PDO::FETCH_ASSOC);
            ?>
            <form method="post" action="profile_process.php">
              <div class="input-group mb-3"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg></span>
                <input class="form-control" type="text" placeholder="First name" value="<?php echo $row['firstname']; ?>" name="fname">
              </div>
              <div class="input-group mb-3"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg></span>
                <input class="form-control" value="<?php echo $row['lastname']; ?>" type="text" placeholder="Last Name" name="lname">
              </div>
              <div class="input-group mb-3"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                  </svg></span>
                <input class="form-control" type="email" placeholder="Email" name="email">
              </div>
              <div class="input-group mb-3"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-phone"></use>
                  </svg></span>
                <input class="form-control" type="text" placeholder="Phone No" name="phone">
              </div>

              <div class="input-group mb-4"><span class="input-group-text">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                  </svg></span>
                <input class="form-control" name="password" type="password" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-primary px-4" type="submit">Submit</button>
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

<?php
include('footer.php');
?>
</div>
</div>