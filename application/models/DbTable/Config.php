<?php

/**
 * 設定資料
 *
 * @author Miles
 */
class Application_Model_DbTable_Config extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'config',
            Zend_Db_Table_Abstract::ROW_CLASS => 'Application_Model_DbTable_Row_Config',
        );

        parent::__construct($config);
    }
}
