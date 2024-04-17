<?php
session_start();

//establish the connection to database, and start the session
require("includes/common.php");

// Redirects the user to products page if he/she is logged in.
if (isset($_SESSION['email'])) {
  header('location: products.php');
}

?>

<!--Specifies document type is html-->
<!DOCTYPE html>
<!--Specifies the language as English-->
<html lang="en">
    <head>
        <!--instructs browser on how to control the page's dimensions and scaling-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Title of index page-->
        <title>Welcome | Life Style Store</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body style="padding-top: 50px;">
        <!-- Header -->
        <?php
        include 'includes/header.php';
        ?>
        <!--Header end-->

        <div id="content">
            <!--Main banner image-->
            <div id = "banner_image">
                <div class="container"> 
                    <center>
                        <div id="banner_content">
                            <h1>Bloom Bliss: Fresh Floral Elegance!</h1>
                            <p>Choose your scents!</p>
                            <br/>
                            <a  href="products.php" class="btn btn-danger btn-lg active">Shop Now</a>
                        </div>
                    </center>
                </div>
            </div>
            <!--Main banner image end-->

            <!--Item categories listing-->
            <div class="container">
                <div class="row text-center" id="item_list">
                    <div class="col-sm-4">
                        <a href="products.php#fresh" >
                            <div class="thumbnail">
                                <img src="img/uploads/fresh.jpg" alt="">
                                <div class="caption">
                                    <h3>Fresh Flowers</h3>
                                    <p>Fresh blooms for every occasion at our flowershop.</p>
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a href="products.php#bouquet" >
                            <div class="thumbnail">
                                <img src="img/uploads/bouquet.jpg" alt="">
                                <div class="caption">
                                    <h3>Bouquet</h3>
                                    <p>Elegant bouquets for every moment, crafted with care at our shop..</p>
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a href="products.php#accessories" >
                            <div class="thumbnail">
                                <img src="img/uploads/acc.jpg" alt="">
                                <div class="caption">
                                    <h3>Accessories</h3>
                                    <p>Charming accessories to complement your gift, available at our shop.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <!--Item categories listing end-->
        </div>
        
        <!--Footer-->
        <?php
        include 'includes/footer.php';
        ?>
        <!--Footer end-->
   
    </body> 
</html>