    <!-- SIGN UP PAGE -->

    <?php 
        /*
            *This redirects the user to the account-type when the 
                $_SESSION['usertype'] is still not set.
        */
        if (!isset($_SESSION['usertype'])){
            header("Location: ".base_url()."account-type");
            exit();
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> 
                    Register as a <?php echo $_SESSION['usertype'];?>
                </div>

                <div class="card-body">
                    <!-- 
                        * Validation errors now show under the specific field na may error
                        * Nde na nawawala yung previous data pag nag press ng confirm
                        button tapos may error like nde unique yung user or email
                    -->
                    <form method="POST" autocomplete="off" action="<?=base_url('auth/signup')?>">
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Username</label>
                            <input type="text" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="username" aria-describedby="name">
                             <?php echo form_error("username", '<p class="text-danger">','</p>');?> 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" aria-describedby="emailHelp">
                            <?php echo form_error("email", '<p class="text-danger">','</p>');?> 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                            <?php echo form_error("password", '<p class="text-danger">','</p>');?> 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" name="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password">
                            <?php echo form_error("confirm_password", '<p class="text-danger">','</p>');?> 
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
        
                        <?php
                            if($this->session->flashdata('success')){?>
                                <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                        <?php } ?>

                        <?php
                            if($this->session->flashdata('error')){?>
                                <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                        <?php } ?>
                    </form>
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>