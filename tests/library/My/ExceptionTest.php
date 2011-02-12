<?php
require_once 'My/Exception.php';

class My_ExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testLibraryExceptionAreCorrectlySet()
    {
        try {
            throw new My_Exception('Test exception');
        } catch (My_Exception $e) {
            $this->assertInstanceOf('My_Exception', $e);
            $this->assertInstanceOf('Zend_Exception', $e);
            $this->assertSame('Test exception', $e->getMessage());
        }
    }
}