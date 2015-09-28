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
            'title' => $this->model->getTitle(),
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
     * @return string
     */
    public function getTitle()
    {
        return $this->data['title'];
    }

    /**
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->data['cover'] = $cover;
        $this->model->setCover($cover);
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->data['description'] = $description;
        $this->model->setDescription($description);
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->data['title'] = $title;
        $this->model->setTitle($title);
    }

    public function save()
    {
        $this->model->save();
    }
}
