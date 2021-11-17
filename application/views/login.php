<!DOCTYPE html>
<html>
<head> 
    <title>WELCOME TO TARHETA!!!</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /></head>
<body>
 <div class="container"><br />
           <h3 align="center">TARHETA(FLASH CARDS)</h3><br />
    <div class="panel panel-default">
        <div class="panel-heading">Login</div>
           <div class="panel-body">
                <form method="post" autocomplete="off" action="<?=base_url('welcome/loginnow')?>">
				        <div class="mb-3">
                            <label for="exampleInputEmail1" name="email" class="form-label">Email</label>
                            <input type="email" placeholder="Email Address" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
                        </div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Login Now</button>
					</div>
					<p>Don't have an account? <a href="<?=base_url('welcome/index')?>">register now.</a>.</p>
					<?php
						if($this->session->flashdata('error')) {	?>
						 <p class="text-danger text-center" style="margin-top: 10px;"> <?=$this->session->flashdata('error')?></p>
					<?php } ?>
				</form>
			</div>
	    </div>
    </div>
</body>
</html>
