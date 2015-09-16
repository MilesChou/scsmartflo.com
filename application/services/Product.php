<?php

class Application_Service_Product
{
    /**
     * @var Application_Model_Product
     */
    private $model;

    public function __construct()
    {
        $this->model = new Application_Model_Product();
    }

    /**
     * @param $title
     */
    public function addCategory($title)
    {
        $this->model->addCategory($title);
    }

    /**
     * @param Zend_Controller_Request_Http
     * @param Zend_File_Transfer_Adapter_Http $file
     */
    public function addProduct($request, $file)
    {
        $post = $request->getPost();
        $fileInfo = $file->getFileInfo();

        if (isset($fileInfo['pic']) && $fileInfo['pic']['error'] == 0) {
            $sub = substr($fileInfo['pic']['name'], -4);
            $filename = time() . $sub;
            $file->addFilter('Rename', array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();

            $this->model->addProduct(
                $post['category'],
                $post['title'],
                $post['description'],
                $filename
            );
        }
    }

    /**
     * @param $id
     * @param $title
     */
    public function updCategory($id, $title)
    {
        $this->model->updCategory($id, $title);
    }

    /**
     * @param Zend_Controller_Request_Http
     * @param Zend_File_Transfer_Adapter_Http $file
     */
    public function updProduct($request, $file)
    {
        $post = $request->getPost();
        $fileInfo = $file->getFileInfo();

        if (isset($fileInfo['pic']) && $fileInfo['pic']['error'] == 0) {
            $sub = substr($fileInfo['pic']['name'], -4);
            $filename = time() . $sub;
            $file->addFilter('Rename', array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();

            $this->model->addProduct(
                $post['category'],
                $post['title'],
                $post['description'],
                $filename
            );
        }
    }

    /**
     * @param $id
     */
    public function delCategory($id)
    {
        $this->model->delCategory($id);
    }

    /**
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getCategory()
    {
        return $this->model->getCategory();
    }

    /**
     * @param int $category
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getProducts($category = null)
    {
        return $this->model->getProducts($category);
    }

}
