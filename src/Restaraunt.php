<?php

class Restaraunt
{

    private $restaraunt_name;
    private $id;
    private $cuisine_id;

    //Constructor
    function __construct($restaraunt_name, $id = null, $cuisine_id)
    {
        $this->restaraunt_name = $restaraunt_name;
        $this->id = $id;
        $this->cuisine_id = $cuisine_id;
    }

    //Setters
    function setRestarauntName($new_restaraunt_name)
    {
        $this->restaraunt_name = (string) $new_restaraunt_name;
    }

    //Getters
    function getRestarauntName()
    {
        return $this->restaraunt_name;
    }

    function getId()
    {
      return $this->id;
    }

    function getCuisineId()
    {
        return $this->cuisine_id;
    }

    //Save function
    function save()
    {
          $statement = $GLOBALS['DB']->exec("INSERT INTO restaraunts (restaraunt_name, cuisine_id) VALUES ('{$this->getRestarauntName()}', {$this->getCuisineId()})");
          $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //Static getAll function
    static function getAll()
    {
        $returned_restaraunts = $GLOBALS['DB']->query("SELECT * FROM restaraunts;");
        $restaraunts = array();
        foreach ($returned_restaraunts as $restaraunt) {

            $restaraunt_name = $restaraunt['restaraunt_name'];
            $id = $restaraunt['id'];
            $cuisine_id = $restaraunt['cuisine_id'];
            $new_restaraunt = new Restaraunt ($restaraunt_name, $id, $cuisine_id);
            array_push($restaraunts, $new_restaraunt);
        }
        return $restaraunts;
    }

    //Static deleteAll function
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaraunts;");
    }

    static function find($search_id)
    {
        $found_restaraunt = null;
        $restaraunts = Restaraunt::getAll();
        foreach ($restaraunts as $restaraunt) {
            $restaraunt_id = $restaraunt->getId();
            if ($restaraunt_id == $search_id) {
                $found_restaraunt = $restaraunt;
            }
        }

        return $found_restaraunt;
    }
}


?>
