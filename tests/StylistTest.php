<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = 22;
            $name = "Sally";
            $stylist = new Stylist($id, $name);

            //Act
            $result = $stylist->getId();

            //Assert
            $this->assertEquals($id, $result);

        }

        function test_getName()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);

            //Act
            $result = $stylist->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function test_save()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            //Act
            $result = $stylist->getAll();

            //Assert
            $this->assertEquals($stylist, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            $id = 2;
            $name = "mandy";
            $stylist2 = new Stylist($id, $name);
            $stylist2->save();

            //Act
            $result = $stylist->getAll();

            //Assert
            $this->assertEquals([$stylist,$stylist2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            $id = 2;
            $name = "mandy";
            $stylist2 = new Stylist($id, $name);
            $stylist2->save();

            //Act
            $result = $stylist->deleteAll();

            //Assert
            $result = $stylist->getAll();
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            $id = 2;
            $name = "mandy";
            $stylist2 = new Stylist($id, $name);
            $stylist2->save();

            //Act
            $result = Stylist::find($stylist->getId());

            //Assert
            $this->assertEquals($stylist, $result);

        }

        function test_update  ()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            $new_name = "hansen";

            //Act
            $stylist->update($new_name);

            //Assert
            $this->assertEquals($new_name, $stylist->getName());

        }

        function test_delete ()
        {
            //Arrange
            $id = 1;
            $name = "sally";
            $stylist = new Stylist($id, $name);
            $stylist->save();

            $id = 2;
            $name = "tally";
            $stylist2 = new Stylist($id, $name);
            $stylist2->save();

            //Act
            $stylist2->delete();

            //Assert
            $this->assertEquals([$stylist], Stylist::getAll());

        }
    }
 ?>
