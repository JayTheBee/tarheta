<!DOCTYPE html>
<html>
<head> 
    <title>WELCOME TO TARHETA!!!</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
 <div class="container"><br />
           <h3 align="center">TARHETA(FLASH CARDS)</h3><br />
    <div class="panel panel-default">
        <div class="panel-heading">Register</div>
           <div class="panel-body">
		   <form method="POST" autocomplete="off" action="<?=base_url('welcome/Register')?>">
                        <div class="row">
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Username</label>
                            <input type="text" placeholder="Username" name="username" class="form-control" id="username" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" name="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password">
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register Now</button>
                        </div>
	                <p>Already have an account? <a href="<?=base_url('welcome/login')?>">Login here</a>.</p>
					<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
					<?php
						if($this->session->flashdata('error')) {?>
					<p class="text-danger text-center" style="margin-top: 10px;"> <?=$this->session->flashdata('error')?></p>
					<?php } ?>
					<?php
						if($this->session->flashdata('success')) {	?>
						 <p class="text-success text-center" style="margin-top: 10px;"> <?=$this->session->flashdata('success')?></p>
					<?php } ?>
		        </form>
			</div>
			
		</div>
	</div>
</body>
</html>
