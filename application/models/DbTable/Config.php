<?php

/**
 * 設定資料
 *
 * @author Miles
 */
class Application_Model_DbTable_Config extends Zend_Db_Table_Abstract
{
    const DEFAULT_ID = 1;

    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'config',
            Zend_Db_Table_Abstract::PRIMARY => 'id',
            Zend_Db_Table_Abstract::ROW_CLASS => 'Application_Model_DbTable_Row_Config',
        );

        parent::__construct($config);
    }

    /**
     * @param int $id
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function getConfigRow($id = self::DEFAULT_ID)
    {
        return $this->fetchRow(array('id = ?' => $id));
    }
}
