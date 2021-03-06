<?php

$key="BLH8839OUtmsh06PoUmvYv1aKVeRp1lwz7Bjsnqmo9vVgjhrlA";

//activate navbar according to page
function nav($curr,$pos){
    if($curr == $pos){
        return "active";
    }
    else{
        return "";
    }
}

function getMenuItem($item){
    require_once "./vendor/autoload.php";
    // Disables SSL cert validation temporary
    Unirest\Request::verifyPeer(false);

    $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/menuItems/search?query=".$item."&offset=0&number=10&minCalories=0&maxCalories=5000&minProtein=0&maxProtein=100&minFat=0&maxFat=100&minCarbs=0&maxCarbs=100",
        array(
            "X-Mashape-Key" => $GLOBALS['key'],
            "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
        )
    );
    return $response->body->menuItems;
}
function searchMenu($query){
    require_once "./vendor/autoload.php";
    // Disables SSL cert validation temporary
    Unirest\Request::verifyPeer(false);

    //fetch data
    $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/menuItems/suggest?query=".$query."&number=5",
        array(
            "X-Mashape-Key" => $GLOBALS['key'],
            "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
        )
    );
    return $response->body->results;
}

function getMenuInfo($id){
    // Disables SSL cert validation temporary
    Unirest\Request::verifyPeer(false);

    //fetch data
    $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/menuItems/".$id,
        array(
            "X-Mashape-Key" => "ZbwYt8rrzGmshEmlKAsALgc4U1Q5p1p33UKjsnO2MXpmdT4w8H",
            "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
        )
    );
    return $response->body;
}
