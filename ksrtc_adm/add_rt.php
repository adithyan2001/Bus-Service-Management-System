<!DOCTYPE html>
<html lang="en">
<head>
  <title>Route Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  
</head>
<body>
  <h1 class='' style='width: fit-content; margin-inline:auto; padding-inline: 1em; padding-block: 0.5em; border-radius: 5px; margin-top: 1.2em;'>KSRTC - Admin</h1>

<div class="container" >
  <h2 class='mx-auto ' style='width:fit-content; margin-inline: auto; position:relative; right: 1em;' >Route Details</h2>
  <form class="form-vertical" action=" " style='width: fit-content; margin-inline:auto; margin-bottom:2em;' method = "POST" >
    <div class="form-group">
      <label class=" col-sm-6 " for="pwd" style="position:relative; top: 2.35em; right: 6em;">Route Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="r_nm" placeholder="Enter route_name" name="route_name" style=' padding-inline:2em; width: 400px; '>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default bg-primary rounded text-light " value = "submit">
      </div>
    </div>
  </form>
</div>

<?php
// process_form.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $r_nm = $_POST["route_name"];
    $sql2 = "select max(route_id ) as rid from bus_routes";
    $res2 = mysqli_query($conn,$sql2);
    $rw = mysqli_fetch_assoc($res2);
    $rid =$rw['rid'] + 1;
    $sql = "INSERT INTO bus_routes (`route_id`, `route_name`) VALUES ('$rid', '$r_nm')";

    if ($conn->query($sql) === TRUE)
     {
        echo "<center>Route added successfully!</center>";
        header( "Location:rt_dtls.php?rid=$rid");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
</body>
</html>