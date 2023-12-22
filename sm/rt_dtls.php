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
  <h1 class='bg-success ' style='width: fit-content; margin-inline:auto; padding-inline: 1em; padding-block: 0.5em; border-radius: 5px; margin-top: 1.2em;'>KSRTC - Admin</h1>

<?php
    $rid = $_GET['rid'];
?>

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
            headerCell3.innerHTML = '<b>Priority</b>';

            // Create new rows based on user input
            for (var i = 0; i < rowCount; i++) {
                var row = table.insertRow(i + 1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.innerHTML = '<input type="text" name="stop_id[]" required>';
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

            cell1.innerHTML = '<input type="text" name="stop_id[]" required>';
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
<button type="button" onclick="generateTable()">Generate Table</button>
<button type="button" onclick="addRow()">Add Row</button>
<button type="button" onclick="deleteRow()">Delete Row</button>

<form action="" method="post">
    <table border="1" id="dynamicTable">
        <!-- Table rows will be dynamically added here based on user input -->
    </table>

    <br>

    <input type="submit" value="Submit">
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

        $sql = "INSERT INTO  `route_stops`(`route_id`, `stop_id`, `stop_order`, `priority`) VALUES ('$rid', '$stop_id', '$stop_order', '$priority')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "<center>Data inserted successfully!</center>";
} else {
    echo "<center>No data submitted</center";
}

$conn->close();
?>
</body>
</html>
