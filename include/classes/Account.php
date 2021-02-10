<?php

class Account
{
    private $con;
    private $errorArray = array(); //empty arr
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmail($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
            return $this->insertUsersDetails($fn, $ln, $un, $em, $pw);
        }

        return false;
    }


    //users details
    private function insertUsersDetails($fn, $ln, $un, $em, $pw)
    {

        //hashing password
        $pw = hash("sha512", $pw);

        //insert data to database
        $query = $this->con->prepare("INSERT INTO users(firstName, lastName, userName, email, password) 
                                        VALUES(:fn, :ln, :un, :em, :pw)");

        $query->bindValue(':fn', $fn);
        $query->bindValue(':ln', $ln);
        $query->bindValue(':un', $un);
        $query->bindValue(':em', $em);
        $query->bindValue(':pw', $pw);


        return $query->execute();
    }


    private function validateFirstName($fn)
    {
        if (strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln)
    {
        if (strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUserName($un)
    {
        if (strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$userNameCharacters);
            return;
        }

        //check to see if the user name exists in the database
        $query = $this->con->prepare("SELECT * FROM users WHERE userName=:un");
        $query->bindValue(":un", $un);

        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$userNameTaken);
        }
    }


    private function validateEmail($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }

        //check the email is valid email
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }


        //check if the email has been taken
        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);

        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if (strlen($pw) < 2 || strlen($pw) > 25) {
            array_push($this->errorArray, Constants::$passwordsLength);
        }
    }



    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}