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
            $file->addFilter('Rename',
                array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();

            $this->model->addDownload(
                $post['title'],
                $filename
            );
        } else {
            $message = "上傳錯誤";

            switch ($fileInfo['file']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $message = "檔案大小超出了伺服器上傳限制";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message = "要上傳的檔案大小超出瀏覽器限制";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = "檔案僅部分被上傳 ";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = "沒有找到要上傳的檔案";
                    break;
                case 5:
                    $message = "伺服器臨時檔案遺失";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = "檔案寫入到站存資料夾錯誤";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = "無法寫入硬碟";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = "File upload stopped by extension.";
                    break;
            }
            throw new Exception($message);
        }
    }

    /**
     * @param int $id
     * @param Zend_Controller_Request_Http $request
     * @param Zend_File_Transfer_Adapter_Http $file
     */
    public function updDownload(
        $id,
        $request,
        $file
    )
    {
        $post = $request->getParams();
        $fileInfo = $file->getFileInfo();
        $filename = null;

        if (isset($fileInfo['file']) && $fileInfo['file']['error'] == 0) {
            $filename = time() . $fileInfo['file']['name'];
            $file->addFilter('Rename',
                array('target' => APPLICATION_PATH . '/../public/upload/' . $filename, 'overwrite' => true));

            $file->receive();
        }

        $this->model->updDownload(
            $id,
            $post['title'],
            $filename
        );
    }

    /**
     * @param Zend_Controller_Request_Http
     */
    public
    function delDownload(
        $id
    )
    {
        $this->model->delDownload($id);
    }

    /**
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public
    function getDownloads()
    {
        return $this->model->getDownload();
    }
}
