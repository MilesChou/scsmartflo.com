<?php

/**
 * Contact model
 *
 * @author Miles
 */
class Application_Model_Contact
{
    const CONFIG_KEY = 'contact';

    /**
     * @var Application_Model_DbTable_Row_Config
     */
    private $configRow;

    /**
     * @var array
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $configTable = new Application_Model_DbTable_Config();
        $this->configRow = $configTable->getConfigRow();
        $this->data = $this->configRow->getConfig(self::CONFIG_KEY);

        if ($this->data === null) {
            $this->data = array(
                'cover' => '',
                'description' => '',
                'pics' => '',
                'picDescription' => '',
                'email' => '',
            );

            $this->save();
        }
    }

    /**
     * 取得公司名稱 Logo 地址 電話 電子信箱
     */
    public function getInfo()
    {
        return $this->data;
    }

    /**
     * 儲存
     */
    public function save()
    {
        $this->configRow->setConfig(self::CONFIG_KEY, $this->data);
        $this->configRow->save();
    }

    /**
     * 編輯公司名稱 Logo 地址 電話 電子信箱
     *
     * @param array $data
     */
    public function setInfo($data)
    {
        $this->data = $data;
    }

    /**
     * 寄信
     *
     * @todo Implement it
     */
    public function sendForm()
    {
    }
}
