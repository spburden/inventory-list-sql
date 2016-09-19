<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ItemTest extends PHPUnit_Framework_TestCase

    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests
    {

    }

       function test_save()
       {
           //Arrange
           $test_item = new Item($name, $description, $quantity);
           $name = "Tennis Ball";
           $description = "Yellow ball";
           $quantity = 23;

           //Act
           $test_item->save();

           //Assert\\
           $result = Item::getAll();
           $this->assertEquals($test_item, $result[0]);
       }

        //TEST FOR LOOPING THROUGH MULTIPLE INPUTS
    //   function test_numword_ones()
    // {
    //     $test_NumWord_Ones = new Numword;
    //     $input_array = ['0','1', '2', '3', '4', '5', '6', '7', '8', '9'];
    //     $expected_results = ['','One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    //     $result_array = array();
    //
    //     foreach ($input_array as $input)
    //     {
    //       array_push($result_array, $test_NumWord_Ones->process_thru_nineteen($input));
    //     }
    //     $this->assertEquals($expected_results, $result_array);
    // }

 ?>
