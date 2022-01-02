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
                <div class="form-row">
                    <p id="choices-container">
                        <!-- <input type="text"> -->
                    </p>
                </div>
                <button id='previous'><-</button>
                <button id='next' value='<?php $_SESSION['Current_Number']?>'>-></button>
            </div>
        </div>
    
    
    
</div>

<script type="text/javascript" language="javascript">
    let flashcard_data;
    let current_number = 0;
    $(document).ready(function(){
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
    // Function connected to the next button
    $(document).on("click","#next",function(){
        if (current_number < flashcard_data['questions'].length-1){
            current_number += 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            get_choices();
        }

    });
    // Function connected to the previous button
    $(document).on("click","#previous",function(){
        if (current_number > 0){
            current_number -= 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            get_choices();
        }
    });
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
                $('#choices-container').append("[]" + flashcard_data['multi_choices'][i]['choiceA'] + "<br>");
                $('#choices-container').append("[]" + flashcard_data['multi_choices'][i]['choiceB'] + "<br>");
                $('#choices-container').append("[]" + flashcard_data['multi_choices'][i]['choiceC'] + "<br>");
                $('#choices-container').append("[]" + flashcard_data['multi_choices'][i]['choiceD'] + "<br>");
            }
        }
    };
    // Sets the identification input box
    function set_identification(){
        $('#choices-container').append("[______________]");
    }
    // Sets the true or false selection
    function set_truefalse(){
        $('#choices-container').append("[]TRUE []FALSE");
    }
</script>