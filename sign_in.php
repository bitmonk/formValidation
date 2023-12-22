<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>


<!-- Login Form -->
    <form action="frontpage.php" method="post">

<div class="signin-form">

<h2>Sign In</h2>
<div class="user-name">
    <label class="text-appearance" for="email">Email</label><br>
    <input id="user-name" type="text" name="username" placeholder="Enter your email address">
</div>

<div class="user-password">
    <label class="text-appearance" for="Px  assword">Password</label><br>
    <input id="Password" type="password" name="password" placeholder="Enter your password">
</div>

<div class="buttons">
            <button type="submit" name="signin-button">Sign In</button>
        </div>


        <div>
            <p class="text-appearance">New Member ? <a href="register.php" class="anchor-button">Register Now<a></p>
        </div>

        </form>

</div>
    <script src="app.js"></script>
</body>
</html>
