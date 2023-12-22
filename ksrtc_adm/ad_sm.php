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
<body style="min-height: 100vh;">
<svg class=""style="position:absolute; top:3em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.html">
  <image href="../images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>
  <h1 class='bg-success ' style='width: fit-content; margin-inline:auto; padding-inline: 1em; padding-block: 0.5em; border-radius: 5px; margin-top: 1.2em;'>KSRTC - Admin</h1>
  <h2 class='mx-auto ' style='width:fit-content; margin-inline: auto; position:relative; right: 0.1em;' >Station Master Details</h2>
  <div class="form-group" style="margin-inline:auto;">
  <div class="center" style="margin-inline:auto; position:relative; left:23em; top: 0.3em" >
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;">Stop_ID:</label>
      <div class="col-sm-10" style="margin-inline:auto; ">          
      <select name="sid" id="sid">
            <?php
            $conn = new mysqli("localhost","root","","bus");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Step 2: Fetch bus stop names from the database
            $sql = "SELECT * FROM bus_stops";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $org_id = $row["stop_id"];
                    $orgin= $row["stop_name"];
                    echo "<option value=\"$org_id\">$orgin</option>";
                }
            }
            ?>

            <!-- Populate this dropdown with stop names from the database -->
        </select>      </div>
        </div>
   

  
  <form class="form-horizontal" action=" " style='width: fit-content; margin-inline:auto; margin-bottom:2em;' method ="post">
 
    <div class="form-group">
    <div class="form-group">
  
    </div>
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;">Login_ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="r_nm" placeholder="Enter Login ID" name="lid" style='padding-inline:2em; width: 400px; '>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd" style="text-align:end;">Password:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="r_nm" placeholder="Enter  Password" name="pwd" style='padding-inline:2em; width: 400px; '>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
<input class='btn btn-primary text-light' type="submit" value = "submit">      </div>
    </div>
  </form>
</div>

</form>
</div>

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
 
    $lid = $_POST["lid"];
    $pwd = $_POST["pwd"];
    $sid = $_POST["sid"];
    $sqll = "Select stop_name from bus_stops where stop_id = '$sid'";
    $ress=mysqli_query($conn,$sqll);
    $rww = mysqli_fetch_assoc($ress);
    $snm = $rww['stop_name'];    
    // SQL query to insert data into the table
    $sql = "INSERT INTO `login`(`login_id`, `pswd`, `role`, `stop_id`,`sname`) VALUES  ('$lid','$pwd', 'StationMaster', '$sid' , '$snm')";

    if ($conn->query($sql) === TRUE) {
        echo "Station Master added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
