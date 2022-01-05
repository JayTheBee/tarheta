<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card" style="margin-top: 5rem">
                <div class="card-header text-center">
                    Classes
                </div>
                
                <div class="card-body">
                <?php if(empty($result)): ?>
                    <p>No Classes Yet!</p>
                <?php else: ?>
                    <?php foreach($result as $row): ?>
                        <p>Class Name: <?php echo $row->class_name ?> </p> 
                        <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("classes/show"); ?>'" >View</button>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>