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
            z-index: 99;
            left: 12%;
	        top: 20%;
            height: 35rem;
        }
    </style>
</head>

<!-- EDIT PROFILE VIEW -->
<div class="editprofile vw-100 vh-100">
    <div class="profile-edit container-fluid">
        <div class="card" style="margin-top: 3rem">
            <div class="pf-header text-center"> Profile  </div>
                <form method="POST" autocomplete="off" action="<?=base_url('profile/editprofile')?>">
                    <div class="form-group">
                    <label>First Name </label> 
                    <input type="text" placeholder="<?php echo $_SESSION["Profile"]['firstname'];?>"
                        name="firstname" value="<?php echo $_SESSION["Profile"]['firstname'];?>"
                        class="form-control pf-edit-fn" id="firstname" aria-describedby="name"
                    > 
                </div>
                    <div class="form-group">
                        <label name="lastname" class="form-label">Last Name</label> 
                        <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="name"> 
                    </div>
                    <div class="form-group">
                        <label name="birthdate" class="form-label">Birthday</label> 
                        <input type="date" name="birthdate" class="form-control" id="birthdate" aria-describedby="name" > 
                    </div>
                    <div class="form-group">
                        <label name="school" class="form-label">School</label> 
                        <input type="text" name="school" class="form-control" id="school" aria-describedby="name"> 
                    </div>
                    <div class="form-group">
                        <label name="course" class="form-label">Course</label> 
                        <input type="text" name="course" class="form-control" id="course" aria-describedby="name"> 
                    </div>
                    <div class="form-group col-md-2">
                        <label for="avatar">Avatar</label>
                        <select id="avatar" name="avatar" class="form-group">
                            <option value="Default">Default</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                        </select>
                    </div>
                <div class="text-center">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo base_url("profile"); ?>'" >Back </button>
                    </div>
                <?php echo form_close()?> 
                    <?php
                        if($this->session->flashdata('success')){?>
                            <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                    <?php } ?>
                    
                    <?php
                    if($this->session->flashdata('error')){?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                    <?php } ?>
               
                </div>
                <div class="pf-btns text-center">
                        <button class="btn pf-confirm" type="submit" >Confirm</button>
                        <button class="btn btn-secondary"type="button"  onclick="window.location='<?php echo site_url("profile"); ?>'" >Back
                        </button></div>
                        <?php
                            if($this->session->flashdata('success')){?>
                                <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                        <?php } ?>
                        
                        <?php
                        if($this->session->flashdata('error')){?>
                            <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                        <?php } ?>
                    </form>
                </div>
      
            </div>
        </div>
    </div>
</div>
<img src="<?php echo base_url("assets/images/accType/teacher_student_boy.png"); ?>" class="position-absolute pf-img" alt="boy">