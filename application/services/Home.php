<?php

class Application_Service_Home
{
    /**
     * @var Application_Model_Home
     */
    private $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new Application_Model_Home();
    }

    /**
     * @param Zend_File_Transfer_Adapter_Http $file
     * @param string $description
     */
    public function addSliderShow($file, $description)
    {
        $fileInfo = $file->getFileInfo();

        if (isset($fileInfo['pic']) && $fileInfo['pic']['error'] == 0) {
            $sub = substr($fileInfo['pic']['name'], -4);
            $filename = time() . $sub;
            $file->addFilter('Rename',
                array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();

            $this->model->addSliderShow(
                $filename,
                $description
            );
        }

        $this->model->save();
    }

    /**
     * @param int $index
     * @param Zend_File_Transfer_Adapter_Http $file
     * @param string $description
     */
    public function updSliderShow($index, $file, $description)
    {
        $fileInfo = $file->getFileInfo();
        $filename = null;

        if (isset($fileInfo['pic']) && $fileInfo['pic']['error'] == 0) {
            $sub = substr($fileInfo['pic']['name'], -4);
            $filename = time() . $sub;
            $file->addFilter('Rename',
                array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();
        }


        $this->model->updSliderShow(
            $index,
            $description,
            $filename
        );
        $this->model->save();
    }

    /**
     * @param int $index
     */
    public function delSliderShow($index)
    {
        $this->model->delSliderShow($index);
        $this->model->save();
    }

    /**
     * @return array
     */
    public function getSliderShows()
    {
        return $this->model->getSliderShows();
    }

}
