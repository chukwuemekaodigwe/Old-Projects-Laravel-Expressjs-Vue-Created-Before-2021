<?php
include('header.php');
include('top-header.php');
?>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex" style="flex-flow: nowrap row; align-items: center; justify-content:space-between">
                        <strong> Mail Inbox</strong> <br>
                        <i>These are mails from the support/contact form</i>
                        <div class="col-md-4">

                            <div class="input-group">
                                <input class="form-control" id="" type="date" title="From" required="">
                                <input class="form-control" id="" type="date" title="To" required="">

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
                                        <th scope="col">From</th>
                                        
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        
                                        <td>@mdo
                                            (Payment Method)
                                        </td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg class="icon">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">View</a>
                                                <a class="dropdown-item text-danger" href="#">Delete</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
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