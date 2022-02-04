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
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
    </style>

    <title>Sprint Demo</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <div width="1" class="create-nav design">
                <div width="0.525" class="nav design">
                    <span class="navbar-brand brand-des mb-0 h1">LOGO</span> <!-- will eventually change to picture -->
                    <button data-functional-selector="top-bar__kahoot-summary-button" aria-label="Enter tarheta title..." class="nav-button">
                        <span class="text">Enter tarheta title…</span>
                        <span class="settings-button mh-75 d-inline-block">
                            <span class="settings">Settings</span>
                        </span>
                    </button>
                </div>
                <div width="0.475" class="right-nav design">
                    <button type="button" id="topbar-preview-button" class="buttons preview">
                        <i class="fas fa-eye"></i>
                        <span>&nbsp;Preview</span>
                    </button>

                    <div class="line">
                        <div class="line-between">
                        </div>
                    </div>


                    <button type="button" class="buttons exit-button" data-functional-selector="top-bar__exit-button">
                        Exit
                    </button>

                    <button type="approve" class="buttons save-button" data-functional-selector="top-bar__save-button">
                        Save
                    </button>
                </div>
            </div>


        </div>
    </nav>
    <!-- end of navbar -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>