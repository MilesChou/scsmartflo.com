<?php

/**
 * About model
 *
 * @author Miles
 */
class Application_Model_About
{
    const CONFIG_KEY = 'about';

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
                'title' => 'Scsmartflo',
                'description' => 'We are Scsmartflo',
                'pic' => '',
            );

            $this->save();
        }
    }

    /**
     * 取得公司介紹
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->data['description'];
    }

    /**
     * 取得大圖顯示的檔案位置
     *
     * @return string
     */
    public function getPic()
    {
        return $this->data['pic'];
    }

    /**
     * 取得附圖文字說明
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->data['title'];
    }

    /**
     * 儲存公司介紹
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->data['description'] = $description;
    }

    /**
     * 儲存大圖顯示的檔案
     *
     * @param string $pic
     */
    public function setPic($pic)
    {
        $this->data['pic'] = $pic;
    }

    /**
     * 取得附圖文字說明
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    /**
     * 儲存
     */
    public function save()
    {
        $this->configRow->setConfig(self::CONFIG_KEY, $this->data);
        $this->configRow->save();
    }
}
