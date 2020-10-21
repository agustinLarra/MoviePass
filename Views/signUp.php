<?php namespace Views;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../Views/css/styleSignUp.css">
</head>
    
    <body>
        <form action="<?= FRONT_ROOT ?> User/create" method="post">
        <div id="signUp-box">
            <div class="left">
                <h1>Sign up</h1>
                
                <input type="text" name="firstName" placeholder="First Name" />
                <input type="text" name="lastName" placeholder="Last Name" />
                <input type="number" name="dni" placeholder="DNI" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password">

                <input type="submit" name="signup_submit" value="Sign me up" />
            </div>
            
            <div class="right">
                <span class="loginwith">Sign in with<br />social network</span>
                
                <button class="social-signin facebook">Log in with facebook</button>
            </div>
            <div class="or">OR</div>
        </div>

        </form>
        
    </body>
</html>