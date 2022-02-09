<head>
<style>
    .set-container{
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

    .crt-label {
    margin: 0.3rem 0 0 0;
    line-height: 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    letter-spacing: 0.2px;
    color:#A2795E;
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
  font-family: "Poppins", sans-serif;
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

<!-- Create Set PAGE -->
<div class="container set-container vh-100">
    <div>
            <div class="card">
            <div class="card-header text-right h3">Flashcard Set</div>
                <form method="POST" autocomplete="off" action="<?php echo base_url('flashcards/update-set/'.$set_id)?>">
                    <div class="form-group">
                        <input class="crt-input" type="text" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" class="form-control" id="name" aria-describedby="name"> 
                        <label class ="crt-label">Name</label> 
                    </div>
                    <div class="form-group"> 
                        <input class="crt-input" type="text" placeholder="Enter description (optional)" name="description" value="<?php echo set_value('description'); ?>" class="form-control" id="description" > 
                        <label class="crt-label">Description </label>
                    </div>
                    <div class="form-group"> 
                        <input class="crt-input" type="text" placeholder="Enter color" name="color" value="<?php echo set_value('color'); ?>" class="form-control" id="color"> 
                        <label class="crt-label"> Color </label>
                    </div>

                    <div class="text-center d-flex justify-content-center footer-summary">
                        <button type="submit" class="footer-button ctr-btn" name='create_set'>Create Set</button>
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