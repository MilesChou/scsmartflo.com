<?php

/**
 * Home model
 *
 * @author Miles
 */
class Application_Model_Home
{
    const CONFIG_KEY = 'home';

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

    public function addSliderShow()
    {
        // TODO: Implement it
    }

    public function delSliderShow()
    {
        // TODO: Implement it
    }

    /**
     * 取得文字說明
     *
     * @return string
     */
    public function getDescription()
    {
        // TODO: Implement it
    }

    /**
     * 取得幻燈片檔案位置
     *
     * @return array
     */
    public function getSliderShow()
    {
        // TODO: Implement it
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
     * 設定文字說明
     */
    public function setDescription()
    {
        // TODO: Implement it
    }
}
