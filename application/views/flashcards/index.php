<head>
    <style>
        .bg-blue {
            background-color: #e4be91;
        }

        .flash-size {
            position: absolute;
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>


<!-- Flashcards View PAGE -->
<!-- <img src="<?php echo base_url("assets/images/dashboard/bg.png"); ?>" class="position-absolute flash-size" alt="..."> -->

<div class="bg-blue">

    <div class="container">
        <div class="container my-6">

            <!-- Check if there are no sets created by the user -->
            <?php if ($sets != FALSE) : ?>
                <br>
                <h3>BROWSE BY SET</h3>
                <!-- SETS NAV BAR -->
                <div class="container-fluid overflow-scroll">
                    <div class="row flex-row flex-nowrap">
                        <?php foreach ($sets as $key => $set) : ?>
                            <div class="col-3">
                                <h6>-----------------------</h6>
                                <h5>Set Name: <?php echo $set['name'] ?></h5>
                                <h6>Set Description: <?php echo $set['description'] ?></h6>
                                <h6>Set Color: <?php echo $set['color'] ?></h6>
                                <button type='button' class='btn btn-primary' onclick="window.location='<?php echo site_url("flashcards/show-set/" . $set["id"]); ?>'">View</button>
                                <h6>-----------------------</h6>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <br><br>
            <h3>BROWSE BY SUBJECT</h3>
            <!-- SUBJECTS NAV BAR -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <!-- Looping through all the retrieved categories -->
                    <?php foreach ($categories as $key => $category) : ?>
                        <!-- 
                        I used the category['id'] for the IDs and other idetifiers
                        because there is a problem if the name has a space in it 
                    -->
                        <button class="nav-link <?php echo ($key == 0) ? 'active' : ''; ?>" id="nav-<?php echo $category['id'] ?>-category" data-bs-toggle="tab" data-bs-target="#nav-category-<?php echo $category['id']; ?>" type="button" role="tab" aria-controls="nav-category-<?php echo $category['id']; ?>" aria-selected="true">
                            <?php echo $category['name']; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </nav>

            <!-- SUBJECTS TAB CONTENTS -->
            <div class="tab-content" id="nav-tabContent">

                <?php foreach ($categories as $key => $category) : ?>
                    <div class="tab-pane fade <?php echo ($key == 0) ? "show active" : ""; ?>" id="nav-category-<?php echo $category['id']; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $category['id'] ?>-category">
                        <div class="container-fluid overflow-scroll">
                            <div class="row flex-row flex-nowrap">
                                <!-- Just reused an old variable found in the flashcard controller in the checkpage function  -->
                                <!-- Slow way. Nice to have a better way xD -->
                                <?php foreach ($category_list as $cat) : ?>
                                    <?php if ($cat['name'] == $category['name']) : ?>
                                        <?php foreach ($flashcards as $flashcard) : ?>
                                            <?php if ($flashcard['id'] == $cat['flashcard_id']) : ?>
                                                <div class="col-4">
                                                    <h6>-----------------------</h6>
                                                    <h5><?php echo $flashcard['name']; ?></h5>
                                                    <h6>Description: <?php echo $flashcard['description']; ?></h6>
                                                    <p><?php echo $flashcard['visibility']; ?></p>
                                                    <p><?php echo $flashcard['qtype']; ?></p>
                                                    <p>
                                                        <?php if ($flashcard['type'] == "REVIEWER") :
                                                            echo $flashcard['type'];
                                                        ?>
                                                        <?php endif; ?>
                                                    </p>
                                                    <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/" . $flashcard["id"]); ?>'">View
                                                    </button>
                                                    <h6>-----------------------</h6>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <br><br>
            <h3>BROWSE BY VISIBILITY</h3>
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
                    <div class="container-fluid overflow-scroll">
                        <div class="row flex-row flex-nowrap">
                            <?php foreach ($flashcards as $flashcard) : ?>
                                <?php if ($flashcard['visibility'] == 'PRIVATE') : ?>
                                    <div class="col-4">
                                        <h6>-----------------------</h6>
                                        <h5><?php echo $flashcard['name']; ?></h5>
                                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                                        <!-- <p><?php //echo $flashcard['visibility']; 
                                                ?></p> -->
                                        <p><?php echo $flashcard['qtype']; ?></p>
                                        <p>
                                            <?php if ($flashcard['type'] == "REVIEWER") :
                                                echo $flashcard['type'];
                                            ?>
                                            <?php endif; ?>
                                        </p>
                                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/" . $flashcard["id"]); ?>'">View
                                        </button>
                                        <h6>-----------------------</h6>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- PUBLIC TAB CONTENT -->
                <div class="tab-pane fade" id="nav-public" role="tabpanel" aria-labelledby="nav-public-tab">
                    <div class="container-fluid overflow-scroll">
                        <div class="row flex-row flex-nowrap">
                            <?php foreach ($flashcards as $flashcard) : ?>
                                <?php if ($flashcard['visibility'] == 'PUBLIC') : ?>
                                    <div class="col-4">
                                        <h6>-----------------------</h6>
                                        <h5><?php echo $flashcard['name']; ?></h5>
                                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                                        <!-- <p><?php //echo $flashcard['visibility']; 
                                                ?></p> -->
                                        <p><?php echo $flashcard['qtype']; ?></p>
                                        <p>
                                            <?php if ($flashcard['type'] == "REVIEWER") :
                                                echo $flashcard['type'];
                                            ?>
                                            <?php endif; ?>
                                        </p>
                                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/" . $flashcard["id"]); ?>'">View
                                        </button>
                                        <h6>-----------------------</h6>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4"></div>
    </div>