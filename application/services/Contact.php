<?php

/**
 * Class Application_Service_Contact
 */
class Application_Service_Contact
{
    /**
     * @var Application_Model_Contact
     */
    private $model;

    public function __construct()
    {
        $this->model = new Application_Model_Contact();
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return $this->model->getInfo();
    }

    /**
     * @param array $info
     */
    public function setInfo($info)
    {
        $this->model->setInfo($info);
        $this->model->save();
    }

    /**
     * @param array $form
     */
    public function send($form)
    {
        $this->model->sendForm($form);
    }
}
