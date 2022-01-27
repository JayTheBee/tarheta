
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
                            case 'class.invite': ?>
                                <p>You have been invited to a class!</p> 
                                <?php echo form_open("user/profile/read/".$row['id']."/".$row['active']."/".$row['context'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>    
                            <?php break; ?>
                            <?case '':?>
                            <?php break; ?>
                            <?php default: ?>
                                <p>test</p>
                            <?php break; ?>
                        <?php endswitch; ?>     
                    <?php endforeach; ?>    
                <?php endif; ?>
                    

                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
