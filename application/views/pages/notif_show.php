
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center"> Notifications  </div>

                <div class="card-body">
                    <p><?php echo $notifs->text ?> </p> 
                    <?php echo form_open("class/classes/enroll_user/".$_SESSION['Profile']['id'] ."/" .$notifs->class_id)?>
                        <button class="btn btn-primary" type="submit">wanna join?</button>
                    <?php echo form_close()?>

                </div>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
