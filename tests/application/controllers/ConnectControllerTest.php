<?php
require_once TEST_PATH . '/ControllerTestCase.php';
class ConnectControllerTest extends ControllerTestCase
{
    public function testSiteCanFetchNewsFeeds()
    {
        $this->dispatch('/connect/news');
        $this->assertQuery('h2.newsFeedTitle');
        $this->assertQueryCount('h2.newsFeedTitle', 10);        
    }

    public function testSiteCanConnectWithTwitter()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
    
    public function testSiteCanConnectWithFacebook()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
    
    public function testSiteCanConnectWithGoogle()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
}

