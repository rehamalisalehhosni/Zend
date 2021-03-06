<?php

class Application_Model_ThreadMapper
{
  protected $_dbTable;

   protected function _hydrate($row)
    {
        $thread = new Application_Model_Thread();
        $thread->setCategory_id($row->category_id)
             ->setDate($row->date)
             ->setThread_body($row->thread_body)
             ->setThread_title($row->thread_title)
             ->setThread_id($row->thread_id)
             ->setThread_state_id($row->thread_state_id)
             ->setThread_sticky($row->thread_sticky)
             ->setOwner_id($row->owner_id)
             ->setOwner_id($row->owner_id)
             ->setViews($row->views);
        return $thread
        ;
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
            $this->setDbTable('Application_Model_DbTable_Thread');
        }
 
        return $this->_dbTable;
    }


    public function save(Application_Model_Thread $thread)
    {
        $data = array(
            'date'       	=> $thread->getDate(),
            'thread_body'   => $thread->getThread_body(),
            'thread_title'  => $thread->getThread_title(),
            'thread_id'     => $thread->getThread_id(),
            'category_id'     => $thread->getCategory_id(),
            'thread_state_id'=> $thread->getThread_state_id(),
            'thread_sticky'=> $thread->getThread_sticky(),
            'owner_id'       => $thread->getOwner_id()
        );
        //<error possibility>
        if (NULL === ($thread_id = $thread->getThread_id())) {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('thread_id= ?' => $thread_id));
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
 public function getThread_category($id)
    {
        $select = $this->getDbTable()->select();
        $select->where('category_id = ?', $id);
        $select->order('thread_sticky DESC ');
        $select->order('thread_id DESC');

       $resultSet = $this->getDbTable()->fetchAll($select);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
 
        return $entries;
   }

    public function find_array($id)
    {
        $result = $this->getDbTable()->find($id)->toArray();

        return $result;
    }
    public function remove($id)
    {
        $result = $this->getDbTable()->delete("thread_id=".$id);

        return $result;
    }
 
    public function fetchAll()
    {
        $select = $this->getDbTable()->select();
        $select->order('thread_sticky DESC ');
        $select->order('thread_id DESC');

        $resultSet = $this->getDbTable()->fetchAll($select);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
 
        return $entries;
    }

    public function getThread($id)
    {
        $resultSet = $this->getDbTable()->fetchAll("thread_id=".$id);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
 
        return $entries;
    }

    public function findByCat($cat_id)
    {
        $select = $this->getDbTable()->select();
        $select->where('category_id = ?', $cat_id);
        $select->order('thread_id DESC');

        $resultSet = $this->getDbTable()->fetchAll($select);
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
        return $entries;
    }

}
