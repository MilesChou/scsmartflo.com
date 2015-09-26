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

        $this->view->categories = $productService->getCategory()->toArray();
        $this->view->products = $productService->getProducts($this->view->categories[0]['id'])->toArray();
    }
}
