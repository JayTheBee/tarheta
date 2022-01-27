
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Notifications  </div>


                <div class="card-body">
                    <p><?php echo $notifs->text ?> </p> 
                    <?php if($notifs->response==NULL): ?>
                        <?php echo form_open("user/profile/check_notif/".$context."/".'ACCEPT'."/".$_SESSION['sess_profile']['user_id']."/".$notifs->class_id."/".$notifs->id)?>
                            <button class="btn btn-primary" type="submit">wanna join?</button>
                        <?php echo form_close()?>

                        <?php echo form_open("user/profile/check_notif/".$context."/".'DECLINE'."/".$_SESSION['sess_profile']['user_id']."/".$notifs->class_id."/".$notifs->id)?>
                            <button class="btn btn-primary" type="submit">decline?</button>
                        <?php echo form_close()?>

                    <?php elseif($notifs->response=='ACCEPT'): ?>
                        <?php echo form_open("classes/show/".$notifs->class_id)?>
                            <button class="btn btn-primary" type="submit">View class</button>
                        </form>
                    <?php else: ?>    
                        <p>You did not join this class!</p>
                        <?php echo form_open(base_url("notifs"))?>
                            <button class="btn btn-primary" type="submit">Go back</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
