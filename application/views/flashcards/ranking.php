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
</style>
<head>
<div class="custom-bg-create vh-100 w-100">
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 3rem">
            <div class="card-header text-center">
                <h4>RANKING</h4>
                <h3><?php echo $flashcard['name']; ?></h3>
                <p><?php echo $flashcard['description'] ?></p>
                <!-- Flash data -->
                <?php
                    if($this->session->flashdata('success')){?>
                        <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                <?php } ?>
                
                <?php
                    if($this->session->flashdata('error')){?>
                        <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                <?php } ?>
            </div>

            <div class="card-body">
                <?php foreach ($users as $user): ?>
                    <h4>Rank: <?php echo $user['flashcard_rank']?></h4>
                    <h5>Username : <?php echo $user['username']?></h5>
                    <h6>Score: <?php echo $user['score'] ?></h6>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</div>