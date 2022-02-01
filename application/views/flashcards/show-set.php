<!-- Flashcards View PAGE -->
<div class="container">
    <div class="container my-6">
        <h3><?php echo $set['name']; ?></h3>
        <p><?php echo $set['description'] ?></p>
        <p>Set ID: <?php echo $set['id']?> </p>
        <p>Set Color: <?php echo $set['color']?></p>
        <!-- Edit Set Button -->
        <button type='button' class='btn btn-success' onclick="window.location='<?php echo site_url("flashcards/edit-set/".$set["id"]); ?>'">Edit</button>
        
        <!-- Delete Set Button -->
        <button type='button' class='btn btn-danger' onclick="window.location='<?php echo site_url("flashcards/delete-set/".$set["id"]); ?>'">Delete</button>
        <p>--------------------------------------------</p>
        <br><br>

        <!-- Displaying all the flashcards in the set -->
        <?php foreach ($flashcards_with_set as $card): ?>
            <?php if ($card['set_id'] == $set['id'] && $card['user_id'] == $_SESSION['sess_profile']['user_id']): ?>
                <h5><?php echo $card['name']; ?></h5>
                <h6>Description: <?php echo $card['description']; ?></h6>
                <?php echo $card['visibility']; ?></p>
                <p><?php echo $card['qtype']; ?></p>
                <p>
                    <?php if ($card['type'] == "REVIEWER"):
                        echo $card['type'];
                    ?>
                    <?php endif;?>
                </p>                 
                <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$card["id"]); ?>'" >View
                </button>
                <br><br>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>

    <div class="col-md-4"></div>
</div>