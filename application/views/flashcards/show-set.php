<head>
<style>
     .custom-bg-create {
      background-color: #E4BE91;
      overflow-x: hidden;
      width: 100%;
      height: 100%;
    }


    .shwflshcrd{
        background-color: #175561;
        width: 25rem;
        height: 15rem;
        border-radius: 20px;
        color: #fff;
        font-size: 1.2em;
        font-weight: 500;
        letter-spacing: 0.2px;
        display: inline-block;
    }

    .shwset{
        border: 2px solid #A2795E;
        border-radius: 20px; 
        display: block;
    }

</style>
</head>
<!-- Flashcards View PAGE -->
<div class="custom-bg-create">
<div class="container p-3 vh-100 w-100">
    <div class="container my-3">
            <div class="shwset p-3 text-truncate">
            <h3><?php echo $set['name']; ?></h3>
            <p><?php echo $set['description'] ?></p>
            <p>Set ID: <?php echo $set['id']?> </p>
            <p>Set Color: <?php echo $set['color']?></p>
            <!-- Edit Set Button -->
            <button type='button' class='btn btn-success' onclick="window.location='<?php echo site_url("flashcards/edit-set/".$set["id"]); ?>'">Edit</button>
            <!-- Delete Set Button -->
            <button type='button' class='btn btn-danger' onclick="window.location='<?php echo site_url("flashcards/delete-set/".$set["id"]); ?>'">Delete</button>
            </div>
            <br><br>
        <!-- Displaying all the flashcards in the set -->
        <div class="d-flex flex-wrap">
        <?php foreach ($flashcards_with_set as $card): ?>
            <?php if ($card['set_id'] == $set['id'] && $card['user_id'] == $_SESSION['sess_profile']['user_id']): ?>
                <div class="shwflshcrd m-4 p-3 text-truncate">
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
                    </div>
                <br><br>
            <?php endif; ?>
        <?php endforeach; ?>
                    </div>
    </div>
</div>
</div>