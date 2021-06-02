<?php

class File
{
    public static function createFile()
    {   
        $route = "C:/xampp/htdocs/twitter/users.json";
        if(!file_exists($route)){
        $file = fopen($route, "w+");
        fclose($file);
        }

        return $route;
    }
    //This function is creating the .json file
}
