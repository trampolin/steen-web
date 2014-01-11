<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="web/images/steen_32x32_schwarz.ico">
<link rel="stylesheet" type="text/css" href="web/style.css">
<title>steen</title>

</head>
<body>
<?php
	include_once("web/functions.php");
	$kacheln = GetKacheln();
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=206800362749008";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div id="everything">
		<div class="innerfull" id="header">
		</div>
		<div class="innerfull" id="kachelcontainer">
			<?php foreach($kacheln as $kachel): ?>
				<div class="<?php echo $kachel->cssclass; ?>" id="<?php echo $kachel->cssid; ?>" <?php echo $kachel->options; ?>>
					<?php echo $kachel->content; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="innerfull" id="quicklinks">
			<a href="http://www.facebook.com/steenband.de" title="Facebook"><div class="smalllink" id="fb"></div></a>
			<a href="http://www.youtube.com/steenband" title="Youtube"><div class="smalllink" id="yt"></div></a>
			<a href="http://www.twitter.com/steenband" title="Twitter"><div class="smalllink" id="tw"></div></a>
		</div>
	</div>
</body>
</html>