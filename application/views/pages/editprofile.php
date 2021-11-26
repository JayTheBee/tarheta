<!-- EDIT PROFILE VIEW -->  
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>
                <form method="POST" autocomplete="off" action="<?=base_url('auth/editprofile')?>">
                    <div class="form-group">
                    <label>First Name </label> 
                    <input type="text" placeholder="Enter first name" name="firstname" value="<?php echo set_value('firstname'); ?>" class="form-control" id="firstname" aria-describedby="name"> 
                </div>
                    <div class="form-group">
                    <label>Last Name </label> 
                    <input type="text" placeholder="Enter last name" name="lastname" value="<?php echo set_value('lastname'); ?>" class="form-control" id="lastname" aria-describedby="name"> 
                </div>
                    <div class="form-group">
                    <label>Birthday </label> 
                    <input type="text" placeholder="0000-00-00" name="birthdate" value="<?php echo set_value('birthdate'); ?>" class="form-control" id="birthdate" aria-describedby="name"> 
                </div>
                    <div class="form-group">
                    <label>School </label> 
                    <input type="text" placeholder="Enter school" name="school" value="<?php echo set_value('school'); ?>" class="form-control" id="school" aria-describedby="name"> 
                </div>
                    <div class="form-group">
                    <label>Course </label> 
                    <input type="text" placeholder="Enter course" name="course" value="<?php echo set_value('course'); ?>" class="form-control" id="course" aria-describedby="name"> 
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