<?php

class Admin_DownloadController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
        $downloadService = new Application_Service_Download();

        $this->view->downloads = $downloadService->getDownloads();
    }

    public function addAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $file = new Zend_File_Transfer_Adapter_Http();

        $downloadService = new Application_Service_Download();
        $downloadService->addDownload($request, $file);
    }

    public function updAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $downloadService = new Application_Service_Download();

    }

    public function delAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $downloadService = new Application_Service_Download();

    }
}
