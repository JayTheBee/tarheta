<!-- EDIT PROFILE VIEW -->
<?php
    if (!isset($_SESSION['UserLoginSession'])){
        $this->session->set_flashdata('error', 'Please Login First');
        header("Location: ".base_url()."login");
        exit();
    }
    if(isset($_SESSION["Profile"])){
        // print_r($_SESSION["Profile"]);
        // exit;
        $firstname = $_SESSION["Profile"]['firstname'];
        $lastname = $_SESSION['Profile']['lastname'];
        $birthdate = $_SESSION['Profile']['birthdate'];
        $school = $_SESSION['Profile']['school'];
        $course = $_SESSION['Profile']['course'];
    }
    else{
        $firstname = "First Name";
        $lastname = "Last Name";
        $birthdate = "Birthdate";
        $school = "School";
        $course = "Course";
    }
?> 
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>
                <form method="POST" autocomplete="off" action="<?=base_url('profile/editprofile')?>">
                    <div class="form-group">
                    <label>First Name </label> 
                    <input type="text" placeholder="<?php echo $firstname;?>"
                        name="firstname" value="<?php echo $firstname;?>"
                        class="form-control" id="firstname" aria-describedby="name"
                    > 
                </div>
                    <div class="form-group">
                    <label>Last Name </label> 
                    <input type="text" placeholder="<?php echo $lastname;?>"
                        name="lastname" value="<?php echo $lastname;?>"
                        class="form-control" id="lastname" aria-describedby="name"
                    > 
                </div>
                    <div class="form-group">
                    <label>Birthday </label> 
                    <input type="date" name="birthdate" value="<?php echo $birthdate;?>"
                        class="form-control" id="birthdate" aria-describedby="name"
                    > 
                </div>
                    <div class="form-group">
                    <label>School </label> 
                    <input type="text" placeholder="<?php echo $school;?>"
                        name="school" value="<?php echo $school;?>"
                        class="form-control" id="school" aria-describedby="name"
                    > 
                </div>
                    <div class="form-group">
                    <label>Course </label> 
                    <input type="text" placeholder="<?php echo $course;?>"
                        name="course" value="<?php echo $course;?>"
                        class="form-control" id="course" aria-describedby="name"
                    > 
                </div>
                <div class="text-center">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("profile"); ?>'" >Back
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
            <div class="col-md-4"></div>
        </div>

    </div>