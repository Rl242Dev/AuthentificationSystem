<?php

$mysqli = new mysqli("127.0.0.1", "rl242", "31#Nigi2", "LoginSystem");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $pwd = $_POST["pwd"];
    $pwd_c = $_POST["pwd-c"];
    $id = $_POST["id"];
    $pwdSplitted = explode(" ", $pwd);
    $stmt = $mysqli->prepare("INSERT INTO LoginSystem.Users (ID, PWD) VALUES (?, ?)");
    if(count($pwdSplitted) > 1){
        echo 'Space Detected. Password Denied in case of SQL Injection';
        $link->close();
    }
    else{
        $stmt->bind_param("ss", $id, $pwd);
        $stmt->execute();
    }

}
?>
 
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System Sign Up</title>
    <style>
        body {
            align-self: auto;
        }
        .card-container{
            margin: auto;
            margin-top: 12.5%;
            width: 20%;
            height: 35%;
            background-color: #1F1F1F;
            box-shadow: 10px 7px 3px #292929;
            border-radius: 3%;

            align-self: auto;
        }
        .username {
            margin: 5%;
        }
        .pwd, .pwd-c {
            margin-top: 5%;
            margin-left: 12.7%;
        }
        .label-id, .input-id{
            margin-top: 5%;
        }
        .label-id, .label-pwd {
            color: aliceblue;
            font-size: 24px;
            font-family: 'Abel', sans-serif;
        }
        .button-submit {
            margin: 10%;
            margin-left: 40%;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <form action="sign-up" method="post">
            <div class="id">
                <label for="id" class="label-id">Username/ID :</label>
                <input type="text" name="id" class="input-id">
            </div>
            <div class="pwd">
                <label for="pwd" class="label-pwd">Password : </label>
                <input type="text" name="pwd" id="input-pwd">
            </div>
            <div class="pwd-c">
                <label for="pwd" class="label-pwd">Password : </label>
                <input type="text" name="pwd-c" id="input-pwd">
            </div>
            <input type="submit" class="button-submit" value="Submit">
        </form>
    </div>
</body>
</html>