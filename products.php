<?php
session_start();
//establish the connection to database, and start the session
require("includes/common.php");
$sql = "SELECT * FROM items";
$result = mysqli_query($con, $sql);

?>

<!--Specifies document type is html-->
<!DOCTYPE html>
<!--Specifies the language as English-->
<html lang="en">

<head>
    <!--instructs browser on how to control the page's dimensions and scaling-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Title of products page-->
    <title>Products | Life Style Store</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include 'includes/header.php';
    include 'includes/check-if-added.php';
    ?>
    <div class="container" id="content">
        <!-- Jumbotron Header -->
        <div class="jumbotron home-spacer" id="products-jumbotron">
            <h1>Welcome to our floral haven!</h1>
            <p>Immerse yourself in the beauty of nature with our handpicked collection, designed to evoke joy and inspire every moment.</p>

        </div>
        <hr>

        <?php
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) :
            if ($count % 4 == 0) {
                echo '<div class="row text-center" id="fresh">';
            }
        ?>

            <div class="col-md-3 col-sm-6 home-feature">
                <div class="thumbnail">
                    <img src="img/uploads/<?= $row['image']; ?>" alt="">
                    <div class="caption">
                        <h3><?= $row['name']; ?></h3>
                        <p>Price: Rp. <?= $row['price']; ?> </p>
                        <?php if (!isset($_SESSION['email'])) { ?>
                            <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                            <?php } else {
                            if (check_if_added_to_cart($row['id'])) {
                                echo '<a href="#" class="btn btn-block btn-success" disabled>Added to cart</a>';
                            } else { ?>
                                <form method="post" action="cart-add.php">
                                    <input type="hidden" name="productId" value="<?= $row['id']; ?>">
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control" value="1" min="1">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </span>
                                    </div>
                                </form>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>


        <?php
            $count++;
            if ($count % 4 == 0) {
                echo '</div>'; // Tutup <div class="row text-center" id="fresh">
            }
        endwhile;
        ?>

        <?php
        // Pastikan untuk menutup div jika jumlah hasil bukan kelipatan 4.
        if ($count % 4 != 0) {
            echo '</div>'; // Tutup <div class="row text-center" id="fresh">
        }
        ?>


        <?php include("includes/footer.php"); ?>
</body>

</html>