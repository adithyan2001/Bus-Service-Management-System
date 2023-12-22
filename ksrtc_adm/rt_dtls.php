<!DOCTYPE html>
<html lang="en">
<head>
  <title>Route Details</title>
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


    
<?php
    $rid = $_GET['rid'];
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

$conn = new mysqli($servername, $username, $password, $dbname);
$sqlll = "SELECT route_name FROM `bus_routes` WHERE route_id = '$rid' ";
$resss = mysqli_query($conn,$sqlll);
$row= mysqli_fetch_assoc($resss);
$snmm = $row['route_name'];
?>

  <h1 class='bg-success ' style='width: fit-content; margin-inline:auto; padding-inline: 1em; padding-block: 0.5em; border-radius: 5px; margin-top: 1.2em;'>KSRTC - Admin</h1>
<center> <h1 >Route Name: <?php echo "<span class='text-danger'>" . $snmm .  "</span>" ;?></h1> 

    
    <script>
        function generateTable() {
            // Get the user input for the number of rows
            var rowCount = document.getElementById("rowCount").value;

            // Get the table element
            var table = document.getElementById("dynamicTable");

            // Clear existing rows
            table.innerHTML = '';

            // Create header row
            var headerRow = table.insertRow(0);
            var headerCell1 = headerRow.insertCell(0);
            var headerCell2 = headerRow.insertCell(1);
            var headerCell3 = headerRow.insertCell(2);

            headerCell1.innerHTML = '<b>Stop ID</b>';
            headerCell2.innerHTML = '<b>Stop Order</b>';
            headerCell3.innerHTML = '<b>Timing</b>';

            // Create new rows based on user input
            for (var i = 0; i < rowCount; i++) {
                var row = table.insertRow(i + 1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.innerHTML = '<select name="stop_id[]" id="source" ><?php $conn = new mysqli("localhost","root","","bus"); if ($conn->connect_error) {   die("Connection failed: " . $conn->connect_error); } $sql = "SELECT * FROM bus_stops"; $result = $conn->query($sql); if ($result->num_rows > 0) {  while ($row = $result->fetch_assoc()) {  $org_id = $row["stop_id"];  $orgin= $row["stop_name"]; echo "<option value=\"$org_id\">$orgin</option>";   } } ?></select>' ;
                cell2.innerHTML = '<input type="text" name="stop_order[]" required>';
                cell3.innerHTML = '<input type="text" name="priority[]" required>';
            }
        }

        function addRow() {
            var table = document.getElementById("dynamicTable");
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML =  '<select name="stop_id[]" id="source" ><?php $conn = new mysqli("localhost","root","","bus"); if ($conn->connect_error) {   die("Connection failed: " . $conn->connect_error); } $sql = "SELECT * FROM bus_stops"; $result = $conn->query($sql); if ($result->num_rows > 0) {  while ($row = $result->fetch_assoc()) {  $org_id = $row["stop_id"];  $orgin= $row["stop_name"]; echo "<option value=\"$org_id\">$orgin</option>";   } } ?></select>';
            cell2.innerHTML = '<input type="text" name="stop_order[]" required>';
            cell3.innerHTML = '<input type="text" name="priority[]" required>';
        }

        function deleteRow() {
            var table = document.getElementById("dynamicTable");
            var rowCount = table.rows.length;

            if (rowCount > 1) {
                table.deleteRow(rowCount - 1);
            }
        }
    </script>

<h2 style='width:fit-content; margin-inline:auto;'>Add Route Details</h2>
<div style='width: fit-content; padding-inline: 2em; margin-inline:auto; margin-bottom: 4em;'>
<label for="rowCount">Enter the number of rows:</label>
<input type="number" id="rowCount" name="rowCount" min="1" required>
<button type="button" onclick="generateTable()" class="btn btn-primary text-light rounded">Generate Table</button>
<div style="margin-top: 1em; margin-bottom:1em;">
<button type="button" onclick="addRow()" class="btn btn-primary text-light rounded">Add Row</button>
<button type="button" onclick="deleteRow()" class="btn btn-primary text-light rounded">Delete Row</button>
    </div>
<form action="" method="post">
    <table border="1" id="dynamicTable">
        <!-- Table rows will be dynamically added here based on user input -->
    </table>

    <br>

    <input class="btn btn-primary text-light" type="submit" value="Submit">
</form>
</div>

<?php
// process_form.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle form submission

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    // Loop through the form data and insert into the database
    foreach ($_POST['stop_id'] as $key => $value) {
        $stop_id = isset($_POST['stop_id'][$key]) ? $_POST['stop_id'][$key] : null;
        $stop_order = isset($_POST['stop_order'][$key]) ? $_POST['stop_order'][$key] : null;
        $priority = isset($_POST['priority'][$key]) ? $_POST['priority'][$key] : null;

        $sql = "INSERT INTO  `route_stops`(`route_id`, `stop_id`, `stop_order`, `time`) VALUES ('$rid', '$stop_id', '$stop_order', '$priority')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "<center class='text-success'>Route Details Added Successfully!</center>";
} else {
    echo "<center class='text-danger'>No Details submitted!</center";
}

$conn->close();
?>
</body>
</html>
