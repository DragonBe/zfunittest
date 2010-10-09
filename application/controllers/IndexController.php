<?php

class IndexController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_session = new Zend_Session_Namespace('twoauth');
    }

    public function indexAction()
    {
        // action body
    }

    public function twitterAction()
    {
        $oauth = new ArrayObject(array (
            'oauth_token'        => '104425911-KEoHsrS6gIV49vySj18ZtrZdRsMerFt7CEauJe46',
            'oauth_secret_token' => 'BUtnfZFGBs7NKEprBvS5fnj15NhW8EAsgorrHk',
        ), ArrayObject::ARRAY_AS_PROPS);
        $config = new ArrayObject(array (
            'callbackUrl'       => 'http://zfunittest.osx/index/callback',
            'siteUrl'           => 'http://www.twitter.com/oauth',
            'consumerKey'       => 'HXWuy6pzdm19uU909a8Rw',
            'consumerSecret'    => 'o8zd9Rv3e8qp8jn9kDQsGPM1yIsHfkgR1oqfn580', 
        ), ArrayObject::ARRAY_AS_PROPS);
        
        $token = new Zend_Oauth_Token_Access;
        $token->setParams(array(
            'oauth_token' => $oauth->oauth_token,
            'oauth_token_secret' => $oauth->oauth_secret_token,
        ));
        
        $twitter = new Zend_Service_Twitter(array(
            'consumerSecret' => $config->consumerSecret,
            'accessToken' => $token
        ));
        
        $status = $twitter->accountVerifyCredentials();
        Zend_Debug::dump($status);
        
        
    }

    public function callbackAction()
    {
        
    }


}







