<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="web/style/images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="web/style/style.css">
<title>steen</title>
<script src="web/scripts/jquery-2.1.0.js" type="text/javascript"></script> 
<script src="web/scripts/jquery.vticker.js" type="text/javascript"></script> 
</head>
<body>	

<script>
	$(function() {
		$('#nextgig').vTicker('init', { speed: 1000, pause: 3000,	padding: 10, showItems: 1});
	});
</script>

<?php
	define("ROOT_DIR", "./web");
	require_once(ROOT_DIR."/classes/pageControl.php");
	
	$pageControl = new PageControl(false);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=206800362749008";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

	<div id="everything">
		<div class="innerfull" id="header"></div>
		<div class="innerfull" id="nextgig">
			<?php echo $pageControl->getGigListHTML(); ?>
		</div>
		<div class="innerfull" id="kachelcontainer">
			<?php echo $pageControl->getKachelListHTML(); ?>
		</div>
		<div class="innerfull" id="quicklinks">
			<div id="quicklink-wrapper" style="width: <?php echo $pageControl->getQuicklinkWrapperWidth();?>px">
				<?php echo $pageControl->getQuicklinkListHTML() ?>
			</div>
		</div>
		<div class="innerfull" id="footer">
			<div><a href="mailto:booking@steenband.de">Booking</a></div>
			<div><a href="#">EPK</a></div>
		</div>
	</div>
</body>
</html>