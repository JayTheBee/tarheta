<!-- Reopen PAGE -->
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        TEST REOPEN
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/update-time/'. $flashcard['id'])?>">


                                <div id='time-fields' >
                                    <div class="form-group col-mb-2">
                                        <label for="time-open" class="form-label">Time Open</label>
                                        <input type="datetime-local" name="time-open" class="form-control" id="time-open">
                                    </div>
                                    <div class="form-group col-mb-2">
                                        <label for="time-close" class="form-label">Time Close</label>
                                        <input type="datetime-local" name="time-close" class="form-control" id="time-close">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name='reopen'>Reopen</button>
                            </div>
                            

                            <?php
                                if($this->session->flashdata('success')){?>
                                    <p class="text-success" style="margin-top:2rem"> <?=$this->session->flashdata('success')?> </p>
                            <?php } ?>
                            
                            <?php
                            if($this->session->flashdata('error')){?>
                                <p class="text-danger" style="margin-top:2rem"> <?=$this->session->flashdata('error')?> </p>
                            <?php } ?>

                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>
