<?php
// login.php

// Start a session (if not started already)
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $sid = $_POST['stid'];
    $pas = $_POST["psd"];
    
    // Connect to your database (replace with your database credentials)
    $conn = mysqli_connect("localhost", "root", "", "bus");

    if ($conn === false) {
        die("Error: Unable to connect to the database");
    }

    // Prepare and execute the query for admin
    $result = mysqli_query($conn, "SELECT * FROM login WHERE login_id = '$sid' AND pswd = '$pas' AND role ='admin'");
    
    if ($result === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['login'] = true;
        header("Location: ksrtc_adm/index.html");
        exit();
    }

    // Prepare and execute the query for StationMaster
    $result2 = mysqli_query($conn, "SELECT * FROM login WHERE login_id = '$sid' AND pswd = '$pas' AND role = 'StationMaster'");
    
    if ($result2 === false) {
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'Admin';
        $_SESSION['name']=$row['sname'];
        die("Error in SQL query: " . mysqli_error($conn));
    }

    if ($row2 = mysqli_fetch_assoc($result2)) {
        $_SESSION['st'] = $row2['stop_id'];
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'StationMaster';
        $_SESSION['name']=$row2['sname'];
        header("Location: sm/index.php");
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}

// Handle invalid login (if needed)
echo "Invalid login credentials";
?>
