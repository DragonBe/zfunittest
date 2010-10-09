<?php
// file: tests/application/controllers/IndexControllerTest.php
require_once TEST_PATH . '/ControllerTestCase.php';

class IndexControllerTest extends ControllerTestCase
{
    public function testCanWeDisplayOurHomepage()
    {
        // go to the main page of the web application
        $this->dispatch('/');
        
        // check if we don't end up on an error page
        $this->assertNotController('error');
        $this->assertNotAction('error');
        
        // ok, no error so let's see if we're at our homepage
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertResponseCode(200);
    }
}