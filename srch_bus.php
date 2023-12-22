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
    
    <div class="wrapper">
    <svg class=""style="position:fixed; top:1em; right: 2em; " width="40px" height="40px" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <a class="homeIcon"href="index.php">
  <image href="images/home.svg" x="0" y="0" height="40px" width="40px"/>
</a>
</svg>
        <div class="container h-10 ">
            <div class=" mt-4 text-center col-12">
                <h1 class="display-3">KSRTC BUS SERVICES</h1>
            </div>
        </div>
        <main>
            <div class="container-fluid middle " style=>
                <div class="card">
    
                    <h5 class=" text-dark"   >
                    <?php
                    if($_POST)
                    {
                        $a=$_POST['source'];
                        $b=$_POST['dest'];
                    }
                    else
                    {
                        echo "no places found";
                    }
                    ?>
                    <div class=" mh-25" style=' '>
                        <div class="card-body p-0  table-responsive b-2 rounded">
                            <?php
                                $conn = mysqli_connect("localhost", "root", "", "bus");
                                if ($conn == false) {
                                    echo "Error on connection";
                                } else {
                                    $query2 = "select route_name , type, s_time , e_time, serv_id from bus_services JOIN bus_routes on bus_routes.route_id = bus_services.route_id where bus_services.route_id in (SELECT BR.route_id FROM bus_routes BR JOIN route_stops RS1 ON BR.route_id = RS1.route_id JOIN route_stops RS2 ON BR.route_id = RS2.route_id WHERE RS1.stop_id = '$a' AND RS2.stop_id = '$b' AND RS2.stop_order >= RS1.stop_order); ";
                                    $result = mysqli_query($conn, $query2);
                                    if (mysqli_num_rows($result) > 0) { ?>

                                        <table class="table text-dark">
                                         
                                                    <tr style = "backround:red;">
                                                        <th>Service</th>
                                                        <th>Type</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                    </tr>
                                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {   ?>
                                            <tr>
                                            <td  ><?php echo $row['route_name']; ?></td>
                                          <td ><?php echo $row['type']; ?></td>
                                          <td ><?php echo $row['s_time'];?></td>
                                          <td ><?php echo $row['e_time']; ?></td>
                                           <td class="text-center dropdown"><button type="button" class="btn btn-primary bg-primary text-light"><a class="text-light" href="status.php?id=<?php echo $row['serv_id']; ?>">Details</a></button></td>
                                           <div class="detailsSection text-primary" style="background:red;"></div>
                                          <?php  echo "</tr>";
                                        }
                                        echo "</tbody></table>";
                                    } else {
                                        echo "No Bus Service Found";
                                    }
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
