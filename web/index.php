<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="style/images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>steen admin</title>
<script src="scripts/jquery-2.1.0.js" type="text/javascript"></script> 
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
<script src="scripts/functions.js" type="text/javascript"></script> 
</head>
<body>
<?php
	define("ROOT_DIR", ".");
	// checking for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
			exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			require_once(ROOT_DIR."/libraries/password_compatibility_library.php");
	}
	require_once(ROOT_DIR."/config/db.php");
	require_once(ROOT_DIR."/classes/Login.php");
	require_once(ROOT_DIR."/classes/pageControl.php");
	
	$login = new Login();
?>
	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">
			<?php		
				if ($login->isUserLoggedIn() == true) {
						include("views/admin.php");

				} else {
						include("views/login.php");
				}
			?>
		</div>
	</div>
</body>
</html>