    <!-- LOGIN PAGE -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center">
                    Login
                </div>
                <div class="card-body">
                    <form method="POST" autocomplete="off" action="<?=base_url('logins/login')?>">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                        </div>
                        <!-- <a href="" data-bs-target="#myModal">Forgot password?</a> -->
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-title="Feedback">Forgot Password</button>
                        </div>
                        
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                            <br><br>
                            <a href="">Don't have an account? Sign up</a>
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

                    <div id="myModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" autocomplete="off" action="<?=base_url('resetpasswords/sendPassReset')?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Password reset.</h5>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                                    </div>
                                    <div class="modal-body">                        
                                        <div class="mb-3">
                                            <!-- <label class="form-label">Email</label>  -->
                                            <input type="text" placeholder="Account Email" class="form-control" name="email">
                                        </div>                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>

                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>