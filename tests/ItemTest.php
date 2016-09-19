<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ItemTest extends PHPUnit_Framework_TestCase
    {
    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests
        protected function tearDown()
        {
            Item::deleteAll();
        }

       function test_save()
       {
           //Arrange
           $name = "Tennis Ball";
           $description = "Yellow ball";
           $quantity = 23;
           $test_item = new Item($name, $description, $quantity);

           //Act
           $test_item->save();

           //Assert\\
           $result = Item::getAll();
           $this->assertEquals($test_item, $result[0]);
       }

       function test_getAll()
       {
           //Arrange
           $name1 = "Tennis Ball";
           $description1 = "Yellow ball";
           $quantity1 = 23;
           $test_item1 = new Item($name1, $description1, $quantity1);
           $test_item1->save();
           $name2 = "Basket Ball";
           $description2 = "Orange ball";
           $quantity2 = 14;
           $test_item2 = new Item($name2, $description2, $quantity2);
           $test_item2->save();

           //Act
           $result = Item::getAll();

           //Assert
           $this->assertEquals([$test_item1, $test_item2], $result);
       }

       function test_getId()
       {
           //Arrange
           $name = "Tennis Ball";
           $description = "Yellow ball";
           $quantity = 23;
           $id = 1;
           $test_item = new Item($name, $description, $quantity, $id);

           //Act
           $result = $test_item->getId();

           //Assert
           $this->assertEquals(1, $result);
       }

       function test_find()
       {
           $name1 = "Tennis Ball";
           $description1 = "Yellow ball";
           $quantity1 = 23;
           $test_item1 = new Item($name1, $description1, $quantity1);
           $test_item1->save();
           $name2 = "Basket Ball";
           $description2 = "Orange ball";
           $quantity2 = 14;
           $test_item2 = new Item($name2, $description2, $quantity2);
           $test_item2->save();

           //Act
           $id = $test_item1->getId();
           $result = Item::find($id);

           //Assert
           $this->assertEquals($test_item1, $result);
       }

    }
 ?>
