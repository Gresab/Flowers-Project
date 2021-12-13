<?php
    include_once '../components/header2.php';
?>

<?php if(isset($_SESSION['is_logged_in'])) {?>
        <h1 style="margin: 250px 0 250px 0;">You are already logged in</h1>
<?php } else { ?>
    <div class="account">            
        <div id="log-error" class="
            <?php if(isset($_SESSION['login-register-error']) && $_SESSION['login-register-error'] == true && (isset($_GET['login']) || isset($_GET['register']))) { 
                echo 'llogaria-error"'; 
            } else { ?>  
                llogaria-error hidden"
            <?php } ?>>
            <p id='msg'><?php
                if(isset($_GET['login'])){
                    if($_GET['login'] == "error") 
                        echo 'Email or password is incorrect';
                    else if ($_GET['login'] == "emptyfields")
                        echo 'All feilds need to be filled';
                }
                else if (isset($_GET['register'])){
                    if ($_GET['register'] == 'emptyfields')
                        echo 'Please fill in all the data';
                    else if($_GET['register'] == 'error')
                        echo 'That email is currently is use. Please try another one!';
                    }
            $_SESSION['login-register-error'] = false; ?></p>
        </div>
        <form method="POST" action="../businessLogic/AccountVerify.php" id='llogaria-form'>
            <div class="login form form-style">
            <h2>Login</h2>
            <div class="slider"></div>
            <label for="">Email</label>
            <input type="email" class="input" id="loginEmail" name="email" placeholder="example@gmail.com"/>
            <label for="">Password</label>
            <input class="input" id="loginPass" name="password" type="password" placeholder="password..."/>
            <input type="submit" id="login-submit" class="button" name="login-btn" value="Login" />
            <p>Not a memeber yet? <a onclick="changeForm(1)">Register</a></p>
        </div>
        <div class="register form hidden">
            <h2>Register</h2>
            <div class="slider"></div>
            <label for="">Username</label>
            <input id="username" type="text" class="input" name="register-username" placeholder="username..."/>
            <label for="">Lastname</label>
            <input id="userlastname" type="text" class="input" name="register-lastname" placeholder="lastname..."/>
            <label for="">Email</label>
            <input id="reg-email" type="email" class="input" name="register-email" placeholder="example@gmail.com" />
            <label for="">Password</label>
            <input id="reg-pw" type="password" class="input" name="register-password" placeholder="password..."/>
            <label for="confirmPassword">Confirm password</label>
            <input id="conf-pw" type="password" class="input" name="confirmpassword" placeholder="confirm password..."/>
            <input type="submit" name="register-btn" class="button" value="Register" id="submit-btn"/>  
            <p>Do you have an account? <a onclick="changeForm(0)">Login</a></p>
        </div>
        </form>
    </div>
<?php } 
include '../components/footer.php'?>