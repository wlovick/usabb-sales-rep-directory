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
	$name = $_POST['name'];
	$searchArea = $_POST['searchArea'];
	//-query  the database table
	$sql = "SELECT * FROM salesteam WHERE " . $searchArea . " like '%" . $name . "%' ORDER BY lastName";
	//echo $sql;
	//-run  the query against the mysql query function
	$result = mysqli_query($conn,$sql);
	//-create  while loop and loop through result set 
	echo '<div id="gallery">';
	while($row = mysqli_fetch_array($result)){ 
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
		//-display the result of the array
			echo '<div class="video">';
				echo '<div align="center"><img src="images/' . $user_image . '" width="200" height="200" border="1" style="border: 1pt solid;" /></div>';
				echo '<div align="center" style="padding-top: 5px;"><span class="nametext">' . $user_firstName . ' ' . $user_lastName . '</span></div>';
				echo '<div align="center" style="padding-top: 0px;"><span class="bodytext">' . $user_phone . '&nbsp;';
				if (empty($user_ext)) {
					echo '</span></div>';
					} else {
					echo '&nbsp;ext:' . $user_ext . '</span></div>';
					}
				echo '<div align="center" style="padding-top: 0px;"><span class="bodytext">' . $user_email . '</span></div>';
				echo '<div align="center" style="padding-top: 0px;"><span class="bodytext">' . $user_team . ' Sales: ' . $user_territory . '</span></div>';
			echo '</div>';
	}
?>



</body>
</html>
