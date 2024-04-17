<!-- this code is header navigation bar in website -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!--To add menu option when screen width is reduced-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Flowerscent.</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <!--If user is logged in, then header will contain these-->
                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <?php if (isset($_SESSION['is_admin']) and ($_SESSION['is_admin'] == 1 or $_SESSION['is_admin'] == 2)) : ?>
                        <li><a href="dashboard.php"></span> Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="cart.php"></span> Cart </a></li>
                    <li><a href="settings.php"></span> Settings</a></li>
                    <li><a href="orderhistory.php"></span> Order History</a></li>
                    <li><a href="logout_script.php"></span> Logout</a></li>
                <?php
                } else {
                ?>
                    <li><a href="signup.php"></span> Sign Up</a></li>
                    <li><a href="login.php"></span> Login</a></li>
                    <li><a href="contact.php"></span> Contact</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>