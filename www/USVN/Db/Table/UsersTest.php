<?php
/**
 * Class to test user's model
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package Db
 * @subpackage Table
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id$
 */

// Call USVN_Auth_Adapter_DbTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Db_Table_UsersTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Auth_Adapter_Db.
 * Generated by PHPUnit_Util_Skeleton on 2007-03-25 at 09:51:30.
 */
class USVN_Db_Table_UsersTest extends USVN_Test_DB {

    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Db_Table_UsersTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp() {
		parent::setUp();

    }

    public function testUserInsertNoLogin()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> '',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		try {
			$obj->save();
		}
		catch (USVN_Exception $e) {
			$this->assertContains('Login empty', $e->getMessage());
			//check on number of insert
			return;
		}
		$this->assertFalse(true);
	}

    public function testUserInsertInvalidEmailAddress()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'InsertInvalidEmailAddress',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'BadEmail'));
		try {
			$obj->save();
		}
		catch (USVN_Exception $e) {
			$this->assertContains('Invalid email address', $e->getMessage());
			$this->assertFalse($table->isAUser('InsertInvalidEmailAddress'));
			return;
		}
		$this->assertFalse(true);
    }

    public function testUserInsertNoPassword()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'InsertNoPassword',
									'users_password' 	=> '',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		try {
			$obj->save();
		}
		catch (USVN_Exception $e) {
			$this->assertContains('Password empty', $e->getMessage());
			$this->assertFalse($table->isAUser('InsertNoPassword'));
			return;
		}
		$this->assertFalse(true);
    }

    public function testUserInsertInvalidPassword()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'InsertNoPassword',
									'users_password' 	=> 'badPass',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		try {
			$obj->save();
		}
		catch (USVN_Exception $e) {
			$this->assertContains('Invalid password', $e->getMessage());
			$this->assertFalse($table->isAUser('InsertNoPassword'));
			return;
		}
		$this->assertFalse(true);
    }

    public function testUserInsertOk()
    {
    	$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'InsertOk',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$obj->save();
		$this->assertTrue($table->isAUser('InsertOk'));
    }

    public function testUserUpdateNoLogin()
	{
    	$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'InsertOkUpdateNoLogin',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$id = $obj->save();
		$obj = $table->find($id)->current();
		$obj->setFromArray(array('users_login' 			=> '',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$obj->save();
		$this->assertTrue($table->isAUser('InsertOkUpdateNoLogin'));
		//check number of insert
    }

    public function testUserUpdateInvalidEmailAddress()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'UpdateInvalidEmailAddress',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$id = $obj->save();
		$obj = $table->find($id)->current();
		$obj->setFromArray(array('users_login' 			=> 'UpdateInvalidEmailAddress',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'badEmail'));
		$obj->save();
		$user = $table->fetchRow(array('users_login = ?' => 'UpdateInvalidEmailAddress'));
		$this->assertEquals($user->email, 'email@email.fr');
    }

    public function testUserUpdateNoPassword()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'UpdateNoPassword',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$id = $obj->save();
		$obj = $table->find($id)->current();
		$obj->setFromArray(array('users_login' 			=> 'UpdateNoPassword',
									'users_password' 	=> '',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$obj->save();
		$user = $table->fetchRow(array('users_login = ?' => 'UpdateNoPassword'));
		$this->assertEquals($user->password, 'password');
    }

    public function testUserUpdateInvalidPassword()
	{
		$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'UpdateInvalidPassword',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$id = $obj->save();
		$obj = $table->find($id)->current();
		$obj->setFromArray(array('users_login' 			=> 'UpdateInvalidPassword',
									'users_password' 	=> 'badPass',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$obj->save();
		$user = $table->fetchRow(array('users_login = ?' => 'UpdateInvalidPassword'));
		$this->assertEquals($user->password, 'password');
    }

    public function testUserUpdateOk()
    {
    	$table = new USVN_Db_Table_Users();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('users_login' 			=> 'UpdateOk',
									'users_password' 	=> 'password',
									'users_firstname' 	=> 'firstname',
									'users_lastname' 	=> 'lastname',
									'users_email' 		=> 'email@email.fr'));
		$id = $obj->save();
		$obj = $table->find($id)->current();
		$obj->setFromArray(array('users_login' 			=> 'newUpdateOk',
									'users_password' 	=> 'newPassword',
									'users_firstname' 	=> 'newFirstname',
									'users_lastname' 	=> 'newLastname',
									'users_email' 		=> 'newemail@email.fr'));
		$obj->save();
		$this->assertFalse($table->isAUser('UpdateOk'));
		$this->assertTrue($table->isAUser('newUpdateOk'));
    }
}

if (PHPUnit_MAIN_METHOD == "USVN_Db_Table_UsersTest::main") {
    USVN_Db_Table_UsersTest::main();
}
?>
