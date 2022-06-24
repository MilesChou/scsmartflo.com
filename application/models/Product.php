<?php

/**
 * Product model
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
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getCategory()
    {
        return $this->categoryTable->fetchAll();
    }

    /**
     * @param string $title
     *
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
     *
     * @return boolean
     */
    public function delCategory($id)
    {
        $row = $this->categoryTable->fetchRow(array('id = ?' => $id));

        if ($row === null) {
            return false;
        }

        $products = $this->getProducts($id);
        foreach ($products as $product) {
            $this->delProduct($product->id);
        }

        $row->delete();

        return true;
    }

    /**
     * @param int $id
     *
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function getProduct($id)
    {
        return $this->productTable->fetchRow(array('id = ?' => $id));
    }

    /**
     * @param null $category
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getProducts($category = null)
    {
        return $this->productTable->getProduct($category);
    }

    /**
     * @param int $category
     * @param string $title
     * @param string $desc
     * @param string $pic
     */
    public function addProduct($category, $title, $desc, $pic)
    {
        $row = $this->productTable->createRow();
        $row->category_id = $category;
        $row->title = $title;
        $row->description = $desc;
        $row->pic = $pic;

        $row->save();
    }

    /**
     * @param int $id
     * @param int $category
     * @param string $title
     * @param string $desc
     * @param string|null $pic
     *
     * @return bool
     */
    public function updProduct($id, $category, $title, $desc, $pic = null)
    {
        $row = $this->productTable->fetchRow(array('id = ?' => $id));

        if ($row === null) {
            return false;
        }

        $row->category_id = $category;
        $row->title = $title;
        $row->description = $desc;

        if ($pic !== null) {
            $row->pic = $pic;
        }

        $row->save();
    }

    /**
     * @param $id
     *
     * @return bool
     * @throws Zend_Db_Table_Row_Exception
     */
    public function delProduct($id)
    {
        $row = $this->productTable->fetchRow(array('id = ?' => $id));

        if ($row === null) {
            return false;
        }

        unlink(APPLICATION_PATH . '/../public/upload/' . $row->pic);
        $row->delete();

        return true;
    }
}
