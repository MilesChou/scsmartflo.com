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
                'send',
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
        $category = $this->getRequest()->getParam('kind', null);

        $productService = new Application_Service_Product();
        $data = $productService->getProducts($category);

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

    /**
     * Send form
     */
    public function faqAction()
    {
        $request = $this->getRequest();
        $username = $request->getParam('username', null);
        $email = $request->getParam('email', null);
        $title = $request->getParam('title', null);
        $message = $request->getParam('message', null);

        $contactService = new Application_Service_Contact();
        $contactService->send($username, $email, $title, $message);
    }
}
