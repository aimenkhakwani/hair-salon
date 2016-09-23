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

        function test_getAll()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $id = 2;
            $name = "cally";
            $stylist_id = 4;
            $client2 = new Client($id, $name, $stylist_id);
            $client2->save();

            //Act
            $result = $client->getAll();

            //Assert
            $this->assertEquals([$client,$client2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $id = 2;
            $name = "cally";
            $stylist_id = 4;
            $client2 = new Client($id, $name, $stylist_id);
            $client2->save();

            //Act
            $result = $client->deleteAll();

            //Assert
            $result = $client->getAll();
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $id = 2;
            $name = "cally";
            $stylist_id = 4;
            $client2 = new Client($id, $name, $stylist_id);
            $client2->save();

            //Act
            $result = Client::find($client->getId());

            //Assert
            $this->assertEquals($client, $result);

        }

    }
 ?>
