<?php

/**
 * @author Miles
 */
class Application_Model_DbTable_Download extends Zend_Db_Table_Abstract
{
    const DEFAULT_ID = 1;

    public function __construct()
    {
        $config = array(
            Zend_Db_Table_Abstract::NAME => 'download',
            Zend_Db_Table_Abstract::PRIMARY => 'id',
        );

        parent::__construct($config);
    }
}
