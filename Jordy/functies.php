<?php
	$connectres = mysqli_connect("localhost","root", "", "cda_db");
		if (mysqli_connect_errno($connectres))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			} /*else { echo "Connection was OK!\n";}*/
			else
			{
			Function loadmenu(){
				$connectres = mysqli_connect("localhost","root", "", "cda_db");
				// Check connection
					$get = mysqli_query($connectres, "select * from PAGES ORDER BY ID ASC");
					While ($row = mysqli_fetch_assoc($get))
						{
							$name = $row["PAGES_DISP"];
							$file = $row["filename"];
							$subitem = $row["subitem"];
								if ($subitem === NULL){
									print "<li><a href=\"$file\">$name</a></li>";
									}
								else
									{
									print "<ul>
									<li><a href=\"$file\">$name</a></li>
									</ul>";
									}
						}
			}
			Function RetrieveLatest(){
				$connectres = mysqli_connect("localhost","root", "", "cda_db");
				print '
						<h1>Home</h1>
							<p>Op deze pagina vindt u de laatste vrijwilligersprojecten in en om Amersfoort</p>
							<div id="bxslider">
								<h2>Fotogallerij</h2>
							</div>
							<h2>Laatst geplaatste Projecten</h2>
							<div class="inhoud">
							<div id="accordion">';
				$get = mysqli_query($connectres, "Select * from projecten order by id_projecten desc limit 5");
				while ($row = mysqli_fetch_assoc($get)){
				$projname = $row["naam_projecten"];
				$projid = $row["id_projecten"];
				$projdata = $row["data_projecten"];
				$projwijk = $row["wijknr_projecten"];
				print '
					<h3>'.$projname.' -- ID '.$projid. ' -- WIJK '.$projwijk.'</h3>
					<div>
						'.$projdata.' <br />
						<a href="#">Bericht plaatsen</a> |  <a href=index.php?pg=edit&id='.$projid.'>Aanpassen</a>
					</div>';
					}
				print '</div>
					   </div>';
			}
			
			Function SaveEdit(){
				if (isset($_POST['verstuur']) ){
					$connectres = mysqli_connect("localhost","root", "", "cda_db");
					$postid = $_GET['id'];
					$newData = $_POST['bewerk'];
					mysqli_query($connectres, "UPDATE 'projecten' SET 'data_projecten'='$newData' WHERE 'id_projecten'='$postid'") or die(mysqli_error($connectres));
					alert("De wijzigingen zijn opgeslagen. U wordt nu doorgestuurd naar de hoofdpagina.");
					header('Location: index.php'); 
					}
				}
			
			Function RetrieveEdit(){
				$connectres = mysqli_connect("localhost","root", "", "cda_db");
				$postid = $_GET['id'];
				if (isset($_POST['verstuur']) ){
					$newData = $_POST['bewerk'];
					mysqli_query($connectres, "UPDATE projecten SET data_projecten='".$newData."' WHERE id_projecten='".$postid."'") or die(mysqli_error($connectres));
					//echo "<script type='text/javascript'>alert('De wijzigingen zijn opgeslagen. U wordt nu doorgestuurd naar de hoofdpagina.')</script>";
					header('Location: index.php'); 
				}else{
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
			 
		//closing of first if statement
		}