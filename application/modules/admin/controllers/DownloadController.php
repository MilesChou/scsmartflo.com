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
    }
}
