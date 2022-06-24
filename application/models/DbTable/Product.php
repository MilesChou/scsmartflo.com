<?php

class Application_Model_DbTable_Product extends Zend_Db_Table_Abstract
{
    const DEFAULT_ID = 1;

    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'product',
            Zend_Db_Table_Abstract::PRIMARY => 'id',
        );

        parent::__construct($config);
    }

    /**
     * @param int|null $category
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getProduct($category = null)
    {
        $select = $this->select();

        if ($category !== null) {
            $select->where('category_id = ?', $category);
        }

        return $this->fetchAll($select);
    }
}
