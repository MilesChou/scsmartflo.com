<?php

/**
 * Download model
 */
class Application_Model_Download
{
    /**
     * @var Application_Model_DbTable_ProductCategory
     */
    private $downloadTable;

    public function __construct()
    {
        $this->downloadTable = new Application_Model_DbTable_Download();
    }

    /**
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getDownload()
    {
        return $this->downloadTable->fetchAll();
    }

    /**
     * @param string $title
     * @param string $file
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function addDownload($title, $file)
    {
        $row = $this->downloadTable->createRow();
        $row->title = $title;
        $row->file = $file;
        $row->save();

        return $row;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string|null $file
     *
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function updDownload($id, $title, $file = null)
    {
        $row = $this->downloadTable->fetchRow(array('id = ?', $id));

        if ($row === null) {
            return false;
        }

        $row->title = $title;

        if ($file !== null) {
            $row->file = $file;
        }

        $row->save();

        return $row;
    }

    /**
     * @param int $id
     *
     * @return boolean
     */
    public function delDownload($id)
    {
        $row = $this->downloadTable->fetchRow(array('id = ?' => $id));

        if ($row === null) {
            return false;
        }

        unlink(APPLICATION_PATH . '/../public/upload/' . $row->file);
        $row->delete();

        return true;
    }
}
