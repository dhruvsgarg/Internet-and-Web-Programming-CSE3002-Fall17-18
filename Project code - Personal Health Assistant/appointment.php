<?php
echo '
<head>
<link href="http://fonts.googleapis.com/css?family=BenchNine:300,400,700" rel="stylesheet" type="text/css">
<style>
#tab {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 550px;
}
#tab td, #tab th {
    border: 1px solid #ddd;
    padding: 8px;
}

#tab tr:nth-child(even){background-color: #f2f2f2;}

#tab tr:hover {background-color: #ddd;}

#tab th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #3a9ecb;
    color: white;
}
h1 {
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
  font-family: "BenchNine", sans-serif;
    font-size: 50px;
  color: #1E8CAA;
}	
  button{
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #3a9ecb;
  width: 150px;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
</style>
</head>';
require_once('conn.php');
session_start();
$name=$_SESSION['fname'];
//echo $name;
$query="select * from appointments where PatientName='$name';";
$result = mysqli_query($con,$query);
echo"<h1>Appointments</h1>";
if($result->num_rows > 0) {
	echo '<center><table cellpadding=10 cellspacing=2 border=1 id="tab">';
		echo '<tr>';
		echo '<th>Appointment Num</th>
			  <th>Doctor Name</th>
			  <th><center>Area</center></th>
			  <th><center>Disease</center></th>';
		echo '</tr>';
	while($row = $result->fetch_assoc()) {
	$area=$row['Area'];
	echo '<tr>';
			echo '  <td>' . $row["ANo"] . '</td>';
			echo '  <td>' . $row["DoctorName"] . '</td>';
			echo '  <td><center>' . $row["Area"] . '</center></td>';
			echo '  <td><center>' . $row["Disease"] . '</center></td>';
			echo '  </td></tr></center>';
		}
	}
	else{
		echo '<br><center>';
		echo 'No Appointments!</center>';
	}
	echo '<center><a href="welcome.php"><button>Back</button></a><br><br></center>';
?> 