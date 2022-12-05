<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>CoreUI Free Bootstrap Admin Template</title>
  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="css/examples.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#signet"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="index.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
          </svg> Dashboard<span class="badge badge-sm bg-info ms-auto"> </span></a></li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-to-right"></use>
          </svg> Quick Access >></a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="print_repayment.php">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-print"></use>
              </svg> Print Repayment</a></li>
          <li class="nav-item"><a class="nav-link" href="new_deposit.php">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
              </svg> New deposit</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="new_withdraw.php">
          <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-exit-to-app"></use>
              </svg>
          </span> New Withdrawal</a></li>
          <li class="nav-item"><a class="nav-link" href="new_repayment.php">
          <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-excerpt"></use>
              </svg>
          </span> New Repayment</a></li>
          <li class="nav-item"><a class="nav-link" href="due_repayments.php">
          <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell-exclamation"></use>
              </svg> Due Re-payment</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-contact"></use>
          </svg> Employees</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="new_employees.php"><span class="nav-icon"></span>New Employees</a></li>
          <li class="nav-item"><a class="nav-link" href="list_employees.php"><span class="nav-icon"></span> List of employees</a></li>
          <li class="nav-item"><a class="nav-link" href="buttons/dropdowns.html"><span class="nav-icon"></span> User Permissions</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
          </svg> Clients</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="new_clients.php"><span class="nav-icon"></span> New clients</a></li>
          <li class="nav-item"><a class="nav-link" href="clients_list.php"><span class="nav-icon"></span> Clients List</a></li>
          <li class="nav-item"><a class="nav-link" href="borrowers_list.php"><span class="nav-icon"></span> Borrowers list</a></li>
          <li class="nav-item"><a class="nav-link" href="savers_list.php"><span class="nav-icon"></span> Savers' list</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cash"></use>
          </svg> Savings Pack</a>
        <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="new_saver.php"><span class="nav-icon"></span> New Savings</a></li>  
        <li class="nav-item"><a class="nav-link" href="new_package.php"><span class="nav-icon"></span> New Packages</a></li>
          <li class="nav-item"><a class="nav-link" href="savings_package.php"><span class="nav-icon"></span> Savings Packages</a></li>

          
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-briefcase"></use>
          </svg> Loan Pack</a>
        <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="new_loan.php"><span class="nav-icon"></span> New loan</a></li>  
        <li class="nav-item"><a class="nav-link" href="loanpackages.php"><span class="nav-icon"></span> Loan Packages</a></li>
          <li class="nav-item"><a class="nav-link" href="new_loanpackage.php"><span class="nav-icon"></span> Add New Loan Packages</a></li>
          
        </ul>
      </li>

      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-line"></use>
          </svg> Transactions</a>
        <ul class="nav-group-items">
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-data-transfer-down"></use>
              </svg> Deposits</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="new_deposit.php"><span class="nav-icon"></span> New Deposits</a></li>
              <li class="nav-item"><a class="nav-link" href="deposit_history.php"><span class="nav-icon"></span> Deposits Reports</a></li>
            </ul>
          </li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-equalizer"></use>
              </svg> Withdrawals</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="new_withdraw.php"><span class="nav-icon"></span> New Withdrawal</a></li>
              <li class="nav-item"><a class="nav-link" href="withdrawal_history.php"><span class="nav-icon"></span> Withdrawals Report</a></li>
            </ul>
          </li>

          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calculator"></use>
              </svg> Loan Repayments</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="new_repayment.php"><span class="nav-icon"></span> New Re-payment</a></li>
              <li class="nav-item"><a class="nav-link" href="due_repayments.php"><span class="nav-icon"></span> Due Re-payment</a></li>
              <li class="nav-item"><a class="nav-link" href="repayment_history.php"><span class="nav-icon"></span> Repayment Records</a></li>
            </ul>
          </li>


        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
          </svg> Messages</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="mail_to_staff.php"><span class="nav-icon"></span> Send to Staffs</a></li>
          <li class="nav-item"><a class="nav-link" href="send_to_customers.php"><span class="nav-icon"></span> Send to Customers</a></li>
          <li class="nav-item"><a class="nav-link" href="sent_mails.php"><span class="nav-icon"></span> Sent Mails</a></li>
          <li class="nav-item"><a class="nav-link" href="inbox.php"><span class="nav-icon"></span> Inbox</a></li>
        </ul>
      </li>

      <li class="nav-title">Configuration</li>
      <li class="nav-item"><a class="nav-link" href="company_details.php">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
          </svg> Company Details</a>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sitemap"></use>
          </svg> Locations/Branches</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="new_location.php"><span class="nav-icon"></span> New Location</a></li>
          <li class="nav-item"><a class="nav-link" href="locations.php"><span class="nav-icon"></span> Locations</a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="system_settings.php">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
          </svg> Settings</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="subscriptions.php">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
          </svg> Subscriptions</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="backup.php">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sync"></use>
          </svg> Back Up</a>
      </li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>