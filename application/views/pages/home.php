
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Home Page </div>

                <div class="card-body">

                    <p>HELLO WORLD </p>
                    <?php 
                        if(isset($_SESSION['UserLoginSession'])){
                            echo "<pre>";
                            print_r($_SESSION['UserLoginSession']);
                            echo "</pre>";

                            echo "<pre>";
                            print_r($_SESSION['Profile']);
                            echo "</pre>";

                            echo "<pre>";
                            print_r($_SESSION['UserType']);
                            echo "</pre>";
                        }
                        // Pang check ko lang ito ng current SESSION DATA
                    ?>


                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
