<?php

class Admin_ProductController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $productService = new Application_Service_Product();
    }
}
