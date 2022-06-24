<?php

/**
 * Contact model
 */
class Application_Model_Auth
{
    const CONFIG_KEY = 'auth';

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
                'password' => '0000',
            );

            $this->save();
        }
    }

    /**
     * @return array
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
     * @param array $data
     */
    public function setInfo($data)
    {
        $this->data = $data;
    }
}
