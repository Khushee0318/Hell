<?php
session_start();
if(isset($_SESSION['username'])) {
    $pos = 3;

    require_once "connect.php";
    $stt=$db->prepare("SELECT * FROM locations ORDER BY location ASC");
    $stt->execute();
    $locations=$stt->fetchAll();

    if(isset($_POST['order'])){
        $title = $_POST['title'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $restaurantChain = $_POST['restaurantChain'];
        $readableServingSize = $_POST['readableServingSize'];
        $numberOfServings = $_POST['numberOfServings'];
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/AIzaSyDLewNY8Hr_iFkqhKN27DwXgkrEM972_r0/js?v=3.exp&sensor=false&libraries=places"></script>
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
                <?php
                if(isset($title)) {
                    ?>
                    <div class="col-md-12"
                         style="margin-bottom:50px;min-height:200px;margin-top: 50px;border: 2px solid #C39C75;border-radius: 4px;">
                        <h4><?php echo $title; ?></h4>
                        <section>
                            <img height="100px" src="<?php echo $image ?>">
                            <span style="margin-left: 50px; text-decoration: solid;font-size: 18px;">
                            Price : $
                                <?php
                                echo $price;
                                ?>
                        </span>
                        </section>
                        <section>

                            <label for="locationTextField">Location</label>
                            <input id="autocomplete" placeholder="Enter your address" onFocus="initAutocomplete()" type="text">


                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Add as favourite food</td>
                                    <td>
                                        <button class="btn btn-warning" id="food" style="color: white;"><i
                                                    class="fa fa-heart"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Add as favourite restaurant</td>
                                    <td>
                                        <button class="btn btn-warning" id="restaurant" style="color: white;"><i
                                                    class="fa fa-star"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </section>
                        <section>
                            <form method="post" action="orderCheckout.php">
                                <input type="text" id="title" name="title" value="<?php echo $title;?>" style="display: none;">
                                <button type="submit" name="ordersub" class="btn btn-success" style="margin-top: 30px;">
                                    Complete Order
                                </button>
                            </form>
                        </section>

                    </div>
                    <?php
                }else{
                    ?>
                    <h2>Please search menu and place order</h2>
                    <?php
                }
                ?>

            </div>
            <div class="col-md-2"></div>

        </div>
    </div>
    <input type="text" id="user" value="<?php echo $_SESSION['username']?>" style="display: none;">
    <script>

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

        }

        $(document).ready(function () {


            $("#food").click(function () {
                var food = $("#title").val();
                var user = $("#user").val();
                $.post('./food.php',{user:user,food:food},function (data) {
                    alert(data);
                });
            });

            $("#restaurant").click(function () {
                var res = $("#location").val().trim();
                var user = $("#user").val();
                if(res!==''){
                    $.post('./restaurant.php',{user:user,res:res},function (data) {
                        alert(data);
                    });
                }else {
                    alert('please enter the location/restaurant')
                }
            });
        })
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLewNY8Hr_iFkqhKN27DwXgkrEM972_r0&libraries=places&callback=initAutocomplete" async defer></script>

    </body>
    </html>
    <?php
}else{
    header("location:index.php");
}
?>
