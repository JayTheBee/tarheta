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
<?php if(!isset($_SESSION['UserLoginSession'])) : ?>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>account-type">Register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>login">Login</a>
                      </li>
<?php else : ?>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/classes">Classes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/joinclass">Join Class</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>classes/createclass">+ Create Class</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>flashcards/create">+Create Flashcards</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>flashcards/index">Flashcard</a>
                      </li>
<?php endif; ?>
                </ul>
                </div>
            </div>
        </nav>

