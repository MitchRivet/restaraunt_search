<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Restaraunt.php";

$server = 'mysql:host=localhost;dbname=restaraunt_search';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RestarauntTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
      Restaraunt::deleteAll();
    }

    function test_save()
    {
        $restaraunt_name = "Yum Yum Kitchen";
        $test_restaraunt = new Restaraunt($restaraunt_name);

        $test_restaraunt->save();

        $result = Restaraunt::getAll();
        $this->assertEquals($test_restaraunt, $result[0]);
    }

    function test_getAll()
    {
      $restaraunt_name = "Yum Yum Kitchen";
      $restaraunt_name2 = "Hot Dog Heaven";
      $test_restaraunt = new Restaraunt($restaraunt_name);
      $test_restaraunt->save();
      $test_restaraunt2 = new Restaraunt($restaraunt_name2);
      $test_restaraunt2->save();

      $result = Restaraunt::getAll();

      $this->assertEquals([$test_restaraunt, $test_restaraunt2], $result);

    }

    function test_deleteAll()
    {
      $restaraunt_name = "Yum Yum Kitchen";
      $restaraunt_name2 = "Hot Dog Heaven";
      $test_restaraunt = new Restaraunt($restaraunt_name);
      $test_restaraunt->save();
      $test_restaraunt2 = new Restaraunt($restaraunt_name2);
      $test_restaraunt2->save();

      Restaraunt::deleteAll();

      $result = Restaraunt::getAll();
      $this->assertEquals([], $result);
    }

    function test_getId()
    {
      $restaraunt_name = "Yum Yum Kitchen";
      $id = 1;
      $test_restaraunt = new Restaraunt($restaraunt_name, $id);

      $result = $test_restaraunt->getId();

      $this->assertEquals(1, $result);
    }

    function test_find()
    {
        $restaraunt_name = "Yum Yum Kitchen";
        $restaraunt_name2 = "Hot Dog Heaven";
        $test_restaraunt = new Restaraunt($restaraunt_name);
        $test_restaraunt->save();
        $test_restaraunt2 = new Restaraunt($restaraunt_name2);
        $test_restaraunt2->save();

        $id = $test_restaraunt->getId();
        $result = Restaraunt::find($id);

        $this->assertEquals($test_restaraunt, $result);
    }

}
?>
