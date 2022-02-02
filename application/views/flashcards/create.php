<head>
    <style>

.card{
        margin-top: 2rem; 
        margin-bottom: 2rem;
        border-radius: 10px;
        border: 2px solid  #A2795E;
}

/* flashcard header */
.summary-header {
  flex: 0 0 auto;
  padding: 0px 24px 0px;
  margin: 0px;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.33;
  background-color: #A2795E;
  border: 2px 2px 0 0 solid  #A2795E;
}

.summary-header::before,
::after {
  box-sizing: inherit;
}

h2 {
  flex: 0 0 auto;
  padding: 24px 24px 8px;
  margin: 0px;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.33;
}

/* flashcard summary content */
.summary-content {
  flex: 1 1 auto;
  padding: 0px 24px;
  overflow-y: auto;
}

.dWjUC {
  display: flex;
}
.frqzVu {
  box-sizing: border-box;
  margin: 16px 0px 0px;
  min-width: 0px;
}

.eROoTb {
  padding-right: 16px;
  width: 50%;
  box-sizing: border-box;
  margin: 0px;
  min-width: 0px;
  width: 100%;
}

/* summary title */
.summary-title {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
}

.st-title {
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0px 0px 0.25rem;
  line-height: 1.5rem;
  font-size: 0.875rem;
  font-weight: 700;
  letter-spacing: 0.2px;
}

.st-titlebox {
  position: relative;
}

.st-titleinput {
  box-sizing: border-box;
  width: 100%;
  min-height: 2.75rem;
  border: 1px solid rgb(178, 178, 178);
  border-radius: 0.25rem;
  background-color: #e4be91;
  color: rgb(51, 51, 51);
  font-size: 0.875rem;
  line-height: 1.25rem;
  letter-spacing: 0.2px;
  transition: all 0.2s ease 0s;
  appearance: none;
  text-overflow: ellipsis;
  resize: none;
  overflow: auto;
  padding: 0px 5rem 0px 1rem;
  white-space: nowrap;
}

.st-titleinput:focus {
  outline-width: 0px;
  border: 1px solid #a2795e;
}

.st-titlelimit {
  position: absolute;
  right: 0.35rem;
  top: 50%;
  transform: translateY(-50%);
  height: 100%;
}

.st-titlelimitchar {
  position: absolute;
  top: 0px;
  bottom: initial;
  right: 0.125rem;
  margin: 0.5rem;
  color: rgb(110, 110, 110);
  animation: 0.5s ease 0s 1 normal none running jfRzPl;
  white-space: nowrap;
}

/* description */
.ivjskN {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
}

/*description label */
.lezPrD {
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0px 0px 0.25rem;
  line-height: 1.5rem;
  font-size: 0.875rem;
  font-weight: 700;
  letter-spacing: 0.2px;
}
label {
  cursor: default;
}
.lgIHpf {
  margin-left: 0.5rem;
  color: rgb(110, 110, 110);
  font-weight: 400;
}

/* description box */
.gJtIs {
  position: relative;
}
.gJtIs::before,
::after {
  box-sizing: inherit;
}
.hgbfPN {
  box-sizing: border-box;
  width: 100%;
  min-height: 2.75rem;
  border: 1px solid rgb(178, 178, 178);
  border-radius: 0.25rem;
  background-color: #e4be91;
  color: rgb(51, 51, 51);
  font-size: 0.875rem;
  line-height: 1.25rem;
  letter-spacing: 0.2px;
  transition: all 0.2s ease 0s;
  appearance: none;
  text-overflow: ellipsis;
  resize: none;
  overflow: auto;
  padding: 0.75rem 3rem 0.75rem 1rem;
}

.fUZYzw {
  position: absolute;
  right: 0.35rem;
  top: 50%;
  transform: translateY(-50%);
  height: 100%;
}

/*description text-limit*/
.jAWBEq {
  color: rgb(110, 110, 110);
}

@keyframes jAWBEq {
  65% {
    transform: scale(1.2);
  }
  80% {
    transform: scale(0.8);
  }
  100% {
    transform: scale(1);
  }
}

.hTDhsC {
  top: 0px;
  bottom: initial;
  right: 0.125rem;
  margin: 0.5rem;
  color: rgb(255, 255, 255);
  animation: 0.5s ease 0s 1 normal none running jfRzPl;
  white-space: nowrap;
}

/*description pro-tip */
.knnLTA {
  font-size: 0.75rem;
  color: rgb(110, 110, 110);
}

/* flashcard summary cover image */
@media screen and (min-width: 40em) {
  .st-coverimage {
    padding-right: 0px;
    width: 50%;
  }
}
.st-coverimage {
  box-sizing: border-box;
  margin: 0px;
  min-width: 0px;
  padding-right: 0px;
  width: 100%;
}

.st-cv-label {
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0px 0px 0.25rem;
  line-height: 1.5rem;
  font-size: 0.875rem;
  font-weight: 700;
  letter-spacing: 0.2px;
}

.st-cv-cv {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
}

.st-cv-color {
  box-sizing: border-box;
  position: relative;
  height: 0px;
  padding: 20px;
  background-color: #E4BE91;
  border-radius: 4px;
  overflow: hidden;
  text-align: start;
  
}

.iTSzXs {
  margin-top: auto;
  margin-bottom: 1rem;
  position: relative;
  z-index: 1;
  display: flex;
  padding: 0px;
  bottom: 0;
}

.st-cv-img-btn /* cover image button */ {
  width: initial;
  margin: 0px;
  border: 0px;
  cursor: pointer;
  display: inline-block;
  vertical-align: bottom;
  box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
  background: #52888a;
  color: rgb(0, 0, 0);
  border-radius: 4px;
  font-size: 0.875rem;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  min-width: 32px;
  min-height: 32px;
  padding: 0px 16px 4px;
  position: relative;
}

/* 2nd column */
.st-2 {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
  display: flex;
}

@media screen and (min-width: 375px) {
  .st-2-1 {
    padding-right: 16px;
    width: 50%;
  }
}
.st-2-1 {
  box-sizing: border-box;
  margin: 0px;
  min-width: 0px;
  padding-right: 16px;
  width: 100%;
}

/* save to */
.st-2-save-to {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
}

.st-2-sv-btn {
  margin: 0px;
  background: #e4be91;
  outline: none;
  font-style: inherit;
  font-variant: inherit;
  font-weight: inherit;
  font-stretch: inherit;
  font-family: inherit;
  cursor: pointer;
  -webkit-font-smoothing: inherit;
  appearance: none;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  padding: 4px 4px 4px 13px;
  width: 100%;
  min-height: 2.75rem;
  border: 1px solid rgb(178, 178, 178);
  border-radius: 0.25rem;
  color: rgb(110, 110, 110);
  font-size: 0.875rem;
  line-height: 24px;
  letter-spacing: 0.2px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.st-2-sv-span1 {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  padding-right: 8px;
  text-align: left;
}

.st-2-sv-span2 {
  margin-left: auto;
}

.st-2-sv-change {
  width: initial;
  margin: 0px;
  border: 0px;
  cursor: pointer;
  display: inline-block;
  vertical-align: bottom;
  background: #52888a;
  color: rgb(0, 0, 0);
  border-radius: 4px;
  box-shadow: rgb(0 0 0 / 25%) 0px -4px inset;
  font-size: 0.875rem;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  min-width: 32px;
  min-height: 32px;
  height: 32px;
  padding: 0px 16px 4px;
  line-height: 32px;
  position: relative;
}

.st-2-quiz-set {
  box-sizing: border-box;
  margin: 0px 0px 16px;
  min-width: 0px;
}

.st-quizset-select select {
  background-color: #e4be91;
}

/* categorical tags*/
.st-2-ctgrcl {
  box-sizing: border-box;
  width: 100%;
  min-height: 2.75rem;
  border: 1px solid rgb(178, 178, 178);
  border-radius: 0.25rem;
  background-color: #e4be91;
  color: rgb(51, 51, 51);
  font-size: 0.875rem;
  line-height: 1.25rem;
  letter-spacing: 0.2px;
  transition: all 0.2s ease 0s;
  appearance: none;
  text-overflow: ellipsis;
  resize: none;
  overflow: auto;
  padding: 0px 1rem;
  white-space: nowrap;
}

/**/
@media screen and (min-width: 375px) {
  .st-2-2 {
    width: 50%;
  }
}
.st-2-2 {
  box-sizing: border-box;
  margin: 0px;
  min-width: 0px;
  width: 100%;
}
/*visibility*/
.st-2-visibilitybox {
  box-sizing: border-box;
  margin: 0px 0px 8px;
  min-width: 0px;
}
.st-2-label {
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0px 0px 0.25rem;
  line-height: 1.5rem;
  font-size: 0.875rem;
  font-weight: 700;
  letter-spacing: 0.2px;
}

.st-2-vsblty {
  display: flex;
  box-sizing: border-box;
  margin: 8px 0px;
  min-width: 0px;
  flex-wrap: wrap;
}

.st-2-vs-radio {
  box-sizing: border-box;
  position: relative;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0.25rem 0.5rem;
}

.st-2-vs-prv {
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  margin: 0.25rem 0.5rem;
  box-sizing: border-box;
  min-width: 0px;
  flex: 0 0 auto;
}

/* visibility checked */
.llrbdE:checked {
  border: 12px solid #52888a !important;
}
.llrbdE {
  flex: 0 0 auto;
  appearance: none;
  width: 24px;
  height: 24px;
  border-radius: 0.75rem;
  box-shadow: rgb(0 0 0 / 10%) 0px 1px 3px 0px;
  border: 1px solid rgb(110, 110, 110);
  transition: border 0.2s linear 0s;
  margin: 0px;
  cursor: pointer;
}

.st-2-vs-label {
  color: rgb(51, 51, 51);
  line-height: 24px;
  cursor: pointer;
  margin: 0px 0.5rem;
}

/* flashcard modal footer */
.footer-summary {
  width: calc(100% - 48px);
  flex: 0 0 auto;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding: 24px;
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
  font-family: Montserrat, "Helvetica Neue", Helvetica, Arial, sans-serif;
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

.footer-done {
  background-color: #A2795E;
  color: rgb(0, 0, 0);
}

.footer-cancel {
  background-color: #C4C4C4;
  color: rgb(0, 0, 0);
}

    </style>
</head>


<!-- ACCOUNT TYPE SELECTION PAGE -->

  
<div
      id="FlashcardCreate"
      class="container">
      <div> 
        <div class= "card flashcard-modal">
          <div class="summary-header">
            <h2 class="summary-title">
            Flashcard Summary
            </h2>
          </div>
          <div class=" summary-content">
            <!--start of form-->
          <form method="POST" autocomplete="off" action="<?=base_url('flashcards/create_flashcards')?>">
            <div class="frqzVu dWjUC">
              <div class="eROoTb">
             
                <div class="summary-title">
                  <label id="tarheta-title" class="st-title">Title</label>
                  <div class="st-titlebox">
                    <input
                      placeholder="Enter Tarheta title... Maximum of 70 words"
                      class="form-control st-titleinput"
                      maxlength="70"
                      aria-label="Tarheta title. 70 characters left."
                      dir="auto"
                      value=""
                      name="name"
                      id="name" aria-describedby="name"
                      type="text"
                    />
                    <?php echo form_error("name", '<p class="text-danger">','</p>');?> 
                    <!-- pang max ng words
                    <div class="st-titlelimit">
                      <span
                        class="st-titlelimitchar"
                        aria-live="polite"
                        aria-label="70 characters left."
                        data-functional-selector="undefined__characters-left"
                        >70</span
                      >
                    </div>
                      -->
                  </div>
                </div>
             
                <div class="form-group ivjskN">
                  <label id="description" class="lezPrD"
                    >Description
                    <span class="lgIHpf">(Optional)</span>
                  </label>
                  <div class="gJtIs">
                    <textarea
                      class="hgbfPN form-control"
                      rows="5"
                      maxlength="300"
                      aria-labelledby="description pro-tip-text description-characters-left"
                      dir="auto"
                      type="text"
                      placeholder="Flashcard description. Maximum of 300 words" name="description" id="description"
                    ></textarea>
                    <!-- max word 
                    <div class="fUZYzw">
                      <span
                        class="hTDhsC jAWBEq"
                        aria-live="polite"
                        id="description-characters-left"
                        aria-label="300 characters left."
                        data-functional-selector="undefined__characters-left"
                        >300</span
                      >
                    </div>
                    -->
                  </div>
                  <label id="pro-tip-text" class="knnLTA"
                    >Pro tip: a good description will help other users find your
                    Tarheta Flashcards.</label
                  >
                </div>
              
              </div>

              <div class="form-group st-coverimage">
                <label class="st-cv-label"> Color </label> 
                <div class="st-cv-cv">
                  <div id="cover-color">
                    <input type="text" placeholder="Enter color" name="color" value="<?php echo set_value('color'); ?>" class="form-control st-cv-color" id="color"> 
                  </div>
                </div>
              </div>
            
              <!--<div class="st-coverimage">
                <label class="st-cv-label">Cover Image</label>
                <div class="st-cv-cv">
                  <div id="cover-image" class="st-cv-img">
                    <div class="dkmyae">
                    
                      <div class="iTSzXs">
                        <button type="button" class="st-cv-img-btn">
                          Change Image
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->
              
            </div>
          
            <div class="st-2">
              <div class="st-2-1">
                <div class="st-2-save-to">
                  <label class="st-2-label">Save to</label>

                  <select id="sets" name="sets" class="form-control st-2-sv-btn">
                                    <?php 
                                        foreach($sets as $row){ 
                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                        }
                                    ?>
                  </select>
                  <!--
                  <button
                    data-functional-selector="folder-location__input-field"
                    value="My Tarheta"
                    title="My Tarheta"
                    aria-label="This Tarheta is saved to My Tarheta folder. Change Tarheta's folder. "
                    class="st-2-sv-btn"
                  >
                    <span class="st-2-sv-span1">My Tarheta Sets</span>
                    <span class="st-2-sv-span2">
                      <span
                        aria-labelledby="location"
                        type="approve"
                        class="st-2-sv-change"
                        >Change</span
                      >
                    </span>
                  </button>-->
                </div>

                <div class="form-group st-2-quiz-set">
                  <label for="type" class="st-2-label">Type</label>
                  <div class="st-quizset-select">
                    <select id="type" name="type" class="form-select" aria-label="Default select example" onchange="showQuizFields('quiz-type', 'time-fields', this)">
                      <option value="QUIZ">Quiz</option>
                      <option value="REVIEWER">Reviewer</option>
                      </select>
                  </div>
                </div>

              
                <div class="form-group st-2-quiz-set">
                  <label for="qtype" id="quiz-set" class="st-2-label">Quiz Mode:</label>
                  <div class="st-quizset-select">
                    <select
                      class="form-select"
                      aria-label="Default select example"
                      id="qtype" name="qtype"
                    >
                      <option selected style="font-size: 0.85rem">
                        Select a quiz mode
                      </option>
                      <option value="POP">POP QUIZ</option>
                      <option value="EXAM">EXAM</option>
                      <option value="ASSIGNMENT">ASSIGNMENT</option>
                    </select>
                  </div>
                </div>


                <div class="st-2-save-to">
                  <label class="st-2-label">Subject Category</label>
                  <div style="position: relative" class="">
                    <select  class="st-2-ctgrcl form-select"id="category" name="category">
                      <--   <option value="">Category 1</option>
                        <option value="">Category 2</option> ->
                                    <?php 
                                        foreach($categories as $row){ 
                                            echo '<option value="'.$row->name.'">'.$row->name.'</option>';
                                        }
                                    ?>
                        </select>
                        <p>needs a script to dynamically add more input fields</p>
                  </div>
                </div>
               
              </div>
              <div class="st-2-2">
                                        
                                        <!--
                <div class="form-group st-2-save-to">
                  <label class="st-2-label" for="visibility">Visibility</label>
                  <div class="st-2-vsblty" >
                    <div class="st-2-vs-radio" id="visibility">
                      <div class="form-check st-2-vs-prv">
                        <input
                          class="form-check-input llrbdE"
                          type="radio"
                          name="flexRadioDefault"
                          value="PRIVATE"
                        />
                        <label
                          class="form-check-label st-2-vs-label"
                          for="flexRadioDefault1"
                        >
                          Private
                        </label>
                      </div>
                      <div class="form-check st-2-vs-prv">
                        <input
                         value="PUBLIC"
                          class="form-check-input llrbdE"
                          type="radio"
                          name="flexRadioDefault"
                          id="flexRadioDefault2"
                        />
                        <label
                          class="form-check-label st-2-vs-label"
                          for="flexRadioDefault2"
                        >
                          Public
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                 -->                         
                
                <div class="form-group st-2-save-to">
                <label class="st-2-label" for="visibility">Visibility</label>
                  <select id="visibility" name="visibility" class="form-select st-2-ctgrcl ">
                      <option value="PRIVATE">Private</option>
                      <option value="PUBLIC">Public</option>
                  </select>
                
                </div>
                                                              



                <div class="st-2-save-to">
                    <label class="st-2-label">Schedule:</label>
                  
                  <div id='time-fields' >
                                    <div class="form-group">
                                        <label for="time-open" class="form-label st-2-label">Time Open</label>
                                        <input type="datetime-local" name="time-open" class="form-control" id="time-open">
                                    </div>
                                    <div class="form-group">
                                        <label for="time-close" class="form-label st-2-label">Time Close</label>
                                        <input type="datetime-local" name="time-close" class="form-control" id="time-close">
                                    </div>
                                </div>
                    </div>
                </div>

                  <!--hatdog-
                                <div class="form-group col-md-2">
                                    <label for="sets">Flashcard Sets</label>
                                    <select id="sets" name="sets" class="form-control">
                                    <?php 
                                        foreach($sets as $row){ 
                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                  hatdog-->              


              </div>
            </div>
          
               <div
                class=" footer-summary"
                >
                <button
                type="button"
                class="footer-button footer-cancel"
                >
                Cancel</button 
                >
                <button type="submit" class="footer-button footer-done">
                Create
                </button>
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

</div>


<!--
<div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="">
            <div class="card" style="margin-top: 5rem">
                    <div class="card-header text-center">
                        CREATE A FLASHCARD
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?=base_url('flashcards/create_flashcards')?>">

                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" placeholder="Flashcard name" name="name" class="form-control" id="name" aria-describedby="name">
                                <?php echo form_error("name", '<p class="text-danger">','</p>');?> 
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" placeholder="Flashcard description" name="description" class="form-control" id="description">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-control" onchange="showQuizFields('quiz-type', 'time-fields', this)">
                                        <option value="QUIZ">Quiz</option>
                                        <option value="REVIEWER">Reviewer</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2" id='quiz-type'>
                                    <label for="qtype">Quiz Type</label>
                                    <select id="qtype" name="qtype" class="form-control">
                                        <option value="POP">Pop</option>
                                        <option value="EXAM">Exam</option>
                                        <option value="ASSIGNMENT">Assignment</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="visibility">Visibility</label>
                                    <select id="visibility" name="visibility" class="form-control">
                                        <option value="PRIVATE">Private</option>
                                        <option value="PUBLIC">Public</option>
                                    </select>
                                </div>

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

                                <div class="form-group col-md-2">
                                    <label for="category">Subjects</label>
                                    <select id="category" name="category" class="form-control">
                                      <--   <option value="">Category 1</option>
                                        <option value="">Category 2</option> ->
                                    <?php 
                                        foreach($categories as $row){ 
                                            echo '<option value="'.$row->name.'">'.$row->name.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <p>needs a script to dynamically add more input fields</p>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="sets">Flashcard Sets</label>
                                    <select id="sets" name="sets" class="form-control">
                                    <option selected="selected" value='-1'> </option>
                                    <?php 
                                        foreach($sets as $row){ 
                                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
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

                            -->
<script>
    function showQuizFields(divID1, divID2, element){
        document.getElementById(divID1).style.display = element.value == "REVIEWER" ? 'none' : 'block';
        document.getElementById(divID2).style.display = element.value == "REVIEWER" ? 'none' : 'block';
    }
</script>
