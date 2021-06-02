<?php

class UserModel
{
    private $username;
    private $password;
    private $email;
    private $phoneNumber;
    private $error;

    public function __construct()
    {
        $this->file = File::createFile();
    }
    function getError()
    {
        return $this->error;
    }
    function getUsername()
    {
        return $this->username;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    function setUsername($username)
    {
        $this->username = $username;
    }
    function setPassword($password)
    {
        $this->password = $password;
    }
    function setEmail($email)
    {
        $this->email = $email;
    }
    function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function saveUser()
    {
        try {
            $CurrentlyUsers =  file_get_contents($this->file);
            $CurrentlyUsersArray = json_decode($CurrentlyUsers, true);

            $CurrentlyUsersArray[] = array(
                "username" => $this->username,
                "password" => $this->password,
                "email" => $this->email,
                "phonenumber" => $this->phoneNumber,
                "messages" => array()

            );
            $CurrentlyUsers = json_encode($CurrentlyUsersArray);
            file_put_contents($this->file, $CurrentlyUsers);
            return true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }

    public function consultUser()
    {
        try {
            $users = file_get_contents($this->file);
            $users = json_decode($users, true);
            $boolean = false;
            if (is_array($users)) {
                foreach ($users as $value) {
                    if ($value["username"] === $this->username && $value["password"] === $this->password) {
                        $boolean = true;
                    }
                }
            }
            return $boolean;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }

    public function userExists()
    {
        try {
            $users = file_get_contents($this->file);
            $users = json_decode($users, true);
            $boolean = false;
            if (is_array($users)) {
                foreach ($users as $value) {
                    if ($value["username"] === $this->username || $value["email"] === $this->email) {
                        $boolean = true;
                    }
                }
            }
            return $boolean;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
}
