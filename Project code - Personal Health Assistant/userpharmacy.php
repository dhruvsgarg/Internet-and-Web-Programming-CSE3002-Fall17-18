<?php

require_once('conn.php');
session_start();
//$eid=$_SESSION['loginuser'];
$ar1=$_SESSION['ar1'];
$ar2=$_SESSION['ar2'];
$ar3=$_SESSION['ar3'];
$ar4=$_SESSION['ar4'];

$pharmacylocation=array();
$pharmacylocation[0]=$ar1;
$pharmacylocation[1]=$ar2;
$pharmacylocation[2]=$ar3;
$pharmacylocation[3]=$ar4;

$allpharmacy=array();
//echo $ar1;
echo'<style>
#tab {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 450px;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
  font-family: "BenchNine", sans-serif;
    font-size: 30px;
  color: #1E8CAA;
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
  width: 150px;
  border: 0;
  padding: 10px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  margin-bottom:10px;
}
	</style>';
echo '<h1>Select Pharmacy</h1>';
echo '<center><form action = "pharmacyorder.php" method = "POST">';
echo '<table cellpadding=10 cellspacing=2 border=1 id="tab">';
		echo '<tr>';
		echo '<th><center>Pharmacy Name</center></th>
			  <th><center>Area</center></th>
			  <th><center>Confirm(Y/N)</center></th>';
		echo '</tr>';
foreach ($pharmacylocation as $phr) {
	$query="select * from pharmacy where Area='$phr';";
	$result = mysqli_query($con,$query);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$phname=$row['Chemist'];
	$area=$row['Area'];
	array_push($allpharmacy,$phname);
	echo '<tr>';
			echo '  <td>' . $row["Chemist"] . '</td>';
			echo '  <td><center>' . $row["Area"] . '</center></td>';
			echo '  <td><center>' . '<input type = "text" name ="'.$phname.'" size=10px></center>';
			echo '  </td></tr>';


		}
	}

}
echo '<button type = "submit">Submit</button>';
		echo '</form></center>';
$_SESSION['list'] = $allpharmacy;
?> 