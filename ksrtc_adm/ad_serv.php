<!DOCTYPE html>
<html lang="en">
<head>
  <title>Service Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <svg class=""style="position:absolute; top:3em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.html">
  <image href="../images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>
  <h1 class='bg-success ' style='width: fit-content; margin-inline:auto; padding-inline: 1em; padding-block: 0.5em; border-radius: 5px; margin-top: 1.2em;'>KSRTC - Admin</h1>

<div class="container" >
  <h2 class='mx-auto ' style='width:fit-content; margin-inline: auto; position:relative; right: 1em;' >Service Details</h2>
  <form class="form-horizontal" action=" " style='width: fit-content; margin-inline:auto; margin-bottom:2em;' method ="post">
    </div>

    <div class="forms" style="margin-inline:auto;">
    <div class="form-group">
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;">Route Name:</label>
      <div class="col-sm-10">          
      </div>
      <select name="rt" id="rt" style="padding-block: 0.3em; padding-inline:2em;">

<?php

$conn = new mysqli("localhost","root","","bus");

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch bus stop names from the database
$sql = "SELECT * FROM bus_routes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    $org_id = $row["route_id"];
    $orgin= $row["route_name"];
    echo "<option value=\"$org_id\">$orgin</option>";
}
}
?>
</select>

    <div style="margin-block:1em;"   >
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;" >Type:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control " id="r_nm" placeholder="Enter Bus Type" name="type" style='padding-inline:2em; width: 400px; '>
      </div>
    </div>
    <div class="form-group" style="margin-block:1em;" >
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;" >Start Time:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="r_nm" placeholder="Enter Start Time" name="s_time" style='padding-inline:2em; width: 400px; '>
      </div>
    </div>
    <div class="form-group" style="margin-block:1em;" >
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;" >End Time:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="r_nm" placeholder="Enter End Time" name="e_time" style='padding-inline:2em; width: 400px; '>
      </div>
    </div>
    <div class="form-group" style="margin-block:1em;" >        
      <div class="col-sm-offset-2 col-sm-10">
<input type="submit" value = "submit" class='btn btn-primary text-light  ' style="margin-top:1em; margin-bottom: 2em;">      </div>
    </div>
  </form>
</div>
</div>




</form>

</body>
</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
 
    $type = $_POST["type"];
    $route_id = $_POST["rt"];
    $s_time = $_POST["s_time"];
    $e_time = $_POST["e_time"];

    $sql2 = "select max(serv_id ) as rid from bus_services";
    $res2 = mysqli_query($conn,$sql2);
    $rw = mysqli_fetch_assoc($res2);
    $rid =$rw['rid'] + 1;
    
    // SQL query to insert data into the table
    $sql = "INSERT INTO bus_services (`serv_id`,type, route_id, s_time, e_time)
            VALUES ('$rid','$type', $route_id, '$s_time', '$e_time')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='text-success' style='margin-left:17em; margin-block:3em;'>Service  added successfully</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
