    <!-- PROFILE VIEW -->

    <!-- jediboy: unnecessary checks -->

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>

                <div class="card-body">
                    <?php
                        if($this->session->userdata('sess_login')){
                            $udata = $this->session->userdata('sess_login');

                            echo 'Welcome'.' '.$udata['username'];
                        }
                        //jediboy: unnecessary checks
                    ?>

                    <br><br>
                    <p>First Name: 
                        <?php echo $_SESSION['sess_profile']['firstname']; ?>
                    </p>
                    <p>Last Name: 
                        <?php echo $_SESSION['sess_profile']['lastname']; ?>
                    </p>
                    <p>Birthday: 
                        <?php echo $_SESSION['sess_profile']['birthdate']; ?>
                    </p>
                    <p>School: 
                        <?php echo $_SESSION['sess_profile']['school']; ?>
                    </p>
                    <p>Course: 
                        <?php echo $_SESSION['sess_profile']['course']; ?>
                    </p>
                    <br>

                    <div class="justify-content-center d-flex flex-column ">
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo base_url("editprofile")?>'">Edit Profile</button>
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url("auth/logins/logout")?>'">Logout</button>
                    </div>
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