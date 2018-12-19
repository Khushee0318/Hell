<?php
session_start();
if(isset($_SESSION['username'])) {
    $pos = 3;
//BLH8839OUtmsh06PoUmvYv1aKVeRp1lwz7Bjsnqmo9vVgjhrlA

    $response = "";
    if (isset($_POST['ordersub'])) {
        $title = $_POST['title'];
        $_SESSION['OrderTitle']=$title;
        require_once "connect.php";
        $stt = $db->prepare("INSERT INTO orders(id,username,menu_name) VALUES (?,?,?)");
        $data = array(NULL,$_SESSION['username'],$title);
        if($stt->execute($data)){
            $response = "Order completed successfully";
        }else{
            $response = "Order failed";
        }
    }
    ?>
    <html>

    <head>

        <title>NJIT DINER | Order</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
    </head>


    <body
        style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAA1BMVEX/zJn3frqVAAAASElEQVR4nO3BgQAAAADDoPlTX+AIVQEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwDcaiAAFXD1ujAAAAAElFTkSuQmCC)">

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
                <h1 style="text-align: center;">Payment</h1>
                <form action="orderComplete.php" method="post">
                    <div class="form-group">
                        <label for="creditcard">
                            Credit Card Number
                        </label>
                        <input class="form-control" type="text" id="creditcard" name="creditcard" placeholder="eg. 1234123412341234" required>
                    </div>
                    <div class="form-group">
                        <label for="cvs">
                            CVS Code
                        </label>
                        <input class="form-control" type="text" id="cvs" name="cvs" placeholder="eg. 123" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping">
                            Delivery Address
                        </label>
                        <input class="form-control" type="text" id="shipping" name="shipping" placeholder="Shipping Address" required>
                    </div>
                    <div class="form-group">
                        <label for="email">
                            Email
                        </label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Proceed</button>
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
    header("location:index.php");
}
?>
