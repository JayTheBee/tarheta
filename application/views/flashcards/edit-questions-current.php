<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Lagay ko na ito dito pero sa login ko palang need para sa forgot pass modal popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- my css -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/create-nav.css"); ?>">
    <!-- Poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
    </style>
    <!-- autosize-input plugin -->
    <!-- <script src="https://rawgit.com/yuanqing/autosize-input/master/autosize-input.min.js"></script> -->
    <!-- Commented out returns error in browswer console -->

    <title>Sprint Demo</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <div width="1" class="create-nav design">
                <div width="0.525" class="nav design">
                    <span class="navbar-brand brand-des mb-0 h1">LOGO</span> <!-- will eventually change to picture -->
                    <button aria-label="Enter tarheta title..." class="nav-button" onclick="window.location='<?php echo site_url('flashcards/edit/flashcard/' . $flashcard['id']); ?>'">
                        <span class="text"><?php echo $flashcard['name'] ?></span>
                        <span class="settings-button mh-75 d-inline-block">
                            <span class="settings">Settings</span>
                        </span>
                    </button>
                </div>
                <div width="0.475" class="right-nav design">
                    <button type="button" id="topbar-preview-button" class="buttons preview">
                        <i class="fas fa-eye"></i>
                        <span>&nbsp;Preview</span>
                    </button>

                    <div class="line">
                        <div class="line-between">
                        </div>
                    </div>

                    <button type="button" class="buttons exit-button" data-functional-selector="top-bar__exit-button" onclick="window.location='<?php echo site_url('flashcards/show/' . $_SESSION['sess_current_flashcard']['flashcard_id']); ?>'">
                        Exit
                    </button>

                    <button type="approve" class="buttons save-button" data-functional-selector="top-bar__save-button" onclick="window.location='<?php echo site_url('flashcards/show/' . $_SESSION['sess_current_flashcard']['flashcard_id']); ?>'">>
                        Save
                    </button>
                </div>
            </div>


        </div>
    </nav>
    <!-- end of navbar -->

    <section id="create-a-flashcard">

        <div class="sidebar">
            <div id="sidebar-id" class="small-preview" data-rbd-droppable-id="droppable" data-rbd-droppable-context-id="1">
                <div tabindex="0" role="button" aria-describedby="rbd-hidden-text-1-hidden-text-3" data-rbd-drag-handle-draggable-id="tarheta-block-0" data-rbd-drag-handle-context-id="1" draggable="false">
                    <!-- eto dapat ma clone ng buo -->
                    <?php foreach ($questions as $key => $question) : ?>
                        <div role="button" id="tarheta-block-" class="small-preview-content">

                            <div role="button" id="slide">

                                <div class="title-name">
                                    <!-- <div class="slide-number" id="slide-num-1"></div> -->
                                    <div class="slide-indicator">Question</div>
                                </div>


                                <div class="create-flashcard-content">
                                    <div tabindex="0" class="preview-des">
                                        <div class="preview-content-des">
                                            <div aria-label="Quiz: Untitled" class="small-question"><?php echo $question['question'] ?></div>
                                            <div aria-hidden="true" class="image-timer">
                                                <div class="timer"><?php echo $question['time'] ?></div>
                                            </div>

                                            <div class="small-choices">
                                                <?php if ($question['question_type'] == 'CHOICE') :
                                                    foreach ($multi_choices as $multi_choice) :
                                                        if ($multi_choice['question_id'] == $question['id']) : ?>
                                                            <div class="choices-small-ver" required></div>
                                                            <div class="choices-small-ver"></div>
                                                            <div class="choices-small-ver"></div>
                                                            <div class="choices-small-ver"></div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php elseif ($question['question_type'] == 'TRUEFALSE') : ?>
                                                    <div class="choices-small-ver">True</div>
                                                    <div class="choices-small-ver">False</div>
                                                <?php elseif ($question['question_type'] == 'IDENTIFICATION') : ?>
                                                    <div class="choices-small-ver"><?php echo $question['answer'] ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="duplicate-delete">
                                        <!-- <span aria-expanded="false">
                                        <span aria-expanded="false">
                                            <button id="Duplicate" onclick="duplicate()" class="duplicate">
                                                <span class="duplicate-icon">
                                                    <i class="far fa-clone">
                                                    </i>
                                                </span>
                                            </button>
                                        </span>
                                    </span> -->
                                        <span aria-expanded="false">
                                            <span aria-expanded="false">
                                                <button type="button" data-question-id=<?php echo $question['id'] ?> data-bs-toggle="modal" data-bs-target="#deleteModal" class="duplicate pass-question-id">
                                                    <span class="duplicate-icon">
                                                        <i class="far fa-trash-alt"></i>
                                                    </span>
                                                </button>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <!-- END HERE -->
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Removed nilipat sa gitna ng page -->
                    <!-- <div class="add-button">
                        <div class="add-question">
                            <span aria-expanded="false">
                                <button onclick="add_question()" type="button" id="button-click" data-functional-selector="add-question-button" class="question-design">
                                    <span>Add question</span>
                                </button>
                            </span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        </div>

        <style>
            input[type='radio'] {
                transform: scale(1.5);
            }
        </style>

        <form method="POST" autocomplete="off" action="<?= base_url('flashcards/save_question') ?>">
            <main class="create-flashcard-body">
                <img src="<?php echo base_url("assets/images/create-flashcard/Vector 15.png"); ?>" class="position-absolute img-responsive wave" alt="...">

                <div class="body-design">
                    <main class="content">

                        <div class="question-box">
                            <div class="idk">
                                <div class="mb-3">
                                    <!-- maximum count of character = 64 -->
                                    <!-- additional feature dapat: countdown kung ilang chars pa natitira -->
                                    <input id="question" name="question" type="text" placeholder="Enter Question" aria-label="Question title. Click to change the title." onchange="myFunction()" class="form-control question-name align-placeholder" maxlength="64">

                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- MULTIPLE CHOICES INPUT BOXES  -->
                        <div class="choices-design" id="multiple-choice-question">
                            <div class="customize">
                                <div class="choices-box" style="width: 100%;">

                                    <div class="choiceA boxes">
                                        <div class="box-A">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">A.</p>
                                            </span>
                                        </div>
                                        <div class="answer">

                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" id="choice-answer-a" name="choice-answer-a" placeholder="A Option (required)" class="input-style" onchange="myFunction2()">

                                                </div>
                                            </span>
                                            <input checked="checked" type='radio' name='choice-answer' value='a' class="radio-des">
                                        </div>
                                    </div>
                                    <div class="choiceB boxes">
                                        <div class="box-B">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">B.</p>
                                            </span>
                                        </div>
                                        <div class="answer">

                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" id="choice-answer-b" name="choice-answer-b" placeholder="B Option (required)" class="input-style">

                                                </div>
                                            </span>
                                            <input type='radio' name='choice-answer' value='b' class="radio-des">
                                        </div>
                                    </div>
                                    <div class="choiceC boxes">
                                        <div class="box-C">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">C.</p>
                                            </span>
                                        </div>
                                        <div class="answer">

                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" id="choice-answer-c" name="choice-answer-c" placeholder="C Option (required)" class="input-style">
                                                </div>
                                            </span>
                                            <input type='radio' name='choice-answer' value='c' class="radio-des">
                                        </div>

                                    </div>
                                    <div class="choiceD boxes">
                                        <div class="box-D">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">D.</p>
                                            </span>
                                        </div>
                                        <div class="answer">

                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" id="choice-answer-d" name="choice-answer-d" placeholder="D Option (required)" class="input-style">
                                                </div>
                                            </span>
                                            <input type='radio' name='choice-answer' value='d' class="radio-des">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TRUE FALSE INPUT BOXES -->
                        <div class="TF-choices-design" style="display: none;" id="true-or-false-question">
                            <div class="customize">
                                <div class="TF-choices-box" style="width: 100%;">
                                    <div class="choiceA boxes">
                                        <div class="box-A">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">A.</p>
                                            </span>
                                        </div>
                                        <div class="answer">
                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" placeholder="TRUE" class="input-style" disabled="disabled">
                                                </div>
                                            </span>
                                            <input checked="checked" type='radio' name='truefalse-answer' value='TRUE' class="radio-des">
                                        </div>

                                    </div>
                                    <div class="choiceB boxes">
                                        <div class="box-B">
                                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                                <p class="text-ABCD">B.</p>
                                            </span>
                                        </div>
                                        <div class="answer">
                                            <span class="answer-here">
                                                <div class="answer-add-style">
                                                    <input type="text" placeholder="FALSE" class="input-style" disabled="disabled">

                                                </div>
                                            </span>
                                            <input type='radio' name='truefalse-answer' value='FALSE' class="radio-des">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- IDENFICATION INPUT BOXES -->
                        <div class="choices-design" style="display: none;" id="identification-question">
                            <div class="customize">
                                <div class="choices-box" style="width: 100%;">

                                    <input id="identification-answer" name="identification-answer" autocomplete="off" type="text" aria-label="Correct answer title. Click to change the title." class="form-control question-name align-placeholder" placeholder="Type the correct answer here..." maxlength="64">

                                </div>
                            </div>
                        </div>

                        <br>

                        <button type="submit" class="question-design">Add Question</button>

                    </main>

                    <aside class="button-open" id="right-sidebar">
                        <!-- clickable button to open and close right sidebar -->
                        <button type="button" aria-label="Right sidebar." id="hideAside" aria-expanded="true" tabindex="0" class="button-design button-style-2">

                            <span style="display: inline-block; vertical-align: middle; width: 20px; height: 20px;">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <!-- additional style to make icon pop out -->
                            <span class="additional-style">
                                <div>
                                    <span style="display: inline-block; vertical-align: middle; width: 20px; height: 20px;">
                                        <svg id="icon-premium-star" data-functional-selector="icon" viewBox="0 0 32 32" focusable="false" stroke="none" stroke-width="0">
                                            <path d="M16,5.4 18.9,12.6 26,12.6 19.8,17.8 23.2,25.5 16,20.7 8.8,25.5 12.2,17.8 6,12.6 13.1,12.6Z" style="fill: rgb(255, 255, 255);"></path>
                                        </svg>
                                    </span>
                                </div>
                            </span>
                        </button>

                        <div class="sidebar-content">
                            <!-- QUESTION TYPE -->
                            <div class="question-type-style">
                                <label class="title-style" id="type">
                                    <span style="display: inline-block; vertical-align: middle; width: 25px; height: 28px;">
                                        <i class="far fa-comments"></i>
                                    </span>
                                    <span class="quest-type">Question type</span>
                                    <div style="margin-top: 8px">
                                        <select class="boxes-styles" name="question-type" id="question-type" onchange="optionCheck()">
                                            <option selected="selected" value="CHOICE" class="dropdown-item text-center">Multiple Choice</option>
                                            <option value="TRUEFALSE" class="dropdown-item text-center">True or False</option>
                                            <option value="IDENTIFICATION" class="dropdown-item text-center">Identification</option>
                                        </select>
                                    </div>
                                </label>

                            </div>
                            <!-- END OF QUESTION TYPE -->
                            <hr class="line-break">

                            <!-- TIME LIMIT -->
                            <div class="time-limit-style">
                                <label class="title-style" id="time-limit">
                                    <span style="display: inline-block; vertical-align: middle; width: 25px; height: 28px;">
                                        <i class="fas fa-hourglass-start"></i>
                                    </span>
                                    <span class="quest-type">Time Limit</span>
                                    <div style="margin-top: 8px">
                                        <select class="boxes-styles form-control" id='time-show' name="time-show">
                                            <option class="dropdown-item text-center" value="5">5 seconds</option>
                                            <option class="dropdown-item text-center" value="10">10 seconds</option>
                                            <option class="dropdown-item text-center" value="20">20 seconds</option>
                                            <option selected="selected" class="dropdown-item text-center" value="30">30 seconds</option>
                                            <option class="dropdown-item text-center" value="60">1 minute</option>
                                            <option class="dropdown-item text-center" value="90">1 minute 30 seconds</option>
                                            <option class="dropdown-item text-center" value="120">2 minutes</option>
                                            <option class="dropdown-item text-center" value="180">3 minutes</option>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <!-- END OF TIME LIMIT -->

                            <hr class="line-break">

                            <!-- START OF POINTS SECTION -->
                            <div class="time-limit-style">
                                <label class="title-style" id="points">
                                    <span style="display: inline-block; vertical-align: middle; width: 25px; height: 28px;">
                                        <i class="fas fa-award"></i>
                                    </span>
                                    <span class="quest-type">Points</span>
                                    <div style="margin-top: 8px">
                                        <select class="boxes-styles" id="points-show" name="points-show">
                                            <option class="dropdown-item text-center" value="1">Standard</option>
                                            <option class="dropdown-item text-center" value="2">Double points</option>
                                            <option class="dropdown-item text-center" value="0">No points</option>
                                        </select>
                                        <div id="one-show" class="points-body">
                                            Award the correct answers with the normal amount of points.
                                        </div>
                                        <div id="two-show" class="points-body">
                                            Give twice as many points for correct answers.
                                        </div>
                                        <div id="three-show" class="points-body">
                                            Lower the stakes of the question and remove points.
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!-- END OF POINTS SECTION -->

                            <hr class="line-break">
                        </div>
                    </aside>
                </div>

                <!-- delete confirmation modal -->
                <div id="deleteModal" class="modal fade" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete question</h5>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <!-- <label class="form-label">Email</label>  -->
                                    <p>Are you sure you want to delete this question? This action can't be undone.</p>
                                </div>
                            </div>
                            <div class="modal-footer" data-functional-selector="dialog-actions">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button id="modal-delete-button" type="button" class="btn btn-primary del" onclick="">Delete</button>
                                <!-- onclick="Remove(this)" NOW WORKING CHECK: $(document).on("click", ".pass-question-id", function () -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </form>

        <!-- start of choose question modal -->
        <div id="myDiv" class="sc-kCqIgV iuuRjG" data-popper-reference-hidden="false" data-popper-escaped="true" data-popper-placement="right" style="width: 25rem; max-width: calc(100% - 14.75rem); padding-top: 4.5rem; position: absolute; inset: 0px auto auto 0px; transform: translate(216px, 0px); padding-bottom: 1rem;">
            <div tabindex="0" data-functional-selector="add-question-dialog" class="sc-jrUCRe fPSzwE">
                <div class="sc-lbnagl hCrMPS">
                    <div data-functional-selector="create-block-popup-menu" aria-label="Add question" role="dialog" aria-modal="true" class="sc-trqNE cvKrHj">
                        <div class="sc-kwWPDW bKKtKM">
                            <div class="sc-cVMLIT jtslMX">
                                <section class="sc-gTEgmx fpGZmQ">
                                    <h2 class="sc-kVThDm fFgEqg">Choose question type to add:</h2>
                                    <div class="sc-jhcxUd exKMRQ">
                                        <button data-functional-selector="create-button__quiz" aria-label="Quiz" class="sc-bktsjm gOvpUq">
                                            <div class="sc-igdLn eFuxbc">
                                                <img src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-color-vitaly-gorbachev/60/000000/external-quiz-online-learning-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png" alt="Quiz" class="sc-iVFPNg fyiKXj" />
                                            </div>
                                            <div class="sc-bDCewv kseOBZ">
                                                <h3 class="sc-hTsBph cTvoQZ">Quiz</h3>
                                            </div>
                                        </button>
                                        <button data-functional-selector="create-button__true-false" aria-label="True or false" class="sc-bktsjm gOvpUq">
                                            <div class="sc-igdLn eFuxbc">
                                                <img src="https://img.icons8.com/clouds/100/000000/question-mark.png" alt="True or false" class="sc-iVFPNg fyiKXj" />
                                            </div>
                                            <div class="sc-bDCewv kseOBZ">
                                                <h3 class="sc-hTsBph cTvoQZ">True or false</h3>
                                            </div>
                                        </button>
                                        <button data-functional-selector="create-button__open-ended" aria-label="Type answer" class="sc-bktsjm gOvpUq">
                                            <div class="sc-igdLn eFuxbc">
                                                <img src="https://img.icons8.com/clouds/100/000000/find-user-male.png" alt="Identification" class="sc-iVFPNg fyiKXj" />
                                            </div>
                                            <div class="sc-bDCewv kseOBZ">
                                                <h3 class="sc-hTsBph cTvoQZ">Type answer</h3>
                                            </div>
                                        </button>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="sc-hdvFCH bibWjt" style="position: absolute; transform: translate(0px, 218px); top: 0px;"></div>
                </div>
            </div>
        </div>
        <!-- end of choose question modal -->
    </section>

    <script>
        // document.getElementById('Duplicate').onclick = duplicate;

        // var i = 1;
        // var original = document.getElementById('slide');

        // function duplicate() {
        //     var clone = original.cloneNode(true); // "deep" clone
        //     clone.id = "slide" + ++i
        //     original.parentNode.appendChild(clone);
        // }

        // Passing data to modal - https://stackoverflow.com/questions/54530823/passing-data-id-from-button-to-bootstrap-modal/54531521
        $(document).on("click", ".pass-question-id", function() {
            var id_var = $(this).attr('data-question-id');
            // https://stackoverflow.com/questions/4506219/how-to-change-onclick-event-with-jquery/8188681
            $("#modal-delete-button").attr("onclick", "window.location='<?php echo site_url('flashcards/delete-question/') ?>" + id_var + "'");
        });

        // document.getElementById("Duplicate").onclick = function() {
        //     var container = document.getElementById("tarheta-block-0");
        //     var section = document.getElementById("slide");
        //     container.appendChild(section.cloneNode(true));
        // }

        // aayusin pa kase pag nag delete ka,, nadedelete sabay sabay yung clone 
        // dapat din pag confirmed yung delete sa question 1, di mabubura lahat ng slides.
        function Remove(obj) {
            $(obj).closest(".slide").removeChild();
            obj.preventDefault()

        }


        // to open sidebar
        $('#hideAside').click(function(e) {
            e.stopPropagation();
            $('#right-sidebar').toggleClass('button-open');
        });
        $('#right-sidebar').click(function(e) {
            e.stopPropagation();
        });
        $('body,html').click(function(e) {
            $('#right-sidebar').removeClass('button-open').addClass('button-close');
        });

        // to close sidebar
        $('#hideAside').click(function(e) {
            e.stopPropagation();
            $('#right-sidebar').toggleClass('button-close');
        });
        $('#right-sidebar').click(function(e) {
            e.stopPropagation();
        });
        $('body,html').click(function(e) {
            $('#right-sidebar').removeClass('button-close').addClass('button-open');
        });

        // points 
        document.getElementById('points-show').onchange = function() {
            for (var i = 0; i < document.getElementsByClassName('points-body').length; i++) {
                document.getElementsByClassName('points-body')[i].style.display = 'none';
            }
            document.getElementById(document.getElementById('points-show').value + '-show').style.display = 'block';
        }


        // // answer options
        // document.getElementById('answer-options-show').onchange = function() {
        //     for (var i = 0; i < document.getElementsByClassName('points-body-2').length; i++) {
        //         document.getElementsByClassName('points-body-2')[i].style.display = 'none';
        //     }
        //     document.getElementById(document.getElementById('answer-options-show').value + '-show').style.display = 'block';
        // }

        // navigate to different pages
        function handleSelect(elm) {
            window.location = elm.value;
        }

        // copy text
        function myFunction() {

            var x = document.getElementById("question-name-box");
            var div = document.getElementById('transfer');
            div.innerHTML = x.value;

        }

        // copy text
        function myFunction2() {
            var firstDivContent = document.getElementById('choice-answer-a');
            var secondDivContent = document.getElementById('small-A');
            secondDivContent.innerHTML = firstDivContent.innerHTML;
        }


        // // open choose question popup on button click
        // $('#button-click').click(function() {
        //     $('#myDiv').toggle('slow', function() {
        //         // Animation complete.
        //     });
        // });

        function optionCheck() {
            var option = document.getElementById("question-type").value;
            if (option == "TRUEFALSE") {
                document.getElementById("true-or-false-question").style.display = "flex";
                document.getElementById("multiple-choice-question").style.display = "none";
                document.getElementById("identification-question").style.display = "none";
            }
            if (option == "IDENTIFICATION") {
                document.getElementById("true-or-false-question").style.display = "none";
                document.getElementById("multiple-choice-question").style.display = "none";
                document.getElementById("identification-question").style.display = "flex";
            }
            if (option == "CHOICE") {
                document.getElementById("multiple-choice-question").style.display = "flex";
                document.getElementById("true-or-false-question").style.display = "none";
                document.getElementById("identification-question").style.display = "none";
            }

        }
    </script>

    <!-- < !--JavaScript Bundle with Popper-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>