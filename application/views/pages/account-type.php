<!-- ACCOUNT TYPE SELECTION PAGE -->
<section class="teacherStudent-bg">
    <div>
        <img src="<?php echo base_url("assets/images/accType/teacher_student_wave.png");?>" class="waveSize position-absolute bottom-0" alt="wave">

        <div class="position-relative boxPos d-flex justify-content-center ">
            <div class="boxWidth">
                <div class="container firstBox">
                    <p>Are you A ...</p>
                    <form method="" autocomplete="off" action="<?php echo base_url('signup'); ?>">
                         <div class="d-flex flex-column mx-5">
                        <!--Choose teacher-->
                             <a role="button">
                                 <button type="button" class="btn-bd-choose boxBorder my-4 d-flex align-items-start" onclick="window.location='<?php echo site_url('auth/signups/set_teacher'); ?>'" >Teacher
                                </button>
                            </a>
                          <!--choose student-->
                             <a role="button">
                                 <button type="button" class="btn-bd-choose boxBorder btm-margin d-flex align-items-start" onclick="window.location='<?php echo site_url('auth/signups/set_student'); ?>'" >Student
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <img src="<?php echo base_url("assets/images/accType/teacher_student_boy.png"); ?>" class="position-absolute teacherStudent-boy" alt="boy">
            <img src="<?php echo base_url("assets/images/accType/teacher_student_plant.png"); ?>" class="position-absolute teacherStudent-plant" alt="plant">

        </div>
    </div>
</section>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>