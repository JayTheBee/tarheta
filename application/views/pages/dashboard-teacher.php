<!--IUUPDATE PA-->
<head>
    <style>
        /*dashboard-body*/

.dashboard-body {
  font-family: "Poppins";
  margin: 1cm 0 0 0;
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
  border-radius: 10px;
}

.ds-class-btn button {
  font-weight: bold;
  font-size: 1em;
  color: #fff;
}

.crtcls {
  color: #fff;
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
  width: 100vw;
	left: 0;
	z-index: 1;
	height: 100vh;
}
.ds-pic-bg {
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: 1;
}

.tchrbg{
  height: 25rem;
}

</style>
</head>
<div style="background-color: #52888a;">

<img src="<?php echo base_url("./assets/images/dashboard/bg.png"); ?>" alt="" class="position-absolute waveSize">
  <img src="<?php echo base_url("./assets/images/dashboard/teacher-bg.png"); ?>" alt="" class="ds-pic-bg tchrbg">
  <div class="dashboard-body boxPos position-relative d-flex justify-content-center "> 
  <div class="ds-transparent-bg">
            <div class="ds-recent sets">
                <a>RECENT SETS</a>
                <div class="text-center"> <!--DIV PAG WALA PANG SETS/folders-->
                    <span>You don't have any sets yet</span> 
                    <span>Sets you create or study will be displayed here. If you want to create a new set, click <a href="#">here.</a></span>
                </div>
            </div>

            <div class="ds-classes sets">
                <a>CLASSES</a>
                <div>
                    <button class="ds-class-btn crtcls">Create Class + </button>
                </div>
            </div>

            <div class="ds-flashcard sets">
                <a>SEE OTHER USERS FLASHCARDS</a>
                <div class="d-flex flscrds">
                  <div>Flashcard here</div>
                  <div>flashcard here</div>
                  <div>more flashcard</div>
                </div>  
            </div>

  </div>
</div>
</div>