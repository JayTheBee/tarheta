<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        CREATE A FLASHCARD
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/create_flashcards')?>">

                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" placeholder="Flashcard name" name="name" class="form-control" id="name" aria-describedby="name">
                                <?php echo form_error("name", '<p class="text-danger">','</p>');?> 
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" placeholder="Flashcard description" name="description" class="form-control" id="description">
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
                                    <p>needs a script to dynamically add more input fields</p>
                                </div>
                            </div>

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

<script>
    function showQuizFields(divID1, divID2, element){
        document.getElementById(divID1).style.display = element.value == "REVIEWER" ? 'none' : 'block';
        document.getElementById(divID2).style.display = element.value == "REVIEWER" ? 'none' : 'block';
    }
</script>