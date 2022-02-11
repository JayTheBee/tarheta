<!-- Reopen PAGE -->
<head>
    <style>
    .custom-bg-create {
    background-color: #E4BE91;
    overflow-x: hidden;
    font-family: "Poppins";
    }

    .wave-size-bg {
      height: 100%;
      width: 100%;
      position: absolute;
    }
    .set-container .card {
        margin-top: 2rem; 
        padding-bottom: 2rem;
        border-radius: 10px;
        border: 2px solid  #A2795E;
        background-color: #fff;
    }

    .set-container .card-header{
        background-color: #A2795E;
        font-weight: bold;
        border: 2px 2px 0 0 solid  #A2795E;
    }

    .crt-label {
    margin: 0.3rem 0 0 0;
    line-height: 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    letter-spacing: 0.2px;
    color:#A2795E;
    }

    .footer-summary button {
     min-width: 7.5rem;
     margin: 0px 4px;
     background-color: #A2795E;
    }

    .footer-button {
     width: initial;
     margin: 0px;
     border: 0px;
     cursor: pointer;
     display: inline-block;
     vertical-align: bottom;
     box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
     border-radius: 4px;
     font-size: 0.875rem;
     font-weight: bold;
     text-align: center;
     text-decoration: none;
     min-width: 42px;
     min-height: 42px;
     padding: 0px 16px 4px;
     position: relative;
    }

    .crtscs {
        text-align: center;
        margin-bottom: 1rem;
        font-size: 1.2em;
        font-weight: 600
    }
    </style>
</head>

<div class="custom-bg-create">
  <img src="<?php echo base_url('assets/images/contact/contact-wave.png'); ?>" class="wave-size-bg" />   
<div class="container vh-100 ">
            <div class="set-container">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header h3">
                        TEST REOPEN
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/update-time/'. $flashcard['id'])?>">


                                <div id='time-fields' >
                                    <div class="form-group col-mb-2">
                                        <label class="crt-label" for="time-open" class="form-label">Time Open</label>
                                        <input type="datetime-local" name="time-open" class="form-control" id="time-open">
                                    </div>
                                    <div class="form-group col-mb-2">
                                        <label class="crt-label" for="time-close" class="form-label">Time Close</label>
                                        <input type="datetime-local" name="time-close" class="form-control" id="time-close">
                                    </div>
                                </div>
                            </div>

                            <div class="footer-summary text-center">
                                <button type="submit" class="footer-button" name='reopen'>Reopen</button>
                            </div>
                            

                            <?php
                                if($this->session->flashdata('success')){?>
                                    <p class="crtscs text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                            <?php } ?>
                            
                            <?php
                            if($this->session->flashdata('error')){?>
                                <p class="crtscs text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                            <?php } ?>

                        </form>
                </div>
            </div>
        </div>

</div>
</div>