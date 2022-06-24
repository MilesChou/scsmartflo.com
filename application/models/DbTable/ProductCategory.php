<?php

class Application_Model_DbTable_ProductCategory extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'productCategory',
            Zend_Db_Table_Abstract::PRIMARY => 'id',
        );

        parent::__construct($config);
    }
}
