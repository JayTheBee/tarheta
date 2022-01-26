<!-- plan to change navbar for login, signup, & choose role -->

<section id="Log In" class="bg-blue">
    <div class="position-relative">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center h-100">
                <img src="<?php echo base_url("assets/images/login/login-rectangle.png"); ?>" class="position-absolute img-responsive rectangle-login" alt="...">
            </div>
        </div>
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <h2 class="position-absolute login-text">Log In to Tarheta</h2>

                <form class="form-inline" method="POST" autocomplete="off" action="<?= base_url('logins/login') ?>">
                    <div class="container form-group d-flex align-items-center justify-content-center">
                        <!-- pag mga forms na coconect sa controller wag nyo tatanggalin yung 'name' na property -->
                        <input class="form-control form-control-lg email" type="email" value="<?php echo set_value('email'); ?>" id="email" name="email" aria-describedby="emailHelp" placeholder="EMAIL ADDRESS">
                        <input class="form-control form-control-lg pass" type="password" placeholder="PASSWORD" id="password" name="password">
                        <p class="forgot-pass">Forgot password?
                            <a href="#" class="log-text" data-bs-toggle="modal" data-bs-target="#myModal" data-title="Feedback">Reset your password</a>
                        </p>
                        <button type="submit" class="btn btn-custom"><span class="log-text">LOG IN</span></button>
                        <a href="<?php echo base_url(); ?>account-type" class="go-to-signup log-text">Don't have an account yet? Signup</a>
                    </div>
                </form>
            </div>

        </div>
        <img src="<?php echo base_url("assets/images/login/man-using-phone.png"); ?>" class="img-responsive position-absolute float-left man" alt="...">
        <img src="<?php echo base_url("assets/images/login/normal-plant.png"); ?>" class="img-responsive position-absolute plant" alt="...">
        <img src="<?php echo base_url("assets/images/login/Vector 7.png"); ?>" class="image-custom-below" alt="...">
    </div>

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" autocomplete="off" action="<?= base_url('resetpasswords/sendPassReset') ?>">
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
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>