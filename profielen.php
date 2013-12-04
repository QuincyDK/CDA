<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">			
<html>
<?php	
	include_once 'functies.php';
?>	
	<head>		
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>		
		<title>Hart voor Amersfoort</title>		
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">		
		<script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="scripts/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="scripts/global.js"></script>	
	</head>	
	<body>		
		<div id="header"></div>
			<div id="container">			
				<div id="menu">					
					<?php
						LoadAdmin();
					?>
					<h2>Menu</h2>				
					<ul id="ulmenu">					
						<?php						
							loadmenu();					
						?>				
					</ul>
				</div>			
				<div id="content">									
					<?php
						if (!isset($_GET['eigen'])){
						gebruikersProfielen();
						print "</div>";
							}
							else
							{
							if($_GET['eigen'] == "ja"){
							ShowOwnProfile();
							}
							}
					?>
				</div>
				<div id="media">				
					<p>					
						<!--<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/QUINCYEPICNATOR" data-widget-id="348057861043138560">Tweets van @QUINCYEPICNATOR</a>						
						<script>!(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://cda.dekoster.tk/quincy/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>					-->				
					</p>			
				</div>		
			</div>		
			<div class="clear">
			</div>		
			<div id="footer">			
				<div id="copyright">				
					<?php					
						print 'Copyrights HartvoorAmersfoort '.date('Y');				
					?>			
				</div>			
				<div id="author">				
					Webdesign by Jordy &amp; Quincy			
				</div>	
			</div>		
		</body>
</html>