<?php
session_start();

require 'config.php';
$start = isset($_SESSION['start']) ? $_SESSION['start'] : '10';

if(isset($_GET['data']) && $_GET['data'] == 'deposit'){
$deposits = Transactions::getLatestDeposits($start, ($start + 10));


?>
<table>
                        <?php
foreach ($deposits as $deposits) {

        ?>
                        <tr>
                            <td width="45%"
                                title="<?php echo ucwords(Users::getNicnameById($deposits['client_id'])); ?>">
                                <span><?php echo $deposits['category'] != 1 ? ucwords(Users::getNicnameById($deposits['client_id'])) : ucwords($deposits['username']); ?></span>
                            </td>
                            <td width="70"><span class="payment-ic payment-ic--48"></span></td>
                            <td class="text-center"><span>$ <?php echo number_format($deposits['amount'], 2); ?></span>
                            </td>
                        </tr>
                        <?php
}

    ?>

                    </table>
                    <?php
}else{
$withd = Transactions::getLatestWithdraw($start, ($start + 10));
?>
<table class="table--deposit table--nowrap">
<?php

foreach ($latest_withd as $deposits) {

?>
<tr>
    <td width="45%"
        title="<?php echo ucwords(Users::getNicnameById($deposits['client_id'])); ?>">
        <span><?php echo $deposits['category'] != 1 ? ucwords(Users::getNicnameById($deposits['client_id'])) : ucwords($deposits['username']); ?></span>
    </td>
    <td width="70"><span class="payment-ic payment-ic--48"></span></td>
    <td class="text-center"><span>$ <?php echo number_format($deposits['amount'], 2); ?></span>
    </td>
</tr>
<?php
}

?>


</table>

<?php

$_SESSION['start'] += 10;
}
?>