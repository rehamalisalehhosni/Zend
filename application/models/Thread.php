<?php

class Application_Model_Thread
{


protected $_category_id;
protected $_date;
protected $_thread_body;
protected $_thread_title;
protected $_thread_id;
protected $_thread_state_id;
protected $_owner_id;
protected $_views;
protected $_thread_sticky;


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

 
    public function setCategory_id($category_id)
    {
        $this->_category_id = (int) $category_id;
 
        return $this;
    }
 
    public function getCategory_id()
    {
        return $this->_category_id;
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

    public function setViews($views)
    {
        $this->_views = $views;
 
        return $this;
    }
 
    public function getViews()
    {
        return $this->_views;
    }
	public function setThread_sticky($thread_sticky)
    {
        $this->_thread_sticky = $thread_sticky;
 
        return $this;
    }
 
    public function getThread_sticky()
    {
        return $this->_thread_sticky;
    }

	//************************************************************************************************

    public function setThread_body($thread_body)
    {
        $this->_thread_body = (string) $thread_body;
 
        return $this;
    }
 
    public function getThread_body()
    {
        return $this->_thread_body;
    }
	
	//************************************************************************************************
	
	public function setThread_title($thread_title)
    {
        $this->_thread_title = (string) $thread_title;
 
        return $this;
    }
 
    public function getThread_title()
    {
        return $this->_thread_title;
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

public function setThread_state_id($thread_state_id)
    {
        $this->_thread_state_id= (int) $thread_state_id;
 
        return $this;
    }
 
    public function getThread_state_id()
    {
        return $this->_thread_state_id;
    }
	//************************************************************************************************

public function setOwner_id($owner_id)
    {
        $this->_owner_id= (int) $owner_id;
 
        return $this;
    }
 
    public function getOwner_id()
    {
        return $this->_owner_id;
    }
	//************************************************************************************************


}

