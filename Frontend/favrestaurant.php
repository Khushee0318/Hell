<?php
session_start();
if(isset($_SESSION['username'])) {
    $pos = 4;
//BLH8839OUtmsh06PoUmvYv1aKVeRp1lwz7Bjsnqmo9vVgjhrlA
    require_once 'connect.php';

    $stt = $db->prepare("SELECT * FROM restaurants WHERE username = ? ORDER BY id ASC");
    $stt->bindParam(1,$_SESSION['username']);
    $stt->execute();
    $rows = $stt->fetchAll();
    ?>
    <html>

    <head>

        <title>NJIT DINER | Favourite Restaurant</title>
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
                <h2>Favourite restaurants</h2>
                <?php
                $i=1;
                foreach ($rows as $row){
                    echo "<span style='font-size: 20px'>{$i} . {$row['restaurant']}</span><br>";
                    $i+=1;
                }
                ?>
            </div>
            <div class="col-md-2"></div>

        </div>
    </div>


    </body>
    </html>
    <?php
}else{
    header("location:index.php");
}
    ?>