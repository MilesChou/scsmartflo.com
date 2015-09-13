<?php

/**
 * @author Miles
 */
class Application_Model_DbTable_Product extends Zend_Db_Table_Abstract
{
    const DEFAULT_ID = 1;

    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'productCategory',
        );

        parent::__construct($config);
    }
}
