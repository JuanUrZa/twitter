<?php
/*
This class is the controller for the model "message" and the view "account".

Functions: 
+ index: Show all messages that are published.
+ saveMessage: Get the message from the view, validate it, and finally save it.
+ searchMessages: Get the filters  "date" and "phrase" from the view, validates them, finally search in the messages and display them.
- show: Sort the array messages by date.
*/
require_once "models/message.php";

class MessagesController
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['user'])) { // Verify that the session is created
            $message = new MessageModel();
            $messageArray =  $message->searchMessages();

            if ($messageArray !== null) { // Verify that the function searchMessages() of model "message" is working fine
                $MessagesController = new MessagesController();
                $MessagesController->show($messageArray);
            } else {
                $error = $message->getError(); // Get the error that occurred when executing the function searchMessages()
                header("Location: index.php?c=messages");
            }
        } else {
            header("Location: index.php"); // If the session is not created it redirects to the Home page 
        }
    }

    public function saveMessage()
    {
        $success = "";
        session_start();

        if (isset($_SESSION['user'])) { // Verify that the session is created

            $text = $_POST['comment'];
            $user = $_SESSION['user'];
            $date = date("Y-m-d");

            if (isset($text) && !empty($text)) {
                $message = new MessageModel();
                $message->setText($text);
                $message->setDate($date);
                $message->setUser($user);
                $success = $message->saveMessage();

                if ($success !== null) {   // Verify that the function saveMessage() of model "message" is working fine                   
                    header("Location: index.php?c=messages");
                } else {
                    $error = $message->getError(); // Get the error that occurred when executing the function saveMessage()
                    header("Location: index.php?c=messages");
                }
            } else {
                header("Location: index.php?c=messages"); 
            }
        } else {
            header("Location: index.php"); // If the session is not created it redirects to the Home page 
        }
    }

    public function searchMessages()
    {
        session_start();

        if (isset($_SESSION['user'])) { // Verify that the session is created

            if (isset($_POST['search']) && !empty($_POST['search'])) $text = $_POST['search'];
            if (isset($_POST['date']) && !empty($_POST['date'])) {
                if (preg_match("/^(\d{4})\-\d{2}\-\d{2}$/", $_POST['date'])) {
                    $date = $_POST['date'];
                }
            }

            $message = new MessageModel();
            if (isset($text)) $message->setText($text);
            if (isset($date)) $message->setDate($date);

            if (isset($text) || isset($date)) {

                if (isset($text) && isset($date)) {
                    $messageArray =  $message->searchDatePhrase();
                } else if (isset($text)) {
                    $messageArray =  $message->searchPhrase();
                } else {
                    $messageArray =  $message->searchDate();
                }

                if ($messageArray !== null) { // Verify that the function searchDate() or searchPhrase() or searchDatePhrase()  of model "message" is working fine
                    $MessagesController = new MessagesController();
                    $MessagesController->show($messageArray);
                } else {
                    $error = $message->getError(); // Get the error that occurred when executing the function searchDate() or searchPhrase() or searchDatePhrase() 
                    header("Location: index.php?c=messages");
                }
            }else {
                header("Location: index.php?c=messages");
            }
        } else {
            header("Location: index.php"); // If the session is not created it redirects to the Home page 
        }
    }
    private function show($messageArray)
    {
        usort($messageArray, function ($a, $b) {
            return strcmp($a[0], $b[0]);
        });

        require_once "views/account.php";
    }
}
