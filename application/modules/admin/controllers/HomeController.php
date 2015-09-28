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

        $this->view->sliderShows = $homeService->getSliderShows();
    }

    public function addAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $description = $this->getRequest()->getParam('description');
        $file = new Zend_File_Transfer_Adapter_Http();

        $homeService = new Application_Service_Home();
        $homeService->addSliderShow($file, $description);

        $this->redirect('/admin/home');
    }

    public function delAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $index = $this->getRequest()->getParam('id');

        $homeService = new Application_Service_Home();
        $homeService->delSliderShow($index);

        $this->redirect('/admin/home');
    }
}
