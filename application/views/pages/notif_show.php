
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Notifications  </div>

                <div class="card-body">
                    <p><?php echo $notifs->text ?> </p> 
                    <?php if($notifs['response']==NULL): ?>
                        <?php echo form_open("class/classes/enroll_user/".$_SESSION['sess_profile']['id'] ."/" .$notifs->class_id)?>
                            <button class="btn btn-primary" type="submit">wanna join?</button>
                        <?php echo form_close()?>
                        <?php echo form_open("class/classes/enroll_user/".$_SESSION['sess_profile']['id'] ."/" .$notifs->class_id)?>
                            <button class="btn btn-primary" type="submit">decline?</button>
                        <?php echo form_close()?>
 
                    <?php elseif($notifs['response']=='YES'): ?>
                        <?php echo form_open("classes/show/".$notifs->class_id)?>
                            <button class="btn btn-primary" type="submit">View class</button>
                        </form>
                    <?php else: ?>    
                        <p>You did not join this class!</p>
                        <?php echo form_open(base_url("notifs"))?>
                            <button class="btn btn-primary" type="submit">View class</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
