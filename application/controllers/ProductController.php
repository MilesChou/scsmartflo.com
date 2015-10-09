<?php

class ProductController extends Zend_Controller_Action
{
    public function getInfoAction()
    {
        //product/get-info/:id
        $this->getHelper('layout')->disableLayout();
        $params = $this->getRequest()->getParams();

        $productService = new Application_Service_Product();

        $product = $productService->getProduct($params['id']);
        $this->view->info = $product->toArray();
    }
}
