<?php

class Admin_IndexController extends Zend_Controller_Action
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
}
