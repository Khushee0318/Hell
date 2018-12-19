<?php
session_start();
if(isset($_SESSION['username'])) {

    if ($_SESSION['username'] == 'admin') {
        $admin = "admin";
        $pos = 0;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['sub'])){
                $errors = array();
                $menu = trim($_POST['menu']);

                if($menu){
                    require_once "../connect.php";
                    $stm = $db->prepare("SELECT * FROM menus WHERE menu = ?");
                    $stm->bindParam(1,$menu);
                    $stm->execute();
                    if($stm->rowCount()==0){
                        $stmt = $db->prepare("INSERT INTO menus(id,menu) VALUES(?,?)");
                        $data = array(NULL,$menu);
                        if($stmt->execute($data)){
                            $success = "Sucessfully added";
                        }else{
                            array_push($errors,"**Adding to db failed**");
                        }
                    }else{
                        array_push($errors,"**Menu already exist**");
                    }
                }else{
                    array_push($errors,"**Please enter the menu**");
                }
            }
        }

        /**
         *
         * Apple fritters
         * Cinnamon Apple Crisp
         * Brown Butter Apple Crumble
         * Apple Tart
         * Apple Tart
         */

        ?>
        <html>

        <head>

            <title>NJIT DINER | Admin</title>
            <link rel="stylesheet" type="text/css" href="../style.css">
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
                    <?php include_once "../navigation.php"; ?>
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
                    <h2>Add Menu</h2>
                    <form action="admin.php" method="post">
                        <?php
                        if(isset($success)) {
                            ?>
                            <div class="form-group">
                                <?php
                                echo "<label style='color: green;'>{$success}</label>";
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <?php
                            if(isset($errors)){
                                foreach ($errors as $error){
                                    echo "<label style='color: red;'>{$error}</label><br>";
                                }
                            }

                            ?>
                        </div>
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input type="text" name="menu" class="form-control" placeholder="Enter menu name to add">
                        </div>
                        <div class="form-group">
                            <div></div>
                            <button name="sub" type="submit" class="btn btn-success">Submit</button>
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
        header("location:../Menus.php");
    }
}else{
    header("location:../index.php");
}
?>