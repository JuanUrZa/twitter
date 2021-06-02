<?php

class MessageModel
{
    private $text;
    private $date;
    private $user;
    private $error;

    public function __construct()
    {
        $this->file = File::createFile();
    }
    function getError()
    {
        return $this->error;
    }
    function getUser()
    {
        return $this->user;
    }

    function getText()
    {
        return $this->text;
    }
    function getDate()
    {
        return $this->date;
    }
    function setUser($user)
    {
        $this->user = $user;
    }
    function setText($text)
    {
        $this->text = $text;
    }
    function setDate($date)
    {
        $this->date = $date;
    }


    public function saveMessage()
    {
        try {
            $CurrentlyMessage =  file_get_contents($this->file);
            $CurrentlyMessageArray = json_decode($CurrentlyMessage, true);

            foreach ($CurrentlyMessageArray as $key => $values) {
                if ($this->user == $values["username"]) {
                    $CurrentlyMessageArray[$key]["messages"][] = array(
                        $this->date => $this->text
                    );
                }
            }
            $CurrentlyMessage = json_encode($CurrentlyMessageArray);
            file_put_contents($this->file, $CurrentlyMessage);
            return true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    public function searchMessages()
    {
        try {
            $CurrentlyMessage =  file_get_contents($this->file);
            $CurrentlyMessageArray = json_decode($CurrentlyMessage, true);
            $array = array();

            foreach ($CurrentlyMessageArray as $values) {
                foreach ($values["messages"] as $messages) {
                    foreach ($messages as $key => $message) {
                        $array[] = array($key, $message, $values["username"]);
                    }
                }
            }
            return $array;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }

    public function searchDate()
    {
        try {
            $CurrentlyMessage =  file_get_contents($this->file);
            $CurrentlyMessageArray = json_decode($CurrentlyMessage, true);
            $array = array();

            foreach ($CurrentlyMessageArray as $values) {
                foreach ($values["messages"] as $messages) {
                    foreach ($messages as $key => $message) {
                        $date_message = strtotime($key);
                        $date_filter = strtotime($this->date);

                        if ($date_message <= $date_filter) {
                            $array[] = array($key, $message, $values["username"]);
                        }
                    }
                }
            }
            return $array;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    public function searchPhrase()
    {
        try {
            $CurrentlyMessage =  file_get_contents($this->file);
            $CurrentlyMessageArray = json_decode($CurrentlyMessage, true);
            $array = array();

            foreach ($CurrentlyMessageArray as $values) {
                foreach ($values["messages"] as $messages) {
                    foreach ($messages as $key => $message) {
                        if (preg_match('/(' . $this->text . ')/i', $message)) {
                            $array[] = array($key, $message, $values["username"]);
                        }
                    }
                }
            }

            return $array;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
    public function searchDatePhrase()
    {
        try {
            $CurrentlyMessage =  file_get_contents($this->file);
            $CurrentlyMessageArray = json_decode($CurrentlyMessage, true);
            $array = array();

            foreach ($CurrentlyMessageArray as $values) {
                foreach ($values["messages"] as $messages) {
                    foreach ($messages as $key => $message) {
                        if (preg_match('/(' . $this->text . ')/i', $message)) {
                            $date_message = strtotime($key);
                            $date_filter = strtotime($this->date);

                            if ($date_message <= $date_filter) {
                                $array[] = array($key, $message, $values["username"]);
                            }
                        }
                    }
                }
            }

            return $array;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return null;
        }
    }
}
