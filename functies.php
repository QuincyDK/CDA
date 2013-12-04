<?php
	// include the configs / constants for the database connection
require_once("login/config/db.php");
include_once 'db_connect.php';
require_once("CR.php");
/*require_once("login/libraries/password_compatibility_library.php");*/
require_once("login/classes/Login.php");

	Function ShowOwnProfile(){
		//$connectres = mysqli_connect("localhost","qdekos1q_cda", "cda123", "qdekos1q_cda_db");
		$id = $_SESSION['user_id'];
		$get = mysqli_query($connectres, "select * from users where user_id = $id");
		$row = mysqli_fetch_assoc($get);
		$username = $row['user_name'];
		$voornaam = $row['user_first_name'];
		$achternaam = $row['user_last_name'];
		$geboortedatum = $row['user_birthdate'];
		$adres = $row['user_adress'];
		$postcode = $row['user_zipcode'];
		$stad = $row['user_city'];
		$telefoonnummer = $row['user_phone'];
		if(isset($_POST['verzend'])){
			$voornaam = $_POST['voornaam'];
			$achternaam = $_POST['achternaam'];
			$geboortedatum = date('Y-d-m',strtotime($_POST['geboortedatum']));
			$adres = $_POST['adres'];
			$postcode = $_POST['postcode'];
			$stad = $_POST['stad'];
			$telefoon = $_POST['telefoonnummer'];
			mysqli_query($connectres, "UPDATE users SET user_first_name='$voornaam', user_last_name='$achternaam', user_birthdate='$geboortedatum', user_adress='$adres', user_zipcode='$postcode', user_city='$stad',user_phone='$telefoon' where user_name = '".$_SESSION['username']."'") or die(mysqli_error($connectres));
		}
		if (!isset($_GET['edit'])){
		print"
			<table>
			<tr>
				<td>my-ID</td><td>$id</td>
			</tr>
			<tr>
				<td>Gebruikersnaam</td><td>$username</td>
			</tr>				
			<tr>
				<td>Voornaam</td><td>$voornaam</td>
			</tr>
			<tr>
				<td>Achternaam</td><td>$achternaam</td>
			</tr>
			<tr>
				<td>Geboortedatum</td><td>$geboortedatum</td>
			</tr>
			<tr>
				<td>Adres</td><td>$adres</td>
			</tr>
			<tr>
				<td>Postcode</td><td>$postcode</td>
			</tr>
			<tr>
				<td>Stad</td><td>$stad</td>
			</tr>
			<tr>
				<td>Telefoonnummer</td><td>$telefoonnummer</td>
			</tr>
			</table>
			<a href=\"profielen.php?eigen=ja&edit=true\"> Klik hier om uw profiel te bewerken.</a>";
		}else{
			print "<form name=\"editprofile\" action=\"\" method=\"post\">
				<table>
					<tr>
						<td>Gebruikers-ID</td><td>$id</td>
					</tr>
					<tr>
						<td>Gebruikersnaam</td><td>$username</td>
					</tr>				
					<tr>
						<td>Voornaam</td><td><input type=\"textbox\" value=\"$voornaam\" name=\"voornaam\"/></td>
					</tr>
					<tr>
						<td>Achternaam</td><td><input type=\"textbox\" value=\"$achternaam\" name=\"achternaam\" /></td>
					</tr>
					<tr>
						<td>Geboortedatum</td><td><input type=\"date\" value=\"$geboortedatum\" name=\"geboortedatum\" /></td>
					</tr>
					<tr>
						<td>Adres</td><td><input type=\"textbox\" value=\"$adres\" name=\"adres\" /></td>
					</tr>
					<tr>
						<td>Postcode</td><td><input type=\"textbox\" value=\"$postcode\" name=\"postcode\" /></td>
					</tr>
					<tr>
						<td>Stad</td><td><input type=\"textbox\" value=\"$stad\" \"name=stad\" /></td>
					</tr>
					<tr>
						<td>Telefoonnummer</td><td><input type=\"textbox\" value=\"$telefoonnummer\" name=\"telefoonnummer\" /></td>
					</tr>
				</table>
				<input type=\"submit\" name=\"verzend\" value=\"verzend\" />
				</form>";
		}
	}
 
	function gebruikersProfielen(){
		//$connectres = mysqli_connect("localhost","qdekos1q_cda", "cda123", "qdekos1q_cda_db");
		if((isset($_SESSION['userName'])) && ($_SESSION['userName'] == $_GET['profiel'])){
			ShowOwnProfile($connectres);
		}elseif(!isset($_GET['profiel'])){
			$query = "SELECT * FROM users";
			$result = mysqli_query($connectres, $query);
			echo'
			<table class="tableProfiel">
				<tr>
					<th class="tableProfielInfo">Naam</th>
					<th class="tableProfielInfo">Achternaam</th>
					<th class="tableProfielInfo">woonplaats</th>';
					$login = new Login();
				if ((isset($_SESSION['role'])) && ($_SESSION['role'] == '3') && ($login->isUserLoggedIn() == true)){
				print '
					<th class="tableProfielInfo">telefoonnummer</th>
					<th class="tableProfielInfo">email</th>';
					}
				print'
					<th class="tableProfielInfo">Zie meer</th>
				</tr>';
			while($row = mysqli_fetch_assoc($result)){
				$userID = $row['user_id'];
				$naam = $row['user_first_name'];
				$achternaam = $row['user_last_name'];
				$geboorte = $row['user_birthdate'];
				$adres = $row['user_adress'];
				$postcode = $row['user_zipcode'];
				$woonplaats = $row['user_city'];
				$telefoonnmmr = $row['user_phone'];
				$email = $row['user_email'];
				echo'
				<tr>
					<td class="tableProfielInfo">'.$naam.'</td>
					<td class="tableProfielInfo">'.$achternaam.'</td>
					<td class="tableProfielInfo">'.$woonplaats.'</td>';
				$login = new Login();
				if ((isset($_SESSION['role'])) && ($_SESSION['role'] == '3') && ($login->isUserLoggedIn() == true)){
				echo'
					<td class="tableProfielInfo">'.$telefoonnmmr.'</td>
					<td class="tableProfielInfo">'.$email.'</td>';
					}
				echo'
					<td class="tableProfielInfo"><a href="profielen.php?link=bekijkprofiel&profiel='.$naam.'">Bekijk het profiel</a></td>
				</tr>';
			echo'
				</table>';
			}
		}
		else
		{
			$query = "SELECT * FROM users WHERE user_name = '".stripfordb($connectres, $_GET['profiel'])."'";
			$result = mysqli_query($connectres, $query);			
			$row = mysqli_fetch_assoc($result);
			$naam = $row['user_first_name'];
			$achternaam = $row['user_last_name'];
			$geboorte = $row['user_birth_date'];
			$straatnaam = $row['user_adress'];
			$postcode = $row['user_zipcode'];
			$woonplaats = $row['user_city'];
			$telefoonnmmr = $row['user_phone'];
			$email = $row['user_email'];
			echo'
			<table>			
				<tr>
					<td>Naam:</td>
					<td>'.$naam.'</td>
				</tr>
				<tr>
					<td>Achternaam:</td>
					<td>'.$achternaam.'</td>
				</tr>
				<tr>
					<td>Geboortedatum:</td>
					<td>'.$geboorte.'</td>
				</tr>
				<tr>
					<td>Adres:</td>
					<td>'.$straatnaam.' '.$huisnummer.'</td>
				</tr>
				<tr>
					<td>Postcode:</td>
					<td>'.$postcode.'</td>
				</tr>
				<tr>
					<td>Woonplaats:</td>
					<td>'.$woonplaats.'</td>
				</tr>
				<tr>
					<td>Telefoonnummer:</td>
					<td>'.$telefoonnmmr.'</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>'.$email.'</td>
				</tr>
			</table>
			<a href="profielen.php">Ga terug</a>';			
		}
	}	
				
	Function LoadAdmin(){
	$login = new Login();
		if ($login->isUserLoggedIn() == true) {
			if ($_SESSION['role'] == 1){
				//Do nothing
			}else{
				print"
				<ul id=\"adminpanel\">					
					<li>Overzicht</li>					
					<li>Paginabeheer</li>					
					<li>Gebruikersbeheer</li>			
				</ul>";
			}
		}
	}
	
	Function loadmenu(){
		// include the configs / constants for the database connection
		require_once("login/config/db.php");
		// load the login class
		require_once("login/classes/Login.php");
		global $connectres;
		include "cr.php";
		// Check connection
		$login = new Login();
		if ($login->isUserLoggedIn() == true) {
		$get = mysqli_query($connectres, "select * from pages  where PAGES_DISP != \"Inloggen\" AND PAGES_DISP != \"Registreer\" order by ID ASC;");
		}
		else 
		{
		$get = mysqli_query($connectres, "select * from pages  where PAGES_DISP != \"Uitloggen\" AND PAGES_DISP !=\"Mijn Profiel\" order by ID ASC;");
		}
		While ($row = mysqli_fetch_assoc($get)){
			$name = $row["PAGES_DISP"];
			$file = $row["filename"];
			print "<li><a href=\"$file\">$name</a></li>";
		}
	}			

	Function ShowLogin() {
		print '
		<script type="text/javascript" src="sha512.js"></script>
		<script type="text/javascript" src="forms.js"></script>';
		if(isset($_GET['error'])) { 
		   echo 'Error Logging In!';
		}
			print '
			<form action="process_login.php" method="post" name="login_form">
				Email: <input type="text" name="email" /><br />
				Password: <input type="password" name="p" id="password"/><br />
				<input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
			</form>';
	}

	Function RegistrationPage(){
		print '
			<!--<form method="post" action="login/register.php" name="registerform">  -->
				<form method="Post" action="verify.php" name="registerform">
    				<!-- the user name input field uses a HTML5 pattern check -->
				<label for="login_input_username">Username letters en nummers (2 tot 64 karakters)</label><br  />
				<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /><br />
				
				<!-- the email input field uses a HTML5 email type check -->
				<label for="login_input_email">User\'s email</label>    <br  />
				<input id="login_input_email" class="login_input" type="email" name="user_email" required />        <br  />
				
				<label for="login_input_password_new">Password (min. 6 characters)</label><br  />
				<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  <br  />
				
				<label for="login_input_password_repeat">Repeat password</label><br  />
				<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />     <br  /> 
				<label for="login_input_username">Voornaam</label><br  />
				<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_first_name" required /><br />
				<label for="login_input_username">(tussenvoegsel en) Achternaam</label><br  />
				<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9 ]{2,64}" name="user_last_name" required /><br />';
          require_once('recaptchalib.php');
          $publickey = "6LeIB-kSAAAAAA0LCmyfSFajRlSSKxu7k_LgAVDF"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
		print '
		 <input type="submit"  name="register" value="Register" />
			</form>';
	}

	Function RetrieveLatest(){
	
		global $connectres;
		include "cr.php";
		print '
		<h1>Home</h1>
			<p>Op deze pagina vindt u de laatste vrijwilligersprojecten in en om Amersfoort</p>
		<center>
		<ul class="bxslider">
			<li><img src="/foto/1.jpg" /></li>
			<li><img src="/foto/2.jpg" /></li>
			<li><img src="/foto/3.jpg" /></li>
		</ul>
		</center>
		<script>
		$(document).ready(function(){
			$(\'.bxslider\').bxSlider({
				auto: true,
				pager: true,
				controls: false,
				speed: 1000
			});
		});
		</script>

			<h2>Laatst geplaatste Projecten</h2>
		<div class="inhoud">
		<div id="accordion">';
		$get = mysqli_query($connectres, "Select * from projecten order by id_projecten desc limit 5");
		while ($row = mysqli_fetch_assoc($get)){
			$projname = $row["naam_projecten"];
			$projid = $row["id_projecten"];
			$projdata = $row["data_projecten"];
			$projwijk = $row["wijknr_projecten"];
			$uid = $row['gebruikerid_projecten'];

			print '
			<h3 class="titeldb">'.$projname.' -- ID '.$projid. ' -- WIJK '.$projwijk.'</h3>
			<div>
				'.$projdata.' <br />
				<a href="index.php?pg=reply&id='.$projid.'">Bericht plaatsen</a> |  ';
				if ((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] == $uid)){
				print '<a href=index.php?pg=edit&id='.$projid.'>Aanpassen</a>	|	';
				}
				print '<a href="index.php?pg=reactions&id='.$projid.'">Bekijk en reageer</a>
			</div>';
		}
		print '</div>
			   </div>';

	}	

	Function RetrieveLatestExtra(){
		global $connectres;
		include "cr.php";
		print '
		<h1>Home</h1>
			<p>Op deze pagina vindt u de laatste vrijwilligersprojecten in en om Amersfoort</p>
		<div id="bxslider">
			<h2>Fotogallerij</h2>
		</div>
			<h2>Laatst geplaatste Projecten</h2>
			Hier vind u de 10 laatst geplaatste projecten en kunt u een nieuw project plaatsen
		<div class="inhoud">
		<div id="accordion">';
		$get = mysqli_query($connectres, "Select * from projecten order by id_projecten desc limit 10");
		while ($row = mysqli_fetch_assoc($get)){
			$projname = $row["naam_projecten"];
			$projid = $row["id_projecten"];
			$projdata = $row["data_projecten"];
			$projwijk = $row["wijknr_projecten"];

			print '
			<h3 class="titeldb">'.$projname.' -- ID '.$projid. ' -- WIJK '.$projwijk.'</h3>
			<div>
				'.$projdata.' <br />
				<a href="index.php?pg=reply&id='.$projid.'">Bericht plaatsen</a> |  <a href=index.php?pg=edit&id='.$projid.'>Aanpassen</a>
			</div>';
		}
		print '</div>
			   </div>';

	}		
	Function PlaatsNieuweActiviteit(){
				print '
				<div id="bxslider">
					<h2>Fotogallerij</h2>
				</div>
				<div class="inhoud">
				<form method="post" name="edit" id="edit" action="">';
				// create a login object. when this object is created, it will do all login/logout stuff automatically
				// so this single line handles the entire login process. in consequence, you can simply ...
				$login = new Login();
				// ... ask if we are logged in here:
				if ($login->isUserLoggedIn() == false) {
					print 'Uw naam: <input type="text" id="name" name="name" value="naam" /> <br />';
				} else {
					print 'Uw naam: <input type="text" id="name" name="name" value="'.$_SESSION['full_name'].'" readonly /> <br />';
					}
					print '
					Titel  : <input type="text" id="title" name="title" value="titel" /> <br />
					Wijknr : <input type="text" id="wijknr" name="wijknr" value="wijknr" /> <br  />
					--- De box Naam komt op den duur te vervallen, zodra gebruiker ingelogd is </br>
					--- De box Titel dient ervoor om de gebruiker een titel te laten geven aan de activiteit </br>
					--- De box Wijknr wordt uiteindelijk vervangen door een drop-down box met wijknamen </br>
					<textarea id="bewerk" name="bewerk"></textarea>
					<script type="text/javascript">
					window.onload = function()
					{ 
					CKEDITOR.replace( \'bewerk\' );
					};
					</script>
					<input type="submit" id="verstuur" name="verstuur" value="Sla op!"></input>
				</form>
				</div>';
	
		
	}
		
	Function SaveEdit(){
		if (isset($_POST['verstuur']) ){
			global $connectres;
			include "cr.php";
			$postid = $_GET['id'];
			$newData = $_POST['bewerk'];
			mysqli_query($connectres, "UPDATE 'projecten' SET 'data_projecten'='$newData' WHERE 'id_projecten'='$postid'") or die(mysqli_error($connectres));
			alert("De wijzigingen zijn opgeslagen. U wordt nu doorgestuurd naar de hoofdpagina.");
			header('Location: index.php'); 
		}
	}

	Function ReplyMessage(){
		global $connectres;
		include "cr.php";
		$postid = $_GET['id'];
		if (!isset($_POST['verstuur'])){
			print '<div class="inhoud">';
			$get = mysqli_query($connectres, "Select * from projecten where id_projecten like '".$postid."'");
			while ($row = mysqli_fetch_assoc($get)){
				$projname = $row["naam_projecten"];
				$projid = $row["id_projecten"];
				$projdata = $row["data_projecten"];
				$projwijk = $row["wijknr_projecten"];
				print '
				<div class="projectnaam">
					<h3>'.$projname.' -- ID '.$projid. ' -- WIJK '.$projwijk.'</h3> ONZIN
				</div>
				<div class="projectinhoud">
					'.$projdata.'
				</div>
				<div class="projectopties">
					<h3><a href=index.php?pg=edit&id='.$projid.'>Aanpassen</a></h3>
				</div>
				<form name="reageer" id="reageer" action="">
					Naam: <input type="text" name="naam" id="naam" /></br>
					Reactie: <br /><input type="textarea" id="reactie" naam="reactie" />
				</form>
				<script type="text/javascript">
					window.onload = function()
					{
						CKEDITOR.replace( \'reactie\' );
					};
				</script>
				<input type="submit" id="replymes" name="replymes" value="Sla op!"></input>
				</div>
				</div>';
			}
		} else {
			if (isset($_POST['replymes'])){
			$post = mysqli_query($connectres, 'insert into replies (data_replies, date_replies, post_replies) VALUES('.$_POST['reactie'].', 01-01-0000 00:00:00, '.$projid.')') or die(mysqli_error($connectres));
			}
		}
	}

	Function RetrieveEdit(){
		global $connectres;
		include "cr.php";
		$postid = $_GET['id'];
		if (isset($_POST['verstuur']) ){
			$newData = $_POST['bewerk'];
			mysqli_query($connectres, "UPDATE projecten SET data_projecten='".$newData."' WHERE id_projecten='".$postid."'") or die(mysqli_error($connectres));
			//echo "<script type='text/javascript'>alert('De wijzigingen zijn opgeslagen. U wordt nu doorgestuurd naar de hoofdpagina.')</script>";
			header('Location: index.php'); 
		} else {
			$get = mysqli_query($connectres, "Select * from projecten where id_projecten like '$postid'") or die(mysqli_error($connectres));
			while ($row = mysqli_fetch_assoc($get)){;
				$data = $row["data_projecten"];
				print '
				<div id="bxslider">
					<h2>Fotogallerij</h2>
				</div>
				<div class="inhoud">
				<form method="post" name="edit" id="edit" action="">
					<textarea id="bewerk" name="bewerk">'.$data.'</textarea>
					<script type="text/javascript">
					window.onload = function()
					{ 
					CKEDITOR.replace( \'bewerk\' );
					};
					</script>
					<input type="submit" id="verstuur" name="verstuur" value="Sla op!"></input>
				</form>
				</div>';
			}
		}
	}
	function stripfordb ($connectres, $dbvar){
		//$connectres = mysqli_connect("localhost","qdekos1q_cda", "cda123", "qdekos1q_cda_db");
		$dbvar = mysqli_real_escape_string($connectres, $dbvar);
		$dbvar = stripslashes($dbvar);
		$dbvar = trim($dbvar);
		return $dbvar;
	}
?>	
