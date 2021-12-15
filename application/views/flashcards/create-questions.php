<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        QUESTIONS
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/questions')?>">

                            <!-- <div class="mb-2">
                                <label for="exampleInputUsername1" class="form-label">Question</label>
                                <input type="text" placeholder="Enter Question" name="name" class="form-control" id="name" aria-describedby="name">
                            </div> -->
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <!-- Pwede daw na wag muna JS rekta controller then load new php file sa view -->
                                    <label for="inputState">Type</label>
                                    <select id="question-type" name="question-type" class="form-control">
                                        <option value="CHOICE">Multiple Choice</option>
                                        <option value="IDENTIFICATION">Identification</option>
                                        <option value="TRUEFALSE">True/False</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">ADD</button>
                            </div>

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

                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>