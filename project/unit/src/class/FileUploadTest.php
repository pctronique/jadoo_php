<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../../../");
require_once(RACINE_UNIT . 'config_path.php');
require_once(RACINE_UNIT . 'function_test.php');
require_once(RACINE_WWW . 'kernel/class/OpenFile/FileUploadTest.php');

/**
 * Description of FileUploadTest
 *
 * @author pctronique
 */
class FileUploadTest extends TestCase {

    /**
     * @var \RemoteWebDriver
     */
    protected $webDriver;

    public function setUp() {
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    public function tearDown() {
        $this->webDriver->close();
    }

    protected $url = 'http://www.netbeans.org/';

    public function testSimple() {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'NetBeans'
        $this->assertContains('NetBeans', $this->webDriver->getTitle());
    }

}
