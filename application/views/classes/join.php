<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <form method="POST" autocomplete="off" action="<?=site_url('classes/join')?>">
                    <div class="form-group">
                        <label>Invites</label> 
                        <input type="text" placeholder="INVITE CODE" name="invite" class="form-control" id="invite" aria-describedby="name"> 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                    </div>
                </form>              
            </div>
                <?php
                    if($this->session->flashdata('success')){?>
                        <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                <?php } ?>
                
                <?php
                if($this->session->flashdata('error')){?>
                    <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                <?php } ?>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>