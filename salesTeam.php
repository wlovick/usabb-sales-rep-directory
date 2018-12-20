<!DOCTYPE html>
<?php
	include("derc.php");
?>

<html>
	<head>
		<title>USABlueBook Rep Directory Admin page</title>
		
		<style type="text/css">
			a {color: #226ab3 !important; text-decoration: none;}
			a:hover {color: #bd1d49 !important;}

			body { margin: 0px; padding: 0px; }
			body > div {margin: auto; text-align: center;}
			
			.textbold {font-weight: bold;}

			.addRep {font-size: 16pt; line-height: 18pt; font-weight: bold; color: #1c6fb5; font-family: Verdana, Arial, Helvetica, sans-serif;}
			.repText {font-size: 10pt; line-height: 12pt; font-family: Verdana, Arial, Helvetica, sans-serif;}

			@media only screen and (max-width: 700px) {
				table[id="container"] {
				width: 100%;
				}
			}

		</style>

		<script language="JavaScript" type="text/javascript">
			function checkDelete(){
				return confirm('Are you sure?');
			}
		</script>
		
	</head>
	
	<body>
		<div style="padding-top: 15px;">
			<div style="">
				<div style="font-size: 22pt; line-height: 24pt; font-weight: bold; color: #226ab3; font-family: Verdana, Arial, Helvetica, sans-serif;"><a href="index.php" style="text-decoration: none;">USABlueBook Sales Representatives Directory</a></div>
				<div style="padding-top: 15px; margin-left: auto; margin-right: auto;"><span class="addRep"><a href="salesTeam.php?add"><img src="images/addUser.jpg" width="27" height="20" border="0" alt="Add user" /> Add Sales Rep</a></span></div>
				<div style="padding-top: 15px; margin-left: auto; margin-right: auto;">
					<?php
						if(isset($_GET['edit'])) {
							include("edit.php");
						}
					?>

					<?php
						if(isset($_GET['add'])) {
							include("add.php");
						}
					?>
				</div>
			</div>
		</div>
		
		<div style="padding: 0;">
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
							<div style="padding: 3px 10px; text-align: left;" class="repText textbold"><?php echo $user_team;?> Sales</div>
							<div style="padding: 3px 10px; text-align: left;" class="repText textbold">SLS id: <?php echo $user_slsid;?></div>
						</div>
						<div style="display: inline-block;">
							<div style="padding: 3px 10px; text-align: left;" class="repText">Name: <span class="textbold"><?php echo $user_firstName;?> <?php echo $user_lastName;?></span></div>
							<div style="padding: 3px 10px; text-align: left;" class="repText">Phone: <span class="textbold"><?php echo $user_phone;
								if (empty($user_ext)) {
									echo '</span></div>';
									} else {
									echo '&nbsp;&nbsp;</span>ext:<span class="textbold">' . $user_ext . '</span></div>';
									} ?>
							<div style="padding: 3px 10px; text-align: left;" class="repText">Email: <span class="textbold"><?php echo $user_email;?></span></div>
							<div style="padding: 3px 10px; text-align: left;" class="repText">Territory: <span class="textbold"><?php echo $user_territory;?></span></div>
							<div style="padding: 3px 10px; text-align: left; max-width: 300px; height: 35px;" class="repText">Search terms: <?php echo $user_searchTer;?></div>
							<div style="display: block; padding: 3px 10px; text-align: center;">
								<div style="display: inline-block; width: 50%;" class="repText textbold"><a href="salesTeam.php?edit=<?php echo $user_id; ?>">Edit</a></div>
								<div style="float: right; display: inline-block; width: 50%;" class="repText textbold"><a href="salesTeam.php?delete=<?php echo $user_id; ?>" onclick="return checkDelete()">Delete</a></div>
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