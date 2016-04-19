<?php

class Application_Model_CategoryMapper
{
    protected $_dbTable;

    protected function _hydrate($row)
    {
        $category = new Application_Model_Category();
        $category->setCategory_id($row->category_id)
               ->setCategory_name($row->category_name)
               ->setCategory_state($row->category_state)
               ->setParent($row->parent);

        return $category;
    }

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable) {
             $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;

        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Category');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Category $category)
    {
        $data = array(
              'category_name' => $category->getCategory_name(),
              'category_id' => $category->getCategory_id(),
              'parent' => $category->getParent(),
              'category_state' => $category->getCategory_state(),
          );

        if (null === ($category_id = $category->getCategory_id())) {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('category_id= ?' => $id));
        }
    }

    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        return $this->_hydrate($row);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }

        return $entries;
    }
}
