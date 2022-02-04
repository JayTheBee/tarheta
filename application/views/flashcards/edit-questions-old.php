<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" data-title="Feedback">
                        Delete Flashcard
                    </button> -->
                    <div class="card-header text-center">
                        QUESTIONS
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/questions')?>">
                            <div class="form-group ">
                                <!-- Pwede daw na wag muna JS rekta controller then load new php file sa view -->
                                <label for="inputState">Type</label>
                                <select class="col-md-2 " id="question-type" name="question-type" class="form-control">
                                    <option value="CHOICE">Multiple Choice</option>
                                    <option value="IDENTIFICATION">Identification</option>
                                    <option value="TRUEFALSE">True/False</option>
                                </select>
                                <button type="submit" class="btn btn-primary">ADD</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <?php foreach($questions as $question): ?>
                                <h5>
                                    <?php echo form_open("flashcards/delete-question/".$question['id'])?>
                                        <button class="btn btn-success" type="submit">X</button>
                                    </form>
                                    <?php echo $question['question']; ?>
                                </h5>
                                <?php if($question['question_type'] == 'CHOICE'):
                                    foreach($multi_choices as $multi_choice):
                                        if($multi_choice['question_id'] == $question['id']):?>
                                            <p>A. <?php echo $multi_choice['choiceA'] ?></p>
                                            <p>B. <?php echo $multi_choice['choiceB'] ?></p>
                                            <p>C. <?php echo $multi_choice['choiceC'] ?></p>
                                            <p>D. <?php echo $multi_choice['choiceD'] ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <p>Answer: <?php echo $question['answer']; ?></p>
                                
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

                        
                        <!--<?php 
                        // echo form_open("flashcards/show/".$_SESSION['sess_current_flashcard']['flashcard_id'])
                        ?>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form> -->
                        <button 
                            type="button" class="btn btn-primary" 
                            onclick="window.location='<?php echo site_url("flashcards/show/".$_SESSION['sess_current_flashcard']['flashcard_id']); ?>'"
                        >
                            Done
                        </button>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>