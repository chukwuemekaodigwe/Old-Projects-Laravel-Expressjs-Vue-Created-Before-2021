<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Melody Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="wow/animate.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    
    <style>
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        opacity: 1 !important;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    .dot {
        height: 30px;
        width: 30px;
        margin: 0 2px;
        background-color: #faf8f3;
        border-radius: 5px;
        display: inline-block;
        transition: background-color 0.6s ease;
        color: #000;
        border: 1px solid yellow;
    }

    .slprev,
    .slnext {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        z-index: 1;
        cursor: pointer;
        position: absolute;
        top: 0;
        width: auto;
        padding: 16px;
        top: 50%;
        margin-top: -22px;
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        transition: background-color 0.6s ease;
        border-radius: 0 3px 3px 0;
    }

    .slprev:hover,
    .slnext:hover {
        color: white;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slnext {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    @media only screen and (max-width: 400px) {

        .slprev,
        .slnext,
        .text {
            font-size: 12px;
        }
    }

    .slideractive,
    .dot:hover {
        background-color: #ced4fa;
    }

    .mySlides {
        display: none;
        height: 75%;
        margin: 20px auto !important;
    }

    .mySlides p {
        font: 14px cursive;
        text-align: center;
    }

    .mySlides .form-check {
        font-size: 2em;

        margin: 10px 5px;
        ;
    }

    .form-check-label {
        cursor: pointer;
    }

    .quest_nos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-flow: row wrap;
        height: 20%;
        margin-top 4%;
    }

    .quest_nos a {
        text-decoration: none;
        font-weight: bold;
        padding-top: 5px;
        margin-top: 5px;
    }

    .btn-link a {
        border: 1px solid #392C70;

    }

    .btn-link a:hover {
        background-color: #392C70;
        text-decoration: none !important;
        color: #fff;

    }

    .actions {
        display: none !important;
    }

    @media(max-width: 300px) {
        body {
            min-width: 300px !important;
            overflow: scroll !important;
        }

        .steps ul {
            display: none !important;
        }

        .actions {
            display: block !important;
            margin-top: 200px;
        }

        .quest_nos {
            margin-top: -300px;
        }

    }
    </style>
</head>
