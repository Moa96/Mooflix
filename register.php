<?php
// FILES
require_once("include/config.php");
require_once("include/classes/FormSanitizer.php");
require_once("include/classes/Constants.php");
require_once("include/classes/Account.php");


$account = new Account($con);


if (isset($_POST['submitButton'])) {


    //sanitizing the inputs 
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);

    $userName = FormSanitizer::sanitizeFormUsername($_POST['userName']);

    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST['confirmEmail']);

    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST['confirmPassword']);


    //validating the form
    // $account->validateFirstName($firstName);
    // $account->validateLastName($lastName);

    $success = $account->register($firstName, $lastName, $userName, $email, $email2, $password, $password2);

    if ($success) {
        header("Location: index.php");
    }
}




?>













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

                <h3>Sign Up</h3>
                <span>to Continue to Mooflix</span>
            </div>

            <form method="POST">

                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" placeholder="First name" name="firstName" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" placeholder="Last name" name="lastName" required>

                <?php echo $account->getError(Constants::$userNameCharacters); ?>
                <?php echo $account->getError(Constants::$userNameTaken); ?>
                <input type="text" placeholder="User name" name="userName" required>

                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" placeholder="Email" name="email" required>
                <input type="email" placeholder="Confirm email" name="confirmEmail" required>


                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordsLength); ?>
                <input type="password" placeholder="Enter Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirmPassword" required>


                <input type="submit" name="submitButton" value=SUBMIT>




            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here</a>

        </div>

    </div>

</body>

</html>