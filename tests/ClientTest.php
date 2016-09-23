<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);

            //Act
            $result = $client->getId();

            //Assert
            $this->assertEquals($id, $result);

        }

        function test_getName()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);

            //Act
            $result = $client->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function test_getStylistId()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);

            //Act
            $result = $client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);

        }

        function test_save()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            //Act
            $result = $client->getAll();

            //Assert
            $this->assertEquals($client, $result[0]);

        }

    }
 ?>