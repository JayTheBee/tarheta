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
                    <div data-functional-selector="question-countdown__count" aria-live="polite" class="fcTimer">0s
                    </div>
                </div>

                <!-- MEDIA -->
                <div class="fcMedia-pos col-4">
                    <img class="fcMedia" aria-live="assertive" role="status" src="<?php echo base_url("assets/images/flashcard/flashcard_media.png"); ?>"
                        aria-label="" data-functional-selector="media-container__media-image">
                </div>
                
                <!-- Std Answering -->
                <div class="Answer-pos AnswersBox col-4">
                    <div class="Answer-des px-2 py-4" data-functional-selector="answer-count">
                        <div data-functional-selector="answer-count-received" class="Answer-no">56</div>
                        <div data-functional-selector="answer-count-title" class="Answer-word">Answers</div>
                    </div>
                </div>
            </div>

            <!-- Choices -->
            <div class="FcChoices-pos">
                <div class="d-flex justify-content-center">
                    <textarea class="md-input inputDes" name="s_bio" cols="30"
                        placeholder="Enter answer here..."></textarea>
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>

                <!-- Next Button -->
                <div class="d-flex flex-row-reverse">
                    <button class="buttons fcNext-button">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

            </div>
        </div>
    </section>