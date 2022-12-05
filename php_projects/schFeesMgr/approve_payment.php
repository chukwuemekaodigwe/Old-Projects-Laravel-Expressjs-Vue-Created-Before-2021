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
                        <strong> Unapproved Payments</strong>
                        <span class="small ms-1">These are list of all unconfirmed payments made by students</span>
                        <div class="col-md-4">
                            <form method="POST" action="">
                                <div class="input-group">
                                    <select class="form-select" name="bysession">
                                        <option selected="" disabled="" value=""> Search by Session</option>
                                        <?php
                                        // $start = date('Y') + 2;
                                        // $check = $start - 10;
                                        // //echo $start; echo $check;
                                        // for ($i = ($check); $i < $start; $i++) {
                                        //     $end = $i + 1;
                                        //     echo $start;
                                        //     echo "<option>$i / $end</option>";
                                        // }

                                    
                                        ?>
                                    </select>
<?php


// $date1 = isset($_POST['date1']) ? date('Y-m-d', (strtotime($_POST['date1']) - 1)) : date('Y-m-d', (strtotime('today') - 31536000));
// $date2 = isset($_POST['date2']) ? date('Y-m-d', (strtotime($_POST['date2']) + 1)) : date('Y-m-d', (strtotime('today') + 1));

?>
                                    <input class="form-control" value="<?php echo $date1; ?>" name="date1" type="date" title="From">
                                    <input class="form-control" value="<?php echo $date2; ?>" name="date2" type="date" title="To" >

                                    <button class="btn btn-danger"> View</button>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <form method="POST" action="approval_process.php">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student N&otilde;</th>
                                            <th>Fee Type</th>
                                            <th scope="col">Session</th>
                                            <th scope="col"> Payment PIN</th>
                                            
                                            <th scope="col">Amount</th>

                                            

                                            <th>
                                                <button class="btn btn-outline-success btn-sm">Approve</button>
                                            </th>
                                        </tr>
                                   </thead>
                                    <tbody>

                                    <?php
$i = 1;
$db2 = new PDO(DSN, USER, PASS, $_SESSION['errMode']);
$get = $db2->query("SELECT a.*, b.title FROM payment a, feetypes b WHERE a.status = 1 AND a.fee_type = b.id");
 

                                    while($row = $get->fetch(PDO::FETCH_ASSOC)){
                                        $student = getstudent( $row['student_id'] );
                                        ?>
                                        <tr>
                                            <td>
                                            <?php echo $i++; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date_paid']; ?>
                                            </td>
                                            
                                                <td><?php echo $student['firstname'].''.$student['lastname']; ?></td>
                                                <td><?php echo $student['email'] ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo $row['payment_pin']; ?></td>
                                                <td><?php echo number_format(intval($row['amount'])); ?></td>
                                                
                                                <td>
                                                <div title="click to select" class="form-check form-switch">
                                                    <input class="form-check-input" name="approve[]" value="<?php echo $row['id'];?>" id="flexSwitchCheckDefault" type="checkbox">
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
        </div>
    </div>
</div>

<?php
include('footer.php');
?>