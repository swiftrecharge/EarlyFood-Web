<?php ob_start(); ?>
<?php session_start();  ?>
<?php require_once("members.process.php"); // important to bring this here ?> 
<?php 
	if (!isset($_SESSION["logged_user_id"])) {
		redirect_to("../loginpage/login.php");
	}
?>
<?php require_once("members.wallet.process.php"); ?>
<?php include("../includes/layout/header.php"); //header file ?>
<script type="text/javascript" src="js/js.js"></script>
<link rel="stylesheet" type="text/css" href="css/memberspage.css">	
<section id = "member_wrapper" class="row">
	<div id="welcome_member" class="row">
		<div id="logout_user">
			<form action="logout.php" method="post">
				<input type="submit" value ="Logout" name ="logout">
			</form>
		</div>
		<div id="welcome_user"><span>Welcome</span>
			<?php 
				$id = $_SESSION["logged_user_id"];
				$first_name = $member -> first_name($id);
				echo ucfirst($first_name);
			?></div>
	</div>
	<div id="left_right" class="">
		<div id="left" class="col-lg-9 col-md-9 col-sm-8">
			<div id="current_orders">
				<div id="shipping">
					<article id="article1_shipping">
						<table class="table table-condensed table-striped table-bordered">
								
							<center><span id="cSpan">Current Orders</span></center><br /><br />
							<tr>
								<th>
									<div id="article1_shipping_item" class="shipping_items_header">
										<span>Food Item</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_price" class="shipping_items_header">
										<span>Price/Item(GHC)</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_qty" class="shipping_items_header">
										<span>Quantity</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_totalPrice" class="shipping_items_header">
										<span>Total Cost</span>
									</div>
								</th>
							</tr>
						<?php
							$id = $_SESSION["logged_user_id"];
							//construct query to retrieve menu items ordered
							$result = $orders -> current_orders($id);
							while ($value = mysqli_fetch_assoc($result)){	
								// this closes the if statement?>
								<tr ALIGN="center">
									<td>
										<div id="article1_shipping_item" class="shipping_items">
											<span><?php echo $value['food_item']; ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_price" class="shipping_items">
											<span><?php printf("%.2f", $value['price']); ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_qty" class="shipping_items">
											<span><?php echo $value['qty_ordered']; ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_totalPrice" class="shipping_items">
											<span><?php printf("%.2f", $value['total_cost']); ?></span>
										</div>
									</td>
								</tr>
									
								<?php // this opens the if statement
							}//while loop
					
						// this closes the session checking if?>
								<tr>
									<?php 
										$id = $_SESSION["logged_user_id"];
										$total_shipping_cost = $orders -> shipping_cost($id);
										$total_cost = $orders -> total_cost($id);
									?>
									<td><span style="font: 1.2em Tahoma; text-align: left;">Shipping Cost = GHC <?php printf("%.2f", $total_shipping_cost); ?></span></td>
									<td colspan="2"><span style="font: 1.2em Tahoma; text-align: left;">Overall Cost  = GHC <?php printf("%.2f", $total_shipping_cost + $total_cost) ?></span></td>
								</tr>
							</table>
						</article>
					</div>
			</div><br /><br />

			<center><span id="cSpan" styele="text-align: center">Your Previous Orders</span></center>
			<div id="previous_orders" class="row">
				<?php 
					$id = $_SESSION["logged_user_id"];
					$result = $orders -> previous_orders($id);
					if(mysqli_num_rows($result)!=0){
						while ($value = mysqli_fetch_assoc($result)) {?>
							<div class="details col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-7"><?php echo $value['food_item']. " From ". $value['restaurant_name']; ?></div>
							<div class="option col-lg-4 col-lg-offset-1 col-md-4 col-md-offset col-sm-4 col-sm-offset-1">
								<a href="#">Re-Order</a>
							</div>
						<?php
						}
					}else{
						echo "<center><i>.......you have no previous orders.........</i></center><br /><br />";
					}
				?>
			</div>
			<div id="place_orders" class="jumbotron col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-2">
				<center><a href="../restaurantspage/restaurants.php">Place a new Order</a></center>
			</div>
		</div>

		<div id="right" class="col-lg-3 col-md-3 col-sm-4">
			<div id="update_details">Update Your Info.
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#mail" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Email Address</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="mail">
							<div class="panel_body">
								<br />
								<form action="membersupdate.php" method="post">
									<span>
										<input type="text" name="mail_address" />
									</span>
									<input class="btn btn-warning" type="submit" name="email" value="Update" onclick="toggleChat();"/>
								</form>
								<br />
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#password" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Password</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="password">
							<div class="panel_body">
								<br />
								<form action="membersupdate.php" method="post">
									<span>
										<input type="text" name="password_old" placeholder="Current Password" /><br /><br />
										<input type="text" name="password_new" placeholder="New Password"/><br /><br />
									</span>
									<input class="btn btn-warning" type="submit" name="pass" value="Update" />
								</form>
								<br />
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#phone_number" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Phone Number</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="phone_number">
							<div class="panel_body">
								<br />
								<form action="membersupdate.php" method="post">
									<span>
										<input type="text" name="phone" id = "phone" onkeyup = "digitsNumerals();" onchange = "phoneDigits();"/>
									</span>
									<input class="btn btn-warning" type="submit" name="phone_update" value="Update" />
								</form>
								<br />
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#address" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Address</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="address">
							<div class="panel_body">
								<br />
								<form action="membersupdate.php" method="post">
									<span>
										<textarea name="address"></textarea><br /><br />
									</span>
									<input class="btn btn-warning" type="submit" name="address_update" value="Update" />
								</form>
								<br />
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#occupation" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Occupation</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="occupation">
							<div class="panel_body">
								<br />
								<form action="membersupdate.php" method="post">
									<span>
										<input type="text" name="occu" />
									</span>
									<input class="btn btn-warning" type="submit" name="occu_update" value="Update" />
								</form>
								<br />
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="#notifs" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Notifications</a>
							</h1>
						</div>
						<div class="panel-collapse collapse" id="notifs">
							<div class="panel_body">
								<form action="membersupdate.php" method="post">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="coupon_code">

				<span>Current Coupon Codes </span><br /><br />
				<?php 
					$message = $member -> sign_up_bonus($id);
					if ($message!="") {
						echo "<image src=\"images/new_blink.gif\" /> " . $message;
					}else{
						echo ".....You have not won a coupon yet...."; 
					}
				?>

			</div><br />
			<div id="gift_cert"><a href="../certificates/gift.php" class="btn btn-warning">Buy a Gift Certificate</a></div>
		</div>
	</div>
</section>
<article id="wallet" class="row">
	<center><h2><span>Your EarlyFood Wallet</span><h2></center><br />
	<table class="table table-condensed table-striped table-bordered">
		<tr>
			<th>
				<div class="shipping_items_header">
					<span>Date</span>
				</div>
			</th>
			<th>
				<div class="shipping_items_header">
					<span>Description</span>
				</div>
			</th>
			<th>
				<div class="shipping_items_header">
					<span>Transaction Amount(GHC)</span>
				</div>
			</th>
			<th>
				<div class="shipping_items_header">
					<span>Transacton <br /> Fee(GHC)</span>
				</div>
			</th>
		</tr>							
			<?php 
				$result = $coupon -> get_transactions($id);
				while($value = mysqli_fetch_assoc($result)){
					?> 

					<tr>
						<td><?php echo $value['transaction_time'] ?></td>
						<td><?php echo $value['transaction_details'] ?></td>
						<td><?php printf('%.2f', $value['transaction_amount']) ?></td>
						<td><?php printf('%.2f', $value['transaction_charges']) ?></td>
					</tr>

					<?php
				}
			?>
	</table>
	<br />
	<span style="font: 1.5em Tahoma;"><?php echo "Available Balance In Your Wallet: GHS";  printf('%0.2f',$coupon -> get_existing_balance($id)); ?></span>
	<br /><br />

	<div id="update_details">
		<div class="panel-group" id="accordion2">
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#depositmoney" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse"><span class="glyphicon glyphicon-usd"></span><span class="glyphicon glyphicon-usd"></span>Deposit Money Into Your Wallet</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="depositmoney">
					<div class="panel_body">
						<br />
						<?php 
							if(!isset($_SESSION["deposit_invoice"])){
							   $merchant_key = "dbf84458-212f-11e7-bf7c-f23c9170642f";
							    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							    $charactersLength = strlen($characters);
							    $randomString = '';
							    for ($i = 0; $i < 25; $i++) {
							        $randomString .= $characters[rand(0, $charactersLength - 1)];
							    }
							    $_SESSION["deposit_invoice"] = $randomString;
							}

						?>
				
				        <script type="text/javascript">
				            function setVisibility() {
				                document.getElementById('iframe1').style.display = "block";
				                document.getElementById('form_1').style.display = "none";
				            }
				            </script>
				            <style type="text/css">
				            #iframe1 {
				                display:none;
				            }
				        </style>
				        <noscript>
				            <style type="text/css">
				            #iframe1 {
				                display:block;
				            }
				            #loadImg{
				            	position:absolute;z-index:999;
				            }
							#loadImg div{
								width:100%;
								height:350px;
								background:#fff;
								text-align:center;
								vertical-align:middle;
							}
				            </style>
				        </noscript>
				   	<div style="font:0.7em Tahoma; padding:10px; text-align:center">
				   		<div id="loadImg" style="display:none">
						     <img src="images/loading1.gif" alt="Loading" id="imgLoad" style="width:100%;"/>
						</div>
				        <iframe src="about:blank" name="myFrame" width="100%" height="350" scrolling="auto" frameborder="0" id="iframe1">

				        </iframe>
			            <form method="POST" action="https://community.ipaygh.com/gateway" target="myFrame" id="form_1">
				            <input type="hidden" name="merchant_key" value="dbf84458-212f-11e7-bf7c-f23c9170642f" />
				            <input type="hidden" name="success_url" value="https://earlyfood.com/userwallet/paymentstatus.php" />
				            <input type="hidden" name="cancelled_url" value="https://earlyfood.com/userwallet/paymentstatus.php" />
				            <input type="hidden" name="deferred_url" value="" />
				            <input type="hidden" name="ipn_url" value="https://earlyfood.com/userwallet/paymentstatus.php" />
				            <span id="inv_id" style="display:none;">
				            	Invoice ID <input type="text" name="invoice_id" value="<?php echo $_SESSION["deposit_invoice"];  ?>" style="font:0.7em Tahoma;" />
				            </span><br /><br />
				           <?php //echo $_COOKIE["xyz"]; ?>
	                       <select id="mpower_deposit_option" name="total">
								<option>Amount To Deposit (GH&cent)</option>
									<?php 
										for ($i=10; $i <=100 ; $i+=5) { 
											echo "<option>" . $i ."</option>";
										}
									?>
							</select><br /><br />
							<input type="hidden" value="" name="myTotal" id="myTotal">
							<span id="display_acceptance"></span><br /><br />
							<input type="submit" name="txtDeposit" value = "Deposit" onclick="setVisibility();" id="txtDeposit" style="display:none;"/>	                    
			            </form>
				      </div>
						<br />
						<script type="text/javascript">
							//this take care of amount selected
							jQuery(document).ready(function($){
								$('#mpower_deposit_option').change(function(){
									var amount = $('#mpower_deposit_option').val();
									//alert(amount);
									if (amount !=="Select Amount To Deposit (GHC)") {
										//valid amount
										$.post("sessions.php", { "xyz":amount });
										statement = "Deposit GHS" + amount + ".00" + " Into My EarlyFood Wallet? ";
										$('#display_acceptance').text(statement); 
										$('#txtDeposit').removeAttr('style');
										$('#inv_id').removeAttr('style');
										//set cookie
										var name = "xyz";
										var value = amount;
										var days = 1;
									    var expires = "";
									    if (days) {
									        var date = new Date();
									        date.setTime(date.getTime() + (days*24*60*60*1000));
									        expires = "; expires=" + date.toUTCString();
									    
									    document.cookie = name + "=" + value + expires + "; path=/";
									}
}
								});

								$('#txtDeposit').click(function(){
									$('#loadImg').attr('style', 'block');
									$('#iframe1').attr('height', '0');
									$('#iframe1').attr('width', '0');
									$('#iframe1').load(function(){
									$('#loadImg').remove();
									$('#iframe1').attr('height', '350px');
									$('#iframe1').attr('width', '100%');

									})
								})
							});
							jQuery(window).load(function(){
								
							 });
						</script>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#loadcouponpersonal" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse">Load A Coupon To Your Wallet</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="loadcouponpersonal">
					<div class="panel_body">
						<br />
						<?php if(isset($mess)){echo $mess;} ?>
						<br /><br />
						<form action="members.php" method="post">
							<span>
								<input type="text" name="coupon_code1" placeholder="Enter Coupon Code" /><br /><br />
								<input type="text" name="coupon_code2" placeholder="Repeat Coupon Code"/><br /><br />
							</span>
							<input class="btn btn-warning" type="submit" name="load_coupon_personal" value="Load Coupon" />
						</form>
						<br />
					</div>
				</div>
			</div>
			</div>
			<!--<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#loadwalletsomeone" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse">Load Wallet For Someone Else</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="loadwalletsomeone">
					<div class="panel_body">
						<br />
						<form action="#" method="post">
							<form action="#" method="post">
							Enter Email Address of The Receiver:<br />
							<input type="text" name="email_address_coupon_receiver" placeholder=""><br />
							<span style="display: none">
								<select>
									<option>Select Payment Option</option>
									<option class = "mobile">MTN Mobile Money</option>
									<option class = "mobile">Glo Mobile Money</option>
									<option class = "mobile">AIRTEL Money</option>
									<option class = "mobile">Vodafone Cash</option>
									<option class = "mobile">Tigo Cash</option>
									<option class = "card">Credit Card</option>
								</select>
							</span>
							
						</form>
						<br />

						<div style="text-align:left; font:1em Tahoma">
							<i>Note on loading Wallet for someone:</i><br />
						
							The person must have an active EarlyFood Account<br />
					
							The email address you've entered above must be the one he/she used in registering for the EarlyFood Account
						</div>
						</form>
						<br />
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#loadcouponsomeone" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse">Credit Coupon To Someones' Wallet</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="loadcouponsomeone">
					<div class="panel_body">
						<br />
						<form action="#" method="post">
							Enter Email Address of The Receiver:<br />
							<input type="text" name="email_address_coupon_receiver" placeholder=""><br />
							<span style="display: none">
								<input type="text" name="coupon_code1" placeholder="Enter Coupon Code" /><br /><br />
								<input type="text" name="coupon_code2" placeholder="Repeat Coupon Code"/><br /><br />
								<input class="btn btn-warning" type="submit" name="load_coupon_someone" value="Load Coupon" />
							</span>
							
						</form>
						<br />

						<div style="text-align:left; font:1em Tahoma">
							<i>Note on loading coupon for someone:</i><br />
						
							The person must have an active EarlyFood Account<br />
					
							The email address you've entered above must be the one he/she used in registering for the EarlyFood Account
						</div>
					</div>
				</div>
			</div> -->
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#statement" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse"><span class="glyphicon glyphicon-envelope"></span> Email Me Monthly Transactions Statement</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="statement">
					<div class="panel_body">
						<br />
						<form action="members.php" method="post">
							<span>
								<input type="text" name="report_receive_email" placeholder="Enter Email Address" />
							</span><br />
							<input class="btn btn-warning" type="submit" name="email_statement" value="Email Statement" />
						</form>
						<br />
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
						<a href="#errors" class="accordion-toggle"  data-parent="#accordion2" data-toggle="collapse">Report Errors With Your EarlyFood Wallet</a>
					</h1>
				</div>
				<div class="panel-collapse collapse" id="errors">
					<div class="panel_body">
						<form action="members.php" method="post">
							<textarea style="width: 100%; text-align:left;">
								
							</textarea><br /><br />
							<input class="btn btn-warning" type="submit" name="walletcomplains" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div><!-- col group ends here -->
		</div>
	</div>

</article>

<?php //require_once("membersupdate.php"); ?>
<?php include("../includes/layout/footer.php"); //footer file ?>
<?php $database -> close_db(); ?>
<?php ob_flush(); ?>