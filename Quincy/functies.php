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
				print '<div id="content">
						<h1>Home</h1>
							<p>Op deze pagina vindt u de laatste vrijwilligersprojecten in en om Amersfoort</p>
							<div id="bxslider">
								<h2>Fotogallerij</h2>
							</div>
							<h2>Laatst geplaatste Projecten</h2>
							<div class="inhoud">';
				$get = mysqli_query($connectres, "Select * from projecten order by id_projecten desc limit 5");
				while ($row = mysqli_fetch_assoc($get)){
				$projname = $row["naam_projecten"];
				$projid = $row["id_projecten"];
				$projdata = $row["data_projecten"];
				$projwijk = $row["wijknr_projecten"];
				print '
					<div class="inhoud">
						<div class="projectnaam">
							<h3>'.$projname.' -- ID '.$projid. ' -- WIJK '.$projwijk.'</h3>
						</div>
						<div class="projectinhoud">
							<h3>'.$projdata.'</h3>
						</div>
						<div class="projectopties">
							<h3><a href="#">Bericht plaatsen</a> |  <a href="#">Aanpassen</a></h3>
						</div>
		`			</div>';
					}
				print '</div></div>';
				
			}
			
			
		//closing of first if statement
		}