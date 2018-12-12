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
			$team = $_POST['team'];
			$image = $_POST['image'];
			
			$insert = "insert into salesteam (firstName, lastName, phone, ext, email, slsid, territory, team, image) values ('$firstName', '$lastName', '$phone', '$ext', '$email', '$slsid', '$territory', '$team', '$image')";
 			//echo $insert = "insert into salesteam (firstName, lastName, phone, ext, email, slsid, territory, team, image) values ('$firstName', '$lastName', '$phone', '$ext', '$email', '$slsid', '$territory', '$team', '$image')";

			$run = mysqli_query($conn,$insert);
			
			if($run) {
			   echo "<h3>Entry entered</h3>";
			}
		}
		?>
		
		<div style="padding: 15px 0">
		<table cellpadding="0" cellspacing="0" border="1">
			<tr>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">#</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">First Name</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Last Name</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Phone</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Ext</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Email</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">SLS Id</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Territory</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Team</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Image URL</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Edit</th>
				<th bgcolor="#cccccc" style="padding: 5px 10px;">Delete</th>
			</tr>
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
			$user_team = $row['team'];
			$user_image = $row['image'];
			
			$i++;

			?>
			<tr align="center">
				<td style="padding: 3px 10px; text-align: left;"><?php echo $i;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_firstName;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_lastName;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_phone;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_ext;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_email;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_slsid;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_territory;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_team;?></td>
				<td style="padding: 3px 10px; text-align: left;"><?php echo $user_image;?></td>
				<td style="padding: 3px 10px; text-align: center;"><a href="salesTeam.php?edit=<?php echo $user_id; ?>">Edit</a></td>
				<td style="padding: 3px 10px; text-align: center;"><a href="salesTeam.php?delete=<?php echo $user_id; ?>">Delete</a></td>
			</tr>
			<?php } ?>

		</table>
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