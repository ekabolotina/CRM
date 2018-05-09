<?php

namespace Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    const HOST = 'smtp.yandex.ru';
    const USERNAME = 'dev@swat.one';
    const PASSWORD = 'b2Ggj2sHvwv7vvf';

    private $host;
    private $username;
    private $password;
    private $mail;

    function __construct ($host = self::HOST, $username = self::USERNAME, $password = self::PASSWORD) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->mail = $this->init();
    }

    function init () {
        $mail = new PHPMailer;
        $mail->setLanguage('ru');
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';

        return $mail;
    }

    function send ($to, $content = '', $from_address = 'dev@swat.one', $from_name = 'YouchCRM',
                   $subject = 'YouchCRM') {
        $this->mail->setFrom($from_address, $from_name);
        $this->mail->Subject = $subject;
        $this->mail->addAddress($to);
        $this->mail->Body = $content;

        return $this->mail->send();
    }
}
