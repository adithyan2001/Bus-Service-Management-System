<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <title>KSRTC BUS </title>
    <meta name="description" content="Hogwarts Express train scheduler">
    <meta name="keywords" content="Hogwarts, Hogwarts Express, trains, train scheduler">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#55030c" />
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Sorts+Mill+Goudy" rel="stylesheet">
    <link rel="stylesheet" href="css2/style.css">
    <link rel="icon" href="favicon.ico?v=2" type="image/x-icon" />
</head>

<body>
<svg class=""style="position:absolute; top:3em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.html">
  <image href="../images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>
    <div class="wrapper">
        <div class="container h-10 ">
            <div class=" mt-4 text-center col-12">
                <h1 class="display-3">KSRTC BUS SERVICES</h1>
            </div>
            <form action="" method="post">
            <div>
            <label for="parkingName">To Station Name: </label>
                <select name="stn" id="stn" class="col-md-6">
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
              <input type="submit" value="search" style="margin-left: 1em;">
         </div>
        </div>
        </form>
        <main>
            <div class="container-fluid middle " style=>
                <div class="card">
    
                    <h5 class=" text-dark"   >
          
                    <div class="container-fluid mh-50">
                        <div class="card-body p-0  table-responsive b-2 rounded">
                            <?php
                                $conn = mysqli_connect("localhost", "root", "", "bus");
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                {
                                  $stn =  $_POST['stn'];
                                  $query2 = "SELECT * FROM `bus_services`JOIN route_stops on route_stops.route_id = bus_services.route_id  JOIN bus_routes on bus_routes.route_id = bus_services.route_id where route_stops.stop_id = $stn ";                                }
                                else
                              {
                                    $query2 = "select * from bus_services join bus_routes ON bus_services.route_id = bus_routes.route_id ";
                                    
                               }
                                     $result = mysqli_query($conn, $query2);
                                    if (mysqli_num_rows($result) > 0) { ?>
                                        <table class="table text-dark">
                                         
                                                    <tr style = "backround:red;">
                                                        <th>Service</th>
                                                        <th>Type</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Status</th>
                                                        <th>Delay</th>
                                                        <th>Current Station</th>
                                                    </tr>
                                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {   ?>
                                            <tr>
                                            <td  ><?php echo $row['route_name']; ?></td>
                                          <td ><?php echo $row['type']; ?></td>
                                          <td ><?php echo $row['s_time'];?></td>
                                          <td ><?php echo $row['e_time']; ?></td>
                                          <td ><?php echo $row['status']; ?></td>
                                          <td ><?php echo $row['delay']; ?> mins</td>
                                          <td ><?php echo $row['cs_nm']; ?></td>
                                           <td class="text-center dropdown"><button type="button" class="btn btn-primary text-light"><a class="text-light" href="delete.php?id=<?php echo $row['serv_id']; ?>">Delete</a></button></td>
                                           <div class="detailsSection text-primary" style="background:red;"></div>
                                          <?php  echo "</tr>";
                                        }
                                        echo "</tbody></table>";
                                    } else {
                                        echo "No Route Found";
                                    }
                                
                                mysqli_close($conn);
                                

                            ?>
                           </h5>
                                                </thead>
                                                <tbody>                            
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
        <script type="text/javascript" src="assets/javascript/setup.js"></script>
        <script type="text/javascript" src="assets/javascript/app.js"></script>
    </div>
</body>

</html>
