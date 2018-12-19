<?php
session_start();
if(isset($_SESSION['username'])) {
    $pos = 0;
    require_once "functions.php";
    $menu = array();
    if(isset($_POST['searchSub'])) {
        $query = trim($_POST['search']);
        $cuisine = trim($_POST['cuisine']);
        if($query){
            foreach (searchMenu($query)as $item) {
                array_push($menu,getMenuInfo($item->id));
            }
        }else{
            header("location:Menus.php");
        }


    }else{
        $query = "";
        $cuisine = "";
    }
        ?>
        <html>

        <head>

            <title>NJIT DINER | Menu</title>
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


        <body style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAA1BMVEX/zJn3frqVAAAASElEQVR4nO3BgQAAAADDoPlTX+AIVQEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwDcaiAAFXD1ujAAAAAElFTkSuQmCC)">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include_once "./navigation.php"; ?>
                </div>

            </div>

            <div class="row">

                <div class="col-md-2"></div>
                <section class="col-md-8">
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <img src="http://www.transparentpng.com/download/food/n0nASj-food-plate-cut-out.png"
                                 style="width:120px; height: 130px; margin-right:500px;">
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </section>
                <div class="col-md-2"></div>


                <div class="col-md-2"></div>
                <section class="col-md-8">
                    <div class="row">

                        <h2 style="text-align: center">
                            <?php
                            if($query !=''){
                                echo "Results for '".$query."' and '".$cuisine."' cuisine";
                            }
                            ?>
                        </h2>
                        <div class="col-md-12">
                        <?php
                        if (count($menu)!=0) {
                            $i = 0;
                            foreach ($menu as $food) {
                                $prices = array(10.05,10.12,18.26,8.26,12.05,9.06,5.13,15.03);
                                ?>
                                <div class="col-md-12" style="margin-bottom:50px;min-height:200px;margin-top: 50px;border: 2px solid #C39C75;border-radius: 4px;">
                                    <h4><?php echo $food->title;?></h4>
                                    <section>
                                        <img height="100px" src="<?php echo $food->images[2]?>">
                                        <span style="margin-left: 50px; text-decoration: solid;font-size: 18px;">
                                            Price : $
                                            <?php
                                            $price = 0;
                                            if($food->price == null){
                                                $price = $prices[rand(0,count($prices)-1)];
                                                echo $price;
                                            }else{
                                                $price = $food->price;
                                                echo $price;
                                            }
                                            $_SESSION['price'] = $price;
                                            ?>
                                        </span>
                                    </section>
                                    <section>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>Restaurant Chain</td>
                                                <td><?php echo $food->restaurantChain;?></td>
                                            </tr>
                                            <tr>
                                                <td>Readable Serving Size</td>
                                                <td><?php echo $food->readableServingSize;?></td>
                                            </tr>
                                            <tr>
                                                <td>Number of Servings</td>
                                                <td><?php echo $food->numberOfServings;?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section>
                                        <form method="post" action="order.php">
                                            <input type="text" name="title" value="<?php echo $food->title;?>" style="display: none;">
                                            <input type="text" name="image" value="<?php echo $food->images[2];?>" style="display: none;">
                                            <input type="text" name="price" value="<?php echo $price;?>" style="display: none;">
                                            <input type="text" name="restaurantChain" value="<?php echo $food->restaurantChain;?>" style="display: none;">
                                            <input type="text" name="readableServingSize" value="<?php echo $food->readableServingSize;?>" style="display: none;">
                                            <input type="text" name="numberOfServings" value="<?php echo $food->numberOfServings;?>" style="display: none;">

                                            <button type="submit" name="order" class="btn btn-success" style="margin-top: 30px;">Order</button>
                                        </form>
                                    </section>

                                </div>
                                <?php
                                $i+=1;

                            }
                        } else {
                            ?>
                            <h5 style="text-align: center;">Results not found on our records</h5>
                            <?php
                        }

                        ?>
                        </div>
                    </div>
                </section>
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