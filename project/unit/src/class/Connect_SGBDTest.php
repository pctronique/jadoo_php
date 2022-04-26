<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../");
require_once(RACINE_UNIT . 'config_path.php');
require_once(RACINE_UNIT . 'function_test.php');
require_once(RACINE_WWW . 'src/class/Connect_SGBD.php');


/**
 * Description of FileUploadTest
 *
 * @author pctronique
 */
class Connect_SGBDTest extends TestCase {
    
    /**
     * @var ConfigIni
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new Connect_SGBD();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {}
    
    public function testVide(): void {
        $this->assertTrue(true);
    }

}

?>
