<?php
session_start();
require('db_connect.php');
include('header.php');
include('top-header.php');
include('functions.php');

$get = $db->query('SELECT * FROM feetypes WHERE status != 0 ORDER BY id ASC');

?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex" style="flex-flow: nowrap row; align-items:center;  justify-content:space-between">
                        <strong> Fee Types</strong>
                        <div class="col-md-4">

                            <div class="input-group">
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
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Fee Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col"> Status</th>
                                        <th scope="col"> Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$i = 0;
                                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo ++$i; ?></th>
                                            <td><?php echo $row['date_created']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo number_format($row['amount'], 2); ?></td>
                                            <td><?php echo ($row['status'] == 1) ? 'Active' : 'Suspended' ; ?></td>
                                            <td><?php echo getUserFullname($row['created_by']) ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg class="icon">
                                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="edit_feetype.php?item=<?php echo $row['id']; ?>">Edit</a><a class="dropdown-item" href="#">Suspend</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
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