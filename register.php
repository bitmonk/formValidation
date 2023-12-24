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

if(isset($_POST['register-button'])){

$username = $_POST['username'];
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$countCom = substr_count(($email), '.com');
$password = $_POST['password'];
$hashPassword = password_hash($password, PASSWORD_DEFAULT);

$errors = array(
    'username' => array(),
    'email' => array(),
    'password' => array()
);

function hasSpace($username) {
    return preg_match('/\s/', $username);
}

function hasSpecialCharacterUser($username){
    return preg_match('/[^A-Za-z0-9]/', $username);
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

    if(hasSpace($username)){
        array_push($errors, "Username must not have any spaces !");
    }
    
    if(hasSpecialCharacterUser($username)) {
        array_push($errors, "Username must not have any special characters !");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $countCom > 1) {
            array_push($errors, "Email is Invalid !");
    }

    if(!hasAllConditions($password)){
        array_push($errors, "Password must have at least one Uppercase letter, one Lowercase letter, one number and one special character !");
    }

    $sql = "SELECT * FROM users WHERE email = ? ";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)){

    mysqli_stmt_bind_param($stmt, "s", $email);
    
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        $errors['email'][] = "Email Already Exitsts !";
    }
}

    if(count($errors) > 0 ){
        foreach ($errors as $error) {
            echo "<div class='error-container'><p class='error-text'>$error<p></div>";
        }

    }else{
            
            $sql = "INSERT INTO users (user, password, email) VALUES (?,?,?)";

            $stmt = mysqli_stmt_init($conn);

            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            

            if($prepareStmt){
                mysqli_stmt_bind_param($stmt,"sss",$username, $hashPassword, $email);
                mysqli_stmt_execute($stmt);

                echo "<div style='color: rgb(255, 153, 0);'>Registration Successful !</div>";
            }else{
                die("Something went wrong !");
            }
        }
    }

?>

    <!-- Register Form -->
    <form action="register.php" method="post">

        <h2>Welcome, New User</h2>
        <h5>Register for free</h5>

        <div class="register-form">

            <div class="user-name">
                <label class="text-appearance" for="user-name">User Name</label><br>
                <input class="input-field" id="user-name" type="text" name="username" placeholder="Enter your username">
            </div>

            <div class="user-email">
                <label class="text-appearance" for="email-address">Email</label><br>
                <input class="input-field" id="email-address" type="text" name="email" placeholder="Enter your Email">
            </div>

            <div class="user-password">
                <label class="text-appearance" for="Password">Password</label><br>
                <input class="input-field" id="Password" type="password" name="password" placeholder="Enter your password">
            </div>

            <button type="submit" name="register-button" class="buttons">Register</button>
        </div>



        <div class="buttons">
            
            <p class="text-appearance">Already a member ? <a href="login.php" class="anchor-button">Login Now</a></p>
        </div>
            

        <!-- Register Form End -->
    </form>
    </div>
</div>


    <script src="app.js"></script>
</body>

</html>




