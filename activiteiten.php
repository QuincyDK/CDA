<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">			
<html>
<?php	
	include_once 'functies.php';
?>	
	<head>		
		<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>		
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
						if ((isset($_GET['pg']) && $_GET['pg'] == "home") || (!isset($_GET['pg']))){
							print "Klik <a href='activiteiten.php?pg=new'> HIER </a>om een nieuwe activiteit te maken'.";
							
							RetrieveLatestExtra();					
						} 					
						else 
						{	
							if (isset($_GET['pg']) && $_GET['pg'] == "new"){							
								if (isset($_POST['verstuur'])) {
									$connectres = mysqli_connect("localhost","qdekos1q_cda", "cda123", "qdekos1q_cda_db");
									$naam = $_POST['name'];
									$datum = time();
									$titel = $_POST['title'];
									$wijknr = $_POST['wijknr'];
									$newData = $_POST['bewerk'];
									$id = $_SESSION['user_id'];
									mysqli_query($connectres, "Insert into projecten(naam_projecten, data_projecten, wijknr_projecten, gebruiker_projecten, datum_projecten, gebruikerid_projecten)
									values('$titel', '$newData', '$wijknr', '$naam', '$datum', '$id')") or die(mysqli_error($connectres));
									//echo "<script type='text/javascript'>alert('De wijzigingen zijn opgeslagen. U wordt nu doorgestuurd naar de hoofdpagina.')</script>";
									print 'TEST'; 
								} 
								else {
								PlaatsNieuweActiviteit();	
							}			
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