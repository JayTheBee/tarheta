<!-- Create Set PAGE -->
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div>
            <div class="card" style="margin-top: 5rem">
            <div class="card-header text-right"> Flashcard Set </div>
                <form method="POST" autocomplete="off" action="<?php echo base_url('flashcards/update-set/'.$set_id)?>">
                    <div class="form-group">
                        <label>Name</label> 
                        <input type="text" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" class="form-control" id="name" aria-describedby="name"> 
                    </div>
                    <div class="form-group">
                        <label>Description </label> 
                        <input type="text" placeholder="Enter description (optional)" name="description" value="<?php echo set_value('description'); ?>" class="form-control" id="description" > 
                    </div>
                    <div class="form-group">
                        <label> Color </label> 
                        <input type="text" placeholder="Enter color" name="color" value="<?php echo set_value('color'); ?>" class="form-control" id="color"> 
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name='create_set'>Create Set</button>
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
        <div class="col-md-4"></div>
    </div>
</div>