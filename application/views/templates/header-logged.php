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

    <title>Sprint Demo</title>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>">Home</a>
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
<?php if($_SESSION['sess_user_type']['type'] == 'TEACHER') : ?>
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
                <div class="ms-auto">
                    <a class="btn btn-bd-login rounded-pill text-decoration-underline" href="<?php echo base_url(); ?>login"><span class="button-login-text">LOG IN</span></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>