<?php

/**
 * 設定資料
 *
 * @author Miles
 */
class Application_Model_DbTable_Row_Config extends Zend_Db_Table_Row_Abstract
{
    const PK = 1;
    const COLUMN = 'content';

    /**
     * @param string$key
     *
     * @return array
     */
    public function getConfig($key)
    {
        $data = json_decode($this->content, true);

        return isset($data[$key]) ? $data[$key] : null;
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function setConfig($key, $data)
    {
        $rowData = json_decode($this->content, true);
        $rowData[$key] = $data;

        $this->content = json_encode($rowData);
    }
}
