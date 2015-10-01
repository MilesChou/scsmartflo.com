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
            'title' => $this->model->getTitle(),
            'description' => $this->model->getDescription(),
            'pic' => $this->model->getPic(),
        );
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
    public function getPic()
    {
        return $this->data['pic'];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->data['title'];
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
     * @param Zend_File_Transfer_Adapter_Http $file
     */
    public function setPic($file)
    {
        $fileInfo = $file->getFileInfo();

        if (isset($fileInfo['pic']) && $fileInfo['pic']['error'] == 0) {
            $sub = substr($fileInfo['pic']['name'], -4);
            $filename = time() . $sub;
            $file->addFilter('Rename', array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));
            $file->receive();

            $this->model->setPic($filename);

            $this->data['pic'] = $filename;
        }
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
