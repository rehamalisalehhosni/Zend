<?php
class My_Acl extends Zend_Acl
{
    public function __construct()
    {
        // Add a new role called "guest"
        $this->addRole(new Zend_Acl_Role('guest'));
        // Add a role called user, which inherits from guest
        $this->addRole(new Zend_Acl_Role('Users'), 'guest');
        // Add a role called admin, which inherits from user
        $this->addRole(new Zend_Acl_Role('admin'), 'Users');

        // Add some resources in the form controller::action
        $this->add(new Zend_Acl_Resource('error::error'));
        $this->add(new Zend_Acl_Resource('auth::login'));
        $this->add(new Zend_Acl_Resource('auth::logout'));
        $this->add(new Zend_Acl_Resource('index::index'));

        // Allow guests to see the error, login and index pages
        $this->allow('guest', 'error::error');
        $this->allow('guest', 'auth::login');
        $this->allow('guest', 'index::index');
        // Allow users to access logout and the index action from the user controller
        $this->allow('Users', 'auth::logout');
        $this->allow('Users', 'Users::index');
        // Allow admin to access admin controller, index action
        $this->allow('Users', 'admin::index');

        // You will add here roles, resources and authorization specific to your application, the above are some examples
    }
}
