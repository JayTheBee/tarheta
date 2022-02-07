
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Notifications  </div>

                <div class="card-body">

                <?php if(empty($notifications)): ?>
                    <p>No notifications yet!</p>
                <?php else: ?>
                    <?php foreach($notifications as $row): ?>
                        <?php if($row['active']==1): ?>
                            <h2>Unread</h2>
                        <?php else: ?>
                             <h2>read</h2>
                        <?php endif; ?>
                        <?php switch($row['context']): 
                            case "class.invite": ?>
                                <p>You have been invited to a class!</p> 
                                <button type="button" class="btn btn-success" onclick="window.location='<?php echo base_url("user/profile/read/".$row['id']."/".$row['active']."/".$row['context'])?>'">Read</button>
                                <?php echo form_open("user/profile/read/".$row['id']."/".$row['active']."/".$row['context'])?>
                                    <button class="btn btn-primary" type="submit">Read2</button>
                                <?php echo form_close()?>    
                            <?php break; ?>
                            <?php case "user.verify":?>
                                <p>Your account has been verified!</p> 
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                            <?php break; ?>
                            <?php case "password.reset":?>
                                <p>Your password has been reset</p>
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                            <?php break; ?>
                            <?case "flashcard.class":?>
                                <p>Your class has been assigned a flashcard</p>
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                            <?php break; ?>
                            <?case "flashcard.user":?>
                                <p>Your have been assigned a flashcard</p>
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                            <?php break; ?>
                            <?case "flashcard.reopen":?>
                                <p>A flashcard has been reopened</p>
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                            <?php break; ?>
                            <?php default: ?>
                                <?php print_r($row)?>
                                <p>Notification error!</p>
                        <?php endswitch; ?>     
                    <?php endforeach; ?>    
                <?php endif; ?>
    
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
