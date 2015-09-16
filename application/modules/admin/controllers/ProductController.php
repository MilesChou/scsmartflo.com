<?php

class Admin_ProductController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->getHelper('layout');
        $layout->setLayout('admin');
    }

    public function indexAction()
    {
        $category = null;
        $productService = new Application_Service_Product();
        $products = $productService->getProducts($category);
        $category = $productService->getCategory();

        $this->view->products = $products;
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
