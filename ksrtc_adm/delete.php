<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus";
$id = $_GET['id'];

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user has confirmed the deletion
if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    // Construct the SQL query
    $sql = "DELETE FROM `bus_services` WHERE  serv_id = " . $id;

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Redirect to the specified location
        header("Location: chk_serv.php");
        exit(); // Ensure that no further code is executed
    } else {
        // Handle the case where the query was not successful
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // If confirmation is not provided, show a confirmation prompt
    echo '<script>
        var confirmed = confirm("Are you sure you want to delete this service?");
        if (confirmed) {
            window.location.href = "delete.php?id=' . $id . '&confirm=true";
        } else {
            // Redirect to the specified location if the user cancels
            window.location.href = "chk_serv.php";
        }
    </script>';
}

// Close the database connection
mysqli_close($conn);
?>
