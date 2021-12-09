<!-- ACCOUNT TYPE SELECTION PAGE -->

<script type="text/javascript" language = "javascript">
    document.getElementById('#question-type').addEventListener("change", function() {
        if(this.value == "CHOICE"){
            console.log(this.value);
            document.getElementById("multiple-choice").style.display="none";
            
        /*Execute your script */
        }
        else if(this.value == "IDENTIFICATION"){
            console.log(this.value);
            document.getElementById("multiple-choice").style.display="none";
        }
        else if(this.value == "TRUEFALSE"){
            console.log(this.value);
            $('#multiple-choice').removeClass('d-none');
            // $("#multiple-choice").toggleClass('d-none');
        }
    });
</script>
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        CREATE QUESTIONS
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/add_question')?>">

                            <div class="mb-2">
                                <label for="exampleInputUsername1" class="form-label">Question</label>
                                <input type="text" placeholder="Flashcard name" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <!-- Pwede daw na wag muna JS rekta controller then load new php file sa view -->
                                    <label for="inputState">Type</label>
                                    <select id="question-type" name="type" class="form-control">
                                        <option value="CHOICE">Multiple Choice</option>
                                        <option value="IDENTIFICATION">Identification</option>
                                        <option value="TRUEFALSE">True/False</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 d-none" id='multiple-choice' >
                                <label for="exampleInputUsername1" class="form-label">Chioces</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                            

                            <?php
                                if($this->session->flashdata('success')){?>
                                    <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                            <?php } ?>
                            
                            <?php
                            if($this->session->flashdata('error')){?>
                                <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                            <?php } ?>

                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>