<!-- EDIT PROFILE VIEW -->

<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>
                <?php echo form_open(base_url("user/profile/edit_profile"))?>
                    <div class="form-group">
                        <label name="firstname" class="form-label">First Name</label> 
                        <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="name"> 
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
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>