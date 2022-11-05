<?php

$mysqli = new mysqli("127.0.0.1", "*", "*", "LoginSystem");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){ // Not veryfing if user already exist

    // Getting post request data from form
    
    $pwd = $_POST["pwd"];
    $id = $_POST["id"];

    // Prepare Query Statement 

    $query = $mysqli->prepare("SELECT * FROM LoginSystem.Users WHERE ID = ? LIMIT 1");
    $query->bind_param("s", $id);
    
    // Query for user pwd

    $query->execute();
    
    // Get Query Data
    // Check if user doesnt exist

    $result = $query->get_result();
    if($result == false){
        echo 'User Doesn\'t exist';
    }
    else{
        while($row = $result->fetch_assoc()){
            if(password_verify($pwd, $row['PWD'])){
                echo 'Correct Password';
            }
            else{
                echo 'Invalid Password';
            };
        }
    }

    // splitting pwd to pre-check SQL Injection

    $pwdSplitted = explode(" ", $pwd);

    // Main check of splitted password    
    if(count($pwdSplitted) > 1){
        echo 'Space Detected. Password Denied in case of SQL Injection';
        $mysqli->close();
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
    <title>Login System Log in</title>
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
        .pwd {
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
        <form action="" method="post">
            <div class="id">
                <label for="id" class="label-id">Username/ID :</label>
                <input type="text" name="id" class="input-id">
            </div>
            <div class="pwd">
                <label for="pwd" class="label-pwd">Password : </label>
                <input type="text" name="pwd" id="input-pwd">
            </div>
            <input type="submit" class="button-submit" value="Login">
        </form>
    </div>
</body>
</html>
