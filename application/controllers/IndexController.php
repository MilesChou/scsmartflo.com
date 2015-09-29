<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $homeService = new Application_Service_Home();
        $aboutService = new Application_Service_About();
        $productService = new Application_Service_Product();
        $contactService = new Application_Service_Contact();
        $downloadService = new Application_Service_Download();

        $this->view->sliderShows = $homeService->getSliderShows();
        $this->view->aboutDescription = $aboutService->getDescription();
        $this->view->aboutTitle = $aboutService->getTitle();
        $this->view->categories = $productService->getCategory()->toArray();
        $this->view->products = $productService->getProducts($this->view->categories[0]['id'])->toArray();
        $this->view->contactInfo = $contactService->getInfo();
        $this->view->downloads = $downloadService->getDownloads()->toArray();
    }
}
