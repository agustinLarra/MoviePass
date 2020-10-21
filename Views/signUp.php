<?php namespace Views;
?>
    
<body class="bodySignUp">
    <form action="<?= FRONT_ROOT ?> User/signUp" method="post">
    <div id="signUp-box">
        <div class="left">
            <h1 class="h1SignUp">Sign up</h1>
            
            <input class="inputSignUp" type="text" name="firstName" placeholder="First Name" />
            <input class="inputSignUp" type="text" name="lastName" placeholder="Last Name" />
            <input class="inputSignUp" type="number" name="dni" placeholder="DNI" />
            <input class="inputSignUp" type="email" name="email" placeholder="Email" />
            <input class="inputSignUp" type="password" name="password" placeholder="Password">

            <input class="inputSignUp" type="submit" name="signup_submit">
        </div>
        
        <div class="right">
            <span class="loginwith">Sign in with<br />social network</span>
            
            <button class="social-signin facebook">Log in with facebook</button>
        </div>
        <div class="or">OR</div>
    </div>

    </form>
