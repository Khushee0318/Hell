<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['OrderTitle'])) {
    $pos = 3;

    if(isset($_POST['creditcard']) && isset($_POST['cvs']) && isset($_POST['shipping']) && isset($_POST['email'])){
        if(is_numeric($_POST['creditcard']) && is_numeric($_POST['cvs'])){
            try{
                $to = $_POST['email'];
                $subject = "Invoice";
                $invoice = "<h1>INVOICE</h1><br>";
                $invoice.= "<h2>{$_SESSION['OrderTitle']}</h2><br>";
                $invoice.= "<h2>$ {$_SESSION['price']}</h2><br>";
                $invoice.= "<p>Will be delivered to {$_POST['shipping']}</p>";

                $headers = "From: support@bttstudio.space";

                mail($to,$subject,$invoice,$headers);

                session_destroy();
            }catch (Exception $e){
                echo "<h2>Cant sent Email on your local host check you php.ini file</h2>";
            }
        }else{
            header("location:orderCheckout.php");
        }


    }else{
        header("location:orderCheckout.php");
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
                <h1><?php echo "Order completed and will be delivered to {$_POST['shipping']}";?></h1>
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
