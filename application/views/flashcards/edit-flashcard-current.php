<head>
    <style>
    .custom-bg-create {
    background-color: #E4BE91;
    overflow-x: hidden;
    }

    .wave-size-bg {
      height: 100vh;
      width: 100vw;
      position: absolute;
    }
    .card {
      margin-top: 2rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      border: 2px solid #A2795E;
      font-family: "Poppins";
    }
    /* flashcard header */
    .summary-header {
      flex: 0 0 auto;
      padding: 0px 24px 0px;
      margin: 0px;
      font-size: 1.5rem;
      font-weight: 700;
      line-height: 1.33;
      background-color: #A2795E;
      border: 2px 2px 0 0 solid #A2795E;
    }

    .summary-title{
      flex: 0 0 auto;
      padding: 24px 24px 8px;
      margin: 0px;
      font-size: 1.5rem;
      font-weight: 700;
      line-height: 1.33;
    }

    .summary-content {
      flex: 1 1 auto;
      padding: 0px 24px;
      overflow-y: auto;
    }

    .summary-content .form-group {
        margin: 10px 0 10px 0;
        box-sizing: border-box;
    }

    .st-2-label {
      margin: 0px 0px 0.25rem;
      line-height: 1.5rem;
      font-size: 0.875rem;
      font-weight: 700;
      letter-spacing: 0.2px;
    }

    .footer-summary{
        margin: 20px 0  20px 0;
    }

    .footer-summary button {
      min-width: 7.5rem;
      margin: 0px 4px;
    }

    .footer-button {
      width: initial;
      margin: 0px;
      border: 0px;
      cursor: pointer;
      display: inline-block;
      vertical-align: bottom;
      box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
      border-radius: 4px;
      font-size: 0.875rem;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      min-width: 30px;
      min-height: 30px;
      padding: 0px 16px 4px;
      position: relative;
      font-family: "Poppins", sans-serif;
    }

    .footer-done {
      background-color: #A2795E;
      color: rgb(0, 0, 0);
    }

    .footer-cancel {
      background-color: #C4C4C4;
      color: rgb(0, 0, 0);
    }
    </style>
</head>

<!-- ACCOUNT TYPE SELECTION PAGE -->
<div class="custom-bg-create">
  <img src="<?php echo base_url('assets/images/contact/contact-wave.png'); ?>" class="wave-size-bg" />   
<div class="container">
        <div class="card flashcard-modal" style="margin: 2rem 0 2rem 0">
            <div class="summary-header card-header">
                <h6 class="summary-title">EDIT FLASHCARD</h6>
            </div>

            <div class="summary-content">
            <form method="POST" autocomplete="off" action="<?=base_url('flashcards/update/flashcard/'.$flashcard['id'])?>">
                <div class="form-group">
                    <label class="st-2-label">Name</label> 
                    <input type="text" placeholder="<?php echo $flashcard['name'];?>"
                        name="name" value="<?php echo $flashcard['name'];?>"
                        class="form-control" id="name" aria-describedby="name"
                    >
                </div>

                <div class="form-group">
                    <label class="st-2-label">Description</label> 
                    <input type="text" placeholder="<?php echo $flashcard['description'];?>"
                        name="description" value="<?php echo $flashcard['description'];?>"
                        class="form-control" id="description" aria-describedby="name"
                    >
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="st-2-label" for="type">Type</label>
                        <select id="type" name="type" class="form-control form-select" onchange="showQuizFields('quiz-type', 'time-fields', this)">
                            <option value="QUIZ">Quiz</option>
                            <option value="REVIEWER">Reviewer</option>
                        </select>
                    </div>

                    <div class="form-group" id='quiz-type'>
                        <label class="st-2-label" for="qtype">Quiz Type</label>
                        <select id="qtype" name="qtype" class="form-control form-select">
                            <option value="POP">Pop</option>
                            <option value="EXAM">Exam</option>
                            <option value="ASSIGNMENT">Assignment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="st-2-label" for="visibility">Visibility</label>
                        <select id="visibility" name="visibility" class="form-control form-select">
                            <option value="PRIVATE">Private</option>
                            <option value="PUBLIC">Public</option>
                        </select>
                    </div>

                    <div id='time-fields' >
                        <div class="form-group">
                            <label class="st-2-label" for="time-open" class="form-label">Time Open</label>
                            <input type="datetime-local" name="time-open" class="form-control" id="time-open">
                        </div>
                        <div class="form-group">
                            <label class="st-2-label" for="time-close" class="form-label">Time Close</label>
                            <input type="datetime-local" name="time-close" class="form-control" id="time-close">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="st-2-label"for="category">Subjects</label>
                        <select id="category" name="category" class="form-control form-select">
                            <!--   <option value="">Category 1</option>
                            <option value="">Category 2</option> -->
                        <?php 
                            foreach($categories as $row){ 
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                            }
                        ?>
                        </select>
                        <h6>Before editing please manually add a category to the DB and select it here</h6>
                    </div>

                    <div class="form-group">
                        <label class="st-2-label" for="sets">Flashcard Sets</label>
                        <select id="sets" name="sets" class="form-control form-select">
                            <option selected="selected" value='-1'>Select Set</option>
                        <?php 
                            foreach($sets as $row){ 
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="footer-summary text-center">
                    <button type="submit" class="footer-button footer-done">Save</button>
                    <button type="button" class="footer-button footer-cancel" onclick="window.location='<?php echo site_url('flashcards/show/'.$flashcard['id']); ?>'" >Back
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" integrity="sha384-DRe+1gYJauFEenXeWS8TmYdBmDUqnR5Rcw7ax4KTqOxXWd4NAMP2VPU5H69U7yP9" crossorigin="anonymous"></script>
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

        $("#sets").val("<?php echo (array_key_exists('set_id', $flashcard)) ? $flashcard['set_id'] : '-1'?>");
        $('#category').val("<?php echo $category[0]['id']?>");
        
        // IDK what to do here yet.
        // $("#category").val('');
    });


    function showQuizFields(divID1, divID2, element){
        document.getElementById(divID1).style.display = element.value == "REVIEWER" ? 'none' : 'block';
        document.getElementById(divID2).style.display = element.value == "REVIEWER" ? 'none' : 'block';
    }
</script>