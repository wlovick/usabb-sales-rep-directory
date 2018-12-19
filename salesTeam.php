<!DOCTYPE html>
<?php
	include("derc.php");
?>

<html>
	<head>
		<title>USABlueBook Rep Directory Admin page</title>
	</head>
	
	<body>
		<div style="display: inline-block;">
			<form method="post" action="salesTeam.php">
				<div style="display: inline-block;">
					<div>
						<input type="text" name="firstName" placeholder="First Name" size="14"/>
						<input type="text" name="lastName" placeholder="Last Name" size="14"/>
					</div>
					<div>
						<input type="text" name="phone" placeholder="Enter Phone"/>
						<input type="text" name="ext" placeholder="Enter Ext" size="8"/>
					</div>
					<div>
						<input type="text" name="email" placeholder="Enter email" size="30"/>
					</div>
				</div>
				<div style="display: inline-block; padding-left: 15px;">
					<div>
						<input type="text" name="slsid" placeholder="Enter SLS ID" size="14"/>
						<input type="text" name="territory" placeholder="Enter Territory State" size="14"/>
					</div>
					<div>
						<select name="team">
							<option value="" selected disabled hidden>Select Team</option>
							<option value="Inside">Inside</option>
							<option value="Outside">Outside</option>
							<option value="International">International</option>
						</select>
						<input type="text" name="searchTer" placeholder="Search Terms" size="14"/>
					</div>
					<div>
						<input type="text" name="image" placeholder="upload image" size="30"/>
					</div>
				</div>
				<div style="display: inline-block; padding-left: 15px;">
					<input type="submit" name="sub" placeholder="Insert Data"/>
				</div>
			</form>
		</div>
		<div style="display: inline-block; padding-left: 15px;">
			<div style="display: inline-block;">
				<?php
					if(isset($_GET['edit'])) {
						include("edit.php");
					}
				?>
			</div>
		</div>
		
		<?php
		if(isset($_POST['sub'])) {
		
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$phone = $_POST['phone'];
			$ext = $_POST['ext'];
			$email = $_POST['email'];
			$slsid = $_POST['slsid'];
			$territory = $_POST['territory'];
			$searchTer = $_POST['searchTer'];
			$team = $_POST['team'];
			$image = $_POST['image'];
			
			$insert = "insert into salesteam (firstName, lastName, phone, ext, email, slsid, territory, searchTer, team, image) values ('$firstName', '$lastName', '$phone', '$ext', '$email', '$slsid', '$territory', '$searchTer', '$team', '$image')";
 			//echo $insert = "insert into salesteam (firstName, lastName, phone, ext, email, slsid, territory, searchTer, team, image) values ('$firstName', '$lastName', '$phone', '$ext', '$email', '$slsid', '$territory', '$searchTer', '$team', '$image')";

			$run = mysqli_query($conn,$insert);
			
			if($run) {
			   echo "<h3>Entry entered</h3>";
			}
		}
		?>
		
		<div style="padding: 15px 0;">
			<div style="margin: auto;">
				<?php

				$select = "select * from salesteam order by lastName";
				$queryRun = mysqli_query($conn,$select);
			
				$i = 0;
				while($row = mysqli_fetch_array($queryRun)) {

				$user_id = $row['id'];
				$user_firstName = $row['firstName'];
				$user_lastName = $row['lastName'];
				$user_phone = $row['phone'];
				$user_ext = $row['ext'];
				$user_email = $row['email'];
				$user_slsid = $row['slsid'];
				$user_territory = $row['territory'];
				$user_searchTer = $row['searchTer'];
				$user_team = $row['team'];
				$user_image = $row['image'];
			
				$i++;

				?>

				<div style="border: 1px solid #000000; margin: 15px; text-align: left; width: 450px; display: inline-block; overflow: auto;">

						<div style="float: left; display: inline-block;">
							<div style="padding: 10px 10px 0; text-align: left;"><img src="images/<?php echo $user_image;?>" width="auto" height="100" border="1" style="border: 1pt solid;" /></div>
							<div style="padding: 3px 10px; text-align: left;"><?php echo $user_team;?> Sales</div>
							<div style="padding: 3px 10px; text-align: left;">SLS id: <?php echo $user_slsid;?></div>
						</div>
						<div style="display: inline-block;">
							<div style="padding: 3px 10px; text-align: left;">Name: <?php echo $user_firstName;?> <?php echo $user_lastName;?></div>
							<div style="padding: 3px 10px; text-align: left;">Phone: <?php echo $user_phone;
								if (empty($user_ext)) {
									echo '</div>';
									} else {
									echo '&nbsp;&nbsp;ext:' . $user_ext . '</div>';
									} ?>
							<div style="padding: 3px 10px; text-align: left;">Email: <?php echo $user_email;?></div>
							<div style="padding: 3px 10px; text-align: left;">Territory: <?php echo $user_territory;?></div>
							<div style="padding: 3px 10px; text-align: left; max-width: 300px; height: 35px;">Search terms: <?php echo $user_searchTer;?></div>
							<div style="display: block; padding: 3px 10px; text-align: center;">
								<div style="display: inline-block; width: 50%;"><a href="salesTeam.php?edit=<?php echo $user_id; ?>">Edit</a></div>
								<div style="float: right; display: inline-block; width: 50%;"><a href="salesTeam.php?delete=<?php echo $user_id; ?>">Delete</a></div>
							</div>
						</div>

				</div>

			<?php } ?>

			</div>
		</div>
		
		<?php
			if(isset($_GET['delete'])) {
				$delete_id = $_GET['delete'];
				$delete = "delete from salesteam where id='$delete_id'";
				$run_delete = mysqli_query($conn, $delete);
	
				if($run_delete) {
					echo "<script>alert('A user has been deleted!')</script>";
					echo "<script>window.open('salesTeam.php', '_self')</script>";
				}
			}
		?>
	
	
	</body>
</html>