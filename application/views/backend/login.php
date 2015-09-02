<!DOCTYPE HTML>
<html>
<head>
<title>.:: Haijai Management ::.</title>

<link href="<?=base_url()?>assets/css/login.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- -->
<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<img src="<?=base_url()?>assets/images/sagaso-logo.png" />
	</div>
		<form action="<?=base_url()?>control/login" method="post">
			<li>
				<input type="text" class="text" name="username" placeholder="Username"><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input type="text" name="password" placeholder="Password"> <a href="#" class="icon lock"></a>
			</li>
			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" name="bt" value="Sign in" >
				<div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
</body>
</html>