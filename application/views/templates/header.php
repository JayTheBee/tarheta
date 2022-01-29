<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Lagay ko na ito dito pero sa login ko palang need para sa forgot pass modal popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- my css -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
    <!-- Poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
    </style>

    <title>Sprint Demo</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-bg fixed-top">
        <div class="container">
            <span class="navbar-brand brand-des mb-0 h1">LOGO</span> <!-- will eventually change to picture -->
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item animation navigation-link mx-4"><a class="nav-link" href="<?php echo base_url("home/#home-page-1"); ?>">HOME</a></li>
                    <li class="nav-item animation navigation-link mx-4"><a class="nav-link" href="<?php echo base_url("home/#home-page-2"); ?>">FEATURES</a></li>
                    <li class="nav-item animation navigation-link mx-4"><a class="nav-link" href="<?php echo base_url("home/#home-page-3"); ?>">ABOUT US</a></li>
                    <li class="nav-item animation navigation-link mx-4"><a class="nav-link" href="<?php echo base_url("home/#home-page-4"); ?>">CONTACT</a></li>
                </ul>
                <div class="ms-auto">
                    <a class="btn btn-bd-login rounded-pill text-decoration-underline" href="<?php echo base_url(); ?>login"><span class="button-login-text">LOG IN</span></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
