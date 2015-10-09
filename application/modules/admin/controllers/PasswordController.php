<?php

class Admin_PasswordController extends Zend_Controller_Action
{
    public function init()
    {
        $authService = new Application_Service_Auth();

        if (!$authService->isLogin()) {
            $this->redirect('/admin/auth');
            return;
        }

        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
    }

    public function saveAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $password = $this->getRequest()->getParam('password');

        $authService = new Application_Service_Auth();
        $authService->edit($password);

        $this->redirect('/admin');
    }
}
