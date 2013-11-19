<?php
include 'functies.php';
print '
<html>
<head>
<title>Hart voor Amersfoort</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
</head>
<body>
	<div id="accountpanel">
		<h2>Account panel</h2>
	</div>
	<div id="header">
		<img src="lay/header.jpg" width="1024" height="150" alt="header"/>
	</div>
	<div id="container">
		<div id="menu">
			<h2>Menu</h2>
			<ul>';
			loadmenu();
			print '
			</ul>
		</div>';
		if ((isset($_GET['pg']) && $_GET['pg'] == "home") || (!isset($_GET['pg']))){
		retrieveLatest();
		}
		?>
		<div id="media">
		<a class="twitter-timeline" data-dnt="true" style="display:table-cell;" href="https://twitter.com/QUINCYEPICNATOR" data-widget-id="348057861043138560">Tweets van @QUINCYEPICNATOR</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		</div>
		<div id="clear">
		</div>
		<div id="footer">
			<div id="copyright">
			<?php echo'Copyrights hartvooramersfoort '.date('Y')?>
			</div>
			<div id="author">
			Webdesign by Jordy &amp; Quincy
			</div>
		</div>
</body>
</html>