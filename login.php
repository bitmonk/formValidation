<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>

<div class="container">
<!-- Login Form -->
    <form action="frontpage.php" method="post">
        
<div class="signin-form">

<h2>Login</h2>
<div class="user-name">
    <label class="text-appearance" for="email">Email</label><br>
    <input class="input-field" id="user-name" type="text" name="username" placeholder="Enter your email address">
</div>

<div class="user-password">
    <label class="text-appearance" for="Password">Password</label><br>
    <input class="input-field" id="Password" type="password" name="password" placeholder="Enter your password">
</div>

<div class="buttons">
            <button type="submit" name="signin-button" class="buttons">Login</button>
        </div>


        <div>
            <p class="text-appearance">New Member ? <a href="register.php" class="anchor-button">Register Now<a></p>
        </div>

        </form>

    </div>
</div>
    <script src="app.js"></script>
</body>
</html>
