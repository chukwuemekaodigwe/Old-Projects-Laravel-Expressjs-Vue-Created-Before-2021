<?php
require 'control.php';
include 'head.php';
?>

<style>
header,
.menu-sidebar,
.foot-alert,
.header-mobile {
    display: none !important;
}

.acct_expire span{
    font-size: 2.8em;
    
    display: flex;
    flex-flow: nowrap column;
    align-items: center;
    font-weight: bolder;
    text-transform: uppercase;
    color: blueviolet;
}
}
</style>
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#staticModal1">
    Static
</button>

<div class="modal fade" style="margin: 0 auto!important; font-weight: normal;" id="staticModal1" tabindex="-1"
    role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document" /*style="margin: 0 auto!important;
        */font-weight: normal;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticModalLabel"> <i class="fa fa-lock fa-3x" ></i>
                   </h5>
                <a href="?pg=exit" class="close danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-power-off" style="color: red" title="Log Out"></i></span>
                </a>

            </div>

            <div class="modal-body" id="printable">
                <div class="login-content">
                    <div class="login-logo acct_expire">

                        <span>

                            Account</span><span> <?php echo ($_SESSION['status'] == ACTIVE) ? 'Deactivated!' : 'Not Activated!'; ?>
                        </span>
                        <br>
                      
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer flex justify-content-around">
           <p style="font-size: 1.3em; font-style: italic;"> Please invest to activate</p>     <a href="?pg=invest" type="button" class="btn btn-secondary btn-danger"><i class="fa fa-reply"
                        style="color: #fff;"></i> Invest</a>
                
            </div>

        </div>
    </div>
</div>

<?php
include_once 'foot.php';
?>