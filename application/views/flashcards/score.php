<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 5rem">
            <div class="card-header text-center">
                <h3><?php echo $flashcard['name']; ?></h3>
                <p><?php echo $flashcard['description'] ?></p>
                <h5><?php echo $user_scores['user_score']?>/<?php echo $flashcard['total_score']?></h5>
                <h6>Attempt : <?php echo $user_answers[0]['attempt']?></h6>
                
                <!-- Flash data -->
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
</div>