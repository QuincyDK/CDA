<?php	
include_once 'functies.php';
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">			
<html>
	<head>		
		<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>		
		<title>Hart voor Amersfoort</title>		
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">		
		<script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="scripts/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="scripts/global.js"></script>
		<!-- bxSlider Javascript file -->
		<script src="jquery.bxslider.min.js"></script>
		<!-- bxSlider CSS file -->
		<link href="jquery.bxslider.css" rel="stylesheet" />

	</head>	
	<body>		
		<div id="header"></div>
			<div id="container">			
				<div id="menu">			
TESTt				
					<?php
						print 'test';
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
					<div id="inside">
					<?php
						if ((isset($_GET['pg']) && $_GET['pg'] == "home") || (!isset($_GET['pg']))){
							RetrieveLatest();					
						} 					
						else 
						{						
							if (isset($_GET['pg']) && $_GET['pg'] == "edit"){							
								RetrieveEdit();						
							}						
							if (isset($_GET['pg']) && $_GET['pg'] == "reply"){							
								ReplyMessage();						
							}						
							if (isset($_GET['pg']) && $_GET['pg'] == "inloggen"){
								// include the configs / constants for the database connection
								require_once("login/config/db.php");

								// load the login class
								require_once("login/classes/Login.php");

								// create a login object. when this object is created, it will do all login/logout stuff automatically
								// so this single line handles the entire login process. in consequence, you can simply ...
								$login = new Login();

								// ... ask if we are logged in here:
								if ($login->isUserLoggedIn() == true) {
								// the user is logged in. you can do whatever you want here.
								// for demonstration purposes, we simply show the "you are logged in" view.
								include("login/views/logged_in.php");

								} else {
									// the user is not logged in. you can do whatever you want here.
									// for demonstration purposes, we simply show the "you are not logged in" view.
									echo "Geen geldige login informatie";
								}
	
							}
							if (isset($_GET['pg']) && $_GET['pg'] == "registreer"){
								RegistrationPage();			
							}
							if (isset($_GET['pg']) && $_GET['pg'] == "reactions"){
									$postid = $_GET['id'];
									$post = mysqli_query($connectres, "SELECT * FROM projecten where id_projecten = $postid");
									$post = mysqli_fetch_assoc($post) or die(mysqli_error($connectres));
									$naam = $post['naam_projecten'];
									$data = $post['data_projecten'];
									$wijk = $post['wijknr_projecten'];
									$user = $post['gebruiker_projecten'];
									$datum = $post['datum_projecten'];
									$userid = $post['gebruikerid_projecten'];
									$retrusr = mysqli_query($connectres, "SELECT user_name from users where user_id = $userid");
									$retrusr = mysqli_fetch_assoc($retrusr) or die(mysqli_error($connectres));
									$postuser = $retrusr['user_name'];
									
									print "$naam door <a href=\"profielen.php?link=bekijkprofiel&profiel=$postuser\"> $user</a> op $datum in $wijk<br />";
									print "$data <br />";
									
									$retrep = mysqli_query($connectres, "select * from replies where post_replies=$id") or die(mysqli_error($connectres));
									while (mysqli_fetch_assoc($retrep)){
										$r_id = $retrep['id_replies'];
										$r_data = $retrep['data_replies'];
										$r_user = $retrep['user_replies'];
										$r_uid = $retrep['userid_replies'];
										$r_date = $retrep['date_replies'];
										$r_userquery = mysqli_query($connectres, "SELECT user_name from users where user_id = $r_uid");
										$r_userquery = mysqli_fetch_assoc($r_userquery) or die(mysqli_error($connectres));
										$r_userfull = $r_userquery['user_name'];
										print "<div style=\"border: 1px solid\">
											#$r_id <a href=\"profielen.php?link=bekijkprofiel&profiel=$r_user\"> $r_userfull</a> heeft op $r_date het volgende geplaatst: <br />
											$r_data";
											}
									
									if($_GET['newrec'] == true){
										if(isset($_POST['verstuur'])){
											$newdata = $_POST['bewerk'];
											$usr = $_SESSION['userName'];
											$query = mysqli_query($connectres, "Insert Into replies 
											(data_replies, user_replies, date_replies, post_replies)
											values ($newdata, $usr, SYSDATE, $postid)") or die(mysqli_error($connectres));								
										}
										Print "<form action=\"post\" name=\"newrec\">
										<textarea id=\"bewerk\" name=\"bewerk\"></textarea>
										<script type=\"text/javascript\">
										window.onload = function()
										{ 
										CKEDITOR.replace( \'bewerk\' );
										};
										</script>
										<input type=\"submit\" id=\"verstuur\" name=\"verstuur\" value=\"Sla op!\"></input>
										</form>";
									}

					}
				}
					?>
					</div>
				</div>
				<div  id="media">								
					<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/QUINCYEPICNATOR" data-widget-id="348057861043138560">Tweets van @QUINCYEPICNATOR</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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