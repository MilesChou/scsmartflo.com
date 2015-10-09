<?php

class Application_Service_Auth
{
    /**
     * @var Application_Model_Auth
     */
    private $model;

    /**
     * @var Zend_Session_Namespace
     */
    private $session;

    /**
     * @var array
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->session = new Zend_Session_Namespace('default');
        $this->model = new Application_Model_Auth();
        $this->data = $this->model->getInfo();
    }

    /**
     * @return boolean
     */
    public function isLogin()
    {
        return isset($this->session->login);
    }

    /**
     * @param string $password
     */
    public function login($password)
    {
        if ($this->data['password'] == $password) {
            $this->session->login = true;
        }
    }

    public function logout()
    {
        unset($this->session->login);
    }

    /**
     * @param string $password
     */
    public function edit($password)
    {
        $this->data['password'] = $password;
        $this->model->setInfo($this->data);
        $this->model->save();
    }
}
