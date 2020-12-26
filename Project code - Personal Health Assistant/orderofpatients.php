<?php
require_once('conn.php');
session_start();
echo '
<head>
<link href="http://fonts.googleapis.com/css?family=BenchNine:300,400,700" rel="stylesheet" type="text/css">
<style>
#tab {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 450px;
    margin-top:20px;
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
$name=$_SESSION['PharmacyName'];
//echo $name;
$query="select * from orders where PharmacyName='$name';";
//echo $query;
$result = mysqli_query($con,$query);
echo '<h1>Orders Received:</h1>';
//echo $query;
if($result->num_rows > 0) {
	echo '<center><table cellpadding=10 cellspacing=2 border=1 id="tab">';
		echo '<tr>';
		echo '<th>Orderno</th>
			  <th>Patient Name</th>
			  <th><center>Area</center></th>';
		echo '</tr>';
	while($row = $result->fetch_assoc()) {
	$area=$row['Area'];
	echo '<tr>';
			echo '  <td>' . $row["ONo"] . '</td>';
			echo '  <td>' . $row["PatientName"] . '</td>';
			echo '  <td><center>' . $row["Area"] . '</center></td>';
			echo '  </td></tr>';
		}
	}
	else{
		echo '<h1><center>No Orders!<h1><br><br>';
	}
	echo '<a href="welcomepharmacy.php"><button>Back</button></a><br><br></center>';
?> 