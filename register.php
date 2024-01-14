<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- php form validation -->
<div class="register-wrapper">

    <?php

    require_once("connection.php");
        $errors = array(
            'username' => array(),
            'email' => array(),
            'password' => array()
        );

    if(isset($_POST['register-button'])){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $countCom = substr_count(($email), '.com');
        $password = $_POST['password'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);


        if(isset($_POST['username'])){

            $user = $_POST['username'];

            if(preg_match('/[^A-Za-z0-9\s]/', $user)){
                $characterError = "Username must not contain any special characters !";
            }
            if(preg_match('/\s/', $user)){
                $spaceError = "Username must not contain any spaces !";
            }            
            
            // }elseif(preg_match('/\s/', $user) && preg_match('/[^A-Za-z0-9]/', $user)){
            //     $bothError = "Both error !";
            // }
            
            
            

        }else{
            echo "Sorry couldnot do that right now !";
       }
        

        function hasUpperCase($password) {
            return preg_match('/[A-Z]/', $password);
        }

        function hasLowerCase($password) {
            return preg_match('/[a-z]/', $password);
        }

        function hasNumber($password) {
            return preg_match('/[0-9]/', $password);
        }

        function hasSpecialCharacter($password) {
            return preg_match('/[^A-Za-z0-9]/', $password);
        }

        function hasAllConditions($password) {
            return hasUpperCase($password) && hasLowerCase($password) && hasNumber($password) && hasSpecialCharacter($password);
        }

        
        // if(hasBothCondition($username)){
        //     $errors['username']['user_check'] = "Username must not contain any spaces and special characters !";
        // }
        
            // if(hasSpecialCharacterUser($username)){
            //     $errors['username']['special_character'] = "Username must not contain any Special Characters !";
            // }elseif(hasSpace($username)){
            //     $errors['username']['space'] = "Username must not contain any spaces!";
            // }elseif(hasBothCondition($username)){
            //     $errors['username']['user_check'] = "Username must not contain any spaces and special characters !";
            // }
        
        

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $countCom > 1) {
            $errors['email'][] = "Email is Invalid !";
        }

        if(!hasAllConditions($password)){
            $errors['password'][] = "Password must have at least one Uppercase letter, one Lowercase letter, one number and one special character !";
        }

        $sql = "SELECT * FROM users WHERE email = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $email);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0) {
                $errors['email'][] = "Email Already Exists !";
            }
        }

        if(count($errors['username']) > 0 || count($errors['email']) > 0 || count($errors['password']) > 0){
            
            ?>

            
            
            <?php
        } else {
            $sql = "INSERT INTO users (user, password, email) VALUES (?,?,?)";

            $stmt = mysqli_stmt_init($conn);

            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

            if($prepareStmt){
                mysqli_stmt_bind_param($stmt,"sss",$username, $hashPassword, $email);
                mysqli_stmt_execute($stmt);

                echo "<div class='registration-popup' style='color: rgb(255, 153, 0);'>Registration Successful !<a class='login-link' href='login.php'>Login</a><a class='back-link' href='register.php'>Back</a></div>";
            
            }else{
                die("Something went wrong !");
            }
        }
    }

    ?>

    <!-- Register Form -->
    <form action="register.php" method="post">

        <h2 class="welcome-heading">Welcome, New User</h2>
        <h5>Register for free</h5>

        <div class="register-form">

            <div class="user-name">
                <label class="text-appearance" for="user-name">User Name</label><br>
                <input class="input-field" id="user-name" type="text" name="username" placeholder="Enter your username" required>
            </div>
            
            <!-- Display spcace error for username -->
            <?php if(isset($spaceError)): ?>
                <div class='error-container'>
                     <p class='error-text'><?php echo $spaceError; ?></p>
                </div>
            <?php endif; ?>

            <!-- Display special character error for username -->
            <?php if(isset($characterError)): ?>
                <div class='error-container'>
                    <p class='error-text'><?php echo $characterError; ?></p>
                </div>
            <?php endif; ?>

            <?php if(isset($bothError)): ?>
                <div class='error-container'>
                     <p class='error-text'><?php echo $bothError; ?></p>
                </div>
            <?php endif; ?>

            <div class="user-email">
                <label class="text-appearance" for="email-address">Email</label><br>
                <input class="input-field" id="email-address" type="text" name="email" placeholder="Enter your Email" required>
            </div>

            <?php foreach ($errors['email'] as $error): ?>
                <div class='error-container'>
                    <p class='error-text'><?php echo $error; ?></p>
                </div>
            <?php endforeach; ?>

            <div class="user-password">
                <label class="text-appearance" for="Password">Password</label><br>
                <input class="input-field password-field" id="Password" type="password" name="password" placeholder="Enter your password" required>             
                <i class="fa-regular fa-eye eye-button" onclick="togglePassword()"></i>
            </div>
            

            <?php foreach ($errors['password'] as $error): ?>
                <div class='error-container'>
                    <p class='error-text'><?php echo $error; ?></p>
                </div>

            <?php endforeach; ?>

            <div class="button-section">
        <div class="button-block">
        <button type="submit" name="register-button" class="buttons">Register</button>
    </div>
            <p class="text-appearance member-text">Already a member ? <a href="login.php" class="anchor-button">Login Now</a></p>
    </div>
           
        

         


        <!-- Register Form End -->
    </form>
    </div>
        
    
        
</div>


<script src="https://kit.fontawesome.com/e8b54f58bf.js" crossorigin="anonymous"></script>
<script src="app.js"></script>
</body>

</html>
