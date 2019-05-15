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
a {color: #226ab3;}
a:hover {color: #bd1d49;}

body {
	width: 100%; 
	margin: 0 auto;
	padding: 0px;
	text-align: center;
	width: 100%;
	font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
	background-color: #F2F2F2;
}

.infoBox {
        width: 900px;
        height: 600px;
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


.btn {margin: 15px;}

.buttons {
	text-align: center;
	padding-top: 25px;
	}

.repName {font-size: 20pt; line-height: 22pt; font-weight: bold; color: #226ab3; font-family: Verdana, Arial, Helvetica, sans-serif;}
.repText {font-size: 14pt; line-height: 16pt; font-family: Verdana, Arial, Helvetica, sans-serif;}
.textbold {font-weight: bold;}

</style>

<?php
	if(isset($_GET['info'])) {
	
		$info_id = $_GET['info'];
	
		$select = "select * from salesteam where id='$info_id'";
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


<div class="infoBox">
	<form method="post" action="" enctype="multipart/form-data">

		<div style="margin: 15px; text-align: center; display: inline-block; overflow: auto;">

				<div style="float: left; display: inline-block;">
					<div style="padding: 10px 10px 0; text-align: left;"><img src="images/<?php echo $user_image;?>" width="auto" height="400" border="1" style="border: 1pt solid;" /></div>
				</div>
				<div style="display: inline-block; padding-top: 15px;">
					<div style="padding: 3px 10px; text-align: left;" class="repName"><?php echo $user_firstName;?> <?php echo $user_lastName;?></div>
					<div style="padding: 3px 10px; text-align: left;" class="repText"><span class="textbold">Direct: </span><?php echo $user_phone;?></div>
					<?php
						if (empty($user_ext)) {
							echo '';
							} else {
							echo '<div style="padding: 3px 10px; text-align: left;" class="repText"><span class="textbold">Phone: </span>800-548-1234 x' . $user_ext . '</div>';
							} ?>
					<div style="padding: 3px 10px; text-align: left;" class="repText"><span class="textbold">Email: </span><?php echo $user_email;?></div>
					<div style="padding: 3px 10px; text-align: left;" class="repText"><span class="textbold"><?php echo $user_team;?> Sales for: </span><?php echo $user_territory;?></div>

					<div style="padding: 7px 10px; text-align: left; width: 400px;" class="repText"><?php echo $user_bio;?></div>
				</div>

		</div>
		
		
		
		<div class="row buttons">
			<div class="col">
				<button type="submit" name="cancel" placeholder="Cancel" class="btn btn-outline-secondary">Close</button>
			</div>
		</div>
	</div>
</form>

<?php

	if(isset($_POST['cancel'])) {
		echo "<script>window.open('index.php', '_self')</script>";
	}

?>


</body>
</html>
