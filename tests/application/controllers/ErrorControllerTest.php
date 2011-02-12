<?php
require_once TEST_PATH . '/ControllerTestCase.php';
class ErrorControllerTest extends ControllerTestCase
{
    public function testNonExistingPageReturnsPageNotFoundError()
    {
        $this->dispatch('/foo');
        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertResponseCode(404);
    }
}