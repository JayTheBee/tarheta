<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card" style="margin-top: 5rem">
            <div class="card-header text-right">
            <?php foreach($result as $row): ?>
                <p>Class Name: <?php echo $row->class_name ?> </p>
                <p>Class Description: <?php echo $row->description ?> </p>
                <p>Affiliate School: <?php echo $row->school ?></p>
                <?php endforeach; ?>
            </div>    
        </div>  
    </div>  
</div>
