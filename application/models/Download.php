<?php

/**
 * Download model
 *
 * @author Miles
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
     * @param string $title
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
     *
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function updDownload($id, $title)
    {
        $row = $this->downloadTable->fetchRow(array('id = ?', $id));

        if ($row === null) {
            return false;
        }

        $row->title = $title;
        $row->save();

        return $row;
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function delDownload($id)
    {
        $row = $this->downloadTable->fetchRow(array('id = ?', $id));

        if ($row === null) {
            return false;
        }

        $row->delete();

        return true;
    }
}
