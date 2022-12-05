<?php
session_start();
include('db_connect.php');
include('header.php');
include('top-header.php');



$id = $_GET['item'];
$get = $db->prepare('SELECT * FROM feetypes WHERE id = ?');
$get->execute([$id]);

$row = $get->fetch(PDO::FETCH_ASSOC);
?>

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-8 offset-2" >
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Edit Fee Type</strong><span class="small ms-1">Fill in all the field</span>
                    </div>
                    <div class="card-body">

                        <form class="row g-3" method="post" action="edit_feetype_process.php">
                            <div class="col-md-12">
                                <input type="hidden" name="feetype" value="<?php echo $row['id'];?>">
                                <label class="form-label" for="validationCustom02">Title of Fee</label>
                                <input class="form-control" id="validationCustom02" type="text" value="<?php echo $row['title'];?>" name="feename" required="">

                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="validationCustom01">Amount</label>
                                <input class="form-control" id="validationCustom01" type="number" value="<?php echo $row['amount'];?>" name="amount" required="">

                            </div>
                      <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div></div>

        <?php
         include('footer.php');
        ?>
    </div>
</div>