<?php

class Restaraunt
{

    private $restaraunt_name;
    private $id;

    function __construct($restaraunt_name, $id = null)
    {
        $this->restaraunt_name = $restaraunt_name;
        $this->id = $id;
    }

    function setRestarauntName($new_restaraunt_name)
    {
        $this->restaraunt_name = (string) $new_restaraunt_name;
    }

    function getRestarauntName()
    {
        return $this->restaraunt_name;
    }

    function getId()
    {
        return $this->id;
    }


    function save()
    {
          array_push($_SESSION['list_of_restaraunts'], $this);
    }

    static function getAll()
    {
        return $_SESSION['list_of_restaraunts']; 
    }

    static function deleteAll()
    {
        $_SESSION['list_of_restaraunts'] = array();
    }


}


?>
