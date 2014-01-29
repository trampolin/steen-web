<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="style.css">
<title>steen admin</title>
<script src="jquery-2.1.0.js" type="text/javascript"></script> 
<script src="functions.js" type="text/javascript"></script> 
</head>
<body>
<?php
	$user = isset($_POST['user']) ? $_POST['user'] : null; 
	$password = isset($_POST['password']) ? $_POST['password'] : null; 
	$loggedin = isset($_POST['loggedin']) ? $_POST['loggedin'] : null; 
	
	echo $user." ".$password." ".$loggedin;

	include_once("functions.php");
	
	$pageControl = new PageControl(true);
	
	//$quicklink = Quicklink::select($pageControl->getDB(),4);//new Quicklink();
	//$quicklink->qltitle = "TEST";
	//$quicklink->qlurl = "TEST";
	//$quicklink->qlorder = 10000;
	//$quicklink->qlcssid = "TEST";
	//$quicklink->qlcssclass = "TEST";
	//$quicklink->active = 0;
	//$quicklink->remove();
	
?>
	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">	
			<?php echo $pageControl->getKachelListHeaderHTML() ?>
			<?php echo $pageControl->getKachelListHTML() ?>
			<?php echo $pageControl->getQuicklinkListHeaderHTML() ?>
			<?php echo $pageControl->getQuicklinkListHTML() ?>
		</div>
	</div>
</body>
</html>