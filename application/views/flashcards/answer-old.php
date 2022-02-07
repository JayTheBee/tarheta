<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
<div class="container">
    <div class="card" style="margin-top: 5rem">
            <body>
                <h5>Time Remaining: <span id="time">00:00</span></h5>
            </body>
            <div class="card-header text-center">
                <!-- Where the question will be displayed -->
                <h5 id='question'></h5>

                <!-- Flash data -->
                <?php
                    if($this->session->flashdata('success')):?>
                        <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                <?php endif; ?>
                
                <?php
                    if($this->session->flashdata('error')):?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                <?php endif; ?>
            </div>
            
            <!-- Where the answers will be displayed -->
            <div class="card-body text-center">
                <form action="" method="POST" id="question-answer" class="form-group">
                    <!-- Container ng Multiple choices and Identification input -->
                    <div class="form-row" id="choices-container">
                        
                    </div>

                    <!-- Container ng True or False choices -->
                    <div class="form-group col-md-2" id='truefalse-container'>
                                        
                    </div>

                    <?php if($flashcard['qtype']=='ASSIGNMENT'):?>
                        <button type="button" id='previous'><-</button>
                    <?php endif; ?>
                    <button type="submit" id='next' value='<?php $_SESSION['Current_Number']?>'>-></button>
                </form>
            </div>
        </div>
</div>


<script type="text/javascript" language="javascript">
    let flashcard_data;
    let current_number = 0;
    let html_timer_var = document.querySelector('#time');
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
                console.log(flashcard_data);
                
                var time_var = parseInt(flashcard_data['questions'][current_number]['time']);
                start_timer(time_var, html_timer_var);
                
                $('#question').append(data['questions'][current_number]['question']);
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

            clearInterval(question_timer); //Clearing the current countdown
            var time_var = parseInt(flashcard_data['questions'][current_number]['time']);
            start_timer(time_var, html_timer_var);

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
            // Getting the value that the user selected via element id
            return ($("#truefalse-answer").val());
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
                input_body += "<div class='mb-2'>";
                input_body += "<input type='radio' name='choice-answer' value='a'>";
                input_body += "<label id='choice-answer-a' for='exampleQuestion1' class='form-label'>" + flashcard_data['multi_choices'][i]['choiceA'] + "</label>";
                input_body += "</div>";

                input_body += "<div class='mb-2'>";
                input_body += "<input type='radio' name='choice-answer' value='b'>";
                input_body += "<label id='choice-answer-b' for='exampleQuestion1' class='form-label'>" + flashcard_data['multi_choices'][i]['choiceB'] + "</label>";
                input_body += "</div>";

                input_body += "<div class='mb-2'>";
                input_body += "<input type='radio' name='choice-answer' value='c'>";
                input_body += "<label id='choice-answer-c' for='exampleQuestion1' class='form-label'>" + flashcard_data['multi_choices'][i]['choiceC'] + "</label>";
                input_body += "</div>";

                input_body += "<div class='mb-2'>";
                input_body += "<input type='radio' name='choice-answer' value='d'>";
                input_body += "<label id='choice-answer-d' for='exampleQuestion1' class='form-label'>" + flashcard_data['multi_choices'][i]['choiceD'] + "</label>";
                input_body += "</div>";

                $("#choices-container").html(input_body);
            }
        }
    };


    // Sets the identification input box
    function set_identification(){
        var input_body = "";
        input_body += "<input type='text' placeholder='Enter Answer' name='identification-answer' class='form-control' id='identification-answer' aria-describedby='name'>"
        $("#choices-container").html(input_body);
    };


    // Sets the true or false selection
    function set_truefalse(){
        var input_body = "";
        input_body += "<select id='truefalse-answer' name='truefalse-answer' class='form-control'>";
        input_body += "<option value='TRUE'>True</option>";
        input_body += "<option value='FALSE'>False</option>";
        input_body += "</select>";
        $("#truefalse-container").html(input_body);
    };

    // Timer Function https://stackoverflow.com/questions/20618355/how-to-write-a-countdown-timer-in-javascript
    // May halong: https://stackoverflow.com/questions/31106189/create-a-simple-10-second-countdown
    function start_timer(duration, display) {
        var timer = duration, minutes, seconds;
        question_timer = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(question_timer);
                document.getElementById("next").click();
            }
        }, 1000);
    }
</script>