
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Home Page </div>

                <div class="card-body">

                    <p>HELLO WORLD </p>
                    <?php 
                        if(isset($_SESSION['sess_login'])){
                            echo "<pre>";
                            print_r($_SESSION['sess_login']);
                            echo "</pre>";

                            echo "<pre>";
                            print_r($_SESSION['sess_profile']);
                            echo "</pre>";

                            echo "<pre>";
                            print_r($_SESSION['sess_user_type']);
                            echo "</pre>";
                        }
                        // Pang check ko lang ito ng current SESSION DATA
                    ?>
                   <?php
                        if($this->session->flashdata('success')){?>
                            <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                    <?php } ?>
                    
                    <?php
                    if($this->session->flashdata('error')){?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                    <?php } ?>


                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
