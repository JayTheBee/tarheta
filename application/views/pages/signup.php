    <!-- SIGN UP PAGE -->
    <!-- reCaptcha -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <section id="sign up" class="bg-blue">
        <div class="position-relative">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <img src="<?php echo base_url("assets/images/login/login-rectangle.png"); ?>" class="position-absolute img-responsive signup-box" alt="...">
                </div>
        </div>
        <div class="container">
             <div class="d-flex flex-column align-items-center justify-content-center">
                <h2 class="signup-text position-absolute">Welcome to Tarheta</h2>
                <p class="signup-p text-center">You are signing up as a <?php echo $_SESSION['usertype'];?><br>Please use a valid school or work email address</p>

                <form method="POST" autocomplete="off" action="<?=base_url('signups/signup')?>" class="form-inline">
                    <div class="container form-group d-flex flex-column align-items-center justify-content-center">
                        <!--username-->
                            <input type="text" class="form-control form-control-lg username position-absolute username"  placeholder="Username" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="username" aria-describedby="name">
                             <?php echo form_error("username", '<p class="text-danger">','</p>');?> 
                         <!--email-->
                         <input type="email" class="form-control form-control-lg position-absolute email-sp" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" aria-describedby="emailHelp">
                            <?php echo form_error("email", '<p class="text-danger">','</p>');?> 
                        <!--password-->
                        <input type="password" class="form-control form-control-lg position-absolute  password-sp"  placeholder="Password" name="password" class="form-control" id="password">
                            <?php echo form_error("password", '<p class="text-danger">','</p>');?> 
                        <!--confirm password-->
                        <input type="password" class="form-control form-control-lg position-absolute confirmpass-sp"  placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password">
                            <?php echo form_error("confirm_password", '<p class="text-danger">','</p>');?> 
                        <!-- Captcha - Site Key-->
                        <div class="position-absolute g-recaptcha" data-sitekey= <?php echo env("RCAPTCHA_SITE_KEY"); ?> >CAPCTHA API NA DI KO MAKITA</div><br> 
                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="btn submit-sp text-center"><span class="log-text">CREATE ACCOUNT</span></button>
        
                        <?php
                            if($this->session->flashdata('success')){?>
                                <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                        <?php } ?>
                        <?php
                            if($this->session->flashdata('error')){?>
                                <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                        <?php } ?>
                       
                    </div>  
                </form>
            </div>  
        
        </div>

        <img src="<?php echo base_url("assets/images/login/man-using-phone.png"); ?>" class="img-responsive position-absolute float-left man" alt="...">
        <img src="<?php echo base_url("assets/images/login/normal-plant.png"); ?>" class="img-responsive position-absolute plant" alt="...">
        <img src="<?php echo base_url("assets/images/login/Vector 7.png"); ?>" class="image-custom-below" alt="...">
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>