<?php
session_start();
include('header.php');
include('top-header.php');
require_once('db_connect.php');
?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
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
                                    $get = $db->prepare('SELECT * FROM payment WHERE student_id = ? AND reg_date BETWEEN ? AND ?');
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
