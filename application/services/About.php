<?php

class Application_Service_About
{
    /**
     * @var Application_Model_About
     */
    private $model;

    /**
     * @var array
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new Application_Model_About();
        $this->data = array(
            'cover' => $this->model->getCover(),
            'description' => $this->model->getDescription(),
            'pics' => $this->model->getPics(),
            'picDescription' => $this->model->getPicDescription(),
        );
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->data['cover'];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->data['description'];
    }

    /**
     * @param $cover
     */
    public function setCover($cover)
    {
        $this->data['cover'] = $cover;
        $this->model->setCover($cover);
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->data['description'] = $description;
        $this->model->setDescription($description);
    }

    public function save()
    {
        $this->model->save();
    }
}
