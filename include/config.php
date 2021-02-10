<?php

ob_start(); //Turns on output buffering

//Starts the session- session is ways of saving variables etc.
session_start();

date_default_timezone_set("Europe/Oslo");

//connect to database
try {
    $con = new PDO("mysql:host=localhost;dbname=mooflix", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $error) {
    exit("Connection Failed!" . $error->getMessage());
}