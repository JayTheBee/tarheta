<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
            <div class="card-header text-right"> Create Class </div>
                <form method="POST" autocomplete="off" action="<?=base_url('classes/create_classes')?>">
                    <div class="form-group">
                        <label>Class Name</label> 
                        <input type="text" placeholder="Enter classname (course, year, section)" name="class_name" value="<?php echo set_value('class_name'); ?>" class="form-control" id="class_name" aria-describedby="name"> 
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter description (optional)" name="description" value="<?php echo set_value('description'); ?>" class="form-control" id="description" > 
                        <label>Description </label> 
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="invite">
                        <label class="form-check-label" for="add">Allow Class to invite new members</label>
                    </div>
                    <div class="form-group">
                        <label>Enter School </label> 
                        <input type="text" placeholder="Enter school" name="school" value="<?php echo set_value('school'); ?>" class="form-control" id="school"> 
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Class</button>
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