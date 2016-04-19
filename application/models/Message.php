<?php

class Application_Model_Message
{
	protected $_message_id;
    protected $_from_user;
    protected $_to_user;
    protected $_date;
    protected $_message;
    protected $_subject;

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

 
    public function setMessage_id($message_id)
    {
        $this->_message_id = (int) $message_id;
 
        return $this;
    }
 
    public function getMessage_id()
    {
        return $this->_message_id;
    }

    public function setFrom_user($from_user)
    {
        $this->_from_user = (string) $from_user;

        return $this;
    }

    public function getFrom_user()
    {
        return $this->_from_user;
    }
     public function setTo_user($to_user)
    {
        $this->_to_user = (string) $to_user;

        return $this;
    }

    public function getTo_user()
    {
        return $this->_to_user;
    }

    public function setDate($date)
    {
        $this->_date = (string) $date;

        return $this;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function setMessage($message)
    {
        $this->_message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function setSubject($subject)
    {
        $this->_subject =  $subject;

        return $this;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

}

