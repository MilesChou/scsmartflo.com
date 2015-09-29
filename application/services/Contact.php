<?php

/**
 * Class Application_Service_Contact
 */
class Application_Service_Contact
{
    const GMAIL_USERNAME = 'scsmartflo@example.com';
    const GMAIL_PASSWORD = 'password';

    /**
     * @var Application_Model_Contact
     */
    private $model;

    public function __construct()
    {
        $this->model = new Application_Model_Contact();
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
            'username' => self::GMAIL_USERNAME,
            'password' => self::GMAIL_PASSWORD,
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
