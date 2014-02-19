<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="web/images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="web/style.css">
<title>steen</title>
<script src="web/jquery-2.1.0.js" type="text/javascript"></script> 
<script src="web/jquery.vticker.js" type="text/javascript"></script> 
</head>
<body onload="$(function() {
  $('#nextgig').vTicker('init', 
		{
			speed: 400, 
			pause: 4000,
			padding: 10,
			showItems: 1
		}
	);
});">
<?php
	include_once("web/pageControl.php");
	
	$pageControl = new PageControl(false);
	
	//$kacheln = GetKacheln();
	//$quicklinks = GetQuicklinks();
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
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="nextgig">
			<?php echo $pageControl->getGigListHTML(); ?>
			<!--ul class="gigtickeritemscontainer innerfull">
				<li class="gigtickeritem">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</li>
				<li class="gigtickeritem">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</li>
				<li class="gigtickeritem">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</li>
			</ul-->
		</div>
		<div class="innerfull" id="kachelcontainer">
			<?php echo $pageControl->getKachelListHTML(); ?>
		</div>
		<div class="innerfull" id="quicklinks">
			<div id="quicklink-wrapper" style="width: <?php echo $pageControl->getQuicklinkWrapperWidth();?>px">
				<?php echo $pageControl->getQuicklinkListHTML() ?>
			</div>
		</div>
	</div>
</body>
</html>