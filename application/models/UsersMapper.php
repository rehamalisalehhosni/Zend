<?php

class Application_Model_UsersMapper 
{
  protected $_dbTable;
 
    protected function _hydrate($row)
    {
        $user = new Application_Model_Users();
        $user->setUser_id($row->User_id)
             ->setUser_password($row->user_password)
             ->setUser_name($row->user_name)
             ->setRegistration_date($row->registration_date)
             ->setGender($row->gender)
             ->setCountry($row->country)
             ->setImage($row->image)
             ->setLast_login_date($row->last_login_date)
             ->setLast_user_type($row->user_type);
        return $user;
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
            $this->setDbTable('Application_Model_DbTable_Users');
        }
 
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Users $user)
    {
        $data = array(
            'user_email'       	=> $user->getUser_email(),
            'user_password'    	=> $user->getUser_password(),
            'user_name'        	=> $user->getUser_name(),
            'registration_date' => $user->getRegistration_date(),
            'gender'        	=> $user->getGender(),
            'country'        	=> $user->getCountry(),
            'image'       		=> $user->getImage(),
            'last_login_date'   => $user->getLast_login_date(),
            'user_type'         => $user->getUser_type()
        );
 
        if (null === ($user_id = $user->getUser_id())) {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('user_id= ?' => $id));
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
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_hydrate($row);
        }
 
        return $entries;
    }

}

