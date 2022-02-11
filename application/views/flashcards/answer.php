<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/flashcard_style.css"); ?>">
<style>
    input[type='radio'] {
        transform: scale(1.5);
    }
</style>

<section class="flashcard-bg">
    <div class="container flashcardBg-design position-relative">
        <!-- QUESTION FIELD -->
        <div class="fcQuestion-box">
            <div class="fcQuestion-design">
                <span class="fcQuestion" id='question'>QUESTION</span>
            </div>
        </div>
        
        <!-- FLASHDATA -->
        <?php
            if($this->session->flashdata('success')):?>
                <p class="fcQuestion-design text-success"> <?=$this->session->flashdata('success')?> </p>
        <?php endif; ?>
        <?php
            if($this->session->flashdata('error')):?>
                <p class="fcQuestion-design text-danger"> <?=$this->session->flashdata('error')?> </p>
        <?php endif; ?>

    <?php if($flashcard['qtype']!='ASSIGNMENT'):?>
        <!-- TIMER DIV -->
        <div class="fcTimeMedia-pos fcTimeMedia-design">
            <!-- TIMER -->
            <div class="fcTimer-pos col-4" data-functional-selector="question-countdown">
                <div id="countdown" data-functional-selector="question-countdown__count" aria-live="polite" class="fcTimer"> </div>
            </div>
        </div>
    <?php endif; ?>

        <form action="" method="POST" id="question-answer" class="form-group">
            <!-- CHOICES DIV -->
            <div class="FcChoices-pos">
                <!-- IDENTIFICATION TEXT BOX CONTAINER DIV -->
                <div class="d-flex justify-content-center" id="identification-container">

                </div>

                <!-- TRUEFALSE CONTAINER -->
                <div class="fcChoice-row" id='truefalse-container'>
                    
                </div>

                <!-- MULTIPLE CHOICE CONTAINER -->
                <div id="choices-container">
                    
                </div>
            </div>
        <?php if($flashcard['qtype']=='ASSIGNMENT'):?>
            <!-- Prev Button -->
            <div class="d-flex flex-row-reverse">
                <button type="button" id='previous' class="buttons fcNext-button">
                <i class="fas fa-chevron-left"></i>Back 
                </button>
            </div>
        <?php endif;?>

            <!-- Next Button -->
            <div class="d-flex flex-row-reverse">
                <button type="submit" id="next" class="buttons fcNext-button">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </form>
    </div>
</section>


<script type="text/javascript" language="javascript">
    let flashcard_data;
    let current_number = 0;
    // let html_timer_var = document.querySelector('#time');
    let question_timer;
    // https://stackoverflow.com/questions/32732808/codeigniter-submit-form-data-without-page-refreshing-with-jquery-ajax
    // https://stackoverflow.com/questions/13406690/jquery-ajax-call-to-php-controller
    // https://www.w3schools.com/jquery/ajax_ajax.asp
    $(document).ready(function(){
        $('#question-answer').submit(function(e){
            e.preventDefault();
            var answer = get_user_answer();
            var controller_link = '<?php echo base_url();?>flashcards/submit-answer';
            $.ajax({
                type:"post",
                url: controller_link,
                data:
                {
                    answer:answer, 
                    user_id: <?php echo $_SESSION['sess_profile']['user_id']; ?>,
                    question_id: flashcard_data['questions'][current_number]['id'],
                    points: flashcard_data['questions'][current_number]['total_points'],
                    qtype: flashcard_data['flashcard']['qtype'],
                },
                success:function(data)
                {
                    /*
                        With regard to the pop quiz I think it is tedious when you prompt
                        the user for a confirmation when submitting their answer. I think
                        it is a unnecessary extra click. However, if it is really necessary
                        then i'll add it. 
                    */
                    if(flashcard_data['flashcard']['qtype']=='POP'){
                        if(data == 'true')
                            alert("ANSWER CORRECT");
                        else
                            alert("WRONG");
                    }
                    //console.log(data);

                    next_number();
                    
                },
                error:function(data)
                {
                    console.log(data);
                    alert('Something Went Wrong');
                }
            });
        });
        // https://stackoverflow.com/questions/6395720/get-data-from-php-array-via-ajax-and-jquery
        $.ajax({
            url : "<?php echo base_url();?>flashcards/get-data/<?php echo $flashcard['id']?>",
            type : "POST",
            dataType: 'json',
            success:function(data){
                flashcard_data = data;
                // console.log(flashcard_data);
                if(flashcard_data['flashcard']['qtype'] != 'ASSIGNMENT'){
                    var time_var = parseInt(flashcard_data['questions'][current_number]['time']);
                    start_timer(time_var);
                }
                
                // $('#question').append(data['questions'][current_number]['question']);
                $('.fcQuestion-design span').html(data['questions'][current_number]['question']);
                get_choices();
            }
        });
    });


    // Function connected to the previous button
    $(document).on("click","#previous",function(){
        if (current_number > 0){
            current_number -= 1;
            set_question();
        }
    });


    // Setting up to display the next number in the flashcard
    function next_number(){
        if (current_number < flashcard_data['questions'].length-1){
            current_number += 1;

            if(flashcard_data['flashcard']['qtype'] != 'ASSIGNMENT'){
                clearInterval(question_timer); //Clearing the current countdown
                var time_var = parseInt(flashcard_data['questions'][current_number]['time']);
                start_timer(time_var);
            }

            set_question();
        }
        else{
            if(flashcard_data['flashcard']['qtype'] != 'ASSIGNMENT' && flashcard_data['flashcard']['qtype'] != 'EXAM')
                window.location.replace('<?php echo base_url();?>flashcards/score-user/<?php echo $_SESSION['sess_profile']['user_id']?>/<?php echo $_SESSION['Current_Answering']['id']?>');
            else
                window.location.replace('<?php echo base_url();?>flashcards/show/<?php echo $_SESSION['Current_Answering']['id']?>');
        }
    }


    function set_question(){
        document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
        document.getElementById("identification-container").innerHTML="";
        document.getElementById("choices-container").innerHTML="";
        document.getElementById("truefalse-container").innerHTML="";

        get_choices();
    }


    // Retrieving the user input
    function get_user_answer(){
        if(flashcard_data['questions'][current_number]['question_type'] == "CHOICE"){
            var radios = document.getElementsByTagName('input');
            var value;
            // Looping through the multiple choices and finding which is selected
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].type === 'radio' && radios[i].checked) {
                    value = radios[i].value;
                    var id = 'choice-answer-' + value;
                    return (document.getElementById(id).textContent);
                }
            }
        }
        else if(flashcard_data['questions'][current_number]['question_type'] == "IDENTIFICATION"){
            // Getting the value that the user entered via element id
            return ($("#identification-answer").val());
        }
        else if(flashcard_data['questions'][current_number]['question_type'] == "TRUEFALSE"){
            var radios = document.getElementsByTagName('input');
            // Looping through the true or false radios and finding which is selected
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].type === 'radio' && radios[i].checked)
                    return (radios[i].value);
            }
        }
    };
    

    // Handles checking what is the question's type
    function get_choices(){
        switch(flashcard_data['questions'][current_number]['question_type']){
            case "CHOICE":
                set_multi(flashcard_data['questions'][current_number]['choice_id']);
                break;
            case "IDENTIFICATION":
                set_identification();
                break;
            case "TRUEFALSE":
                set_truefalse();
                break;
        }
    };


    // Gets the multiple choices answer and displays it
    function set_multi(choice_id){
        for (var i = 0; i < flashcard_data['multi_choices'].length; i++){
            if (flashcard_data['multi_choices'][i]['id'] == choice_id){
                var input_body = "";
                // Setting up Choice A
                input_body += "<div class='fcChoice-row'>";
                input_body += "<div class='fcChoice boxes' data-functional-selector='answer-0' data-mapped-index='0' dir='ltr'>";
                input_body += "<div class='fcBox fcBoxA-color'>";
                input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>A.</p></span>";
                input_body += "</div>";
                input_body += "<span data-functional-selector='question-choice-text-0' class='fcText-answers'><span id='choice-answer-a'>" + flashcard_data['multi_choices'][i]['choiceA'] + "</span></span>";
                input_body += "<input type='radio' name='choice-answer' value='a' class='radio-des'>";
                input_body += "</div>";

                // Setting up Choice B
                input_body += "<div class='fcChoice boxes' data-functional-selector='answer-1' data-mapped-index='1' dir='ltr'>";
                input_body += "<div class='fcBox fcBoxB-color'>";
                input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>B.</p></span>";
                input_body += "</div>";
                input_body += "<span data-functional-selector='question-choice-text-1' class='fcText-answers'><span id='choice-answer-b'>" + flashcard_data['multi_choices'][i]['choiceB'] + "</span></span>";
                input_body += "<input type='radio' name='choice-answer' value='b' class='radio-des'>";
                input_body += "</div>";
                input_body += "</div>";

                // Setting up Choice C
                input_body += "<div class='fcChoice-row'>";
                input_body += "<div class='fcChoice boxes' data-functional-selector='answer-2' data-mapped-index='2' dir='ltr'>";
                input_body += "<div class='fcBox fcBoxC-color'>";
                input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>C.</p></span>";
                input_body += "</div>";
                input_body += "<span data-functional-selector='question-choice-text-2' class='fcText-answers'><span id='choice-answer-c'>" + flashcard_data['multi_choices'][i]['choiceC'] + "</span></span>";
                input_body += "<input type='radio' name='choice-answer' value='c' class='radio-des'>";
                input_body += "</div>";

                // Setting up Choice B
                input_body += "<div class='fcChoice boxes' data-functional-selector='answer-3' data-mapped-index='3' dir='ltr'>";
                input_body += "<div class='fcBox fcBoxD-color'>";
                input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>D.</p></span>";
                input_body += "</div>";
                input_body += "<span data-functional-selector='question-choice-text-3' class='fcText-answers'><span id='choice-answer-d'>" + flashcard_data['multi_choices'][i]['choiceD'] + "</span></span>";
                input_body += "<input type='radio' name='choice-answer' value='d' class='radio-des'>";
                input_body += "</div>";
                input_body += "</div>";

                $("#choices-container").html(input_body);
            }
        }
    };


    // Sets the identification input box
    function set_identification(){
        var input_body = "";
        input_body += "<textarea class='md-input inputDes' name='identification-answer' id='identification-answer' cols='30' placeholder='Enter answer here...'></textarea>"
        $("#identification-container").html(input_body);
    };


    // Sets the true or false selection
    function set_truefalse(){
        var input_body = "";
        input_body += "<div class='fcChoice boxes' data-functional-selector='answer-0' data-mapped-index='0' dir='ltr'>";
        input_body += "<div class='fcBox fcBoxA-color'>";
        input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>A.</p></span>";
        input_body += "</div>";
        input_body += "<span data-functional-selector='question-choice-text-0' class='fcText-answers'><span>True</span></span>";
        input_body += "<input type='radio' id='truefalse-answer' name='truefalse-answer' value='TRUE' class='radio-des'>";
        input_body += "</div>";

        input_body += "<div class='fcChoice boxes' data-functional-selector='answer-1' data-mapped-index='1' dir='ltr'>";
        input_body += "<div class='fcBox fcBoxB-color'>";
        input_body += "<span class='style' style='display: inline-block; vertical-align: middle;'><p class='text-ABCD'>B.</p></span>";
        input_body += "</div>";
        input_body += "<span data-functional-selector='question-choice-text-1' class='fcText-answers'><span>False</span></span>";
        input_body += "<input type='radio' id='truefalse-answer' name='truefalse-answer' value='FALSE' class='radio-des'>";
        input_body += "</div>";



        input_body += "</select>";
        input_body += "</select>";
        $("#truefalse-container").html(input_body);
    };

    // Timer Function https://stackoverflow.com/questions/20618355/how-to-write-a-countdown-timer-in-javascript
    // May halong: https://stackoverflow.com/questions/31106189/create-a-simple-10-second-countdown
    function start_timer(duration) {
        var timer = duration;
        question_timer = setInterval(function () {
            document.getElementById("countdown").innerHTML = timer + " s";

            if(--timer < -1){
                clearInterval(question_timer);
                alert('No Time');
                document.getElementById("countdown").innerHTML = "";
                document.getElementById("next").click();
            }
 
        }, 1000);
    }
</script>