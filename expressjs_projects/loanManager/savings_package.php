<?php
include('header.php');
include('top-header.php');
?>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex" style="flex-flow: nowrap row;">
            <strong>Savings Packages</strong>
            <a href="new_package.php" class="btn btn-success btn-sm" style="
    position: absolute; right: 3px;
    top: 0;
text-align: right;" target="_blank" rel="noopener noreferrer">Add New</a>
          </div>
          <div class="card-body">
<div class="table-responsive">
          <table class="table table-succss table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Sequence</th>
                  <th scope="col">Duration</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Commission</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>@mdo</td>
                  <td>@mdo</td>
                  <td>@mdo</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
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