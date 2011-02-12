<?php
class My_News_FeedTest extends PHPUnit_Framework_TestCase
{
    protected $_stub;
    
    protected function setUp()
    {
        $this->_stub = $this->getMockBuilder('My_News_Feed')
                            ->getMock();
        $this->_stub->expects($this->any())
                    ->method('getNews')
                    ->will($this->returnValue(Zend_Feed::importFile(TEST_PATH . '/_files/rssfeed.xml')));
        parent::setUp();
    }
    protected function tearDown()
    {
        parent::tearDown();
        $this->_stub = null;
        $this->_feed = null;
    }
    public function testFeedDetectsRss()
    {
        $this->assertInstanceOf('My_News_Feed', $this->_stub);
        $this->_stub->setUri('http://www.example.com');
        $this->assertSame(5, count($this->_stub->getNews()));
    }
}