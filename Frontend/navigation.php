<?php
require_once "functions.php";
?>
<marquee>
    <h1>Welcome to NJIT Diner</h1>
</marquee>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            if(!isset($admin)) {
                ?>
                <li class="nav-item <?php echo nav(1, $pos) ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo nav(2, $pos) ?>">
                    <a class="nav-link" href="./Menus.php">Menus</a>
                </li>
                <li class="nav-item <?php echo nav(3, $pos) ?>">
                    <a class="nav-link" href="./order.php">Online Order</a>
                </li>
                <li class="nav-item dropdown <?php echo nav(4, $pos) ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./favfood.php">Favorite Foods</a>
                        <a class="dropdown-item" href="./favrestaurant.php">Favorite Restaurants</a>
                        <a class="dropdown-item" href="./pastorders.php">View Past Orders</a>
                    </div>
                </li>
                <?php
            }else {
                ?>
                <li class="nav-item?>">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item?>">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
        if(isset($_SESSION['username'])){
            if(!isset($admin)) {
                ?>
                <a href="./logout.php" class="btn btn-warning" style="margin-right: 10px;">Logout</a>
                <?php
            }else{
                ?>
                <a href="../logout.php" class="btn btn-warning" style="margin-right: 10px;">Logout</a>
                <?php
            }
        }
        ?>
    </div>
</nav>