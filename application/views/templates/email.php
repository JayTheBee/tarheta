<html>
<head>
    <style type='text/css'>
        body {background-color: #CCD9F9;
             font-family: Verdana, Geneva, sans-serif}

        h3 {color:#4C628D}

        p {font-weight:bold}
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Lagay ko na ito dito pero sa login ko palang need para sa forgot pass modal popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                    <h1>
                        <?php echo $header?>
                    </h1>
                    <p> Hello <?php echo $username?></p>
                    <br>
                    <p><?php echo $body?></p>
                    <form action="<?php echo $link?>">
                        <input type="submit" value=<?php echo $button?> />
                    </form>
            </div>
        </div>
    </div>

</div>

</body>
</html>