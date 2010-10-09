<?php
class Application_Model_Mapper_GuestbookEntry
{
    /**
     * @var     Zend_Db_Table_Abstract
     */
    protected $_dataSource;
    
    /**
     * Sets the datasource linked to this model
     * 
     * @param   string|Zend_Db_Table_Abstract $dataSource
     * @return  Application_Model_Mapper_GuestbookEntry
     * @throws  RuntimeException
     */
    public function setDataSource($dataSource)
    {
        if (is_string($dataSource)) {
            if (!class_exists($dataSource)) {
                throw new RuntimeException('Invalid datasource provided');
            }
            $dataSource = new $dataSource;
        }
        if (!$dataSource instanceof Zend_Db_Table_Abstract) {
            throw new RuntimeException('Invalid datasource type provided');
        }
        $this->_dataSource = $dataSource;
    }
    /**
     * Retrieves the datasource linked to this model
     * 
     * @return  Application_Model_DbTable_GuestbookEntry
     */
    public function getDataSource()
    {
        if (null === $this->_dataSource) {
            $this->setDataSource('Application_Model_DbTable_GuestbookEntry');
        }
        return $this->_dataSource;
    }
    /**
     * Fetches a single row and populates a provide model
     * 
     * @param   Application_Model_GuestbookEntry $model
     * @param   null|array|Zend_Db_Table_Select $where
     * @param   string|array $order
     * @throws  RuntimeException
     */
    public function fetchRow($model, $where = null, $order = null)
    {
        if (!$model instanceof Application_Model_GuestbookEntry) {
            throw new RuntimeException('Invalid model provided');
        }
        if (null !== ($resultSet = $this->getDataSource()->fetchRow($where, $order))) {
            if (null !== ($row = $resultSet->current())) {
                $model->populate($row);
            }
        }
    }
    /**
     * Saves the current model into a datasource
     * 
     * @param   Application_Model_GuestbookEntry $model
     * @throws  RuntimeException
     */
    public function save($model)
    {
        if (!$model instanceof Application_Model_GuestbookEntry) {
            throw new RuntimeException('Invalid model provided');
        }
        $data = $model->__toArray();
        try {
            $this->getDataSource()->insert($data);
        } catch (Zend_Db_Statement_Exception $e) {
            throw new RuntimeException($e->getMessage());
            /** this means this content was already provided **/
        }
    }
}