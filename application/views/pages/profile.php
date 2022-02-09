<head>
    <style>
         .editprofile{
            background-color: #52888A;
            background-image: url("<?php echo base_url("./assets/images/login/Vector 7.png"); ?>");
         }
        .profile-edit{
            position: absolute;
            width: 50rem;
            top: 5%;
            left: 20%;
            z-index: 1;
        }
        .profile-edit .pf-header{
            font-size: 1.6rem;
            font-style: bold;
        }
        .profile-edit .card{
            padding: 2% 15% 5% 15%;
            background-color: rgba(	112,95,	89, 0.74);
            border-radius: 32px;
        }
        .profile-edit .form-group{
            margin-bottom: 1rem;
        }

        .profile-edit .pf-btns button {
            border-radius: 10px;
            color: #fff;
            margin: 0 15px 0 15px;
            box-shadow: 2px 2px rgba(0,0,0,0.25);
        }

        .profile-edit .pf-btns .pf-confirm{
            background: #175561;
        }
        .profile-edit .pf-btns .pf-confirm:hover{
            background: #0B4B57;
        }

        .pf-img{
            left: 12%;
	        top: 20%;
            height: 35rem;
        }

        .profile-edit .card-body p {
            font-size: 1em;
            color: #fff;
            font-family: "Poppins";
        }

        .pfrror {
        text-align: center;
        margin-bottom: 1rem;
        font-size: 1.2em;
        font-weight: 600;
        }

    </style>
</head>

    <div class="editprofile vw-100 vh-100">
        <div class="profile-edit container-fluid">
            <div class="card" style="margin-top: 6rem">
                <div class="pf-header text-center"> Profile </div>

                     <div class="card-body">
                     <!--<img src="assets/images/<?php echo $_SESSION['sess_profile']['avatar']; ?>.png" style="width:30%" class="avatar"><br>-->
                     <p style="font-weight: 500; font-size: 2em"><?php
                            if ($this->session->userdata('sess_login')) {
                                $udata = $this->session->userdata('sess_login');

                                echo 'Welcome' . ' ' . $udata['username'];
                            }
                            //jediboy: unnecessary checks
                            ?> </p>
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

                            <div class="pf-btns text-center">
                                <button type="button" class="btn pf-confirm" onclick="window.location='<?php echo base_url("editprofile") ?>'">Edit Profile</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo base_url("auth/logins/logout") ?>'">Logout</button>
                            </div>
                            <?php
                            if ($this->session->flashdata('success')) { ?>
                                <p class="pfrror" style="margin-top:2rem; color: #0B4B57"> <?= $this->session->flashdata('success') ?> </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
    <img src="<?php echo base_url("assets/images/accType/teacher_student_boy.png"); ?>" class="position-absolute pf-img" alt="boy">
