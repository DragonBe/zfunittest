<?php
require_once TEST_PATH . '/DatabaseTestCase.php';
class Application_Model_GuestbookEntryTest extends DatabaseTestCase
{
    protected $_gbEntry;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_gbEntry = new Application_Model_GuestbookEntry();
    }
    protected function tearDown()
    {
        $this->_gbEntry = null;
    }
    public function testEntryIsEmptyAtConstruct()
    {
        $this->assertType('Application_Model_GuestbookEntry', $this->_gbEntry);
        $this->assertNull($this->_gbEntry->getFullName());
        $this->assertNull($this->_gbEntry->getEmailAddress());
        $this->assertNull($this->_gbEntry->getWebsite());
        $this->assertNull($this->_gbEntry->getComment());
        $this->assertNull($this->_gbEntry->getTimestamp());
    }
    
    public function testEntryCanBePopulated()
    {
        $this->_gbEntry->setFullName('Test User')
                       ->setEmailAddress('test@example.com')
                       ->setWebsite('http://www.example.com')
                       ->setComment('This is a test')
                       ->setTimestamp('2010-01-01 00:00:00');
                       
        $this->assertSame('Test User', $this->_gbEntry->getFullName());
        $this->assertSame('test@example.com', $this->_gbEntry->getEmailAddress());
        $this->assertSame('http://www.example.com', $this->_gbEntry->getWebsite());
        $this->assertSame('This is a test', $this->_gbEntry->getComment());
        $this->assertSame('2010-01-01 00:00:00', $this->_gbEntry->getTimestamp());
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
     * @param $data
     */
    public function testEntryCanBePopulatedAtConstruct($data)
    {
        $entry = new Application_Model_GuestbookEntry($data);
        $this->assertSame($data, $entry->__toArray());
    }
    
    
    /** integration testing **/
    
    public function testDatabaseCanBeRead()
    {
        $ds = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet(
            $this->getConnection()
        );
        $ds->addTable('gbentry', 'SELECT * FROM gbentry');
        $this->assertDataSetsEqual(
            $this->createFlatXmlDataSet(
                TEST_PATH . "/_files/readingDataFromSource.xml"),
            $ds
        );
    }
    
public function testNewEntryPopulatesDatabase()
{
    $data = $this->gbEntryProvider();
    foreach ($data as $row) {
        $entry = new Application_Model_GuestbookEntry($row[0]);
        $entry->save();
        unset ($entry);
    }
    $ds = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet(
        $this->getConnection()
    );
    $ds->addTable('gbentry', 'SELECT * FROM gbentry');
    $dataSet = $this->createFlatXmlDataSet(
            TEST_PATH . "/_files/addedTwoEntries.xml");
    $filteredDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter(
        $dataSet, array('gbentry' => array('id'))); 
    $this->assertDataSetsEqual($filteredDataSet, $ds);
}
}