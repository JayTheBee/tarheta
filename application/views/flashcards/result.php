<head>
<style>
    .custom-bg-create {
    background-color: #E4BE91;
    overflow-x: hidden;
    background-image: url("<?php echo base_url('assets/images/contact/contact-wave.png'); ?>");
    width: 100%;
    height: 100%;
    font-family: "Poppins";
}
</style>
<head>
<div class="custom-bg-create vh-100 w-100">
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 3rem">
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

            <div class="card-body">
                <div class="form-row">
                    <?php foreach($questions as $index => $question): ?>
                        <h5><?php echo $question['question']; ?></h5>

                        <!-- Displays if the question type is multiplechoice -->
                        <?php if($question['question_type'] == 'CHOICE'):
                            foreach($multi_choices as $multi_choice):
                                if($multi_choice['question_id'] == $question['id']):?>
                                    <p>A. <?php echo $multi_choice['choiceA'] ?></p>
                                    <p>B. <?php echo $multi_choice['choiceB'] ?></p>
                                    <p>C. <?php echo $multi_choice['choiceC'] ?></p>
                                    <p>D. <?php echo $multi_choice['choiceD'] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <!-- Displays if the question type is True or False -->
                        <?php elseif($question['question_type'] == 'TRUEFALSE'):?>
                            <p>[ TRUE/FALSE ]</p>
                        <!-- Displays if the question type is Identification -->
                        <?php elseif($question['question_type'] == 'IDENTIFICATION'):?>
                            <p>[ IDENTIFICATION ]</p>
                        <?php endif; ?>    
                        
                        <!-- AREA WHERE THE USER'S ANSWER WILL GO -->
                        <div class="user-answer">
                            <!-- https://stackoverflow.com/questions/4480803/two-arrays-in-foreach-loop -->
                            <h5>USER ANSWER: <?php echo $user_answers[$index]['answer']?></h5>
                            <h5>JUDGEMENT: <?php echo $user_answers[$index]['judgement']?></h5>                            <p></p>
                        </div>
                        <br><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>