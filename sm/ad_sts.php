<!DOCTYPE html>
<html lang="en">
<?php
session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Station Master</title>
</head>
<body style='min-height:100vh; padding-top: 2em; background: url("../ksrtc/images/ksrtc-bg.jpeg"); background-size:contain; background-repeat: no-repeat; background-position-x : 85%; background-position-y: 20%; '>
    
<h2 class='mx-auto ' style='font-weight:800 ; margin-top: 1em;max-width:fit-content;  font-size: 3em;'>Station Master</h2>
<center> <h3 >  Depot : <?php echo $_SESSION['name']; ?> </h3> </center>
<!-- admin_update.php -->
<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

$conn = new mysqli($servername, $username, $password, $dbname);
$servid = $_GET['id'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted by the admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["admin_submit"])) {
    // Check if the form is for updating the bus status
    if (isset($_POST["status"])) {
        $status = $_POST["status"];
        $delay = $_POST['delay'];
        $sql = "UPDATE bus_services SET status = '$status', delay = '$delay', cs_nm = '" . $_SESSION['name'] . "' WHERE serv_id = $servid";

            if ($conn->query($sql) !== TRUE) {
                echo "<div class='text-danger'>Error updating service status: " . $conn->error . "</div>";
            }
        }

        echo "<div class='text-success'style='position:absolute; bottom: 10em; left: 28em; font-weight: 600; font-size: 1.3em;'>Bus status updated successfully !</div>";
    }


// Close the database connection

?>

<!-- Admin Form for Status Update -->
<form  method="post" action="" style='min-height:inherit ; display:flex; flex-direction:column; align-items:center; justify-content:center; position: absolute; top: 1em; left: 23em;  '>
<div  class='text-light bg-primary ' style='padding-inline:2em; padding-block:2em;  box-shadow: 2px 2px 10px #ccc; border-radius: 13px; font-weight: 600; '>
    
   
    <label for="status">Update Status:</label>
    <select name="status" class="btn rounded" style='padding-block: 0.16em; position:relative; bottom: 2px;'>
        <option value="Active">Active</option>
        <option value="Service Terminated">Service Terminated</option>
    </select>
    Delay : <input type = "text" name ="delay" id="delay" class="rounded input btn" style='padding-block: 0.16em; position:relative; bottom: 2px;'>
    <input class="btn btn-light rounded text-primary"type="submit" name="admin_submit" value="Update Status" style='padding-block: 0.16em; position:relative; bottom: 2px;'>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<svg class=""style="position:absolute; top:3em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.php">
  <image href="../images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>


<svg class=""style="position:absolute; top:3em; right: 6em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="backIcon"href="v_serv.php">
  <image href="../images/back.svg" x="0" y="0" height="40px" width="40px"/>
  </a>
</svg>
</body>
</html>
