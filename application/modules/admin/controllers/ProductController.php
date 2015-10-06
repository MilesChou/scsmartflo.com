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

        $this->redirect('/admin/product');
    }

    public function updAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');
        $file = new Zend_File_Transfer_Adapter_Http();

        $productService = new Application_Service_Product();
        $productService->updProduct($id, $request, $file);

        $this->redirect('/admin/product');
    }

    public function delAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');

        $productService = new Application_Service_Product();
        $productService->delProduct($id);

        $this->redirect('/admin/product');
    }

    public function addCategoryAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $title = $request->getParam('title');

        $productService = new Application_Service_Product();
        $productService->addCategory($title);

        $this->redirect('/admin/product');
    }

    public function updCategoryAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');
        $title = $request->getParam('title');

        $productService = new Application_Service_Product();
        $productService->updCategory($id, $title);

        $this->redirect('/admin/product');
    }

    public function delCategoryAction()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();

        $request = $this->getRequest();
        $id = $request->getParam('id');

        $productService = new Application_Service_Product();
        $productService->delCategory($id);

        $this->redirect('/admin/product');
    }
}
