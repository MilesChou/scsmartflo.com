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
            'api-available' => array(),
        );

        $this->getResponse()->setBody(json_encode($json));
    }

    public function getProductAction()
    {
        //get[kind] 產品分類

        $json = array(
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
            array(
                'id' => 'product',                 //產品id 同時也是圖片id
                'name' => 'ViaAjax',          //產品名稱
                'description' => 'Super.........'   //產品敘述
            ),
        );

        echo json_encode($json);
    }

    public function faqAction () {
        //post[username]
        //post[email]
        //post[phone] *optional
        //post[title]
        //post[message] *optional
    }
}
