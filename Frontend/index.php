<?php
$pos = 1;
if(!isset($_SESSION['username'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $errors = array();
        $success = "";
        if (isset($_POST['sub'])) {
            $user = trim($_POST['username']);
            $pass = trim($_POST['password']);
            if ($user) {
                if ($pass) {
                    $hpass = md5($pass);
                    require_once "connect.php";

                    $stt = $db->prepare("SELECT * FROM users WHERE username = ?");
                    $stt->bindParam(1, $user);
                    $stt->execute();
                    if ($stt->rowCount() == 1) {
                        $stm = $stt->fetch(PDO::FETCH_ASSOC);
                        if ($hpass == $stm['password']) {
                            session_start();
                            $_SESSION['username'] = $user;
                            if ($_SESSION['username'] == 'admin') {
                                header("location:admin/admin.php");
                            } else {
                                header("location:Menus.php");
                            }

                        } else {
                            array_push($errors, "Wrong password");
                        }
                    } else {
                        array_push($errors, "User with that username doesnt exist");
                    }
                } else {
                    array_push($errors, "Please enter the password");
                }
            } else {
                array_push($errors, "Please enter the username");
            }
        }
    }

    ?>
    <html>

    <head>

        <title>NJIT DINER | Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
    </head>


    <body style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAA1BMVEX/zJn3frqVAAAASElEQVR4nO3BgQAAAADDoPlTX+AIVQEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwDcaiAAFXD1ujAAAAAElFTkSuQmCC)">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include_once "./navigation.php"; ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <img src="http://www.transparentpng.com/download/food/n0nASj-food-plate-cut-out.png"
                             style="width:120px; height: 130px; margin-right:500px;">
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
            <div class="col-md-2"></div>


            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <?php
                        if (isset($errors)) {
                            foreach ($errors as $error) {
                                echo "<label style='color: red;'>{$error}</label><br>";
                            }
                        }

                        ?>
                    </div>
                    <div class="form-group">
                        <label for="username">testUsername</label>
                        <input id="username" name="username" type="text" class="form-control"
                               placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control"
                               placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="sub" class="btn btn-success">Login</button>
                    </div>
                    <div class="form-group">
                        <span>
                            Dont have an Account?
                            <a href="Register.php">Register Here</a>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>

        </div>
    </div>


    </body>
    </html>
    <?php
}else{
    header("location:Menus.php");
}
    ?>
