<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <div class="card" style="margin-top: 5rem">
            <div class="card-header text-center">
                <!-- Where the question will be displayed -->
                <h5 id='question'></h5>

                <!-- Flash data -->
                <?php
                    if($this->session->flashdata('success')){?>
                        <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                <?php } ?>
                
                <?php
                    if($this->session->flashdata('error')){?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                <?php } ?>
            </div>
            
            <!-- Where the answers will be displayed -->
            <div class="card-body text-center">
                <form action="" method="POST" id="question-answer" class="form-group">
                    <div class="form-row" id="choices-container">
                        
                    </div>
                    <div class="form-group col-md-2" id='truefalse-container'>
                                        
                    </div>
                    <!-- 
                        Commented muna since ayaw ko pa muna ifigure out yung pag
                        handle pag back ng user sa previous answered questions
                        That's future ramon's problem
                    -->
                    <!-- <button type="button" id='previous'><-</button> -->
                    <button type="submit" id='next' value='<?php $_SESSION['Current_Number']?>'>-></button>
                </form>
            </div>
        </div>
    
    
    
</div>

<script type="text/javascript" language="javascript">
    let flashcard_data;
    let current_number = 0;
    // https://stackoverflow.com/questions/32732808/codeigniter-submit-form-data-without-page-refreshing-with-jquery-ajax
    // https://stackoverflow.com/questions/13406690/jquery-ajax-call-to-php-controller
    // https://www.w3schools.com/jquery/ajax_ajax.asp
    $(document).ready(function(){
        $('#question-answer').submit(function(e){
            console.log("helloworld");
            e.preventDefault();
            var answer = get_user_answer();
            $.ajax({
                type:"post",
                url:'<?php echo base_url();?>flashcards/submit-answer',
                data:
                {
                    answer:answer, 
                    user_id: <?php echo $_SESSION['Profile']['user_id']; ?>,
                    question_id: flashcard_data['questions'][current_number]['id'],
                    points: flashcard_data['questions'][current_number]['total_points'],
                },
                success:function(data)
                {
                    console.log(data);
                    if(data == 'true')
                        alert('CORRECT!!');
                    else
                        alert('SADNESS IN OUR HEARTS');
                    next_number();
                },
                error:function()
                {
                    alert('fail');
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
                $('#question').append(data['questions'][current_number]['question']);
                get_choices();
            }
        });
    });
    $

    // ------> MOVED to the 'next_number()' function since may conflict at natatawag ito before the submit function ng form -------
    // Function connected to the next button
    // $(document).on("click","#next",function(){
    //     if (current_number < flashcard_data['questions'].length-1){
    //         submit_answer();
    //         current_number += 1;
    //         document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
    //         document.getElementById("choices-container").innerHTML="";
    //         document.getElementById("truefalse-container").innerHTML="";
    //         get_choices();
    //     }
    // });


    // Function connected to the previous button
    $(document).on("click","#previous",function(){
        if (current_number > 0){
            current_number -= 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            document.getElementById("truefalse-container").innerHTML="";
            get_choices();
        }
    });

    // Setting up to display the next number in the flashcard
    function next_number(){
        if (current_number < flashcard_data['questions'].length-1){
            current_number += 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            document.getElementById("truefalse-container").innerHTML="";
            get_choices();
        }
        else{
            // Placeholder for the redirect to the results page
            // or maybe a button na view results then dun palang magreredirect?
            window.location.replace("<?php echo base_url();?>flashcards/index");
        }
    }

    // Retrieving the user input
    function get_user_answer(){
        console.log("Getting User Answer");
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
        console.log("Choices");
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
</script>