<?php

class Application_Service_Download
{
    /**
     * @var Application_Model_Download
     */
    private $model;

    public function __construct()
    {
        $this->model = new Application_Model_Download();
    }

    /**
     * @param Zend_Controller_Request_Http $request
     * @param Zend_File_Transfer_Adapter_Http $file
     */
    public function addDownload($request, $file)
    {
        $post = $request->getParams();
        $fileInfo = $file->getFileInfo();

        if (isset($fileInfo['file']) && $fileInfo['file']['error'] == 0) {
            $filename = time() . $fileInfo['file']['name'];
            $file->addFilter('Rename', array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();

            $this->model->addDownload(
                $post['title'],
                $filename
            );
        }
    }

    /**
     * @param int $id
     * @param Zend_Controller_Request_Http $request
     */
    public function updDownload($id, $request)
    {
        $post = $request->getParams();

        $this->model->updDownload(
            $id,
            $post['title']
        );
    }

    /**
     * @param Zend_Controller_Request_Http
     */
    public function delDownload($id)
    {
        $this->model->delDownload($id);
    }

    /**
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getDownloads()
    {
        return $this->model->getDownload();
    }
}
