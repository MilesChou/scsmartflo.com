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
     * 儲存附圖
     *
     * @param int $index
     */
    public function delPic($index)
    {
        unset($this->data['pics'][$index]);
        $this->data['pics'] = array_values($this->data['pics']);
    }

    /**
     * 取得大圖顯示的檔案位置
     *
     * @return string
     */
    public function getCover()
    {
        return $this->data['cover'];
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
     * 取得附圖檔案位置
     *
     * @return array
     */
    public function getPics()
    {
        return $this->data['pics'];
    }

    /**
     * 取得附圖文字說明
     *
     * @return string
     */
    public function getPicDescription()
    {
        return $this->data['picDescription'];
    }

    /**
     * 儲存大圖顯示的檔案
     *
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->data['cover'] = $cover;
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
     * 儲存附圖
     *
     * @param int $index
     * @param string $pic
     */
    public function setPic($index, $pic)
    {
        $this->data['pics'][$index] = $pic;
    }

    /**
     * 儲存附圖文字說明
     *
     * @param string $description
     */
    public function setPicDescription($description)
    {
        $this->data['picDescription'] = $description;
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
