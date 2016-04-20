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
               ->setParent($row->category_parent)
               ->setCategory_description($row->category_description);
        return $category;
    }

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
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
        //var_dump($category); exit();
        $data = array(
              'category_name' => $category->getCategory_name(),
              'category_id' => $category->getCategory_id(),
              'category_parent' => $category->getCategory_parent(),
              'category_state' => $category->getCategory_state(),
              'category_description' => $category->getCategory_description()
          );
         # var_dump($data); exit();
        if (null === ($category_id = $category->getCategory_id())) {
            $this->getDbTable()->insert($data);
            #echo "Saved"; exit();
        } else {
            $this->getDbTable()->update($data, array('category_id= ?' => $category_id));
            #echo "updated"; exit();
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
    public function categoryExists($name)
    {
        $select = $this->getDbTable()->select()
                       ->where('category_name'.' =?', $name);

        $row = $this->getDbTable()->fetchRow($select);
        if (is_null($row['category_id'])) {
            return 0;
        } else {
            return $row->category_id;
        }
    }
    public function findMainCats() {

        $resultSet = $this->getDbTable()->fetchAll("category_parent = 0");
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }

        return $entries;
    }
    public function remove($id)
    {
        $result = $this->getDbTable()->delete('category_id='.$id);
        return $result;
    }
    public function find_array($id)
    {
        $result = $this->getDbTable()->find($id)->toArray();

        return $result[0];
    }
}
