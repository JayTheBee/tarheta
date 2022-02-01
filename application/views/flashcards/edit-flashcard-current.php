<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 5rem">
            <div class="card-header text-center">
                <h6>EDIT FLASHCARD</h6>
            </div>
            <form method="POST" autocomplete="off" action="<?=base_url('flashcards/update/flashcard/'.$flashcard['id'])?>">
                <div class="form-group">
                    <label>Name</label> 
                    <input type="text" placeholder="<?php echo $flashcard['name'];?>"
                        name="name" value="<?php echo $flashcard['name'];?>"
                        class="form-control" id="name" aria-describedby="name"
                    >
                </div>

                <div class="form-group">
                    <label>Description</label> 
                    <input type="text" placeholder="<?php echo $flashcard['description'];?>"
                        name="description" value="<?php echo $flashcard['description'];?>"
                        class="form-control" id="description" aria-describedby="name"
                    >
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control" onchange="showQuizFields('quiz-type', 'time-fields', this)">
                            <option value="QUIZ">Quiz</option>
                            <option value="REVIEWER">Reviewer</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2" id='quiz-type'>
                        <label for="qtype">Quiz Type</label>
                        <select id="qtype" name="qtype" class="form-control">
                            <option value="POP">Pop</option>
                            <option value="EXAM">Exam</option>
                            <option value="ASSIGNMENT">Assignment</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="visibility">Visibility</label>
                        <select id="visibility" name="visibility" class="form-control">
                            <option value="PRIVATE">Private</option>
                            <option value="PUBLIC">Public</option>
                        </select>
                    </div>

                    <div id='time-fields' >
                        <div class="form-group col-mb-2">
                            <label for="time-open" class="form-label">Time Open</label>
                            <input type="datetime-local" name="time-open" class="form-control" id="time-open">
                        </div>
                        <div class="form-group col-mb-2">
                            <label for="time-close" class="form-label">Time Close</label>
                            <input type="datetime-local" name="time-close" class="form-control" id="time-close">
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="category">Subjects</label>
                        <select id="category" name="category" class="form-control">
                            <!--   <option value="">Category 1</option>
                            <option value="">Category 2</option> -->
                        <?php 
                            foreach($categories as $row){ 
                                echo '<option value="'.$row->name.'">'.$row->name.'</option>';
                            }
                        ?>
                        </select>
                        <h6>Before editing please manually add a category to the DB and select it here</h6>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="sets">Flashcard Sets</label>
                        <select id="sets" name="sets" class="form-control">
                            <option selected="selected" value='-1'> </option>
                        <?php 
                            foreach($sets as $row){ 
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url('flashcards/show/'.$flashcard['id']); ?>'" >Back
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if ($flashcard['type'] == 'QUIZ'):?>
            $("#qtype").val('<?php echo $flashcard['qtype']?>');
            $("#type").val("QUIZ");

            // Converting both time to a format that is accepted by datetime input which is:
            // "yyyy-MM-ddThh:mm" https://stackoverflow.com/questions/15484772/how-to-set-datetime-on-datetime-local-via-jquery/19922867
            // .replace(/\s/g, 'T') replaces the white space to 'T' since the echoed value == yyyy-MM-dd hh:mm
            var timeopen = '<?php echo $flashcard['timeopen']?>'.replace(/\s/g, 'T');
            var timeclose = '<?php echo $flashcard['timeclose']?>'.replace(/\s/g, 'T');

            $('#time-open').val(timeopen);
            $('#time-close').val(timeclose);
        <?php else: ?>
            $("#type").val("REVIEWER");
            $('#time-fields').hide();
            $('#quiz-type').hide();
        <?php endif; ?>

        $("#visibility").val('<?php echo $flashcard['visibility']?>');

       
        $("#sets").val("<?php echo (array_key_exists('set_id', $flashcard)) ? $flashcard['set_id'] : ''?>");
        
        
        // IDK what to do here yet.
        // $("#category").val('');
    });


    function showQuizFields(divID1, divID2, element){
        document.getElementById(divID1).style.display = element.value == "REVIEWER" ? 'none' : 'block';
        document.getElementById(divID2).style.display = element.value == "REVIEWER" ? 'none' : 'block';
    }
</script>