<?php

class Application_Service_Contact
{
    /**
     * @var Application_Model_Contact
     */
    private $model;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new Application_Model_Contact();

        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('gmail');

        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return $this->model->getInfo();
    }

    /**
     * @param array $info
     */
    public function setInfo($info)
    {
        $this->model->setInfo($info);
        $this->model->save();
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $title
     * @param string $message
     */
    public function send($username, $email, $title, $message)
    {
        $info = $this->model->getInfo();

        $smtpHost = 'smtp.gmail.com';
        $smtpConf = array(
            'auth' => 'login',
            'ssl' => 'ssl',
            'port' => '465',
            'username' => $info['username'],
            'password' => $info['password'],
        );
        $transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);

        $mail = new Zend_Mail();
        $mail->setBodyText($message);
        $mail->setFrom($email);
        $mail->addTo($info['title'] . ' <' . $info['email'] . '>');
        $mail->setSubject($title);
        $mail->send($transport);
    }
}
