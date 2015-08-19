<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaraunt_search';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaraunt::deleteAll();
        }

        function test_getCuisineName()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);

            //Act
            $result = $test_cuisine->getCuisineName();

            //Assert
            $this->assertEquals($cuisine_name, $result);

        }

        function test_getId()
        {
            //Arrange
            $cuisine_name = "Italian";
            $id = 1;
            $test_cuisine = new Cuisine($cuisine_name, $id);

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $cuisine_name = "Italian";
            $cuisine_name2 = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($cuisine_name2);
            $test_cuisine2->save();

            //Act

            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll()
        {
            $cuisine_name = "Italian";
            $cuisine_name2 = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($cuisine_name2);
            $test_cuisine2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $cuisine_name = "Italian";
            $cuisine_name2 = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($cuisine_name2);
            $test_cuisine2->save();

            $result = Cuisine::find($test_cuisine->getId());

            $this->assertEquals($test_cuisine, $result);
        }

        function testsGetRestaraunts()
        {
            $cuisine_name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $restaraunt_name = "Uncle Chuck's Friend Pig";
            $test_restaraunt = new Restaraunt($restaraunt_name, $id, $test_cuisine_id);
            $test_task->save();

            $restaraunt_name2 = "Yum Yum Kitchen";
            $test_restaraunt2 = new Restaraunt($restaraunt_name2, $id, $test_cuisine_id);
            $test_restaraunt2->save();

            //Act
            $result = $test_category->getTasks();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }
    }

?>
