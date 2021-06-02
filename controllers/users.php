<?php
/*
This class is the controller for the model "user" and the views "login" - "signup".

Functions: 
+ index: Show the login view.
+ singup: Show the singup view.
+ saveUser: Get the user data from the view and validate it, finally if the user does not exist create the new user.
+ login: Get the user data from the view and validate if the user exist, if exist, show the account the user (Message posting view).
- validations: Validate if user data meets conditions.
*/

require_once "models/user.php";

class UsersController
{
    public function index()
    {
        require_once "views/login.php";
    }
    public function singup()
    {
        require_once "views/signup.php";
    }
    public function saveUser()
    {
        $success = "";

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone'];

        $usersController = new UsersController();
        $correctUser = $usersController->validations($username, "username");
        $correctPassword = $usersController->validations($password, "password");
        $correctEmail = $usersController->validations($email, "email");
        $correctPhone = $usersController->validations($phoneNumber, "phone");

        if ($correctUser && $correctPassword && $correctEmail && $correctPhone) { // Validate if the data of the user is correct
            $user = new UserModel();
            $user->setEmail($email);
            $user->setUsername($username);

            $success = $user->userExists();

            if ($success !== null) { // Verify that the function userExists() of model "user" is working fine
                if (!$success) {  // Verify that the user does not currently exist
                    $user->setPassword($password);
                    $user->setPhoneNumber($phoneNumber);
                    $success = $user->saveUser();
                    if ($success == null) {  // Verify that the function saveUser() of model "user" is working fine
                        $error = $user->getError(); // Get the error that occurred when executing the function saveUser()
                        require_once "views/signup.php";
                    }else{
                        $userCreated ="User created successfully";
                        require_once "views/signup.php";
                    }
                } else {
                    $error = "The username or email is currently being used by another account";
                    require_once "views/signup.php";
                }
            } else {
                $error = $user->getError(); // Get the error that occurred when executing the function userExists()
                require_once "views/signup.php";
            }
        } else {
            require_once "views/signup.php";
        }
    }
    public function login()
    {
        $success = "";

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (isset($username) && isset($password) && !empty($username) && !empty($password)) {
            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);

            $success = $user->consultUser();
            if ($success !== null) {   // Verify that the function consultUser() of model "user" is working fine
                if ($success) { // Verify that the user currently exist

                    session_start();
                    $_SESSION['user'] = $user->getUsername();
                    require_once "views/account.php";
                    header("Location: index.php?c=messages");
                } else {
                    $error = "The username or password is incorrect";
                    require_once "views/login.php";
                }
            } else {
                $error = $user->getError();
                require_once "views/signup.php";
            }
        } else {
            $error = "The username or password is incorrect";
            require_once "views/login.php";
        }
    }
    private function validations($fact, $name)
    {

        $expressions = [
            "username" => "/^[a-zA-Z0-9]{6,}$/",
            "password" => "/^[a-zA-Z0-9-]{6,}$/",
            "email" => "/[-a-zA-Z0-9@:%_\+.~#?&=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&=]*)?/",
            "phone" => "/^[0-9]{10,}$/",
        ];

        switch ($name) {
            case 'username': // Should not be empty, have at least 4 letters and 2 numbers, and should not contain special characters.
                if (isset($fact)) {
                    if (!empty($fact)) {
                        if (preg_match($expressions["username"], $fact)) {
                            if (strlen(preg_replace("/[0-9]/", "", $fact)) >= 4 && strlen(preg_replace("/[a-zA-Z]/", "", $fact)) >= 2) {
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
                break;
            case 'password': // It should be at least 6 characters long and contain a “-” and an uppercase letter.
                if (isset($fact)) {
                    if (!empty($fact)) {
                        if (preg_match($expressions["password"], $fact)) {
                            if (strlen(preg_replace("/[^-]/", "", $fact)) === 1 && strlen(preg_replace("/[^A-Z]/", "", $fact)) === 1) {
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
                break;
            case 'email': // It must be a valid email example@email.com
                if (isset($fact)) {
                    if (!empty($fact)) {
                        if (preg_match($expressions["email"], $fact)) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
                break;
            case 'phone': // It should have at least 10 numbers, all the characters here must be numbers.
                if (isset($fact)) {
                    if (!empty($fact)) {
                        if (preg_match($expressions["phone"], $fact)) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
    }
}
