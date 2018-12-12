<!DOCTYPE html>
<?php
	include("derc.php");
?>

<html>
<head>
	<title></title>
</head>
<body>


<?php
	if(isset($_GET['edit'])) {
	
		$edit_id = $_GET['edit'];
	
		$select = "select * from salesteam where id='$edit_id'";
		$queryRun = mysqli_query($conn, $select);

		$row = mysqli_fetch_array($queryRun);

		$user_firstName = $row['firstName'];
		$user_lastName = $row['lastName'];
		$user_phone = $row['phone'];
		$user_ext = $row['ext'];
		$user_email = $row['email'];
		$user_slsid = $row['slsid'];
		$user_territory = $row['territory'];
		$user_team = $row['team'];
		$user_image = $row['image'];
	}
?>

<br/>
<form method="post" action="">
	<div style="color: #e9f1f7; border: 5px solid #e9f1f7; margin: 0px;">
		<div style="display: inline-block;">
			<div>
				<input type="text" name="u_firstName" value="<?php echo $user_firstName;?>" size="14"/>
				<input type="text" name="u_lastName" value="<?php echo $user_lastName;?>" size="14"/>
			</div>
			<div>
				<input type="text" name="u_phone" value="<?php echo $user_phone;?>"/>
				<input type="text" name="u_ext" value="<?php echo $user_ext;?>" size="8"/>
			</div>
			<div>
				<input type="text" name="u_email" value="<?php echo $user_email;?>" size="30"/>
			</div>
		</div>
		<div style="display: inline-block; padding-left: 15px;">
			<div>
				<input type="text" name="u_slsid" value="<?php echo $user_slsid;?>" size="14"/>
				<input type="text" name="u_territory" value="<?php echo $user_territory;?>" size="14"/>
			</div>
			<div>	
				<select id="u_team" name="u_team">
					<option <?php if ($user_team == "" ) echo 'selected' ; ?> value="" disabled hidden >Select Team</option>
					<option <?php if ($user_team == "Inside" ) echo 'selected' ; ?> value="Inside" >Inside</option>
					<option <?php if ($user_team == "Outside" ) echo 'selected' ; ?> value="Outside" >Outside</option>
					<option <?php if ($user_team == "International" ) echo 'selected' ; ?> value="International"  >International</option>
				</select><br/>
			</div>
			<div>
				<input type="text" name="u_image" value="<?php echo $user_image;?>" size="30"/>
			</div>
		</div>
		<div style="display: inline-block; padding-left: 15px;">
			<input type="submit" name="update" placeholder="Update Data"/>
		</div>
	</div>
</form>

<?php
if(isset($_POST['update'])) {

	$update_firstName = $_POST['u_firstName'];
	$update_lastName = $_POST['u_lastName'];
	$update_phone = $_POST['u_phone'];
	$update_ext = $_POST['u_ext'];
	$update_email = $_POST['u_email'];
	$update_slsid = $_POST['u_slsid'];
	$update_territory = $_POST['u_territory'];
	$update_team = $_POST['u_team'];
	$update_image = $_POST['u_image'];

	$update = "update salesteam set firstName='$update_firstName', lastName='$update_lastName', phone='$update_phone', ext='$update_ext', email='$update_email', slsid='$update_slsid', territory='$update_territory', team='$update_team', image='$update_image' where id='$edit_id'";
// 	echo $update = "update salesteam set firstName='$update_firstName', lastName='$update_lastName', phone='$update_phone', ext='$update_ext', email='$update_email', slsid='$update_slsid', territory='$update_territory', team='$update_team', image='$update_image' where id='$edit_id'";

	$update_run = mysqli_query($conn,$update);
	
	if($update_run) {
		echo "<script>alert('Team member has been updated!')</script>";
		echo "<script>window.open('salesTeam.php', '_self')</script>";
	}
}
?>


</body>
</html>
