<?php
require_once('conn.php');
session_start();
//$eid=$_SESSION['loginuser'];
$disease=$_SESSION['disease'];
echo '<center><h1>Most probable disease : '.$disease.'</h1></center>';
$query="select distinct(Specialist) from disease_doctor where DiseaseName='$disease';";
$result = mysqli_query($con,$query);
if($result->num_rows > 0) {
	$specialist = array();
	while($row = $result->fetch_assoc()) {
	$check=$row['Specialist'];
			array_push($specialist, $check);
		}
	}
	echo '<h3><center>Specialist(s) required to treat the disease the disease : </h3></center>';
	for($i = 0; $i < sizeof($specialist); $i++)
	{
		echo '<h4><center>'.($i+1).'.  '.$specialist[$i].'</h4></center>';
	}

/*$query="select * from doctor_location where Area='$_POST['location1']' or Area='$_POST['location2']' or Area='$_POST['location3']' or Area='$_POST['location4']';";
echo $query;
$result = mysqli_query($con,$query);
if($result->num_rows > 0) {
	$specialist = array();
	while($row = $result->fetch_assoc()) {
	$check=$row['Specialist'];
			array_push($specialist, $check);
		}
	}*/
$ar1=$_POST['location1'];
$ar2=$_POST['location2'];
$ar3=$_POST['location3'];
$ar4=$_POST['location4'];
$_SESSION['ar1']=$ar1;
$_SESSION['ar2']=$ar2;
$_SESSION['ar3']=$ar3;
$_SESSION['ar4']=$ar4;

$alldoctors=array();

//echo $ar1;


echo'<html>
<head>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=BenchNine:300,400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
<style type="text/css">
h1 {
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
  font-family: "BenchNine", sans-serif;
    font-size: 50px;
  color: #1E8CAA;
}
h4{
  font-family: "PT Sans Narrow", sans-serif;
  font-weight: bold;
  font-size:20px;
  color:red;
}
h3 {
  text-transform: uppercase;
  font-family: "PT Sans Narrow", sans-serif;
  font-size:30px;
}
#tab {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 650px;
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
button{
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #3a9ecb;
  width: 100px;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  margin-bottom:10px;
}
td {
  font-family: "BenchNine", sans-serif;
  font-size: 25px;
  font-weight: bold;
}
th {
  text-transform: uppercase;
  color: #1E8CAA;
  font-family: "PT Sans Narrow", sans-serif;
  font-size:25px;
}
	</style>';



echo '<body><form action = "doctorappointment.php" method = "POST">';
echo '<center><table cellpadding=10 cellspacing=2 border=1 id="tab">';
		echo '<tr>';
		echo '<th>Speciality</th>
			  <th>Doctor Name</th>
			  <th><center>Area</center></th>
			  <th><center>Confirm(Y/N)</center></th>';
		echo '</tr>';
foreach ($specialist as $spl) {
	$query="select * from doctor_location where Speciality='$spl' and (Area='$ar1' or Area='$ar2' or Area='$ar3' or Area='$ar4');";
	$result = mysqli_query($con,$query);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$docname=$row['Name'];
	$area=$row['Area'];
	array_push($alldoctors,$docname);
	echo '<tr>';
			echo '  <h4><td>' . $row["Speciality"] . '</td>';
			echo '  <td>' . $row["Name"] . '</td>';
			echo '  <td><center>' . $row["Area"] . '</center></td>';
			echo '  <td><center>' . '<input type = "text" name ="'.$docname.'" size=10px>';
			echo '  </center></td></tr>';


		}
	}
	echo '</center>';
}
echo '<button type = "submit">Submit</button>';
		echo '</form></body>';
$_SESSION['list'] = $alldoctors;
?> 