<!-- RESET PASSWORD PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        Enter new password
                    </div>
                    <div class="card-body">
                        <?php echo form_open(base_url("auth/reset_passwords/reset_main"))?>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" name="password" class="form-label">New Password</label>
                                <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword2" name="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Confirm</button>
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