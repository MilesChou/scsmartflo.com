<?php

class Admin_ContactController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $contactService = new Application_Service_Contact();
    }
}
