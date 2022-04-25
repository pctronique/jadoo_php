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
require_once(RACINE_WWW . 'src/class/ConfigIni.php');


/**
 * Description of FileUploadTest
 *
 * @author pctronique
 */
class ConfigIniTest extends TestCase {
    /**
     * @var ConfigIni
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new ConfigIni();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {}
    
   public function testCrypt() {
       foreach (array_string_all() as $value) {
        $this->assertNotNull($this->object->crypt($value));
        $this->assertIsString($this->object->crypt($value));
       }
   }

        public function testGetError_code() {
        $this->assertNotNull($this->object->getError_code());
        $this->assertFalse(($this->object->getError_code() < 0));
        $this->assertIsInt($this->object->getError_code());
        }

        public function testGetError_message() {
        $this->assertNotNull($this->object->getError_message());
        $this->assertIsString($this->object->getError_message());
        }
        
        public function testGetType() {
        $this->assertNotNull($this->object->getType());
        $this->assertIsString($this->object->getType());
        }
        
        public function testGetServer() {
        $this->assertNotNull($this->object->getServer());
        $this->assertIsString($this->object->getServer());
        }
        
        public function testGetPort() {
        $this->assertNotNull($this->object->getPort());
        $this->assertFalse(($this->object->getPort() < 0));
        $this->assertIsInt($this->object->getPort());
        }
        
        public function testGetName() {
        $this->assertNotNull($this->object->getName());
        $this->assertIsString($this->object->getName());
        }
        
        public function testGetUser() {
        $this->assertNotNull($this->object->getUser());
        $this->assertIsString($this->object->getUser());
        }
        
        public function testGetPass() {
        $this->assertNotNull($this->object->getPass());
        $this->assertIsString($this->object->getPass());
        }
        
        public function testGetPrefix() {
        $this->assertNotNull($this->object->getPrefix());
        $this->assertIsString($this->object->getPrefix());
        }

}

?>
