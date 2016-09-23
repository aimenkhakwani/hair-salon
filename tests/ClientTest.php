<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            //Act
            $result = $client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

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
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            //Act
            $result = $client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            //Arrange
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
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
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $name = "cally";
            $stylist_id = $stylist->getId();
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
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $name = "cally";
            $stylist_id = $stylist->getId();
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
            $id = null;
            $stylist_name = "gary";
            $stylist = new Stylist ($id, $stylist_name);
            $stylist->save();

            $name = "ally";
            $stylist_id = $stylist->getId();
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $name = "cally";
            $stylist_id = $stylist->getId();
            $client2 = new Client($id, $name, $stylist_id);
            $client2->save();

            //Act
            $result = Client::find($client->getId());

            //Assert
            $this->assertEquals($client, $result);

        }

        function test_update()
        {
            //Arrange
            $id = 1;
            $name = "ally";
            $stylist_id = 3;
            $client = new Client($id, $name, $stylist_id);
            $client->save();

            $new_name = "anny";

            //Act
            $client->update($new_name);

            //Assert
            $this->assertEquals($new_name, $client->getName());

        }

        function test_delete ()
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
            $client2->delete();

            //Assert
            $this->assertEquals([$client], Client::getAll());

        }
    }
 ?>
