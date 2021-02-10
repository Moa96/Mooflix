<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mooflix</title>
    <link rel="stylesheet" href="assets/styles/style.css" type="text/css">
</head>

<body>


    <!-- register sign form -->
    <div class="signInContainer">

        <div class="column">

            <!-- header sign in secton -->
            <div class="header">
                <!-- logo -->
                <img src="assets/images/mooflix-logo.png" alt="logo-img" title='Logo'>

                <h3>Sign In</h3>
                <span>to Continue to Mooflix</span>
            </div>

            <form method="POST">


                <input type="text" placeholder="User name" name="userName" required>



                <input type="password" placeholder="Enter Password" name="password" required>


                <input type="submit" name="submitButton" value=SUBMIT>




            </form>

            <a href="register.php" class="signInMessage">Don't have an account? Sign up here</a>

        </div>

    </div>

</body>

</html>