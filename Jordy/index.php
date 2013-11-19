<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">			
			<?php
				include 'functies.php';
				print '
<html>
<head>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<title>Hart voor Amersfoort</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="scripts/global.js"></script>
</head>
<body>
	<div id="header">
		<div id="accountpanel">
		<h2>Account panel</h2>
		</div>
	</div>
	<div id="container">
		<div id="menu">
			<h2>Menu</h2>
						<ul>';
					loadmenu();
					print '
						</ul>
					</div>
					<div id="content">';
								if ((isset($_GET['pg']) && $_GET['pg'] == "home") || !isset($_GET['pg'])){
									RetrieveLatest();
								} else {
									if (isset($_GET['pg']) && $_GET['pg'] == "edit"){
									RetrieveEdit();
									}
									if (isset($_GET['pg']) && $_GET['pg'] == "reply"){
									ReplyMessage();
									}
							}
						?>
					</div>
				<div id="media">
					<p>
					<!--<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/QUINCYEPICNATOR" data-widget-id="348057861043138560">Tweets van @QUINCYEPICNATOR</a>
					<script>!(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://cda.dekoster.tk/quincy/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					-->
					</p>
				</div>
			</div>
		<div id="clear">
		</div>
		<div id="footer">
			<?php
			print'
			<div id="copyright">';
			print 'Copyrights HartvoorAmersfoort '.date('Y').'
			</div>
			<div id="author">
			Webdesign by Jordy &amp; Quincy
			</div>';
			?>
		</div>	
</body>
</html>