<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 5rem">
            <div class="card-body">
                <!-- class id fetch -->

                <p>theres supposed to be a class info here</p>
                <p>Name: <?php echo $class['class_name']?> </p>
                <p>Description: <?php echo $class['description'] ?></p>
                <p>School: <?php echo $class['school'] ?></p>

                <p>assign flashcards</p>
                <div class="text-right">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AsgnModal">Assign Flashcards</button>
                </div>

                <div id="AsgnModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" autocomplete="off" action="<?=base_url('class/classes/assignFlashcards')?>">
                                 <input type="hidden" id='class-id' name='class-id' value='<?php echo $class['id']?>'>
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign Flashcards</h5>
                                </div>
                                <div class="modal-body">                        
                                    <label for="flashcard">Flashcards</label>
                                    <select id="flashcard" name="flashcard" class="form-control">
                                    <?php 
                                        foreach($createdFlashcards as $row){ 
                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>  
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>

                <p>invite members</p>
                <div class="text-right">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#InvModal">Invite</button>
                </div>
                <div id="InvModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" autocomplete="off" action="<?=base_url('class/classes/invite')?>">
                                <input type="hidden" id='class-name' name='class-name' value='<?php echo $class['class_name']?>'>
                                <input type="hidden" id='class-id' name='class-id' value='<?php echo $class['id']?>'>
                                <div class="modal-header">
                                    <h5 class="modal-title">INVITE USERS</h5>
                                </div>
                                <div class="modal-body">                        
                                    <div class="mb-3">
                                        <input type="text" placeholder="Enter Email" class="form-control" name="email">
                                    </div>                       
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>  
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>


                <p>CLASS FLASHCARDS</p>
                <?php if(empty($assignedFlashcards)): ?>
                    <p>No Flashcards Yet!</p>
                <?php else: ?>       
                    <?php foreach($assignedFlashcards as $flashcard): ?>
                        <h5><?php echo $flashcard['name']; ?></h5>
                        <h6>Description: <?php echo $flashcard['description']; ?></h6>
                        <p><?php echo $flashcard['visibility']; ?></p>
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$flashcard["id"]); ?>'" >View</button>
                        <br><br>
                    <?php endforeach; ?>
                <?php endif; ?>


                <p>CLASS MEMNBERS</p>
                <?php if(empty($classMembers)): ?>
                    <p>No Members Yet!</p>
                <?php else: ?>       
                    <?php foreach($classMembers as $member): ?>
                        <h5><?php echo $member['firstname'] ;
                                  echo " "; 
                                  echo $member['lastname'];?></h5>
                        <h6>Course: <?php echo $member['course']; ?></h6>

                        <br><br>
                    <?php endforeach; ?>
                <?php endif; ?>

                <p>rankings</p>

                
                    <?php
                        if($this->session->flashdata('success')){?>
                            <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                    <?php } ?>
                    
                    <?php
                    if($this->session->flashdata('error')){?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                    <?php } ?>
            </div>    
        </div>  
    </div>  
</div>             
 
