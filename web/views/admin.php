
<?php 
	if (isset($login) && $login->isUserLoggedIn() == true)
	{
		if (!isset($pageControl))
		{
			$pageControl = new PageControl(true);
		}
		?>
			<div class='adminkachel' id='messages'>Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in.</div>
		<?php
		echo $pageControl->getKachelListHeaderHTML(); 
		echo $pageControl->getKachelListHTML(); 
		echo $pageControl->getQuicklinkListHeaderHTML();
		echo $pageControl->getQuicklinkListHTML();
		?>
			<div class='adminkachel' ><a href="index.php?logout">logout</a></div>
		<?php
	}
	else
	{
?>
	<div class='adminkachel' id='errors'>Not logged in!</div>
<?php
	};
?>