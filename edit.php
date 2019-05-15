<!DOCTYPE html>
<?php
	include("derc.php");
?>

<html>
<head>
	<title></title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

<style type="text/css">
.editBox {
        width: 700px;
        height: 800px;
        background-color: #e9f1f7;
        border-radius: 15px;
        box-shadow: 5px 5px 15px grey;
        text-align: left;

        position: fixed; /*it can be fixed too*/
        z-index: 2000;
        left: 0; right: 0;
        top: 0; bottom: 0;
        margin: auto;
        padding: 15px;

        /*this to solve "the content will not be cut when the window is smaller than the content": */
        max-width: 100%;
        max-height: 100%;
        overflow: auto;
    }

.row {padding-top: 15px;}

.btn {margin: 15px;}

.buttons {
	text-align: center;
	padding-top: 25px;
	}

</style>

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
		$user_searchTer = $row['searchTer'];
		$user_team = $row['team'];
		$user_image = $row['image'];
		$user_bio = $row['bio'];
	}
?>


<div class="editBox">
	<form method="post" action="" enctype="multipart/form-data">

		<div class="row">
			<div class="col">
				<label for="u_firstName">First Name:</label>
				<input type="text" name="u_firstName" value="<?php echo $user_firstName;?>" class="form-control"/>
			</div>
			<div class="col">
				<label for="u_lastName">Last Name:</label>
				<input type="text" name="u_lastName" value="<?php echo $user_lastName;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="u_phone">Phone:</label>
				<input type="text" name="u_phone" value="<?php echo $user_phone;?>" class="form-control"/>
			</div>
			<div class="col">
				<label for="u_ext">Ext:</label>
				<input type="text" name="u_ext" value="<?php echo $user_ext;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="u_email">Email Address:</label>
				<input type="text" name="u_email" value="<?php echo $user_email;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="u_slsid">SLS id:</label>
				<input type="text" name="u_slsid" value="<?php echo $user_slsid;?>" class="form-control"/>
			</div>
			<div class="col">
				<label for="u_territory">Territory:</label>
				<input type="text" name="u_territory" value="<?php echo $user_territory;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<select id="u_team" name="u_team" class="form-control">
					<option <?php if ($user_team == "" ) echo 'selected' ; ?> value="" disabled hidden >Select Team</option>
					<option <?php if ($user_team == "Inside" ) echo 'selected' ; ?> value="Inside" >Inside</option>
					<option <?php if ($user_team == "Outside" ) echo 'selected' ; ?> value="Outside" >Outside</option>
					<option <?php if ($user_team == "International" ) echo 'selected' ; ?> value="International"  >International</option>
				</select>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="u_searchTer">Search Terms (state abv &amp; spelled out):</label>
				<input type="text" name="u_searchTer" value="<?php echo $user_searchTer;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="user_bio">Biography:</label>
				<input type="text" name="user_bio" value="<?php echo $user_bio;?>" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="oldimage">Current Image: </label>
				<input type="text" name="oldimage" id="oldimage" value="<?php echo $user_image;?>" class="form-control"/>
			</div>
			<div class="col">
				<label for="u_editimage">Update Image:</label><br/>
				<input type="file" name="u_editimage" id="u_editimage"/>
			</div>
		</div>
		
		<div class="row buttons">
			<div class="col">
				<button type="submit" name="update" placeholder="Update Rep" class="btn btn-primary">Update Rep</button>
				<button type="submit" name="cancel" placeholder="Cancel" class="btn btn-outline-secondary">Cancel</button>
			</div>
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
		$update_searchTer = $_POST['u_searchTer'];
		$update_bio = $_POST['user_bio'];
		$update_team = $_POST['u_team'];
		$new_image = basename($_FILES["u_editimage"]["name"]);
		$keep_image = $_POST['oldimage'];

		if($new_image) {
			$edittarget_dir = "images/";
			$edittarget_file = $edittarget_dir . $new_image;
			$editimageUpload = move_uploaded_file($_FILES["u_editimage"]["tmp_name"], $edittarget_file);
			$update_image = $new_image;
		}
		else {
			$update_image = $keep_image;
		}


		$update = "update salesteam set firstName='$update_firstName', lastName='$update_lastName', phone='$update_phone', ext='$update_ext', email='$update_email', slsid='$update_slsid', territory='$update_territory', searchTer='$update_searchTer', bio='$update_bio', team='$update_team', image='$update_image' where id='$edit_id'";

		$update_run = mysqli_query($conn,$update);
	
		if($update_run) {
// 	 		echo "<script>alert('Team member has been updated!')</script>";
			echo "<script>window.open('salesTeam.php', '_self')</script>";
		}
	}

	if(isset($_POST['cancel'])) {
		echo "<script>window.open('salesTeam.php', '_self')</script>";
	}

?>


</body>
</html>
