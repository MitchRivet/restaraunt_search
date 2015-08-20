<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Restaraunt.php";
require_once "src/Cuisine.php";

$server = 'mysql:host=localhost;dbname=restaraunt_search_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RestarauntTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
      Restaraunt::deleteAll();
      Cuisine::deleteAll();
    }

    function test_save()
    {
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);

        $test_restaraunt->save();

        $result = Restaraunt::getAll();
        $this->assertEquals($test_restaraunt, $result[0]);
    }

    function test_getAll()
    {
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $test_restaraunt->save();

        $restaraunt_name2 = "Big Bobs Fried Alligator";
        $test_restaraunt2 = new Restaraunt($restaraunt_name2, $id, $cuisine_id);
        $test_restaraunt2->save();

        //Act
        $result = Restaraunt::getAll();

        //Assert
        $this->assertEquals([$test_restaraunt, $test_restaraunt2], $result);
    }

    function test_deleteAll()
    {
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $test_restaraunt->save();

        $restaraunt_name2 = "Big Bobs Fried Alligator";
        $test_restaraunt2 = new Restaraunt($restaraunt_name2, $id, $cuisine_id);
        $test_restaraunt2->save();

        //Act
        Restaraunt::deleteAll();

        //Assert
        $result = Restaraunt::getAll();
        $this->assertEquals([], $result);
    }

    function test_getId()
    {
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $test_restaraunt->save();

        //Act
        $result = $test_restaraunt->getId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    function test_getCuisineId()
    {
        //Arrange
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $test_restaraunt->save();

        //Act
        $result = $test_restaraunt->getCuisineId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    function test_find()
    {
        //Arrange
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $test_restaraunt->save();

        $restaraunt_name2 = "Big Bobs Fried Alligator";
        $test_restaraunt2 = new Restaraunt($restaraunt_name2, $id, $cuisine_id);
        $test_restaraunt2->save();

        //Act
        $result = Restaraunt::find($test_restaraunt->getId());

        //Assert
        $this->assertEquals($test_restaraunt, $result);
    }

    function test_RestarauntUpdate()
    {
        //Arrange
        $cuisine_name = "Italian";
        $id = null;
        $test_cuisine = new Cuisine($cuisine_name, $id);
        $test_cuisine->save();

        $restaraunt_name = "Mamas Home Country Cookin";
        $cuisine_id = $test_cuisine->getId();
        $test_restaraunt = new Restaraunt($restaraunt_name, $id, $cuisine_id);
        $new_restaraunt_name = "Wow! This is it!";

        //Act
        $test_restaraunt->update($new_restaraunt_name);

        //Assert
        $this->assertEquals("Wow! This is it!", $test_restaraunt->getRestarauntName());
    }
}
?>
