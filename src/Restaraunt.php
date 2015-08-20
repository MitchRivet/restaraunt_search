<?php

class Restaraunt
{

    private $restaraunt_name;
    private $id;
    private $cuisine_id;
    private $address;
    private $menu;
    private $hours;

    //Constructor
    function __construct($restaraunt_name, $id = null, $cuisine_id, $address, $menu, $hours)
    {
        $this->restaraunt_name = $restaraunt_name;
        $this->id = $id;
        $this->cuisine_id = $cuisine_id;
        $this->address = $address;
        $this->menu = $menu;
        $this->hours = $hours;
    }

    //Setters
    function setRestarauntName($new_restaraunt_name)
    {
        $this->restaraunt_name = (string) $new_restaraunt_name;
    }

    function setAddress($new_address)
    {
        $this->address = (string) $new_address;
    }

    function setMenu($new_menu)
    {
        $this->menu = $new_menu;
    }

    function setHours($new_hours)
    {
        $this->hours = $new_hours;
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

    function getAddress()
    {
        return $this->address;
    }

    function getMenu()
    {
        return $this->menu;
    }

    function getHours()
    {
        return $this->hours;
    }

    //Save function
    function save()
    {
          $GLOBALS['DB']->exec("INSERT INTO restaraunts (restaraunt_name, cuisine_id, address, menu, hours)
          VALUES ('{$this->getRestarauntName()}',{$this->getCuisineId()},'{$this->getAddress()}','{$this->getMenu()}','{$this->getHours()}')");
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
            $address = $restaraunt['address'];
            $menu = $restaraunt['menu'];
            $hours = $restaraunt['hours'];
            $new_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id, $address, $menu, $hours);
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

    function update($new_restaraunt_name, $new_address, $new_menu, $new_hours)
    {
        $GLOBALS['DB']->exec("UPDATE restaraunts
            SET restaraunt_name = '{$new_restaraunt_name}',
            SET address = '{$new_address}',
            SET menu = '{$new_menu}',
            SET hours = '{$new_hours}'
            WHERE id = {$this->getId()};");
        $this->setRestarauntName($new_restaraunt_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaraunts WHERE id = {$this->getId()};");
    }
}


?>
