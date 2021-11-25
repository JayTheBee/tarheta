    <!-- PROFILE VIEW -->

    <?php 
        /*
            *This redirects the user to the Login page when the 
                $_SESSION['UserLoginSession'] is still not set.
        */
        if (!isset($_SESSION['UserLoginSession'])){
            $this->session->set_flashdata('error', 'Please Login First');
            header("Location: ".base_url()."login");
            exit();
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>

                <div class="card-body">
                    <?php
                        if($this->session->userdata('UserLoginSession')){
                            $udata = $this->session->userdata('UserLoginSession');

                            echo 'Welcome'.' '.$udata['username'];
                        }
                        else{
                            redirect(base_url('login'));
                        }
                    ?>


                    <br><br>
                    <p>First Name: </p>
                    <p>Last Name: </p>
                    <p>Birthday: </p>
                    <p>School: </p>
                    <p>Course: </p>
                    <br>

                    <div class="justify-content-center d-flex flex-column ">
                        <button type="button" class="btn btn-success" >Edit Profile
                        </button>
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url("auth/logout"); ?>'" >Logout
                        </button>
                    </div>

                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>