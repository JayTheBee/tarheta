<!-- Flashcards View PAGE -->
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <select id="flashcards-selection" name="flashcards-selection" class="form-control" onchange="show(this)">
                    <option value="CLASS">Class Flashcards</option>
                    <option value="OTHER">Browse by Visibility</option>
                    <option value="SUBJECT">Browse by Subject</option>
                </select>

                <!-- Visibility Drop Down Menu -->
                <select id="visibility" name="visibility" class="form-control">
                    <option value="PUBLIC">Public</option>
                    <option value="PRIVATE">Private</option>
                </select>

                <!-- Category Drop Down Meny -->
                <select id="subject" name="subject" class="form-control">
                    <!-- Looping through the available categories -->
                    <?php foreach($categories as $category): ?>
                        <option value='<?php echo($category['id'])?>'> <?php echo($category['name'])?> </option>
                    <?php endforeach;?>
                </select>

            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center">
                    Flashcards
                </div>
                
                <!-- 
                    Needs some ajax fuction to show the specific flashcards based on the filter
                    in the category drop down menu. Right now that's future Ramon's problem.
                -->
                <div class="card-body">
                    <?php foreach($flashcards as $flashcard): ?>
                        <h5><?php echo $flashcard['name']; ?></h5>
                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                        <p><?php echo $flashcard['visibility']; ?></p>
                        <p><?php echo $flashcard['qtype']; ?></p>
                        <p>
                            <?php if ($flashcard['type'] == "REVIEWER"):
                                echo $flashcard['type'];
                            ?>
                            <?php endif;?>
                        </p>                 
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$flashcard["id"]); ?>'" >View
                        </button>
                        <br><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>

<script>
    $(document).ready(function(){
        reset();
    });

    // This fuction just hides the other drop down menus
    function reset(){
        document.getElementById('visibility').style.display = 'none';
        document.getElementById('subject').style.display = 'none';
    }

    // This function does the check on which drop down menu will apeear
    function show(element){
        reset();
        if(element.value == "CLASS")
            reset(); 
        else if(element.value == "OTHER")
            showOptions('visibility');
        else if(element.value == "SUBJECT")
            showOptions('subject');
    }

    // Handles showing the specific drop down that is passed
    function showOptions(divId){
        document.getElementById(divId).style.display = (document.getElementById(divId).style.display == 'none') ? 'block':'none';
    }
</script>