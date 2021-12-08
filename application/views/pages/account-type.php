<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        I am a
                    </div>
                    <div class="card-body">
                        <form method="" autocomplete="off" action="<?php echo base_url(); ?>signup">

                            <!-- 
                                * Setting the usertype by calling the auth controller function.
                                https://stackoverflow.com/questions/21446903/how-can-i-call-controller-method-inside-button-onclick
                                * Pasabi nalng pag may better way.
                            -->
                            <div class="text-center">
                                <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("signups/setTeacher"); ?>'" >Teacher
                                </button>
                                <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("signups/setStudent"); ?>'" >Student
                                </button>
                            </div>


                            <!-- jediboy: unnecessary flashdata checks -->


                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>