<?php

class Admin_ContactController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
        $contactService = new Application_Service_Contact();

        $this->view->info = $contactService->getInfo();
    }

    public function saveAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $params = $this->getRequest()->getParams();

        $contactService = new Application_Service_Contact();
        $contactService->setInfo($params);

        $this->redirect('/admin/contact');
    }
}
