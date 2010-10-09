<?php
require_once 'PHPUnit/Framework/TestCase.php';
class Application_Model_GuestbookTest extends PHPUnit_Framework_TestCase
{
    protected $_gb;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_gb = new Application_Model_Guestbook();
    }
    protected function tearDown()
    {
        $this->_gb = null;
        parent::tearDown();
    }
    public function testGuestBookIsEmptyAtConstruct()
    {
        $this->assertType('Application_Model_GuestBook', $this->_gb);
        $this->assertFalse($this->_gb->hasEntries());
        $this->assertSame(0, count($this->_gb->getEntries()));
        $this->assertSame(0, count($this->_gb));
    }
    
    public function gbEntryProvider()
    {
        return array (
            array (array (
                'fullName' => 'Test User',
                'emailAddress' => 'test@example.com',
                'website' => 'http://www.example.com',
                'comment' => 'This is a test',
                'timestamp' => '2010-01-01 00:00:00',
            )),
            array (array (
                'fullName' => 'Test Manager',
                'emailAddress' => 'testmanager@example.com',
                'website' => 'http://tests.example.com',
                'comment' => 'This is another test',
                'timestamp' => '2010-01-01 01:00:00',
            )),
        );
    }
    
    /**
     * @dataProvider gbEntryProvider
     */
    public function testGuestbookAdsEntry($data)
    {
        $this->_gb->addEntry(new Application_Model_GuestbookEntry($data));
        $this->assertTrue($this->_gb->hasEntries());
    }
}