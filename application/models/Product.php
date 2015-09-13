<?php

/**
 * Product model
 *
 * @author Miles
 */
class Application_Model_Product
{
    /**
     * @var Application_Model_DbTable_ProductCategory
     */
    private $categoryTable;

    /**
     * @var Application_Model_DbTable_Product
     */
    private $productTable;

    public function __construct()
    {
        $this->categoryTable = new Application_Model_DbTable_ProductCategory();
        $this->productTable = new Application_Model_DbTable_Product();
    }


    /**
     * @return array
     */
    public function getCategory()
    {
        return $this->categoryTable->fetchAll();
    }

    /**
     * @param string $title
     * @return Zend_Db_Table_Row_Abstract
     */
    public function addCategory($title)
    {
        $row = $this->categoryTable->createRow();
        $row->title = $title;
        $row->save();

        return $row;
    }

    /**
     * @param int $id
     * @param string $title
     *
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function updCategory($id, $title)
    {
        $row = $this->categoryTable->fetchRow(array('id = ?', $id));

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
    public function delCategory($id)
    {
        $row = $this->categoryTable->fetchRow(array('id = ?', $id));

        if ($row === null) {
            return false;
        }

        $row->delete();

        return true;
    }

    /**
     * @param int $id
     */
    public function getProduct($id)
    {
    }

    /**
     * @param null $category
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getProducts($category = null)
    {
        return $this->productTable->fetchAll();
    }

    public function addProduct()
    {

    }

    public function updProduct()
    {

    }

    public function delProduct()
    {

    }
}
