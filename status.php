<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Status</title>
</head>
<body style='min-height: 100vh;'>

<div style='display: flex; flex-direction:column; align-items: center; justify-content:center; min-height:inherit'>
<h1 class="font-weight-bold" >Service Details</h1>
<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";
$id = $_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve bus information from the database
$sql = "SELECT *  FROM bus_services where serv_id = '$id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rtid = $row['route_id'];
        $stime = $row['s_time'];

        if($row['status']=='Active'){
        echo "<p class='bg-primary text-light px-3  py-2 rounded text-success  ' style='margin-inline: auto; max-width:fit-content; margin-top:2em; font-size: 1.7em; box-shadow:2px 3px 10px #ccc' > Status:Active </p>";
        }else if($row['status']=='Service Terminated'){
            echo "<p class='bg-warning px-3  py-2 rounded text-danger  ' style='margin-inline: auto; max-width:fit-content; margin-top:2em; font-size: 1.7em; box-shadow:2px 3px 10px #ccc' > Status:Terminated </p>";
        }

        echo "<br> <p class='bg-danger text-light px-3 py-2 rounded ' style='margin-inline: auto; max-width:fit-content; font-size: 1.2em; box-shadow:2px 3px 10px #ccc'> Delay : ".$row['delay']." mins</p>";
        echo "<p class=' px-3  py-2 rounded text-light bg-primary  ' style='margin-inline: auto; max-width:fit-content; margin-top:2em; font-size: 1.7em; box-shadow:2px 3px 10px #ccc' > CURRENT STATION : " . $row["cs_nm"] . "</p>";

    }
} else {
    echo "No services found in the database";
}
$sql2 = "SELECT * FROM `route_stops` JOIN bus_stops on route_stops.stop_id = bus_stops.stop_id where route_stops.route_id = '$rtid' order by stop_order";
$rs2 = mysqli_query($conn,$sql2);
$time = new datetime();
list($hour, $minute, $second) = explode(':', $stime);
$time->setTime($hour, $minute, $second);
echo "<div class='font-weight-bold'>Timing</div>";




echo "<div class=' text-dark px-4 py-3 mt-2 rounded ' style='box-shadow:2px 2px 12px #ccc;'>";
echo "<table > <tr><th colspan=4 style='padding-right: 1em;'>Stop</th><th></th><th >Arrival</th></tr>";
while ($rw2 = $rs2->fetch_assoc()) {
echo  "<tr><td colspan=4 style='padding-right: 3em;'>".$rw2['stop_name']."</td>";
$tm = $rw2['time'];
$tt = "+".$tm." minutes";
 $time->modify($tt);
 echo "<td>  </td><td >". $time->format("H:i:s")."</td></tr>";
// echo "<br>";
}
echo "</div>";
$conn->close();
?>

<svg class=""style="position:absolute; top:3em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.php">
  <image href="images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>

</div>
<style>

</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>