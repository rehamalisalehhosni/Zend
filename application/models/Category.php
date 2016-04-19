<?php

class Application_Model_Category
{
    protected _category_id;
    protected _category_name;
    protected _category_state;
    protected _parent;

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

    public function setCategory_name($categoryName)
    {
        $this->_category_name = (string) $categoryName;
        return $this;
    }
    public function setCategory_state($categoryState)
    {
        $this->_category_state = (string) $categoryState;
        return $this;
    }
    public function setParent()($categoryParent)
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
}
