<?php

class DownloadController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $downloadService = new Application_Service_Download();
    }
}
