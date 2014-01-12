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
	$user = isset($_POST['user']) ? $_POST['user'] : null; 
	$password = isset($_POST['password']) ? $_POST['password'] : null; 
	$loggedin = isset($_POST['loggedin']) ? $_POST['loggedin'] : null; 
	
	echo $user." ".$password." ".$loggedin;

	include_once("functions.php");
	$kacheln = GetKacheln(true);
?>
	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">		
		
			<?php foreach($kacheln as $kachel): ?>
				<div class="adminkachel <?php echo $kachel->active ? "active" : " inactive";?>">
					<span><?php echo $kachel->kachelname; ?></span>
				</div>
			<?php endforeach; ?>
			
		</div>
	</div>
</body>
</html>