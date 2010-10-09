<?php
require_once 'Zend/Application.php';
require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';

abstract class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    protected function setUp()
    {
        // we override the parent::setUp() to solve an issue regarding not
        // finding a default module
    }
}