<!--home-->
<section id="home-page-1">
    <div class="home-bg">
        <div class="mx-3">
            <img src="<?php echo base_url("assets/images/home/home_bg.png"); ?>" class="float-left position-absolute wave-size">
            <div class="row positionZ">
                <div class="col-6 hText-padding-top px-md-4">
                    <div class="d-flex align-content-center flex-column ">
                        <div class="home-text">
                            <h1>Study Anywhere, Anytime & Grow Your Skills</h1>
                        </div>
                        <div>
                            <!--just to make the get started button not occupying the full width-->
                            <a class="btn btn-bd-getStarted rounded-pill" href="<?php echo base_url("home/#home-page-2"); ?>" role="button">Get Started></a>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="img-size-girl mx-5 pt-2">
                        <img src="<?php echo base_url("assets/images/home/home-girl.png"); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- features page -->
<section id="home-page-2" class="home-bg">

    <div id="carouselwithIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="container">
            <div class="carousel-indicators position-absolute">
                <button type="button" data-bs-target="#carouselwithIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselwithIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselwithIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>

        <div class="carousel-inner position-absolute">
            <div class="container position-relative">
                <div class="carousel-item active">
                    <img src="<?php echo base_url('assets/images/features/collaborate.png'); ?>" class="features-img" alt="...">
                    <div class="carousel-caption d-none d-md-block desc">
                        <h3 class="text-decoration-underline py-2">&nbsp;COLLABORATE WITH OTHERS&nbsp;</h3>
                        <p class="text-center py-2">
                            Integrating collaborative activities into an online classroom improves student performance. Collaborative group interactions promote social connection, a friendly eLearning community, active learning, and knowledge sharing.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url('assets/images/features/compete.png'); ?>" class="features-img" alt="...">
                    <div class="carousel-caption d-none d-md-block desc">
                        <h3 class="text-decoration-underline py-2">&nbsp;COMPETE WITH ONE ANOTHER&nbsp;</h3>
                        <p class="text-center py-2">
                            Tarheta© participants compete against each other to bring out a competitive spirit and create a fun experience! The development of collaborative online discussions requires that instructors allot sufficient time for student discourse and moderation.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url('assets/images/features/go.png'); ?>  " class="d-block features-img" alt="...">
                    <div class="carousel-caption d-none d-md-block desc">
                        <h3 class="text-decoration-underline py-2">&nbsp;STUDY ON THE GO!&nbsp;</h3>
                        <p class="text-center py-3">
                            Tarheta© creates an effective learning tools that allows you to study anything anytime at anywhere. Start studying right now with flashcards, quiz mode, and many more. - all for free!
                        </p>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselwithIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselwithIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <img src="<?php echo base_url('assets/images/features/features-wave.png'); ?>" class="wave-size" />
        <img src="<?php echo base_url('assets/images/features/blackboard.png'); ?>" class="position-absolute start-50 top-50 translate-middle blackbrd">

    </div>

</section>

<!-- developers page -->
<section id="home-page-3" class="dev-custom h-auto">
    <img src="<?php echo base_url("assets/images/developers/molecule.png"); ?>" class="position-absolute molecule" alt="...">
    <div class="bg-blue">
        <img src="<?php echo base_url("assets/images/developers/Vector 14.png"); ?>" class="position-absolute cust-wave-size" alt="...">

        <div class="mx-auto px-5 py-5">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/jediboy.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">JEDIBOY BETOS</h5>
                            <p class="card-text text-center">jediboy.betos@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/53ndNVD35"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/JayTheBee"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <i class="fab fa-linkedin fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/camille.jpeg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">ALLIYAH CAMILLE GONZALES</h5>
                            <p class="card-text text-center">alliyahcamille.gonzales@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/allyxgnzls/"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/alliyahh"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/alliyah-gonzales-ba4405192/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/loryvi.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">LORYVI GRACE LEOGO</h5>
                            <p class="card-text text-center">loryvigrace.leogo@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/Lgleogo"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/loryvi"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/loryvi/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/kenshiro.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">KENSHIRO NONAN</h5>
                            <p class="card-text text-center">kenshiro.nonan@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/knonan2"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/kenblader"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/kenshiro-nonan-8ab77622a/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/tarun.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">DAN MATTHEW TARUN</h5>
                            <p class="card-text text-center">danmatthew.tarun@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/agpalaban.red"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/Tarun1-afk"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/dan-matthew-tarun-8bb06b22b/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/ryl.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">RYLDALE TORRES</h5>
                            <p class="card-text text-center">ryldale.torres@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/rylgeeel"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/ryldale"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/ryldale-torres-65509122b/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/jon.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">JON PATRIX VELASCO</h5>
                            <p class="card-text text-center">jonpatrix.velasco@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/madkiller11"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/jon-velasco"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/jon-velasco-732092229/"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url("assets/images/developers/ramon.jpg"); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">KYLE RAMON ZANTE</h5>
                            <p class="card-text text-center">kyleramon.zante@tup.edu.ph</p>
                            <div class="text-center">
                                <a href="<?php echo "https://www.facebook.com/KRZante"; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="<?php echo "https://github.com/krzante"; ?>" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                                <a href="<?php echo "https://www.linkedin.com/in/ramon-zante-b6009022b"; ?>" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>

<section id="home-page-4" class="h-auto">
    <div class="home-darkbrown-bg">
        <img src="<?php echo base_url("assets/images/contact/contact-wave.png"); ?>" class="position-absolute wave-size-2 w-100" style="background-size: cover;" alt="...">
        <img src="<?php echo base_url("assets/images/contact/friends.png"); ?>" class="position-absolute friends" alt="...">

        <div class="container contact py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 py-3">
                    <div class="section-title text-center">
                        <h2 class="text-capitalize fw-bold mb-4 text-light">Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="contact-item row d-flex">
                        <div class="icon fs-2 text-light">
                            <i class="far fa-envelope"></i>
                            <h4 class="fs-3 text-light" style="display: inline-table;">Email</h4>
                            <p class="text-light">tarheta.app@gmail.com</p>
                        </div>
                        <div class="icon fs-2 text-light">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3 class="fs-3 text-light" style="display: inline-table;">Location</h3>
                            <p class="text-light">Technological University of the Philippines, Ermita, Manila</p>

                        </div>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="contact-form">
                        <form method="POST" autocomplete="off" action="<?=base_url('user/profile/contact_us')?>">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <input type="text" name="user_name" id="user_name" placeholder="Your Name" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <input type="email" name="user_email" id="user_email" placeholder="Your Email" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <input type="text" name="subject" id="subject" placeholder="Subject" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <textarea placeholder="Your Message" name="message" id="message" class="form-control form-control-lg fs=6 border-0 shadow-sm" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <button class="btn btn-contact" type="submit">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>

<div class="modal" tabindex="-1" id="notifModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <?php
        if ($this->session->flashdata('success')) { ?>
            <p class="text-success" style="margin-top:2rem"> <?= $this->session->flashdata('success') ?> </p>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#notifModal').modal('show');
                });
            </script>
        <?php } ?>

        <?php
        if ($this->session->flashdata('error')) { ?>
            <p class="text-danger" style="margin-top:2rem"> <?= $this->session->flashdata('error') ?> </p>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#notifModal').modal('show');
                });
            </script>
        <?php } ?>
      </div>
    </div>
  </div>
</div>