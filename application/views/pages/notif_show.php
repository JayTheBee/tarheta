<head>
    <style>
      .notif-container  {
        font-family: "Poppins";
      }

      .notif-container .card{
          border: 2px solid #e4be91;
      } 
      .notif-header {
        background-color: #e4be91;
        font-weight: bold;
        font-size: 1.8em;
      }
  
      .notif-body p {
        font-family: "Poppins";
        margin: 0.3rem 0 0 0;
        font-size: 1.2em;
        letter-spacing: 0.2px;
        color: #000;
        
      }
  
      .notif-body button {
        background-color: #e4be91;
        color: #000;
        border-color: none !important;
        margin: 0px 4px;
        border: 0px;
        cursor: pointer;
        display: inline-block;
        vertical-align: bottom;
        box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
        border-radius: 4px;
        font-size: 1em;
        font-weight: 600;
        text-align: center;
        min-height: 30px;
        padding: 0px 10px 0px;
      }
  
      .notif-body .btn-primary:hover {
        background-color: #a2795e !important;
      }
      .custom-bg-create {
      background-color: #E4BE91;
      overflow-x: hidden;
      background-image: url("<?php echo base_url('assets/images/contact/contact-wave.png'); ?>");
      width: 100%;
      height: 100%;
        }
    </style>
</head>
<div class="custom-bg-create">
    <div class="notif-container container vh-100 w-100">
            <div class="card" style="margin: 2rem 0 2rem 0;">
                <div class="notif-header card-header text-center"> Notifications  </div>


                <div class="notif-body card-body">
                    <p><?php echo $notifs->text ?> </p> 
                    <?php if($notifs->response==NULL): ?>
                        <?php echo form_open("user/profile/check_notif/".$context."/".'ACCEPT'."/".$_SESSION['sess_profile']['user_id']."/".$notifs->class_id."/".$notifs->id)?>
                            <button class="btn btn-primary" type="submit">Join</button>
                        <?php echo form_close()?>

                        <?php echo form_open("user/profile/check_notif/".$context."/".'DECLINE'."/".$_SESSION['sess_profile']['user_id']."/".$notifs->class_id."/".$notifs->id)?>
                            <button class="btn btn-primary" type="submit">Decline</button>
                        <?php echo form_close()?>

                    <?php elseif($notifs->response=='ACCEPT'): ?>
                        <?php echo form_open("classes/show/".$notifs->class_id)?>
                            <button class="btn btn-primary" type="submit">View class</button>
                        <?php echo form_close()?>
                    <?php else: ?>    
                        <p>You did not join this class!</p>
                        <?php echo form_open(base_url("profile"))?>
                            <button class="btn btn-primary" type="submit">Go back</button>
                        <?php echo form_close()?>
                    <?php endif; ?>
                </div>
            </div>
    </div>
</div>