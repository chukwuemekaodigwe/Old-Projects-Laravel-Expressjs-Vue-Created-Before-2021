<?php
session_start();

if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == 2) {

  echo "
    <script>
    alert('please complete your registration');
    window.location='register.php';
    </script>
    ";

  die();
}

require_once('db_connect.php');
require_once('functions.php');
include('header.php');
include('top-header.php');


$no_students = countStudent(date('Y'));;
$income = sumIncome(date('Y'));
$awaiting = countUnapproved();
$no_of_feetypes = countFeeTypes();
?>

<div class="body flex-grow-1 px-3">
  <div class="container-lg">

    <?php if ($_SESSION['user_level'] == 1) {  ?>
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold"><?php echo $no_students; ?><span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-graduation-cap"></use>
                    </svg></span></div>
                <div>Students</div>
              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
              <canvas class="chart" id="card-chart1" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">N <?php echo number_format($income, 2); ?> <span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                    </svg></span></div>
                <div>Income</div>
              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
              <canvas class="chart" id="card-chart2" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold"><?php echo $awaiting; ?> <span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                    </svg></span></div>
                <div>Awaiting Approval</div>
              </div>

            </div>
            <div class="c-chart-wrapper mt-3" style="height:70px;">
              <canvas class="chart" id="card-chart3" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">Info<span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-right"></use>
                    </svg></span></div>
                <div>Active Session: </div>
                <div>Total Fee Types: <?php echo $no_of_feetypes; ?></div>

              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:45px;">
              <canvas class="chart" id="card-chart4" height="45"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- /.row-->
    <?php } elseif ($_SESSION['user_level'] == 2) { ?>
      <!-- Student portal -->
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg>
                </div>
                <div><?php echo $_SESSION['useremail']; ?></div>
                <div> <?php echo getUserFullname($_SESSION['user_id']); ?></div>

              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
              <canvas class="chart" id="card-chart1" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <?php
                $student_fee = getStudentLastFee($_SESSION['student_id'])


                ?>
                <div class="fs-4 fw-semibold">
                  Last Fee
                </div>
                <div>N <?php echo number_format($student_fee[0], 2); ?> &nbsp;( <?php echo $student_fee[1]; ?> )</div>
              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
              <canvas class="chart" id="card-chart2" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold"> <a href="generate.php"> Generate PIN</a><span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-payment"></use>
                    </svg></span></div>
                <div>Quick Link</div>
              </div>

            </div>
            <div class="c-chart-wrapper mt-3" style="height:70px;">
              <canvas class="chart" id="card-chart3" height="70"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
          <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">Info<span class="fs-6 fw-normal">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-right"></use>
                    </svg></span></div>
                <div>Active Session: </div>
                <div>Total Fee Types: <?php echo $no_of_feetypes; ?></div>

              </div>

            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:45px;">
              <canvas class="chart" id="card-chart4" height="45"></canvas>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- /.row-->
    <?php } 
    if ($_SESSION['user_level'] == 1) { 
    ?>
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title mb-0">Income Analysis</h4>
          <div class="small text-medium-emphasis">January - July 2022</div>

        </div>
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
          <canvas class="chart" id="main-chart" height="300"></canvas>
        </div>
      </div>

    </div>
    <!-- /.card.mb-4-->

    <!-- /.row-->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header"> <b>Awaiting Payments: </b><small>Payments awaiting approval from the management</small> </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table border mb-0">
                <thead class="table-light fw-semibold">

                  <form method="POST" action="approval_process.php">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Student Name</th>
                        <th>Fee Type</th>
                        <th scope="col"> Payment PIN</th>

                        <th scope="col">Amount</th>



                        <th>
                          <button class="btn btn-danger btn-sm">Approve</button>
                        </th>
                      </tr>
                    </thead>
                <tbody>

                  <?php
                  $i = 1;
                  $db2 = new PDO(DSN, USER, PASS, $_SESSION['errMode']);
                  $get = $db2->query("SELECT a.*, b.title FROM payment a, feetypes b WHERE a.status = 1 AND a.fee_type = b.id");


                  while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                    $student = getstudent($row['student_id']);
                  ?>
                    <tr>
                      <td>
                        <?php echo $i++; ?>
                      </td>
                      <td>
                        <?php echo $row['date_paid']; ?>
                      </td>

                      <td><?php echo $student['firstname'] . '' . $student['lastname']; ?></td>

                      <td><?php echo $row['title']; ?></td>

                      <td><?php echo $row['payment_pin']; ?></td>
                      <td><?php echo number_format(intval($row['amount'])); ?></td>

                      <td>
                        <div title="click to select" class="form-check form-switch">
                          <input class="form-check-input" name="approve[]" value="<?php echo $row['id']; ?>" id="flexSwitchCheckDefault" type="checkbox">
                        </div>
                      </td>

                    <?php
                  }

                    ?>

                </tbody>
                </form>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
  </div>
</div>

<?php
    }else{
      ?>
<div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex" style="flex-flow: nowrap row; align-items:center;  justify-content:space-between">
                        <strong> Payment History</strong>
                        <div class="col-md-4">
                            <?php
                            $date1 = isset($_POST['date1']) ? date('Y-m-d', (strtotime($_POST['date1']) - 1)) : date('Y-m-d', (strtotime('today') - 31536000));
                            $date2 = isset($_POST['date2']) ? date('Y-m-d', (strtotime($_POST['date2']) + 1)) : date('Y-m-d', (strtotime('today') + 1));

                            ?>
                            <form method="POST" action="">
                                <div class="input-group">
                                    <input class="form-control" value="<?php echo $date1; ?>" name="date1" type="date" title="From" required="">
                                    <input class="form-control" value="<?php echo $date2; ?>" name="date2" type="date" title="To" required="">

                                    <button class="btn btn-danger"> View</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Fee Type</th>
                                        <th scope="col"> Sch Session</th>
                                        <th scope="col">Payment PIN </th>
                                        <th scope="col">Amount</th>
                                        <th scope="col"> Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get = $db->prepare('SELECT * FROM payment WHERE student_id = ? AND reg_date BETWEEN ? AND ? ORDER BY id DESC');
                                    $student_id = $_SESSION['student_id'];

                                    $get->execute([$student_id, $date1, $date2]);
                                    $i = 1;
                                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                        $status = ($row['status'] == 0) ? 'Unpaid' : (($row['status'] == 1) ? 'Pending Approval' : 'Approved');
                                  
                                  ?>
                                        <tr>
                                            <th scope="row"><?php echo $i++ ?>
                                            </th>
                                            <td><?php echo $row['reg_date']; ?></td>
                                            <td><?php echo $row['fee_type']; ?></td>

                                            <td><?php echo $row['session']; ?></td>
                                            <td><?php echo $row['payment_pin']; ?></td>

                                            <td>
                                                <?php echo $row['amount']; ?>
                                            </td>
                                            <td><?php echo $status; ?></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg class="icon">
                                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="view_receipt.php?receipt=<?php echo $row['id']; ?>"> Print Receipt</a><a class="dropdown-item" href="#">View</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    if($i == 6) break;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div></div>
        </div>
      <?php
    }

include('footer.php')

?>