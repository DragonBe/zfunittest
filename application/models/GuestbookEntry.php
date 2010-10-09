<?php
class Application_Model_GuestbookEntry
{
    /**
     * @var     string The full name of the visitor
     */
    protected $_fullName;
    /**
     * @var     string The email address of the visitor
     */
    protected $_emailAddress;
    /**
     * @var     string An optional link to a webpage of the visitor
     */
    protected $_website;
    /**
     * @var     string Comments provided by the visitor
     */
    protected $_comment;
    /**
     * @var     Zend_Date The timestamp the visitor left the message
     */
    protected $_timestamp;
    /**
     * @var     Application_Model_Mapper_GuestbookEntry
     */
    protected $_mapper;
    /**
     * Constructor for this guestbook entry that can populate this model at
     * construction.
     * 
     * @param   null|array|Zend_Db_Table_Row $params
     */
    public function __construct($params = null)
    {
        if (null !== $params) {
            $this->populate($params);
        }
    }
	/**
	 * Sets the full name of the visitor
	 * 
     * @param   string $fullName
     * @return  Application_Model_GuestbookEntry
     */
    public function setFullName ($fullName)
    {
        $this->_fullName = (string) $fullName;
        return $this;
    }
	/**
	 * Retrieves the full name of the visitor
	 * 
     * @return string
     */
    public function getFullName()
    {
        return $this->_fullName;
    }
    /**
     * Sets the e-mail address for the visitor
     * 
     * @param   string $emailAddress
     * @return  Application_Model_GuestbookEntry
     */
    public function setEmailAddress($emailAddress)
    {
        $this->_emailAddress = (string) $emailAddress;
        return $this;
    }
    /**
     * Retrieves the e-mail from the visitor
     * 
     * @return  string
     */
    public function getEmailAddress()
    {
        return $this->_emailAddress;
    }
    /**
     * Sets the website URL for the visitor
     * 
     * @param   string $website
     * @return  Application_Model_GuestbookEntry
     */
    public function setWebsite($website)
    {
        $this->_website = (string) $website;
        return $this;
    }
    /**
     * Retrieves the website URL from the visitor
     * 
     * @return  string
     */
    public function getWebsite()
    {
        return $this->_website;
    }
    /**
     * Sets the comment for the visitor
     * 
     * @param   string $comment
     * @return  Application_Model_GuestbookEntry
     */
    public function setComment($comment)
    {
        $this->_comment = (string) $comment;
        return $this;
    }
    /**
     * Retrieves the comment from the visitor
     * 
     * @return  string
     */
    public function getComment()
    {
        return $this->_comment;
    }
    /**
     * Sets the timestamp for the creation of this entry
     * 
     * @param   string $timestamp
     * @return  Application_Model_GuestbookEntry
     */
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
        return $this;
    }
    /**
     * Retrieves the timestamp from this entry
     * 
     * @return  string
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }
    /**
     * Populates the model with data
     * 
     * @param   array|Zend_Db_Table_Row $row
     */
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($row->fullName)) { $this->setFullName($row->fullName); }
        if (isset ($row->emailAddress)) { $this->setEmailAddress($row->emailAddress); }
        if (isset ($row->website)) { $this->setWebsite($row->website); }
        if (isset ($row->comment)) { $this->setComment($row->comment); }
        if (isset ($row->timestamp)) { $this->setTimestamp($row->timestamp); }
    }
    /**
     * Converts this object into an array
     * 
     * @return  array
     */
    public function __toArray()
    {
        return array (
            'fullName'      => $this->getFullName(),
            'emailAddress'  => $this->getEmailAddress(),
            'website'       => $this->getWebsite(),
            'comment'       => $this->getComment(),
            'timestamp'     => $this->getTimestamp(),
        );
    }
    /**
     * Magic setter
     * 
     * @param   string $name The name of the property to set
     * @param   mixed $value The value to assign to this property
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucFirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }
    /**
     * Magic getter
     * 
     * @param   string $name The name of the property to get
     * @return  mixed
     */
    public function __get($name)
    {
        $value = null;
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            $value = $this->$method();
        }
        return $value;
    }
    /**
     * Sets the mapper class for this model
     * 
     * @param   string|Application_Model_Mapper_GuestbookEntry $mapper
     * @return  Application_Model_GuestbookEntry
     * @throws  RuntimeException
     */
    public function setMapper($mapper)
    {
        if (is_string($mapper)) {
            if (!class_exists($mapper)) {
                throw new RuntimeException('Invalid mapper provided');
            }
            $mapper = new $mapper;
        }
        $this->_mapper = $mapper;
        return $this;
    }
    /**
     * Retrieve the mapper from this model
     * 
     * @return  Application_Model_Mapper_GuestbookEntry
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper('Application_Model_Mapper_GuestbookEntry');
        }
        return $this->_mapper;
    }
    /**
     * Fetches a single row from a datasource and populates this model
     * 
     * @param   null|string|array|Zend_Db_Table_Select $where
     * @param   null|string|array $order
     */
    public function fetchRow($where = null, $order = null)
    {
        $this->getMapper()->fetchRow($this, $where, $order);
    }
    /**
     * Saves this model into a datasource
     */
    public function save()
    {
        $this->getMapper()->save($this);
    }
}


