<head>
<style>
    .vrfy-container {
        background-color: #52888A;
        padding: 0;
        margin: 0;
        background-image: url("<?php echo base_url("assets/images/accType/teacher_student_wave.png");?>");
    }

    .boxPosvrfy {
        position: absolute;
        width: 50rem;
        top: 8%;
        left: 20%;
        z-index: 1;
    }
    .boxPosvrfy .card{
        padding: 2% 15% 5% 15%;
        background-color: rgba(	112,95,	89, 0.74);
        border-radius: 32px;
        align-items: center;
    }

    .boxPosvrfy .card p {
        font-family: "Poppins";
        font-size: 2em;
        font-weight: 900;
    }

    .btnvrfy-login{
        background-color: #175561;
        color: #fff;
        font-size: 1.2em;
        border-radius: 20px;
        padding: 5px 25px 5px 25px;
    }

</style>
</head>


<section class="vrfy-container vh-100 w-100">
    <div class="boxPosvrfy position-relative justify-content-center">
    <div class="card">
    <p> YAY! </p>
    <img src="<?php echo base_url("assets/images/login/verified.png");?>" width="300" alt="verified account">
    <p>Your Account has been Verified.</p>
    <button type="button" class="btn btnvrfy-login " onclick="window.location='<?php echo site_url("login"); ?>'" >LOGIN</button>
    </div>
    </div>
</section>