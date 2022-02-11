<!-- ACCOUNT TYPE SELECTION PAGE -->
<head>
<style>
.custom-bg-create {
      background-color: #E4BE91;
      overflow-x: hidden;
      background-image: url("<?php echo base_url('assets/images/contact/contact-wave.png'); ?>");
      width: 100%;
      height: 100%;
      background-size:cover;
}

</style>
</head>


<div class="custom-bg-create">
    <div class="container vh-100 w-100">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="card" style="margin: 5rem 0 5rem 0; background-color: rgba(112,95,89,.9); color: #fff">
                <div class="card-header text-center">
                    <h3><?php echo $flashcard['name']; ?></h3>
                    <p><?php echo $flashcard['description'] ?></p>
                    <!-- <p>Flashcard ID: <?php echo $flashcard['id']?> </p> -->
                    <!-- <p>Creator ID: <?php echo $flashcard['creator_id']?> </p> -->
                    <!-- <p>Visibility: <?php echo $flashcard['visibility'] ?></p>-->
                    <!-- <p>Flashcard Type: <?php echo $flashcard['type'] ?></p> -->
                    <!-- <p>Tags:
                        <?php foreach($category as $cat): ?>
                            <?php echo $cat['name']; ?>
                        <?php endforeach; ?>
                    </p> -->
                    <?php if($flashcard['type'] == 'QUIZ'): ?>
                        <!-- <p>Quiz Type: <?php echo $flashcard['qtype'] ?></p> -->
                        <p>Time Open: <?php echo $flashcard['timeopen'] ?></p>
                        <p>Time Close: <?php echo $flashcard['timeclose'] ?></p>
                    <?php endif; ?>

                    <?php 
                        //$_SESSION['sess_current_flashcard']['flashcard_id'] = $flashcard['id'];
                        //echo form_open("flashcards/edit/".$flashcard['id'])
                    ?>

    <!-- Flashcard Creator Available Buttons -->
    <?php if($flashcard['creator_id']== $_SESSION['sess_profile']['user_id']):?>
                    <div class="text-center">
                        <!-- Share Button -->
                        <?php if($flashcard['visibility'] == 'PRIVATE' && $flashcard['creator_id']== $_SESSION['sess_profile']['user_id']):?>

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" data-title="Feedback">
                                    Assign/Share
                                </button>
                        <?php endif; ?>

                        <!-- Edit Flashcard Details -->
                            <button type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url("flashcards/edit/flashcard/".$flashcard["id"]); ?>'" >
                            Edit Flashcard
                            </button>

                        <!-- Edit Questions -->
                            <button type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url("flashcards/edit/questions/".$flashcard["id"]); ?>'" >
                            Edit Questions
                            </button>

                        <!-- Reopen -->
                            <button type="button" class="btn btn-danger" onclick="window.location='<?php echo site_url("flashcards/reopen/".$flashcard["id"]); ?>'">
                                Reopen
                            </button>
                        
                        <!-- Ranking -->
                            <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo site_url("flashcards/ranking/" .(($flashcard['qtype']=='POP' || $flashcard['qtype']=='ASSIGNMENT')?'first':'latest') ."/" .$flashcard["id"]); ?>'">
                            Ranking
                            </button>
                    </div>
    <?php endif; ?>
                    
                    <!-- Answer Quiz Button -->
                    <?php
                        // https://stackoverflow.com/questions/961074/how-do-i-compare-two-datetime-objects-in-php-5-2-8
                        $timenow_var = new DateTime("now");
                        $timeopen_var = new DateTime($flashcard['timeopen']);
                        $timeclose_var = new DateTime($flashcard['timeclose']);
                    ?>
                    <br>
                    <?php if(($flashcard['type']=="QUIZ" && $timeopen_var < $timenow_var && $timeclose_var > $timeopen_var) || ($flashcard['type']=="REVIEWER")): ?>
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url("flashcards/answer/".$flashcard["id"]); ?>'">
                        Answer
                        </button>
                    <?php endif; ?>

                    <!-- View Result Button -->
                    <?php if(
                        ($is_answered == TRUE && ($flashcard['qtype'] == "POP")) 
                        || (($flashcard['qtype'] != "POP") &&  strtotime($flashcard['timeclose']) < time())
                    ):?>
                        <button type="button" class="btn btn-danger" onclick="window.location='<?php echo site_url("flashcards/result/".$_SESSION['sess_profile']['user_id']."/".$flashcard["id"]); ?>'">
                        Results
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
                            
                            <!-- Shows answer button when type is reviewer-->
                            <?php if($flashcard['type'] == 'REVIEWER' || $flashcard['creator_id']== $_SESSION['sess_profile']['user_id']):?>
                                <div class="answer"> 
                                    <button class="btn btn-success" onclick="revealAnswersFunction(this)">Click/Tap To Reveal Answers: </button>
                                    <div class="showanswer" style="display:none"><?php echo $question['answer']; ?> </div>
                                </div>
                            <?php endif; ?>
                            <br><br>
                        <?php endforeach; ?>
                    </div>

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

<script>
    function revealAnswersFunction(e) {
        var all =document.getElementsByClassName('showanswer');
        for(let i=0;i<all.length;i++){
            all[i].style.display='none';
        }

        var div = e.nextSibling.nextElementSibling;
        div.style.display = 'inline-block';
    }
</script>