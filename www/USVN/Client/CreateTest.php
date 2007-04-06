<?php
/**
 * Create an svn repository and install usvn hooks.
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package client
 * @subpackage create
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id$
 */
// Call USVN_Client_CreateTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Client_CreateTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Client_Create.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-05 at 20:13:55.
 */
class USVN_Client_CreateTest extends USVN_Client_CommandTest {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Client_CreateTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    public function setUp() {
		parent::setUp();
		USVN_DirectoryUtils::removeDirectory('tests/tmp/testrepository2');
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    public function tearDown() {
		USVN_DirectoryUtils::removeDirectory('tests/tmp/testrepository2');
		parent::tearDown();
	}

	public function testCreate() {
	        new USVN_Client_Create('tests/tmp/testrepository2', 'http://example.com', 'auth007', $this->httpClient);
			$this->assertFileExists('tests/tmp/testrepository2/usvn');
	}

	public function testCreateTargetAlreadyExist() {
			try {
				new USVN_Client_Create('tests/tmp/testrepository', 'http://example.com', 'auth007', $this->httpClient);
			}
			catch (USVN_Exception $e) {
				$this->assertFileExists('tests/tmp/testrepository/');
				return;
			}
			$this->fail();
	}
}

// Call USVN_Client_CreateTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Client_CreateTest::main") {
    USVN_Client_CreateTest::main();
}
?>
