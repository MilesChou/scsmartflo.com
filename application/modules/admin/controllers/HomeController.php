<?php

class Admin_HomeController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
        $homeService = new Application_Service_Home();

        $this->view->home = $homeService->getInfo();
    }

    public function saveAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $params = $this->getRequest()->getParams();

        $homeService = new Application_Service_Home();

        $this->redirect('/admin/home');
    }
}
