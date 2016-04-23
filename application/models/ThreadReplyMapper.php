<?php

class Application_Model_ThreadReplyMapper
{
  protected $_dbTable;

     protected function _hydrate($row)
    {
        $reply = new Application_Model_ThreadReply();
        $reply->setDate($row->date)
              ->setOwner_id($row->owner_id)
              ->setReply_body($row->reply_body)
              ->setReply_id($row->reply_id)
              ->setThread_id($row->thread_id);
        return $reply;
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
            $this->setDbTable('Application_Model_DbTable_ReplyThread');
        }

        return $this->_dbTable;
    }


    public function save(Application_Model_ThreadReply $reply)
    {
        $data = array(
            'date'       	=> $reply->getDate(),
            'owner_id'    	=> $reply->getOwner_id(),
            'reply_body'        	=> $reply->getReply_body(),
            'reply_id' => $reply->getReply_id(),
            'thread_id'        	=> $reply->getThread_id()
        );

        if (null === ($reply_id = $reply->getReply_id())) {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('reply_id= ?' => $reply_id));
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

    public function find_array($id)
    {
        $result = $this->getDbTable()->find($id)->toArray();

        return $result;
    }
    public function remove($id)
    {
        $result = $this->getDbTable()->delete("reply_id=".$id);

        return $result;
    }


    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }

        return $entries;
    }
    public function findByThread($htread_id)
    {
        $resultSet = $this->getDbTable()->fetchAll("thread_id = $htread_id");
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
        return $entries;
    }
    public function findReplyThread($thread_id)
    {
        $resultSet = $this->getDbTable()->fetchAll("thread_id = $thread_id");
        return count($resultSet);
    }
    public function findReplies($thread_id)
    {
        $resultSet = $this->getDbTable()->fetchAll("thread_id = $thread_id");
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
        return $entries;
    }
}
