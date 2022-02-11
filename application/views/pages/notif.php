<!--style-->
<head>
  <style>
    .modal-body .rd {
      font-family: "Poppins";
      font-weight: 400;
      font-size: 0.875em;
    }
    .notif-header {
      font-family: "Poppins";
      background-color: #e4be91;
      font-weight: bold;
      border: 2px 2px 0 0 solid #a2795e;
    }

    .modal-body p {
      font-family: "Poppins";
      margin: 0.3rem 0 0 0;
      font-size: 1em;
      letter-spacing: 0.2px;
      color: #000;
    }

    .modal-body button {
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
      font-size: 0.8rem;
      font-weight: 600;
      text-align: center;
      min-height: 30px;
      padding: 0px 10px 0px;
      font-family: "Poppins";
    }

    .modal-body .btn-primary:hover {
      background-color: #a2795e !important;
    }
  </style>
</head>

    <div class="notif-header modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
    <button
        type="button"
        class="close"
        data-bs-dismiss="modal"
        aria-label="Close"
    >
     <span aria-hidden="true">&times;</span>
     </button>
    </div>   
        <div class="modal-body">
                <?php if(empty($notifications)): ?>
                    <p>No notifications yet!</p>
                <?php else: ?>
                    <?php foreach($notifications as $row): ?>
                        <?php if($row['active']==1): ?>
                            <p class="rd">Unread</p>
                        <?php else: ?>
                            <p class="rd">Read</p>
                        <?php endif; ?>
                        <?php switch($row['context']): 
                            case "class.invite": ?>
                                <p>You have been invited to a class!</p> 
                                <?php echo form_open("user/profile/read/".$row['id']."/".$row['active']."/".$row['context'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
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
                                <p>A new flashcard has been assigned!</p>
                                <?php echo $row['context']?>
                                <?php echo form_open("user/profile/notif_redirects/".$row['context']."/".$row['id'])?>
                                    <button class="btn btn-primary" type="submit">Read</button>
                                <?php echo form_close()?>
                        <?php endswitch; ?>     
                    <?php endforeach; ?>    
                <?php endif; ?>
        </div>
