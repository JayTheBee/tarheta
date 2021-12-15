<!-- ADD QUESTION PAGE -->
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        ADD QUESTION
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/save_question')?>">

                            <div class="mb-2">
                                <label for="exampleQuestion1" class="form-label">Question</label>
                                <input type="text" placeholder="Enter Question" name="question" class="form-control" id="question" aria-describedby="name">
                            </div>
<?php if ((isset($_SESSION['Current_Question'])) && ($_SESSION['Current_Question']['question_type']=='IDENTIFICATION')): ?>
                            <div   div class="mb-2">
                                <label for="exampleQuestion1" class="form-label">ANSWER</label>
                                <input type="text" placeholder="Enter Answer" name="identification-answer" class="form-control" id="identification-answer" aria-describedby="name">
                            </div>
<?php elseif ((isset($_SESSION['Current_Question'])) && ($_SESSION['Current_Question']['question_type']=='TRUEFALSE')): ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <!-- Pwede daw na wag muna JS rekta controller then load new php file sa view -->
                                    <label for="inputState">Answer</label>
                                    <select id="truefalse-answer" name="truefalse-answer" class="form-control">
                                        <option value="TRUE">True</option>
                                        <option value="FALSE">False</option>
                                    </select>
                                </div>
                            </div>
<?php elseif ((isset($_SESSION['Current_Question'])) && ($_SESSION['Current_Question']['question_type']=='CHOICE')): ?>
                            <div   div class="mb-2">
                                <input type='radio' name='choice-answer' value='a'>
                                <label for="exampleQuestion1" class="form-label">A</label> 
                                <input type="text" placeholder="A" name="choice-answer-a" class="form-control" id="choice-answer-a" aria-describedby="name">
                            </div>
                            <div   div class="mb-2">
                                <input type='radio' name='choice-answer' value='b'>
                                <label for="exampleQuestion1" class="form-label">B</label> 
                                <input type="text" placeholder="B" name="choice-answer-b" class="form-control" id="choice-answer-b" aria-describedby="name">
                            </div>
                            <div   div class="mb-2">
                                <input type='radio' name='choice-answer' value='c'>
                                <label for="exampleQuestion1" class="form-label">C</label> 
                                <input type="text" placeholder="C" name="choice-answer-c" class="form-control" id="choice-answer-c" aria-describedby="name">
                            </div>
                            <div   div class="mb-2">
                                <input type='radio' name='choice-answer' value='d'>
                                <label for="exampleQuestion1" class="form-label">D</label>
                                <input type="text" placeholder="D" name="choice-answer-d" class="form-control" id="choice-answer-d" aria-describedby="name">
                            </div>
<?php endif; ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
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