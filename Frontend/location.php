<?php
require_once "connect.php";

$locations=array(
    "Giovanni Pizza Pasta & Grill",
"Intrinsic Cafe",
"Ramen Gami",
"Burger Walla",
"Thai Cuisine",
"Resa Grill",
"The Halal Guys",
"Ono Grinds Poke",
"McGovers Tavern",
"The Green Chicpea",
"La Cocina",
"Sunrise Kitchen",
"Harvest Table",
"Panda Chinese Restaurant",
"Mercato Tomato Pie",
"Robert's Pizzeria",
"Nizi Sushi",
"27 Mix",
"Dinosaur Bar-B-Que",
"Smashburger",
"Subway",
"Annabella's Kitchen",
"Blaze Pizza",
"QDOBA Mexican Eats",
"IHOP",
"E-Z Market",
"Tops Diner",
"Sonic Drive-In",
"Dario's "
);

/*foreach ($locations as $location){
    $stt=$db->prepare("INSERT INTO locations(id,location) VALUES(?,?)");
    $data=array(NULL, $location);
    if($stt->execute($data)){
        echo 'inserted<br>';
    }else{
        echo 'error<br>';
    }
}*/