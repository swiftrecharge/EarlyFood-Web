<?php 
	//search request from homepage
	include("rating/index.php"); 
	if (isset($_POST['find_food'])) {
		$street_address = $_POST['txtStreetAddress'];
		$post_code = $_POST['txtPostCode']; #will use that later
		if (!empty($street_address)) {
			//there is a value perform query
			$query = "SELECT * FROM restaurant WHERE street_address LIKE '%{$street_address}%' ";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Database connection failed." . mysqli_error($connection));
			}else{
				if (mysqli_num_rows($result)==0) {
					//No results found out put mesage
					echo "No Restaurants Found For Your Search " . $street_address . ". Please Refine Your Search!";
				}else{ ?>

					<div id="searchTag">
		 				<span style="font-size: 30px; padding: 0px;">Restaurants Around <?php echo ucwords($street_address); ?></span>
		 			</div>
		 			<?php
		 				while($values = mysqli_fetch_assoc($result)){ ?>
		 					<form action="cartpage.php" method="get">
								<a href="../cartpage/cartpage.php?id=<?php echo $values["id"]; ?>&name=<?php echo urlencode($values["restaurant_name"]); ?>" >
									<div class="set">
										<div class="set_img">
											<?php
												if ($values["logo"]!="") {
													$image = $values["logo"];
													
													if (file_exists("rlogo/{$image}")) {
														//echo "restaurantspage/rlogo/{$image}";
														echo "<img src=\"rlogo/$image\">";	
													}else{

													}
												}else{
													$image = 1;
													if (file_exists("alogo/{$image}.jpg")) {
														//echo "restaurantspage/alogo/{$image}.jpg";
														echo "<img src=\"alogo/{$image}.jpg\">";	
													}else{
														
													}
													//echo "<img src=\"restaurantspage/alogo/$image\">"; 
												}
											?>
										</div>
										<div class="set_text">
											<span style="font-size: 1.4em; font-weight: bold;"><?php echo $values["restaurant_name"]; ?><span><br />
											<!--<span style="font-size: 0.5em; font-style: italic;"><?php //echo $values["slogan"]; ?><span><br /> -->
											<span style="font-size: 0.7em; font-style: italic;"><?php echo $values["street_address"]; ?></span></div>
									</div>
								</a>
							</form>
						<?php
							} //end of while loop
				}
			}
		}else{
			//redirect_to("../homepage.php");
		}
	}elseif(isset($_POST["findRegion"]) && $_POST["findByRegion"]!=="Select Region") {
	 		 //query to retrieve refined results 
 			$selectedRegion = $_POST["findByRegion"];
 			$query = "SELECT * FROM restaurant WHERE loc_region = '{$selectedRegion}' ";
 			$result = mysqli_query($connection, $query);
 			if (mysqli_num_rows($result)!=0) { ?>
 			<div id="searchTag">
 				<span style="font-size: 30px; padding: 0px;"><?php echo $selectedRegion; ?> Restaurants</span>
 			</div>
 			<?php
 				while($values = mysqli_fetch_assoc($result)){ ?>
 					<form action="../cartpage/cartpage.php" method="get">
						<a href="../cartpage/cartpage.php?id=<?php echo $values["id"]; ?>&name=<?php echo urlencode($values["restaurant_name"]); ?>" >
							<div class="set">
								<div class="set_img">
									<?php
										if ($values["logo"]!="") {
											$image = $values["logo"];
											
											if (file_exists("rlogo/{$image}")) {
												//echo "restaurantspage/rlogo/{$image}";
												echo "<img src=\"rlogo/$image\">";	
											}else{

											}
										}else{
											$image = 1;
											if (file_exists("alogo/{$image}.jpg")) {
												//echo "restaurantspage/alogo/{$image}.jpg";
												echo "<img src=\"alogo/{$image}.jpg\">";	
											}else{
												
											}
											//echo "<img src=\"restaurantspage/alogo/$image\">"; 
										}
									?>
								</div>
								<div class="set_text">
									<span style="font-size: 1.4em; font-weight: bold;"><?php echo $values["restaurant_name"]; ?><span><br />
									<!--<span style="font-size: 0.5em; font-style: italic;"><?php //echo $values["slogan"]; ?><span><br /> -->
									<span style="font-size: 0.7em; font-style: italic;"><?php echo $values["street_address"]; ?></span>
								</div>
								<hr>
								<span><?php //include("rating/index.php"); ?></span>
							</div>
						</a>
					</form>
				<?php
					} //end of while loop
 			}else{
 				echo "Sorry! No Restaurant In This Area is available for Online Ordering At This Time. Check Again Later.";
 			}// end of row checker if

	 	}elseif(isset($_POST['findName'])){
	 		$name = $_POST['findByName'];
	 		if (!empty($name)) {
			//there is a value perform query
			$query = "SELECT * FROM restaurant WHERE restaurant_name LIKE '%{$name}%' ";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Database connection failed." . mysqli_error($connection));
			}else{
				if (mysqli_num_rows($result)==0) {
					//No results found out put mesage
					echo "No Restaurants Found For Your Search " . $name . ". Please Refine Your Search!";
				}else{ ?>

					<div id="searchTag">
		 				<span style="font-size: 30px; padding: 0px;">Restaurants Bearing The Name <?php echo ucwords($name); ?></span>
		 			</div>
		 			<?php
		 				while($values = mysqli_fetch_assoc($result)){ ?>
		 					<form action="cartpage.php" method="get">
								<a href="../cartpage/cartpage.php?id=<?php echo $values["id"]; ?>&name=<?php echo urlencode($values["restaurant_name"]); ?>" >
									<div class="set">
										<div class="set_img">
											<?php
												if ($values["logo"]!="") {
													$image = $values["logo"];
													
													if (file_exists("rlogo/{$image}")) {
														//echo "restaurantspage/rlogo/{$image}";
														echo "<img src=\"rlogo/$image\">";	
													}else{

													}
												}else{
													$image = 1;
													if (file_exists("alogo/{$image}.jpg")) {
														//echo "restaurantspage/alogo/{$image}.jpg";
														echo "<img src=\"alogo/{$image}.jpg\">";	
													}else{
														
													}
													//echo "<img src=\"restaurantspage/alogo/$image\">"; 
												}
											?>
										</div>
										<div class="set_text">
											<span style="font-size: 1.4em; font-weight: bold;"><?php echo $values["restaurant_name"]; ?><span><br />
											<!--<span style="font-size: 0.5em; font-style: italic;"><?php //echo $values["slogan"]; ?><span><br /> -->
											<span style="font-size: 0.7em; font-style: italic;"><?php echo $values["street_address"]; ?></span></div>
									</div>
									<hr>
									<span><?php //include("rating/index.php"); ?></span>
								</a>
							</form>
						<?php
							} //end of while loop
				}
			}
		}else{
			//redirect_to("../homepage.php");
		}

	 	}else{
	 		 // construct query to retrieve restaurants all
	 		?>
	 			<div id="searchTag">
	 				<span style="font-size: 30px; padding: 0px;">Available Restaurants</span>
	 			</div>
	 		<?php
				 $query = "SELECT * FROM restaurant ";
				$result = mysqli_query($connection, $query);
				while($values = mysqli_fetch_assoc($result)){ ?> 
				<form action="../cartpage/cartpage.php" method="GET">
					<a href="../cartpage/cartpage.php?id=<?php echo $values["id"]; ?>&name=<?php echo urlencode($values["restaurant_name"]); ?>">
						<div class="set">
							<div class="set_img">
								<?php
									if ($values["logo"]!="") {
										$image = $values["logo"];
										
										if (file_exists("rlogo/{$image}")) {
											//echo "restaurantspage/rlogo/{$image}";
											echo "<img src=\"rlogo/$image\">";	
										}else{

										}
									}else{
										$image = 1;
										if (file_exists("alogo/{$image}.jpg")) {
											//echo "restaurantspage/alogo/{$image}.jpg";
											echo "<img src=\"alogo/{$image}.jpg\">";	
										}else{
											
										}
										//echo "<img src=\"restaurantspage/alogo/$image\">"; 
									}
								?>
							</div>
							<div class="set_text">
								<span style="font-size: 1.1em; font-weight: bold;"><?php echo $values["restaurant_name"]; ?><span><br />
								<!--<span style="font-size: 0.5em; font-style: italic;"><?php //echo $values["slogan"]; ?><span><br /> -->
								<span style="font-size: 0.7em; font-style: italic;"><?php echo $values["street_address"]; ?></span>
							</div>
							<div>
								<?php include("rating/rate_row.html"); ?>
							</div>
						</div>
					</a>
				</form>
			<?php
				} 
			
	 	}// end of isset if
?>