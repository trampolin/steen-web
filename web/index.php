<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="style.css">
<title>steen admin</title>

</head>
<body>
<?php
	include_once("pageControl.php");
?>
	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">		
			<div id="login">
				<form action="admin.php" method="post">
				<p>User: <input name="user" type="text" size="12" maxlength="12"><p>
				<p>Password: <input name="password" type="password" size="12" maxlength="12"></p>
				<p><input type="submit" value=" Absenden "></p>
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>