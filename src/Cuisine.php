<?php
    class Cuisine
    {
        private $cuisine_name;
        private $id;

        function __construct($cuisine_name, $id = null)
        {
            $this->cuisine_name = $cuisine_name;
            $this->id = $id;
        }

        function setCuisineName($new_cuisine_name)
        {
            $this->cuisine_name = $new_cuisine_name;
        }

        function getCuisineName()
        {
            return $this->cuisine_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (cuisine_name) VALUES ('{$this->getCuisineName()}')");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $cuisine_name = $cuisine['cuisine_name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($cuisine_name, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");

        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach ($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function getRestaraunts()
        {
            $restaraunts = array();
            $returned_restaraunts = $GLOBALS['DB']->query("SELECT * FROM restaraunts WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaraunts as $restaraunt) {
                $restaraunt_name = $restaraunt['restaraunt_name'];
                $id = $restaraunt['id'];
                $cuisine_id = $restaraunt['cuisine_id'];
                $new_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
                array_push($restaraunts, $new_restaraunt);
            }

            return $restaraunts;
        }



    }
?>
