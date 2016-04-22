<?php

class Application_Model_Users
{
	protected $_user_id;
    protected $_user_email;
    protected $_user_password;
    protected $_user_name;
    protected $_registration_date;
    protected $_gender;
    protected $_country;
    protected $_image;
    protected $_last_login_date;
    protected $_user_type;
    protected $_ban;

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
 
    public function setUser_id($user_id)
    {
        $this->_user_id = (int) $user_id;
 
        return $this;
    }
 
    public function getUser_id()
    {
        return $this->_user_id;
    }

    public function setUser_email($user_email)
    {
        $this->_user_email = (string) $user_email;

        return $this;
    }

    public function getUser_email()
    {
        return $this->_user_email;
    }
     public function setUser_name($user_name)
    {
        $this->_user_name = (string) $user_name;

        return $this;
    }

    public function getUser_name()
    {
        return $this->_user_name;
    }

    public function setUser_password($user_password)
    {
        $this->_user_password = (string) $user_password;

        return $this;
    }

    public function getUser_password()
    {
        return $this->_user_password;
    }

    public function setRegistration_date($registration_date)
    {
        $this->_registration_date = $registration_date;

        return $this;
    }

    public function getRegistration_date()
    {
        return $this->_registration_date;
    }

    public function setUser_type($user_type)
    {
        $this->_user_type =  $user_type;

        return $this;
    }

    public function getUser_type()
    {
        return $this->_user_type;
    }
    public function setBan($ban)
    {
        $this->_ban =  $ban;

        return $this;
    }

    public function getBan()
    {
        return $this->_ban;
    }
    public function setGender($gender)
    {
        $this->_gender =  $gender;

        return $this;
    }

    public function getGender()
    {
        return $this->_gender;
    }
    public function setCountry($country)
    {
        $this->_country =  $country;

        return $this;
    }

    public function getCountry()
    {
        return $this->_country;
    }
    public function setImage($image)
    {
        $this->_image =  $image;

        return $this;
    }

    public function getImage()
    {
        return $this->_image;
    }
    public function setLast_login_date($last_login_date)
    {
        $this->_last_login_date =  $last_login_date;

        return $this;
    }

    public function getLast_login_date()
    {
        return $this->_last_login_date;
    }

}
