    <!-- SIGN UP PAGE -->
    <!-- reCaptcha -->
    <!-- https://stackoverflow.com/questions/39374880/sub-resource-integrity-value-for-maps-google-com-maps-api-js -->
    <!-- integrity check not necessary -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">

                <div class="card-header text-center"> 
                    Register as a <?php echo $_SESSION['sess_user_type'];?>
                </div>


                <div class="card-body">
                    <?php echo form_open(base_url("auth/signups/signup"))?>
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Username</label>
                            <input type="text" placeholder="Username" name="username" class="form-control" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" class="form-control" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" name="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control">
                        </div>


                        <!-- Captcha - Site Key-->
                        <div class="g-recaptcha" data-sitekey= <?php echo env("RCAPTCHA_SITE_KEY"); ?> ></div><br> 

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