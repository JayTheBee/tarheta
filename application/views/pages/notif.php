
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
                        <?php if($row['context'] == 'class.invite'):?>
                            <p><?php echo $row['context'] ?> </p> 

                            <?php echo form_open("profile/read/".$row['id'])?>
                                <button class="btn btn-primary" type="submit">Read</button>
                            <?php echo form_close()?>
                           
                      <?php endif; ?>
                    <?php endforeach; ?>    
                <?php endif; ?>
                    

                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
