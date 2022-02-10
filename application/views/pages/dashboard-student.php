<!--IUUPDATE PA-->
<head>
    <style>
        /*dashboard-body*/

.dashboard-body {
  font-family: "Poppins";
  margin: 0 ;
}

.ds-transparent-bg {
  margin: 2%;
  border-radius: 10px;
  width: 95%;
  height: 90%;
  padding: 1rem;
  background-color: rgba(255, 255, 255, 0.2);
  justify-content: center;
}

 .ds-transparent-bg .sets {
  box-sizing: auto;
  width: 90%;
}

.ds-transparent-bg .sets a {
  font-size: 1.2em;
  font-weight: bold;
  color: #000;
}

.ds-recent {
  color: #fff;
}

.ds-recent div {
  color: #fff;
  padding: 1.8rem;
  height: 200px;
  width: 50%;
}

.ds-recent span:nth-child(1) {
  font-weight: bold;
  font-size: 1.5em;
}
.ds-recent span:nth-child(1)::after {
  content: "\a";
  white-space: pre;
}

.ds-recent span:nth-child(2) {
  font-weight: 200;
}

.ds-recent span:nth-child(2) a {
  font-weight: 600;
  color: #fff;
  letter-spacing: 2px;
}


.ds-classes .ds-class-btn {
  margin: 1rem 2rem 2rem 1rem;
  background-color: #a2795e;
  width: 30%;
  box-shadow: 1px 2px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
}

.ds-class-btn .form-control {
  background-color: #a2795e;
  border-color: #a2795e;
  border-radius: 10px;
}

.ds-class-btn .form-control::placeholder {
  color: rgba(255, 255, 255, 0.6);
  font-weight: light;
  font-size: 0.875em;
}


.ds-flashcard .flscrds div {
  width: 20rem;
  background-color: #175561;
  height: 10rem;
  margin: 1rem 2rem 1rem 2rem ;
  border-radius: 20px;
  text-align: center;
}

.ds-wave {
	left: 0;
	z-index: 1;
	height: 100vh;
  width: 100%;
}
.ds-pic-bg {
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: 1;
}
.stdbg{
  height: 35rem;
}


.boxPos {
	z-index: 2;
	width: 100vw;
	height: 100vh;
}

</style>
</head>
<div style="background-color: #52888a;" class="m-0">

<img src="<?php echo base_url("./assets/images/dashboard/bg.png"); ?>" alt="" class="position-absolute ds-wave">
  <img src="<?php echo base_url("./assets/images/dashboard/student-bg.png"); ?>" alt="" class="ds-pic-bg stdbg">
  <div class="dashboard-body boxPos position-relative d-flex justify-content-center "> 
  <div class="ds-transparent-bg">
            <div class="ds-recent sets">
                <a>RECENT SETS</a>
                <div class="text-center"> <!--DIV PAG WALA PANG SETS/folders-->
                    <span>You don't have any sets yet</span> 
                    <span>Sets you create or study will be displayed here. If you want to create a new set, click <a href="<?php echo base_url(); ?>flashcards/create-set">here.</a></span>
                </div>
            </div>

            <div class="ds-classes sets">
                <a>CLASSES</a>
                <div class="ds-class-btn">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="ENTER CLASS CODE" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                        <button class="btn" type="button">JOIN</button>
                      </div>
                </div>
            </div>
            <div class="ds-flashcard sets">
                <a>FLASHCARDS</a>
                <div class="ds-recent m-5" style="color: #000;">
                  <span>You don't any flashcard yet. <a  href="<?php echo base_url(); ?>flashcards/create">Create a flashcard </a></span> 
                  <br><span>View flashcards tab <a href="<?php echo base_url(); ?>flashcards/index">here.</a></span>
                </div>  
            </div>

  </div>
</div>
</div>

