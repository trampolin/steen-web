<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="style.css">
<title>steen admin</title>
<script src="jquery-2.1.0.js" type="text/javascript"></script> 
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
<script src="functions.js" type="text/javascript"></script> 
</head>
<body>
<?php
	require_once("pageControl.php");
?>
	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">		
			<div id="login">
				<form action="/" method="post" id="loginform" name="loginform">
				<p>User: <input name="user" type="text" size="12" maxlength="12"><p>
				<p>Password: <input name="password" type="password" size="12" maxlength="12"></p>
				<p><input type="submit" value="Absenden "></p>
				</form>
				
				<script>
					$( "#loginform" ).submit(function( event ) {
						var $form = $( this );
						var $user = $form.find( "input[name='user']" ).val();
						var $passw =  $form.find( "input[name='password']" ).val();
						$passw =  CryptoJS.MD5($passw);
						$passw =  $passw.toString();
						event.preventDefault();
						adminLogin($user,$passw);
					});
				</script>
				
			</div>
			
		</div>
	</div>
</body>
</html>