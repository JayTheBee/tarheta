<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Lagay ko na ito dito pero sa login ko palang need para sa forgot pass modal popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- my css -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">

    <title>Sprint Demo</title>
  </head>
  <body>
      <!-- navbar -->
      <nav class="navbar navbar-expand-md  navbar-light navbar-bg navbar sticky-top">
          <div class="container">
              <a href="#home" class="navbar-brand brand-des">LOGO</a>  <!-- will eventually change to picture -->
              <button type="button" class="navbar-toggler " data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon navbar-dark" ></span>
              </button>
      
              <div class="collapse navbar-collapse show" id="navbarCollapse">
                  <ul class="navbar-nav flex-row flex-wrap ms-auto pt-2 py-md-0">
                      <li class="nav-item col-6 col-md-auto px-lg-5 px-3"><a class="nav-link" href="<?php echo base_url();?>home">HOME</a></li>
                      <li class="nav-item col-6 col-md-auto px-lg-5 px-3"><a class="nav-link" href="#">FEATURES</a></li>
                      <li class="nav-item col-6 col-md-auto px-lg-5 px-3"><a class="nav-link" href="#">DEVELOPERS</a></li>
                  </ul>

                  <div class="ms-auto">
                      <a class="btn btn-bd-login rounded-pill text-decoration-underline" href="#" role="button" href="#" role="button">LOG IN</a>
                  </div>
              </div>
          </div>
      </nav>
      <!-- end of navbar -->