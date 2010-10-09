<?php
// file: tests/application/controllers/IndexControllerTest.php
require_once TEST_PATH . '/ControllerTestCase.php';

class CommentControllerTest extends ControllerTestCase
{
    public function testCanWeDisplayOurForm()
    {
        // go to the main comment page of the web application
        $this->dispatch('/comment');
        
        // check if we don't end up on an error page
        $this->assertNotController('error');
        $this->assertNotAction('error');
        
        $this->assertModule('default');
        $this->assertController('comment');
        $this->assertAction('index');
        $this->assertResponseCode(200);
        
        $this->assertQueryCount('form', 1);
        $this->assertQueryCount('input[type="text"]', 3);
        $this->assertQueryCount('textarea', 1);
    }
    
    public function testCanWeSubmitOurForm()
    {
        $this->request->setMethod('post')
                      ->setPost(array (
                        'fullName'     => 'Unit Tester',
                        'emailAddress' => 'test@example.com',
                        'website'      => 'http://www.example.com',
                        'comment'      => 'This is a simple test',
                      ));
        $this->dispatch('/comment/send-comment');
        
        // check if we don't end up on an error page
        $this->assertNotController('error');
        $this->assertNotAction('error');
        
        // let's check if we ended up on the correct page
        $this->assertModule('default');
        $this->assertController('comment');
        $this->assertAction('send-comment');
        $this->assertNotRedirect();
        $this->assertResponseCode(200);

        $this->assertQueryCount('dt', 1);
        $this->assertQueryCount('dd', 1);
        $this->assertQueryContentContains('dt#fullName', 
            '<a href="http://www.example.com">Unit Tester</a>');
        $this->assertQueryContentContains('dd#comment', 'This is a simple test');
    }
    
    public function testSubmitFailsWhenNotPost()
    {
        $this->request->setMethod('get');
        $this->dispatch('/comment/send-comment');
        $this->assertResponseCode(302);
        $this->assertRedirectTo('/comment');
    }
    
    /**
     * @dataProvider wrongDataProvider
     */
    public function testSubmitFailsWithWrongData($fullName, $emailAddress, $comment)
    {
        $this->request->setMethod('post')
                      ->setPost(array (
                        'fullName'      => $fullName,
                        'emailAddress'  => $emailAddress,
                        'comment'       => $comment,
                      ));
        $this->dispatch('/comment/send-comment');
        
        $this->assertResponseCode(302);
        $this->assertRedirectTo('/comment');
    }
    
    public function wrongDataProvider()
    {
        return array (
            array ('', '', ''),
            array ('~', 'bogus', ''),
            array ('', 'test@example.com', 'This is correct text'),
            array ('Test User', '', 'This is correct text'),
            array ('Test User', 'test@example.com', str_repeat('a', 50001)),
        );
    }
}