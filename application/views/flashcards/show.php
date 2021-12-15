<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        <h3><?php echo $flashcard['name']; ?></h3>
                        <p><?php echo $flashcard['description'] ?></p>
                        <p>Visibility: <?php echo $flashcard['visibility'] ?></p>
                        <p>Flashcard Type: <?php echo $flashcard['type'] ?></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/questions')?>">


                            <div class="form-row">
                                <?php foreach($questions as $question): ?>
                                    <h5><?php echo $question['question']; ?></h5>
                                    <?php if($question['question_type'] == 'CHOICE'):
                                        foreach($multi_choices as $multi_choice):
                                            if($multi_choice['question_id'] == $question['id']):?>
                                                <p>A. <?php echo $multi_choice['choiceA'] ?></p>
                                                <p>B. <?php echo $multi_choice['choiceB'] ?></p>
                                                <p>C. <?php echo $multi_choice['choiceC'] ?></p>
                                                <p>D. <?php echo $multi_choice['choiceD'] ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php elseif($question['question_type'] == 'TRUEFALSE'):?>
                                        <p>TRUE/FALSE</p>
                                    <?php elseif($question['question_type'] == 'IDENTIFICATION'):?>
                                        <p>TEXT BOX GO BRRRRR</p>
                                    <?php endif; ?>    
                                    
                                    <?php if($flashcard['type'] == 'REVIEWER'):?>
                                        <p>Answer: <?php echo $question['answer']; ?></p>
                                    <?php endif; ?>    
                                    <br><br>
                                <?php endforeach; ?>
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