<?php

class Api_V1Controller extends Zend_Controller_Action
{
    public function init()
    {
        $this->getHelper('viewRenderer')->setNoRender();
        $this->getHelper('layout')->disableLayout();
    }

    public function indexAction()
    {
        $json = array(
            'path' => '/api/v1',
            'available' => array(
                'get-category',
                'get-product',
                'get-download',
            ),
        );

        $this->getResponse()->setBody(json_encode($json));
    }

    /**
     * 取得分類列表
     */
    public function getProductCategoryAction()
    {
        $productService = new Application_Service_Product();
        $data = $productService->getCategory();

        $this->getResponse()->setBody(json_encode($data->toArray()));
    }

    /**
     * 取得產品列表
     */
    public function getProductAction()
    {
        $productService = new Application_Service_Product();
        $data = $productService->getProducts();

        $this->getResponse()->setBody(json_encode($data->toArray()));
    }

    /**
     * Get downloads
     */
    public function getDownloadAction()
    {
        $downloadService = new Application_Service_Download();
        $data = $downloadService->getDownloads();

        $this->getResponse()->setBody(json_encode($data->toArray()));
    }

    public function faqAction()
    {
        //post[username]
        //post[email]
        //post[phone] *optional
        //post[title]
        //post[message] *optional
    }
}
