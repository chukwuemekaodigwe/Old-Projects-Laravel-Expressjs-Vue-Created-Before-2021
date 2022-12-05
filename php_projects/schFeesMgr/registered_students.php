<?php
session_start();
require('db_connect.php');
include('header.php');
include('top-header.php');

?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex" style="flex-flow: nowrap row; align-items:center; justify-content:space-between">
                        <strong> Registered Students</strong>
                        <span class="small ms-1">These are list of all students</span>
                        <div class="col-md-4">
                        <?php
     $date1 = isset($_POST['date1']) ? date('Y-m-d', (strtotime($_POST['date1']) - 1)) : date('Y-m-d', (strtotime('today') - 31536000));
     $date2 = isset($_POST['date2']) ? date('Y-m-d', (strtotime($_POST['date2']) + 1)) : date('Y-m-d', (strtotime('today') + 1));

                            ?>
                            <form method="POST" action="">
                                <div class="input-group">
                                           <select class="form-select" id="validationCustom06">
                                    <option selected="" disabled=""> Search by Session</option>

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

                                <input class="form-control" value="<?php echo $date1; ?>" name="date1" type="date" title="From">
                                    <input class="form-control" value="<?php echo $date2; ?>" name="date2" type="date" title="To" >

                                <button class="btn btn-danger"> View</button>

                            </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="table-respoive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col">#</th>

                                        <th class="text-center">
                                            <svg class="icon">
                                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                                            </svg>
                                        </th>

                                        <th scope="col">Student Name</th>
                                        <th scope="col">Student N&otilde;</th>
                                        <th scope="col">Student email</th>
                                        <th scope="col">Date Reg.</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                $get = $db->prepare('SELECT * FROM students WHERE reg_date BETWEEN ? AND ?');

                                $get->execute([$date1, $date2]);    
                                $i = 1;
                                
                              while($row = $get->fetch(PDO::FETCH_ASSOC)){
//var_dump($row); die();
                                ?>
                                    <tr class="align-middle">
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td class="text-center">
                                            <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo $row['img_url']; ?>" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td><?php echo  $row['firstname'].' '.$row['lastname'];?></td>
                                        <td><?php echo $row['reg_no']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['reg_date']; ?></td>
                                        <td><?php echo $row['entry_level']; ?></td>
                                        <td><?php echo ($row['status'] == 1) ? 'Active' : 'suspended' ; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg class="icon">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                <?php if($row['status'] == 2){ ?>
                                                <a class="dropdown-item" href="student_status.php?id=<?php echo $row['id'];?>&item=activate">Activate</a>    
                                               <?php }else{ ?>
                                                <a class="dropdown-item" href="student_status.php?id=<?php echo $row['id'];?>&item=suspend">Suspend</a>
                                               <?php } ?>
                                                <a class="dropdown-item text-danger" href="student_status.php?id=<?php echo $row['id'];?>&item=delete">Delete</a>
                                                </div>
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