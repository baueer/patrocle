<?php
    session_start();
    if(isset($_SESSION['error'])) {
        $aux = explode('-', $_SESSION['error']);
        $errorType = $aux[0];
        if($errorType == 1 || $errorType == 2) {
            $errorEmail = $aux[2];
            $errorText = $aux[1];
        }
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['user'])) {
        header('location: '.ROOT.DASHBOARD_ROUTE);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PATROCLE.ME</title>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="inc/css/main.css">
</head>
<body>

    <div id="login-container" class="perfect-center">
        <h1>PATROCLE.me</h1>

        <form action="login/submitLogin" method="POST" id="login-form">
            <div class="inline-login-aux-box">
                <label for="email" 
                <?php 
                    if(isset($errorType)) {
                        if($errorType == 1) {
                            echo 'class="error"';
                        }
                    }
                ?>>EMAIL</label>
                <?php 
                    if(isset($errorType)) {
                        if($errorType == 1) {
                            echo '<div class="error-login-box">'.$errorText.'</div>';
                        }
                    }
                ?>
            </div><br>
            <input type="text" name="email" placeholder="john@doe.com" autocomplete="off"
                <?php
                    if(isset($errorType)) {
                        if($errorType == 2) {
                            echo 'value="'.$errorEmail.'"';
                        }
                        if($errorType == 1) {
                            echo 'class="error"';
                        }
                    }
                ?>
            ><br>
            <div class="inline-login-aux-box">
                <label for="password"
                <?php 
                    if(isset($errorType)) {
                        if($errorType == 2) {
                            echo 'class="error"';
                        }
                    }
                ?>>PASSWORD</label>
                <?php 
                    if(isset($errorType)) {
                        if($errorType == 2) {
                            echo '<div class="error-login-box">'.$errorText.'</div>';
                        }
                    }
                ?>
            </div><br>
            
            <input type="password" name="password" placeholder="password" autocomplete="off" 
                <?php 
                if(isset($errorType)) {
                    if($errorType == 2) {
                        echo 'class="error"';
                    }
                }
                ?>><br>
            <label class="checkbox" style="margin-top: 5px">
                remember me
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <input type="submit" name="submit" value="LOGIN">
        </form>
    </div>

</body>
</html>