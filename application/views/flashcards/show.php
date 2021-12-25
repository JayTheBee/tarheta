<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        <h3><?php echo $flashcard['name']; ?></h3>
                        <p><?php echo $flashcard['description'] ?></p>
                        <p>Flashcard ID: <?php echo $flashcard['id']?> </p>
                        <p>Creator ID: <?php echo $flashcard['creator_id']?> </p>
                        <p>Visibility: <?php echo $flashcard['visibility'] ?></p>
                        <p>Flashcard Type: <?php echo $flashcard['type'] ?></p>

                        <!-- Share Button -->
                        <?php if($flashcard['visibility'] == 'PRIVATE' && $flashcard['creator_id']== $_SESSION['Profile']['user_id']):?>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-title="Feedback">Assign/Share</button>
                            </div>
                        <?php endif; ?>

                        <!-- Edit Button -->
                        <?php if($flashcard['creator_id']== $_SESSION['Profile']['user_id']):?>
                            <?php 
                                $_SESSION['Current_Flashcard']['flashcard_id'] = $flashcard['id'];
                                echo form_open("flashcards/edit/".$flashcard['id'])
                            ?>
                                <button class="btn btn-success" type="submit">Edit</button>
                            </form>
                        <?php endif; ?>
                        <!-- Answer Quiz Button -->
                        <?php if ($flashcard['type']=="QUIZ"): ?>
                            <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$flashcard["id"]); ?>'" >Answer
                            </button>
                        <?php endif; ?>
                        
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
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/questions')?>">


                            <div class="form-row">
                                <?php //if ($flashcard['type'] == "REVIEWER"): ?>
                                <!-- 
                                    Does the user have the ability to view the questions when 
                                    viewing a QUIZ type flashcard?
                                -->
                                <?php foreach($questions as $question): ?>
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
                                        <p>TRUE/FALSE</p>
                                    <!-- Displays if the question type is Identification -->
                                    <?php elseif($question['question_type'] == 'IDENTIFICATION'):?>
                                        <p>TEXT BOX GO BRRRRR</p>
                                    <?php endif; ?>    
                                    
                                    <!-- Shows answer when type is reviewer-->
                                    <?php if($flashcard['type'] == 'REVIEWER'):?>
                                        <p>Answer: <?php echo $question['answer']; ?></p>
                                    <?php endif; ?>    
                                    <br><br>
                                <?php endforeach; ?>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php echo form_open("flashcards/share/".$flashcard["id"])?>   
                        <div class="modal-header">
                            <h5 class="modal-title">Assign/Share to</h5>
                        </div>
                        <div class="modal-body">                        
                            <div class="mb-3">
                                <input type="text" placeholder="Account Email" class="form-control" name="email">
                            </div>                       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

</div>