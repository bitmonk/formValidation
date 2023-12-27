<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
</head>


<body>
<?php 
        require_once("connection.php");

        
        
        if(isset($_POST['login-button'])){
                $email = $_POST['email'];
                $password = $_POST['password'];

                
                $sql = "SELECT * FROM users WHERE email = '$email'";

                $result = mysqli_query($conn, $sql);

                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if(isset($_POST['email'])){
                    $storedEmail = $_POST['email'];
                }

                if($user){
                    if(password_verify($password, $user["password"])){

                        header("Location: dashboard.php");
                        die();
                    }else{
                        $passwordError = "Password Doesnot Match !";
                    }

                }else{
                    $emailError =  "Email Doesnot Match !";
                }
            }
        
        ?>

<div class="login-container">
<!-- Login Form -->


    <form action="login.php" method="post">
        
<div class="login-form">

<h2>Login</h2>
<div class="user-name">
    <label class="text-appearance" for="email">Email</label><br>
    <input class="input-field" id="email" type="text" name="email" value="<?php if(!empty($storedEmail)){echo $storedEmail;}else{echo "";} ?>" placeholder="Enter your email address" required>
</div>

<?php  if(isset($emailError)): ?>
    <div class="login-error">
        <p class="error-text"><?php echo $emailError; ?></p>
</div>

<?php endif; ?>

<div class="user-password">
    <label class="text-appearance" for="Password">Password</label><br>
    <input class="input-field" id="Password" type="password" name="password" placeholder="Enter your password" required>
</div>

<?php  if(isset($passwordError)): ?>
    <div class="login-error">
        <p class="error-text"><?php echo $passwordError; ?></p>
</div>

<?php endif; ?>

<div class="buttons">
            <button type="submit" name="login-button" class="buttons">Login</button>
        </div>


        <div>
            <p class="text-appearance">New Member ? <a href="register.php" class="anchor-button">Register Here<a></p>
        </div>

        
        </form>
    </div>

<!-- form end -->

</div>
    <script src="app.js"></script>
</body>
</html>
