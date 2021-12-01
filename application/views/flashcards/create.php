<!-- ACCOUNT TYPE SELECTION PAGE -->
    
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        CREATE A FLASHCARD
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/create_flashcards')?>">

                            <div class="mb-2">
                                <label for="exampleInputUsername1" class="form-label">Name</label>
                                <input type="text" placeholder="Flashcard name" name="name" class="form-control" id="name" aria-describedby="name">
                                <?php echo form_error("name", '<p class="text-danger">','</p>');?> 
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputUsername1" class="form-label">Description</label>
                                <input type="text" placeholder="Flashcard description" name="description" class="form-control" id="description">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputState">Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="QUIZ">Quiz</option>
                                        <option value="REVIEWER">Reviewer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Visibility</label>
                                    <select id="visibility" name="visibility" class="form-control">
                                        <option value="PRIVATE">Private</option>
                                        <option value="PUBLIC">Public</option>
                                    </select>
                                </div>
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