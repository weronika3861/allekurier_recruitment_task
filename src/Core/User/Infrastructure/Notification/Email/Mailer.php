<?php

namespace App\Core\User\Infrastructure\Notification\Email;

use App\Common\Mailer\MailerInterface;
use App\Core\User\Domain\Notification\NotificationInterface;

class Mailer implements NotificationInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function send(string $recipient, string $subject, string $message): void
    {
        $this->mailer->send($recipient, $subject, $message);
    }
}
