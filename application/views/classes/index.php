<head>
    <style>
        .class-container {
            background-color: #52888A;
            margin: 0;
            padding: 0;
            background-image: url("<?php echo base_url("./assets/images/dashboard/bg.png"); ?>");
            display: flex;
            flex-direction: column;    
            min-height: 100%;
        }
        
        .class-boxPos {
        border-radius: 10px;
        width: 95%;
        min-height: 90%;
        padding: 1rem;
        background-color: rgba(255, 255, 255, 0.2);
        justify-content: center;
        margin: auto;
        overflow:auto;
        }

        .class-container .class-header {
        font-weight: bold;
        font-size: 2em;
        margin-left: 10px;
        }

        .class-boxPos .class-index {
        margin: 0 2% 0 2%;
        }

        .classes-card {
        background-color: #A2795E;
        width: 23rem;
        margin: 0 20px 30px 0;
        border-radius: 10px;
        height: 6rem;
        
        }

        .class-link {
        text-decoration: none;
        margin: 2px 10px 2px 10px;
        color: #000;
        font-size: 1.8em;
        font-weight: 500;
        }

        .class-name{
        margin: 0.3rem 0 0 0;
        line-height: 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        letter-spacing: 0.2px;
        color:#000;
        overflow: hidden;
        text-overflow: ellipsis; 
        }

        .class-btn{
        background-color: #EFD8B3;
        width: 5rem;
        height: 3rem;
        font-weight: 500;
        border-radius: 20px;
        border: none;
        box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
        }
        
    </style>
</head>


<div class="class-container vh-100 w-100">
    <div class="class-boxPos"> 

                <div class="d-flex justify-content-between m-3">
                    <p class="class-header">Classes</p>
                    <div>
                    <a class="class-link" href="<?php echo base_url(); ?>classes/join">Join Class</a>
                    <a class="class-link" href="<?php echo base_url(); ?>classes/create">Create Class</a>
                    </div>
                </div>
                
                <div class="class-index d-flex flex-wrap">
                <?php if(empty($result)): ?>
                    <p class="class-header">No Classes Yet!</p>
                <?php else: ?>
                    <?php foreach($result as $row): ?>
                        <div class="classes-card d-flex justify-content-between">
                            <p class="class-name m-3"><?php echo $row['class_name'] ?></p>
                            <?php echo form_open("classes/show/".$row['id'])?>
                            <button class="class-btn m-3" type="submit">View</button>
                        </div>
                        </form>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>

</div>