<?php

/**
 * Home model
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
                'sliderShow' => array(),
            );

            $this->save();
        }
    }

    /**
     * @param string $file
     * @param string $description
     */
    public function addSliderShow($file, $description)
    {
        $this->data['sliderShow'][] = array(
            'pic' => $file,
            'description' => $description,
        );
    }

    /**
     * @param int $index
     */
    public function delSliderShow($index)
    {
        unset($this->data['sliderShow'][$index]);
    }

    /**
     * @return array
     */
    public function getSliderShows()
    {
        return $this->data['sliderShow'];
    }

    /**
     * 儲存
     */
    public function save()
    {
        $this->data['sliderShow'] = array_values($this->data['sliderShow']);
        $this->configRow->setConfig(self::CONFIG_KEY, $this->data);
        $this->configRow->save();
    }

    /**
     * @param int $index
     * @param string $description
     * @param string $filename
     */
    public function updSliderShow($index, $description, $filename)
    {
        $index = (int)$index;
        $this->data['sliderShow'][$index] = array(
            'pic' => $filename,
            'description' => $description,
        );
    }
}
