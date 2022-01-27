<!--flashcard-->
    <section class="flashcard-bg">
        <img src="<?php echo base_url("assets/images/flashcard/flashcard_wave.png"); ?>" class="position-absolute img-responsive flashcard-wave" alt="...">

        <!-- Question -->
        <div class="container flashcardBg-design position-relative">
            <div class="fcQuestion-box">
                <div class="fcQuestion-design">
                    <span class="fcQuestion">QUESTION</span>
                </div>
            </div>
    
            <div class="fcTimeMedia-pos fcTimeMedia-design">
                <!-- TIMER -->
                <div class="fcTimer-pos col-4" data-functional-selector="question-countdown">
                    <div data-functional-selector="question-countdown__count" aria-live="polite" class="fcTimer">0s</div>
                </div>
                
                <!-- MEDIA -->
                <div class="fcMedia-pos col-4">
                    <img class="fcMedia" aria-live="assertive" role="status"
                        src="<?php echo base_url("assets/images/flashcard/flashcard_media.png"); ?>" aria-label=""
                        data-functional-selector="media-container__media-image">
                </div>
            </div>
        
            <!-- Choices -->
            <div class="FcChoices-pos">
                <div class="fcChoice-row">
                    <!-- For Choice A and B-->
                    <!-- Choice A-->
                    <div class="fcChoice boxes" data-functional-selector="answer-0" data-mapped-index="0" dir="ltr">
                        <div class="fcBox fcBoxA-color">
                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                <p class="text-ABCD">A.</p>
                            </span>
                        </div>
            
                        <span data-functional-selector="question-choice-text-0" class="fcText-answers"><span>Answer 1</span></span>
                    </div>
            
                    <!-- Choice B-->
                    <div class="fcChoice boxes" data-functional-selector="answer-1" data-mapped-index="1" dir="ltr">
                        <div class="fcBox fcBoxB-color">
                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                <p class="text-ABCD">B.</p>
                            </span>
                        </div>
            
                        <span data-functional-selector="question-choice-text-1" class="fcText-answers"><span>Answer 2</span></span>
                    </div>
                </div>
            
                <div class="fcChoice-row">
                    <!-- For Choice C and D-->
                    <!-- Choice C -->
                    <div class="fcChoice boxes" data-functional-selector="answer-2" data-mapped-index="2" dir="ltr">
                        <div class="fcBox fcBoxC-color">
                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                <p class="text-ABCD">C.</p>
                            </span>
                        </div>
            
                        <span data-functional-selector="question-choice-text-2" class="fcText-answers"><span>Answer 3</span></span>
                    </div>
            
                    <!-- Choice D -->
                    <div class="fcChoice boxes" data-functional-selector="answer-3" data-mapped-index="3" dir="ltr">
                        <div class="fcBox fcBoxD-color">
                            <span class="style" style="display: inline-block; vertical-align: middle;">
                                <p class="text-ABCD">D.</p>
                            </span>
                        </div>
            
                        <span data-functional-selector="question-choice-text-3" class="fcText-answers"><span>Answer 4</span></span>
                    </div>
                </div>


                <!-- Next Button -->
                <div class="d-flex flex-row-reverse">
                    <button class="buttons fcNext-button">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

            </div>
        </div>
    </section>