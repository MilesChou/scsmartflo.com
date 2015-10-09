<?php

class Admin_AuthController extends Zend_Controller_Action
{
    public function init()
    {
    }

    public function indexAction()
    {
        $this->getHelper('layout')->disableLayout();
    }

    public function loginAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $password = $this->getRequest()->getParam('password');

        $authService = new Application_Service_Auth();
        $authService->login($password);

        $this->redirect('/admin');
    }

    public function logoutAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $authService = new Application_Service_Auth();
        $authService->logout();

        $this->redirect('/admin');
    }
}
