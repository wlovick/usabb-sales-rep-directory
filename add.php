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
.addBox {
        width: 700px;
        height: 700px;
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

<!-- <div style="display: inline-block; "> -->
<div class="addBox">
	<form method="post" action="add.php" enctype="multipart/form-data">
		<div class="row">
			<div class="col">
				<label for="firstName">First Name:</label>
				<input type="text" name="firstName" placeholder="First Name" class="form-control"/>
			</div>
			<div class="col">
				<label for="lastName">Last Name:</label>
				<input type="text" name="lastName" placeholder="Last Name" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="phone">Phone:</label>
				<input type="text" name="phone" placeholder="Enter Phone" class="form-control"/>
			</div>
			<div class="col">
				<label for="ext">Ext:</label>
				<input type="text" name="ext" placeholder="Enter Ext" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="email">Email Address:</label>
				<input type="text" name="email" placeholder="Enter email" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="slsid">SLS id:</label>
				<input type="text" name="slsid" placeholder="Enter SLS ID" class="form-control"/>
			</div>
			<div class="col">
				<label for="territory">Territory:</label>
				<input type="text" name="territory" placeholder="Enter Territory State(s)" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<select name="team" class="form-control">
					<option value="" selected disabled hidden>Select Team</option>
					<option value="Inside">Inside</option>
					<option value="Outside">Outside</option>
					<option value="International">International</option>
				</select>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="searchTer">Search Terms (state abv & spelled out)</label>
				<input type="text" name="searchTer" placeholder="Search Terms" class="form-control"/>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<label for="image">Add Image:</label><br/>
				<input type="file" name="image" id="image"/>
			</div>
		</div>
		
		<div class="row buttons">
			<div class="col">
				<button type="submit" name="sub" placeholder="Add Rep" class="btn btn-primary">Add Rep</button>
				<button type="submit" name="cancel" placeholder="Cancel" class="btn btn-outline-secondary">Cancel</button>
			</div>
		</div>
		
	</form>
</div>

<?php
	if(isset($_POST['sub'])) {
	
		$firstName = $_POST['firstName'] . " ";
		$lastName = $_POST['lastName'] . " ";
		$phone = $_POST['phone'];
		$ext = $_POST['ext'];
		$email = $_POST['email'];
		$slsid = $_POST['slsid'];
		$territory = $_POST['territory'] . " ";
		$searchTer = $_POST['searchTer'];
		$team = $_POST['team'];

		$addtarget_dir = "images/";
		$image = basename($_FILES["image"]["name"]);

		$addtarget_file = $addtarget_dir . $image;

		move_uploaded_file($_FILES["image"]["tmp_name"], $addtarget_file);
		
		$insert = "insert into salesteam (firstName, lastName, phone, ext, email, slsid, territory, searchTer, team, image) values ('$firstName', '$lastName', '$phone', '$ext', '$email', '$slsid', '$territory', '$searchTer', '$team', '$image')";

		$run = mysqli_query($conn,$insert);
		
		if($run) {
	 		echo "<script>alert('Representative has been added!')</script>";
			echo "<script>window.open('salesTeam.php', '_self')</script>";
		}
	}
	
	if(isset($_POST['cancel'])) {
		echo "<script>window.open('salesTeam.php', '_self')</script>";
	}
	
	
?>


</body>
</html>
