<head>
<style>
    .custom-bg-create {
    background-color: #E4BE91;
    overflow-x: hidden;
    background-image: url("<?php echo base_url('assets/images/contact/contact-wave.png'); ?>");
    width: 100%;
    height: 100%;
    font-family: "Poppins";
}
.set-container .card {
        margin-top: 2rem; 
        padding-bottom: 2rem;
        border-radius: 10px;
        border: 2px solid  #A2795E;
    }

    .set-container .card-header{
        background-color: #A2795E;
        font-weight: bold;
        border: 2px 2px 0 0 solid  #A2795E;
    }

    .set-container .form-group {
        margin: 1rem 2rem 1rem 2rem;
    }

    .crt-input {
    display: flex;
    border:none;
    border-bottom: 3px solid #A2795E;
    width: 100%;
    font-size: 1.2em;
    }

    .crt-input.[placeholder]::-webkit-input-placeholder {
    opacity: 1;
    color:#ACA7A4;
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

    .ctr-btn {
    background-color: #A2795E;
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
<div class="set-container container vh-100 w-100">
    <div>
            <div class="card" style="margin-top: 5rem">
                <form method="POST" autocomplete="off" action="<?=site_url('classes/join')?>">
                    <div class="card-header text-right h3">Invites</div>
                    <div class="form-group">
                        <input type="text" placeholder="INVITE CODE" name="invite" class="crt-input" id="Enter Invite Code" aria-describedby="name">
                        <label class="crt-label">Invite Code</label> 
                        <div class="footer-summary text-center">
                            <button type="submit" class="footer-button ctr-btn">Submit</button>
                         </div>
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