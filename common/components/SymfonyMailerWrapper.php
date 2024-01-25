<?php

namespace common\components;

use Yii;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class SymfonyMailerWrapper
{
    private $mailer;

    public function __construct()
    {
        $transport = Transport::fromDsn('smtp://smtp.gmail.com:587');
        $transport->setUsername('rbssapplication@gmail.com');
        $transport->setPassword('luzzvifdogtmpfly');
        $this->mailer = new Mailer($transport);
    }

    public function sendEmail($to, $subject, $body)
    {
        $email = (new Email())
            ->from(Yii::$app->name.' <'.Yii::$app->params['supportEmail'].'>')
            ->to($to)
            ->subject($subject)
            ->html($body);

        return $this->mailer->send($email);
    }
}
?>