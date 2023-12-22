<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <title>KSRTC BUS </title>
    <meta name="description" content="Hogwarts Express train scheduler">
    <meta name="keywords" content="Hogwarts, Hogwarts Express, trains, train scheduler">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#661D26" />
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Sorts+Mill+Goudy" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="favicon.ico?v=2" type="image/x-icon" />
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="jumbotron text-center col-12">
                <h1 class="display-3">KSRTC BUS SERVICES</h1>
            </div>
        </div>
        <main>
            <div class="container-fluid middle">
                <div class="card">
                    <h5 class="card-header">Current Running Services</h5>
                    <div class="container-fluid">
                        <div class="card-body table-responsive">
                        <?php
   	 $conn=mysqli_connect("localhost","root","","bus_timing");
   	 if($conn==false)
   	 {
   		 echo "error on connection";
   	 }
   	 else
   	 {
   		 $query2="select * from bus_timings";
   		 $result=mysqli_query($conn, $query2);
   		 if(mysqli_num_rows($result) > 0)
   		 {
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Bus Details</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Depature</th>
                                        <th scope="col">Arrival</th>
                                        <th scope="col" class="text-center"><button type="button" class="btn btn-primary">Details</button></th>
                                    </tr>
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row['source'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['destination'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['start_time'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['end_time'];
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                else
                                {
                                    echo "no rows selected";
                                }
                            }
                            mysqli_close($conn);
                            ?>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
                
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="assets/javascript/setup.js"></script>
    <script type="text/javascript" src="assets/javascript/app.js"></script>
</body>

</html>