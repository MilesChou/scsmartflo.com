<?php

class ProductController extends Zend_Controller_Action
{
    public function getInfoAction()
    {
        //product/get-info/:id
        $this->getHelper('layout')->disableLayout();
        $this->view->info = array(
            "pic" => "/path/to/img",
            "title" => "i am title",
            "description" => "i am what i am"
        );
    }
}
