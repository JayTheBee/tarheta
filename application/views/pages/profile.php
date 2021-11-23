    <!-- PROFILE VIEW -->

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Profile </div>

                <div class="card-body">
                    <?php
                        if($this->session->userdata('UserLoginSession')){
                            $udata = $this->session->userdata('UserLoginSession');

                            echo 'Welcome'.' '.$udata['username'];
                        }
                        else{
                            redirect(base_url('login'));
                        }
                    ?>
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>