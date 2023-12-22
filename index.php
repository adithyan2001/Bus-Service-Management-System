<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>KSRTC</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body style="">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <span class="text-dark" style="position:absolute; right:17em;">
              KSRTC
            </span>
          </a>

          <div class="navbar-collapse" id="">
            
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="index.php" class='font-weight-bold'>Home</a>
              <a href="login.html"  class='font-weight-bold' >Admin</a>
                <a href="login.html"  class='font-weight-bold'>Station Master</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div class="slider_container">
        <div class="img-box">
          <img src="images/ks2.jpg " alt="">
        </div>
        <div class="detail_container">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="detail-box">
                  <h1>
                    Track <br>
                     MY <br>
                    BUS
                  </h1>
                  
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h1>
                    Track <br>
                    MY <br>
                    BUS
                  </h1>
                  
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h1>
                    Track<br>
                    MY <br>
                    BUS
                  </h1>
                 
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
      </div>
     
    <div class="form_container" style="position:absolute; top: 18em; left: 12em; background: #fff; padding-inline:2em; padding-block:4em; border-radius: 8px; box-shadow:2px 2px 12px gray;">
      <form action="srch_bus.php" method="post" style="width:fit-content; padding-right:-2em;">
        <div class="form-row" style="min-width:fit-content;" >
          <div class="col-lg-8">
            <div class="form-row" style="width:fit-content; margin-right: 0;">
              <div class="col-md-6">
                <label for="parkingName">From Where</label>
                <select name="source" id="source" class="">

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
          </select>
              </div>
              <div class="col-lg-6">
                <label for="parkingNumber">To Where</label>
                <select name="dest" id="dest" class="">
                <?php
        $sql = "SELECT * FROM bus_stops";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dest_id = $row["stop_id"];
                    $destination= $row["stop_name"];
                    echo "<option value=\"$dest_id\">$destination</option>";
                }
            }
            ?>
          </select>
              </div>
            </div>

          </div>
          <div class="  d-flex align-items-end rounded " style="width:fit-content; padding-inline:0; margin-inline:0;"  >
            <div class="btn-container">
              <button type="submit" class="rounded bg-primary btn py-0  text-light" style="">
                Search
              </button>
            </div>
          </div>
        </div>

      </form>
    </div>
   
  
    </section>
    <!-- end slider section -->
  </div>
  <!-- book section -->
  
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>


</body>

</html>