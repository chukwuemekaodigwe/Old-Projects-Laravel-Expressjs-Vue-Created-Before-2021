<?php
session_start();
require('db_connect.php');
include('header.php');
include('top-header.php');
include('functions.php');
?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex" style="flex-flow: nowrap row; align-items:center; justify-content:space-between">
                        <strong> Students Payments</strong>
                        <span class="small ms-1">These are list of all approved payments made by students</span>
                        <div class="col-md-4">

                            <div class="input-group">
                                <select class="form-select" id="validationCustom06" required="">
                                    <option selected="" disabled="" value=""> Search by Session</option>

                                    <?php
                                    $start = date('Y') + 2;
                                    $check = $start - 10;
                                    //echo $start; echo $check;
                                    for ($i = ($check); $i < $start; $i++) {
                                        $end = $i + 1;
                                        echo $start;
                                        echo "<option>$i / $end</option>";
                                    }

                                    ?>
                                </select>


                                <input class="form-control" id="" type="date" placeholder="From" required="">
                                <input class="form-control" id="" type="date" placeholder="To" required="">

                                <button class="btn btn-danger"> View</button>

                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Student N&otilde;</th>
                                        <th scope="col">Session</th>
                                        <th scope="col">Amount</th>

                                        <th scope="col">Fee Type</th>
                                        <th scope="col"> Received By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    //$db2 = new PDO(DSN, USER, PASS, $_SESSION['errMode']);
                                    $get = $db->query("SELECT a.*, b.title FROM payment a, feetypes b WHERE a.status = 2 AND a.fee_type = b.id");

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
                                            <td><?php echo $student['email'] ?></td>
                                          
                                            <td><?php echo $row['session']; ?></td>
                                            <td><?php echo number_format(intval($row['amount'])); ?></td>
                                            
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo getUserFullname($row['approved_by']); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg class="icon">
                                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">View Details</a><a class="dropdown-item text-danger" href="#">Unapprove</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>