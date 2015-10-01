<?php

class Admin_AboutController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
        $aboutService = new Application_Service_About();

        $this->view->description = $aboutService->getDescription();
        $this->view->title = $aboutService->getTitle();
        $this->view->pic = $aboutService->getPic();
    }

    public function saveAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $description = $this->getRequest()->getParam('description');
        $title = $this->getRequest()->getParam('title');
        $file = new Zend_File_Transfer_Adapter_Http();

        $aboutService = new Application_Service_About();
        $aboutService->setDescription($description);
        $aboutService->setTitle($title);
        $aboutService->setPic($file);
        $aboutService->save();
    }
}
