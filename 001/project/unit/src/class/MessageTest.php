<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../");
require_once(RACINE_UNIT . 'config_path.php');
require_once(RACINE_UNIT . 'function_test.php');
require_once(RACINE_WWW . 'src/class/Message.php');


/**
 * Description of FileUploadTest
 *
 * @author pctronique
 */
class MessageTest extends TestCase
{

        protected $object;

        /**
         * Sets up the fixture, for example, opens a network connection.
         * This method is called before a test is executed.
         */
        protected function setUp(): void
        {
                foreach (array_string_all() as $value) {
                        foreach (array_string_all() as $value1) {
                                foreach (array_string_all() as $value2) {

                                        foreach (array_string_all() as $value3) {
                                                $this->object = new Message($value, $value1, $value2, $value3);
                                                $this->testGetDate();
                                                $this->testGetDateSt();
                                                $this->testSetDate();
                                                $this->testSetDateSt();
                                                $this->testGetLu();
                                                $this->testSetLuInt();
                                                $this->testSetLuSt();
                                                $this->testSetLu();

                                                $this->testGetNom();
                                                $this->testGetPrenom();
                                                $this->testGetEmail();
                                                $this->testGetMessage();
                                        }
                                }
                        }
                }
        }

        /**
         * Tears down the fixture, for example, closes a network connection.
         * This method is called after a test is executed.
         */
        protected function tearDown(): void
        {
        }

        public function testGetDate(): void
        {
                $funct_value = $this->object->getDate();
                //$this->assertNotNull($funct_value);
                //$this->assertFalse(($funct_value < 0));
                //$this->assertIsInt($funct_value);
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function testSetDate(): void
        {
                $this->object->setDate(null);
                $this->testGetDate();
                $this->testGetDateSt();
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function testSetDateSt(): void
        {
                foreach (array_string_all() as $value) {
                        $this->object->setDateSt($value);
                        $this->testGetDate();
                        $this->testGetDateSt();
                }
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function testGetDateSt(): void
        {
                $funct_value = $this->object->getDateSt();
                $this->assertNotNull($funct_value);
                $this->assertIsString($funct_value);
        }


        /**
         * Get the value of lu
         */
        public function testGetLu(): void
        {
                $funct_value = $this->object->getLu();
                $this->assertNotNull($funct_value);
                $this->assertIsBool($funct_value);
        }

        /**
         * Set the value of lu
         */
        public function testSetLuSt(): void
        {
                foreach (array_string_all() as $value) {
                        $this->object->setLuSt($value);
                        $this->testGetLu();
                }
        }

        /**
         * Set the value of lu
         */
        public function testSetLuInt(): void
        {
                foreach (array_int() as $value) {
                        $this->object->setLuInt($value);
                        $this->testGetLu();
                }
        }

        /**
         * Set the value of lu
         */
        public function testSetLu(): void
        {
                $this->object->setLu(true);
                $this->testGetLu();

                $this->object->setLu(false);
                $this->testGetLu();
        }

        /**
         * Get the value of Nom
         */
        public function testGetNom(): void
        {
                $funct_value = $this->object->getNom();
                $this->assertNotNull($funct_value);
                $this->assertIsString($funct_value);
        }

        /**
         * Get the value of Prenom
         */
        public function testGetPrenom(): void
        {
                $funct_value = $this->object->getPrenom();
                $this->assertNotNull($funct_value);
                $this->assertIsString($funct_value);
        }

        /**
         * Get the value of Email
         */
        public function testGetEmail(): void
        {
                $funct_value = $this->object->getEmail();
                $this->assertNotNull($funct_value);
                $this->assertIsString($funct_value);
        }

        /**
         * Get the value of Message
         */
        public function testGetMessage(): void
        {
                $funct_value = $this->object->getMessage();
                $this->assertNotNull($funct_value);
                $this->assertIsString($funct_value);
        }
}
