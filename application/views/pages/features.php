<div class="features container-fluid min-vh-100">
      <div class="row justify-content-center align-items-center">
        <div class="blackboard col-sm-8">
          <img
            src="<?php echo base_url('assets/images/features/blackboard.png');?>"
            class="blackbrd my-1"
            height="500rem"
            width="800rem"
          />
          <div class="feature text-center" id="feature1">
            <img src="<?php echo base_url('assets/images/features/Ikbal.png');?>" class="features-img pt-5" />
            <p class="description py-5">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Aspernatur, accusantium dicta, amet dignissimos, possimus officiis
              quo id provident exercitationem aperiam labore. Sequi libero odio
              cum saepe accusantium enim adipisci voluptatibus.
            </p>
          </div>
          <div class="feature text-center" id="feature2">
            <img src="<?php echo base_url('assets/images/features/Marni.png');?>"  class="features-img pt-5" />
            <p class="description py-5">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo,
              error! Eius perferendis excepturi id magni totam perspiciatis
              odit! Deleniti vero dolorem qui expedita aliquam ducimus debitis
              perferendis error, obcaecati architecto.
            </p>
          </div>
          <div class="feature text-center" id="feature3">
            <img src="<?php echo base_url('assets/images/features/Badrun.png');?>" class="features-img pt-5" />
            <p class="description py-5">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi
              beatae possimus, ullam itaque ea, corrupti earum fuga mollitia
              quae soluta magnam nostrum laborum nisi, facilis a atque nesciunt
              aliquam doloribus.
            </p>
          </div>
        </div>
        <!--col-sm-8-->
        <div class="col-md-4">
          <div class="row">
            <p class="btn my-5" onclick="Show1()">COLLABORATE WITH OTHERS</p>
            <p class="btn my-5" onclick="Show2()">COMPETE WITH ONE ANOTHER</p>
            <p class="btn my-5" onclick="Show3()">STUDY ON THE GO!</p>
            <img class="eye" src="<?php echo base_url('assets/images/features/eye.png');?>" />
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function Show1() {
        document.getElementById("feature1").style.display = "block";
        document.getElementById("feature2").style.display = "none";
        document.getElementById("feature3").style.display = "none";
      }
      function Show2() {
        document.getElementById("feature1").style.display = "none";
        document.getElementById("feature2").style.display = "block";
        document.getElementById("feature3").style.display = "none";
      }
      function Show3() {
        document.getElementById("feature1").style.display = "none";
        document.getElementById("feature2").style.display = "none";
        document.getElementById("feature3").style.display = "block";
      }
    </script>