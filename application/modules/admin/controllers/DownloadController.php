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

        $this->redirect('/admin/download');
    }

    public function updAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');
        $file = new Zend_File_Transfer_Adapter_Http();

        $downloadService = new Application_Service_Download();
        $downloadService->updDownload($id, $request);

        $this->redirect('/admin/download');
    }

    public function delAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');

        $downloadService = new Application_Service_Download();
        $downloadService->delDownload($id);

        $this->redirect('/admin/download');
    }
}
