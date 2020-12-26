<?php
require_once('conn.php');
session_start();



	$items = $_SESSION['list'];
	$flag = 0;
	echo'
<head><style>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=BenchNine:300,400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
<style type="text/css">
body {
   font-family: "PT Sans Narrow", sans-serif;
}
h1 {
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
  font-family: "BenchNine", sans-serif;
  font-size: 50px;
  color: #1E8CAA;
}
h2{
	text-align: center;
	text-transform: uppercase;
	font-weight: bold;
	font-family: "BenchNine",sans-serif;
	font-size: 50px;
	color: #1E8CAA;
}
h3{
	text-align: center;
	font-weight: bold;
	font-family: "BenchNine",sans-serif;
	font-size: 20px;
}
button{
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #3a9ecb;
  width: 150px;
  border: 0;
  padding: 10px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}


	</style></head>';
	echo '<h2> Appointment status </h2>';
	foreach($items as $value)
	{	$valuepreg=preg_replace('/\s+/','_', $value);
		$valuepreg=str_replace('.','_', $valuepreg);
		$confirmation=$_POST[$valuepreg];
		//echo $confirmation;
		
		
			if ($confirmation=='Y')
			{ 
				$sql="Select Area from doctor_location where Name='$value';";
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$area=$row["Area"];
				$patientname=$_SESSION['fname'];
				//echo $patientname;
				$disease=$_SESSION['disease'];
				$sql = "Insert into appointments (DoctorName, PatientName, Disease, Area) values('$value','$patientname','$disease','$area');";
				//echo $sql;
				$result = mysqli_query($con,$sql);
				$flag = 1;
				

				echo '<center><h3>Booked appointment with '.$value.'! </center></h3>';
			}


	}
	if($flag == 0)
	{
		echo '<br><br><br><br><body><h3>You have not booked an appointment with any doctor.<br></h3>';
	}
	echo '<body><center><h3>You can also check pharmacies in your nearby areas<br><br><a href="userpharmacy.php"><button style="color:white; text-decoration: none;">Click Here</button></a></h3></center></body>';
?>