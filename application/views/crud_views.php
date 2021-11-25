<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>	Title</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
	<body>

<?php echo validation_errors(); ?>
<?php echo form_open('crud_controller/register'); ?>

<!-- Forms using bootstrap -->
<!-- codeigniter recognizes input names, no need for post call -->
<div class="text-center">
	<form class="form-signin">
		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<label for="inputEmail" class="sr-only">Username</label>
		<input type="text" class="form-control" name="username" id="inlineFormInputGroup" placeholder="Username">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="password" name="password" class="form-control validate" placeholder="Password">
		<label for="inputPassword" class="sr-only">Confirm Password</label>
		<input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
		
	</form>
</div>
	</body>
</html>

<?php echo form_close(); ?>
