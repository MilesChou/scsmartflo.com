<?php

class Admin_ProductController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $category = null;
        $productService = new Application_Service_Product();
        $list = $productService->getList($category);
        $category = $productService->getCategory();

        $this->view->list = $list;
        $this->view->category = $category;
    }

    public function addAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $file = new Zend_File_Transfer_Adapter_Http();

        $productService = new Application_Service_Product();
        $productService->addProduct($request, $file);
    }
}
