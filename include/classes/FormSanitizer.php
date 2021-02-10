<?php

class FormSanitizer
{

    //sanitizing the firstName and lastName
    public static function sanitizeFormString($inputText)
    {
        $inputText = strip_tags($inputText); //removing html tags
        $inputText = str_replace(' ', '', $inputText); //removing all space

        //make sure all character is lower case
        $inputText = strtolower($inputText);
        //just uppercase the firt character
        $inputText = ucfirst($inputText);

        return $inputText;
    }

    public static function sanitizeFormUsername($inputText)
    {
        $inputText = strip_tags($inputText); //removing html tags
        $inputText = str_replace(' ', '', $inputText); //removing all space


        return $inputText;
    }

    public static function sanitizeFormPassword($inputText)
    {
        $inputText = strip_tags($inputText); //removing html tags


        return $inputText;
    }

    public static function sanitizeFormEmail($inputText)
    {
        $inputText = strip_tags($inputText); //removing html tags
        $inputText = str_replace(' ', '', $inputText); //removing all space


        return $inputText;
    }
}