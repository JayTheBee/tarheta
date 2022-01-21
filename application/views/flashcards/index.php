<!-- Flashcards View PAGE -->
<div class="container">
    <div class="container my-6">
        <!-- PUBLIC AND PRIVATE NAVBAR -->
        <nav>
            <!-- https://www.youtube.com/watch?v=IMM93WydBSw -->
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-private-tab" data-bs-toggle="tab" data-bs-target="#nav-private" type="button" role="tab" aria-controls="nav-private" aria-selected="true">
                    Private
                </button>

                <button class="nav-link" id="nav-public-tab" data-bs-toggle="tab" data-bs-target="#nav-public" type="button" role="tab" aria-controls="nav-public" aria-selected="true">
                    Public
                </button>
            </div>
        </nav>

        <!-- Private and Public flashcard tab contents -->
        <div class="tab-content" id="nav-tabContent">
            <!-- PRIVATE TAB CONTENT -->
            <div class="tab-pane fade show active" id="nav-private" role="tabpanel" aria-labelledby="nav-private-tab">
                <?php foreach($flashcards as $flashcard): ?>
                    <?php if ($flashcard['visibility'] == 'PRIVATE'): ?>
                        <h5><?php echo $flashcard['name']; ?></h5>
                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                        <!-- <p><?php //echo $flashcard['visibility']; ?></p> -->
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
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- PUBLIC TAB CONTENT -->
            <div class="tab-pane fade" id="nav-public" role="tabpanel" aria-labelledby="nav-public-tab">
                <?php foreach($flashcards as $flashcard): ?>
                    <?php if ($flashcard['visibility'] == 'PUBLIC'): ?>
                        <h5><?php echo $flashcard['name']; ?></h5>
                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                        <!-- <p><?php //echo $flashcard['visibility']; ?></p> -->
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
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- SUBJECTS NAV BAR -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- Looping through all the retrieved categories -->
                <?php foreach ($categories as $key => $category): ?>
                    <!-- 
                        I used the category['id'] for the IDs and other idetifiers
                        because there is a problem if the name has a space in it 
                    -->
                    <button class="nav-link <?php echo ($key == 0) ? 'active':'';?>" id="nav-<?php echo $category['id']?>-category" data-bs-toggle="tab" data-bs-target="#nav-category-<?php echo $category['id'];?>" type="button" role="tab" aria-controls="nav-category-<?php echo $category['id'];?>" aria-selected="true">
                        <?php echo $category['name']; ?> 
                    </button>
                <?php endforeach; ?>
            </div>
        </nav>

        <!-- Flashcard tab contents via Subjects-->
        <div class="tab-content" id="nav-tabContent">

            <?php foreach ($categories as $key => $category): ?>
                <div class="tab-pane fade <?php echo ($key == 0) ? "show active":"";?>" id="nav-category-<?php echo $category['id'];?>" role="tabpanel"  aria-labelledby="nav-<?php echo $category['id']?>-category">
                    <?php echo $category['name']?>
                </div>
            <?php endforeach; ?>
            
        </div>

    </div>

    <div class="col-md-4"></div>
</div>