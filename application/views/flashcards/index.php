<!-- Flashcards View PAGE -->
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center">
                    Flashcards
                </div>
                
                <div class="card-body">
                    <?php foreach($flashcards as $flashcard): ?>
                        <h5><?php echo $flashcard['name']; ?></h5>
                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                        <p><?php echo $flashcard['visibility']; ?></p>
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$flashcard["id"]); ?>'" >View
                        </button>
                        <!-- <?php //echo base_url("flashcards/show/".$flashcard["id"])?>
                            <button class="btn btn-primary" type="submit">View</button>
                        </form> -->
                        <!-- <button href="">View</button> -->
                        <br><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>