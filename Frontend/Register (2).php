<?php
$pos = 0;
//BLH8839OUtmsh06PoUmvYv1aKVeRp1lwz7Bjsnqmo9vVgjhrlA
require_once 'vendor/autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = array();
    $success = "";
    if(isset($_POST['reg'])){
        $user=trim($_POST['username']);
        $pass=trim($_POST['password']);
        $repass=trim($_POST['repassword']);
        if($user){
            if($pass){
                if($repass){
                    if($repass==$pass){
                        require_once "connect.php";
                        $hpass = md5($pass);
                        $stt = $db->prepare("SELECT * FROM users WHERE username = ?");
                        $stt->bindParam(1,$user);
                        $stt->execute();
                        if($stt->rowCount()==0){
                            $stm = $db->prepare("INSERT INTO users(id,username,password,regdate) VALUES(?,?,?,?)");
                            $data = array(NULL,$user,$hpass,date("F, Y"));
                            if($stm->execute($data)){
                                $success = "Inserted Successfully";
                                header("location:index.php");
                            }else{
                                array_push($errors,"Failed to add");
                            }
                        }else{
                            array_push($errors,"User with that username already exists");
                        }

                    }else{
                        array_push($errors,"Passwords do not match");
                    }
                }else{
                    array_push($errors,"Please confirm your passsword");
                }
            }else{
                array_push($errors,"Please enter the password");
            }
        }else{
            array_push($errors,"Please enter the username");
        }
    }
}

?>
<html>

<head>

    <title>NJIT DINER | Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function HandleLoginResponse(response)
        {
            var text = JSON.parse(response);
            document.getElementById("output").innerHTML = "response: "+text+"<p>";
        }
        function sendLoginRequest(username,password)
        {
            var request = new XMLHttpRequest();
            request.open("POST","",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.onreadystatechange= function ()
            {

                if ((this.readyState == 4)&&(this.status == 200))u
                {
                    HandleLoginResponse(this.responseText);
                }
            }
            request.send("type=login&uname="+username+"&pword="+password);
        }
    </script>
</head>


<body style = "background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAA1BMVEX/zJn3frqVAAAASElEQVR4nO3BgQAAAADDoPlTX+AIVQEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwDcaiAAFXD1ujAAAAAElFTkSuQmCC)">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include_once "./navigation.php";?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <img src = "http://www.transparentpng.com/download/food/n0nASj-food-plate-cut-out.png" style="width:120px; height: 130px; margin-right:500px;">
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
        <div class="col-md-2"></div>


        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post" action="Register.php">
                <?php
                if(isset($errors)){
                    foreach ($errors as $error){
                        ?>
                        <div style="color: red;">
                            <span><?php echo $error?></span>
                        </div>
                        <?php
                    }
                }
                if(isset($success)){
                    ?>
                    <div style="color: green;">
                        <span><?php echo $success?></span>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">

                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="repassword">Password</label>
                    <input id="repassword" type="password" name="repassword" class="form-control" placeholder="Confirm your password">
                </div>
                <div class="form-group">
                    <button type="submit" name="reg" class="btn btn-success">Register</button>
                </div>
                <div class="form-group">
                    <span>
                        Already have an Account?
                        <a href="index.php">Login Here</a>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>

    </div>
</div>


</body>
</html>

