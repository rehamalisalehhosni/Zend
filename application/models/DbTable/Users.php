<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';

    function addUser($data){
    	if (isset($data['module']))  
			unset( $data['module']) ;
		if (isset($data['controller'])) 
	 		unset( $data['controller']);
		if (isset($data['action']))
			 unset( $data['action']);
		if (isset($data['submit']))
			 unset( $data['submit']);
		if (isset($data['MAX_FILE_SIZE']))
			 unset( $data['MAX_FILE_SIZE']);
		if (isset($data['captcha']))
			 unset( $data['captcha']);
		$data['user_password']=md5($data['user_password']);
		return $this->insert($data);
    }
    function editUser($id,$data){

    }
    function removeUser($id){

    }
}

