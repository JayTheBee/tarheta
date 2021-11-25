    <!-- LOGIN PAGE -->


    <?php 
        /*
            *This redirects the user to the profile page when the 
                $_SESSION['UserLoginSession'] is still set.
        */
        if (isset($_SESSION['UserLoginSession'])){
            header("Location: ".base_url()."profile");
            exit();
        }
    ?>

    
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        Login
                    </div>
                    <div class="card-body">
                    <form method="POST" autocomplete="off" action="<?=base_url('auth/login')?>">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
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
                            <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                        <?php } ?>


                        </form>
                    </div>
                    </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>