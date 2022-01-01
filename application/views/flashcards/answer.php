<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <p id='question'></p>
    <p id="choices-container">
        <!-- <input type="text"> -->
    </p>
    
    <button id='previous'>Previous</button>
    <button id='next' value='<?php $_SESSION['Current_Number']?>'>Next</button>
    
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
    $(document).on("click","#next",function(){
        if (current_number < flashcard_data['questions'].length-1){
            current_number += 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            get_choices();
        }

    });
    $(document).on("click","#previous",function(){
        if (current_number > 0){
            current_number -= 1;
            document.getElementById("question").innerHTML=flashcard_data['questions'][current_number]['question'];
            document.getElementById("choices-container").innerHTML="";
            get_choices();
        }
    });
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
    function set_identification(){
        $('#choices-container').append("[______________]");
    }
    function set_truefalse(){
        $('#choices-container').append("[]TRUE []FALSE");
    }
</script>