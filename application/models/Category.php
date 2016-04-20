<?php

class Application_Model_Category
{
    protected $_category_id;
    protected $_category_name;
    protected $_category_state;
    protected $_category_description;
    protected $_category_parent;

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
        //var_dump($this);
        return $this;
    }

    public function setCategory_id($id)
    {
        $this->_category_id = (int) $id;

        return $this;
    }

    public function setCategory_name($categoryName)
    {
        $this->_category_name = (string) $categoryName;
        return $this;
    }
    public function setCategory_description($s)
    {
        $this->_category_description = (string) $s;
        return $this;
    }
    public function setCategory_state($categoryState)
    {
        $this->_category_state = (string) $categoryState;
        return $this;
    }
    public function setCategory_parent($categoryParent)
    {
        $this->_category_parent = (string) $categoryParent;
        return $this;
    }
    public function getCategory_name()
    {
        return $this->_category_name;
    }
    public function getCategory_id()
    {
        return $this->_category_id;
    }
    public function getCategory_state()
    {
        return $this->_category_state;
    }
    public function getCategory_parent()
    {
        return $this->_category_parent;
    }
    public function getCategory_description()
    {
        return $this->_category_description;
    }
}
