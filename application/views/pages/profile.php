    <!-- PROFILE VIEW -->

    <!-- jediboy: unnecessary checks -->

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>

                <div class="card-body">
                <img src="assets/images/<?php echo $_SESSION['Profile']['avatar'];?>.png" style="width:30%" class="avatar"><br>
                    <?php
                        if($this->session->userdata('UserLoginSession')){
                            $udata = $this->session->userdata('UserLoginSession');
                            echo 'Welcome'.' '.$udata['username'];
                        }
                        //jediboy: unnecessary checks
                    ?>
                    <br><br>
                    <p>First Name: 
                        <?php echo $_SESSION['Profile']['firstname']; ?>
                    </p>
                    <p>Last Name: 
                        <?php echo $_SESSION['Profile']['lastname']; ?>
                    </p>
                    <p>Birthday: 
                        <?php echo $_SESSION['Profile']['birthdate']; ?>
                    </p>
                    <p>School: 
                        <?php echo $_SESSION['Profile']['school']; ?>
                    </p>
                    <p>Course: 
                        <?php echo $_SESSION['Profile']['course']; ?>
                    </p>
                    <br>

                    <div class="justify-content-center d-flex flex-column ">
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("editprofile"); ?>'" >Edit Profile
                        </button>
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url("auth/logins/logout"); ?>'" >Logout
                        </button>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>