<head>
<style>
    .custom-bg-create {
        background-color: #E4BE91;
        overflow-x: hidden;
        background-image: url("<?php echo base_url('assets/images/contact/contact-wave.png'); ?>");
        width: 100%;
        height: 100%;
        background-size:cover;
        font-family: "Poppins";
    }

    .class-container {
        margin-top: 1rem;
    }

    .class-header{
        background-color: 175561;
        font-family: "Poppins";
        color: #fff;
        margin: 1rem 0 1rem 0;
    }

    .class-header .icon{
        display: flex;
        margin: 0 10px 0 10px; 
    }
    .class-header .icon i{
        margin: auto;
        font-size: 2em;
    }
    .class-header .icon p{
        font-weight: 600;
        color: #fff;
        margin: auto;
        padding-left: 10px; 
        font-size: 2em;
        font-family: "Poppins";
        word-wrap: break-word;  width: 50rem;
        
    }   


    .clssttle{
        display:flex;
        justify-content: space-between;
    }

    .clssttle button {
        color: #000;
        margin-right: 10px;
        background-color: #EFD8B3;
        width: 12rem;
        height: 3rem;
        font-weight: 500;
        border-radius: 20px;
        border: none;
        box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
    }
    .dscptn {
        margin-top: 1rem;
    }
    .dscptn p {
        color: #000;
        padding-left: 10px;
        margin-bottom: 0;
        font-size: 1.2em;
        word-wrap: break-word;
    }

    .dscptn .f{
        font-weight: 500;
    }

    .class-tab {
        margin: 0;
        padding: 0;
        border-bottom: none !important;
    }

    .class-tabs .nav-link:focus{
        color: #fff;
        background-color: #175561 !important;
    }

    .class-tabs .nav-link{
        color: #fff;
        background-color: #A2795E;
    }

     .shwflscrd {
        background-color: rgb(82 138 112 / 90%);
        border-radius: 10px;
        margin: 10px 5px 10px 5px;
        padding: 10px;
        color: #fff;
        width: 20rem;
        margin-right: 30px;
        }


</style>
</head>


<div class="custom-bg-create">

<div class="container-fluid class-container vh-100 w-100">
                <!-- class id fetch -->

                <div class="card-header class-header">
                    <div class="clssttle">
                        <div class="icon"> <i class="fas fa-users "></i> <p><?php echo $class['class_name']?></p></div>
                    
                            <div class="btns d-flex mx-4">
                                <div class="text-right">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AsgnModal">Assign Flashcards</button>
                                </div>
                                <?php if($class['invitations'] == 'YES'): ?>
                                <div class="text-right">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#InvModal">Invite</button>
                                </div>
                                <?php else: ?>
                                    <?php if($_SESSION['sess_user_type']['type'] == 'TEACHER'): ?>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#InvModal">Invite</button>
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                    </div>
                   
                        <div class="dscptn">
                            <p><p class="f">Description:<p><?php echo $class['description'] ?></p>
                            <p class="f">School: <?php echo $class['school'] ?></p>
                            <p class="f">Invite Code: <?php echo $class['invite_code'] ?></p>   
                        </div>
                        
                        <nav class="class-tabs">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-flashcard-class" data-bs-toggle="tab" data-bs-target="#nav-flashcard" type="button" role="tab" aria-controls="nav-flashcard" aria-selected="true">
                                Flashcard
                            </button>

                            <button class="nav-link" id="nav-members-class" data-bs-toggle="tab" data-bs-target="#nav-members" type="button" role="tab" aria-controls="nav-members" aria-selected="true">
                                Members
                            </button>
                            </div>
                        </nav>
                </div>
                
           
            <!-- Flashcard and Members tab contents -->   
            <div class="tab-content" id="nav-tabContent">
                <!-- flashcard tab -->
                <div class="tab-pane fade show active" id="nav-flashcard" role="tabpanel" aria-labelledby="nav-flashcard-class">
                    <div class="container-fluid overflow-scroll">
                        <div class="row flex-row flex-nowrap">
                                <div class="container">
                                        <div>
                                            <h5>CLASS FLASHCARDS</h5>
                                            <?php if(empty($assignedFlashcards)): ?>
                                                <h6>No Flashcards Yet!</h6>
                                                <?php else: ?> 
                                                <div style="display:flex;" class="flex-wrap  justify-content-center">      
                                                <?php foreach($assignedFlashcards as $flashcard): ?>
                                                <div class="shwflscrd text-truncate" >
                                                    <h5><?php echo $flashcard['name']; ?></h5>
                                                    <h6>Description: <?php echo $flashcard['description']; ?></h6>
                                                    <p><?php echo $flashcard['visibility']; ?></p>
                                                    <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("flashcards/show/".$flashcard["id"]); ?>'" >View</button>
                                                    <br><br>
                                                </div>
                                                <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>

                                                
            
            <!-- Class Members Tab -->
            <div class="tab-pane fade" id="nav-members" role="tabpanel" aria-labelledby="nav-members-class">
                <div class="container-fluid overflow-scroll">
                        <div class="row flex-row flex-nowrap">
                            <div>
                                    <div class="card-body">
                                        <h5>CLASS MEMBERS</h5>
                                        <?php if(empty($classMembers)): ?>
                                            <p>No Members Yet!</p>
                                        <?php else: ?>       
                                            <?php foreach($classMembers as $member): ?>
                                                <h5><?php echo 'Name:'.$member['firstname'];
                                                        echo " "; 
                                                        echo $member['lastname'];
                                                        echo $member['course']; ?></h5>

                                                    <br><br>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
            
            <!--          
                <section id="Class-Flashcard">
                    <div class="card-body">
                    <h5>CLASS FLASHCARDS</h5>
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
                    </div>
                </section>  

                <section class="Class-Members">
                    <div class="card-body">
                    <h5>CLASS MEMBERS</h5>
                    <?php if(empty($classMembers)): ?>
                        <p>No Members Yet!</p>
                    <?php else: ?>       
                        <?php foreach($classMembers as $member): ?>
                            <h5><?php echo $member['firstname'] ;
                                    echo " "; 
                                    echo $member['lastname'];
                                    echo $member['course']; ?></h5>

                            <br><br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </section> -->
</div>             
</div>

<div id="AsgnModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" autocomplete="off" action="<?=base_url('class/classes/assign_flashcards')?>">
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

<div class="modal" tabindex="-1" id="notifModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <?php
        if ($this->session->flashdata('success')) { ?>
            <p class="text-success" style="margin-top:2rem"> <?= $this->session->flashdata('success') ?> </p>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#notifModal').modal('show');
                });
            </script>
        <?php } ?>

        <?php
        if ($this->session->flashdata('error')) { ?>
            <p class="text-danger" style="margin-top:2rem"> <?= $this->session->flashdata('error') ?> </p>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#notifModal').modal('show');
                });
            </script>
        <?php } ?>
      </div>
    </div>
  </div>
</div>