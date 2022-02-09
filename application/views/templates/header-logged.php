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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- my css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/dashboard.css"); ?>">
  <!-- Poppins -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
  </style>
  <link rel="icon" href="<?php echo base_url("assets/images/logo/icon.png"); ?>" type="image/x-icon">
  <title>Tarheta</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <div class="create-nav design">
        <div class="ds-nav-1 design">
          <span class="navbar-brand brand-des mb-0"> <img src="<?php echo base_url("assets/images/logo/logo.png"); ?>" width="120"></span>
          <a class="ds-nav-btn dsdsgn" href="<?php echo base_url('dashboard-student'); ?>">Home</a>
          <a class="ds-nav-btn dsdsgn" href="<?php echo base_url(''); ?>flashcards/index">Flashcards</a>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle ds-nav-create dsdsgn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              CREATE
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>flashcards/create/">Flashcard</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>flashcards/create-set">Sets</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url(); ?>classes/create">Class</a></li>
            </ul>
          </div>

        </div>
        <div class="right-nav design">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2 ds-nav-search dsdsgn" type="search" placeholder="Search" aria-label="Search">
          </form>
          <a href="<?php echo base_url('notif'); ?>" id="topbar-notification" data-toggle="modal" data-target="#theModal" class="buttons preview dsdsgn li-modal">
            <span class="fas fa-bell ds-nav-bell"><span class="badge">0</span></span>

          </a>

          <div class="dropdown">
            <button class="btn dropdown-toggle ds-nav-user dsdsgn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle" style="color:#e4be91; font-size: 1.6em; "></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profile</a></li>
              <li><a class="dropdown-item" href="#"><button type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url("auth/logins/logout") ?>'">Logout</button></a></li>
            </ul>
          </div>
        </div>
      </div>
  </nav>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!--
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('dashboard-teacher'); ?>">Home</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/index">Classes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/join">Join Class</a>
                      </li>


<?php if ($_SESSION['sess_user_type']['type'] == 'TEACHER') : ?>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/create">+ Create Class</a>
                      </li>
<?php endif; ?>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>flashcards/create">+Create Flashcards</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>flashcards/index">Flashcard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>flashcards/create-set">+Create Set</a>
                      </li>
                </ul>
            </div>
        </div>
    </nav>
    end of navbar -->
  <!--Notification Modal-->
  <div id="theModal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      </div>
    </div>
  </div>
  <script>
    $('.li-modal').on('click', function(e) {
      e.preventDefault();
      $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
    });
  </script>