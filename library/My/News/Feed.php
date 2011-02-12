<?php
/**
 * My library
 *
 * My custom library to override or add new functionality to this
 * demo application
 *
 * @package		My
 * @license		CreativeCommons-Attribution-ShareAlike
 * @link		http://creativecommons.org/licenses/by-sa/3.0/
 */
/**
 * @see			Zend_Feed
 */
/**
 * My_News_Feed
 *
 * Class that fetches feeds from a remote website.
 */
class My_News_Feed
{
    /**
     * @var 	string The uri or the file location
     */
    protected $_uri;
    /**
     * Constructor takes an optional uri
     * 
     * @param 	null|string $uri The uri of the feed
     */
    public function __construct($uri = null)
    {
        if (null !== $uri) {
            $this->setUri($uri);
        }
    }
    /**
     * Sets the uri of the feed
     * 
     * @param 	string $uri
     * @return	My_News_Feed
     */
    public function setUri($uri)
    {
        $this->_uri = (string) $uri;
        return $this;
    }
    /**
     * Retrieves the uri of the feed
     * 
     * @return	string
     */
    public function getUri()
    {
        return $this->_uri;
    }
    /**
     * Processes the feed and returns a Zend_Feed instance
     * 
     * @return	Zend_Feed
     */
    public function getNews()
    {
        return Zend_Feed::import($this->getUri());
    }
}