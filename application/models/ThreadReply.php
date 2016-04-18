<?php

class Application_Model_ThreadReply
{


protected $_date;
protected $_owner_id;
protected $_reply_body;
protected $_reply_id;
protected $_thread_id;


public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
     public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
 
        return $this;
    }
 
    //************************************************************************************************

	public function setDate($date)
    {
        $this->_date = $date;
 
        return $this;
    }
 
    public function getDate()
    {
        return $this->_date;
    }
//************************************************************************************************

public function setOwner_id($owner_id)
    {
        $this->_owner_id = (int) $owner_id;
 
        return $this;
    }
 
    public function getOwner_id()
    {
        return $this->_owner_id;
    }



//************************************************************************************************

	public function setReply_body($reply_body)
    {
        $this->_reply_body = (string) $reply_body;
 
        return $this;
    }
 
    public function getReply_body()
    {
        return $this->_reply_body;
    }

//************************************************************************************************

public function setReply_id($reply_id)
    {
        $this->_reply_id = (int) $reply_id;
 
        return $this;
    }
 
    public function getReply_id()
    {
        return $this->_reply_id;
    }

//************************************************************************************************

public function setThread_id($thread_id)
    {
        $this->_thread_id = (int) $thread_id;
 
        return $this;
    }
 
    public function getThread_id()
    {
        return $this->_thread_id;
    }
//************************************************************************************************


}

