<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $homeService = new Application_Service_Home();
        $productService = new Application_Service_Product();

        $aboutService = new Application_Service_About();

        $this->view->aboutDescription = $aboutService->getDescription();
        $this->view->aboutTitle = $aboutService->getTitle();
        $this->view->categories = $productService->getCategory()->toArray();
        $this->view->products = $productService->getProducts($this->view->categories[0]['id'])->toArray();
    }
}
