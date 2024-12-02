<?php

namespace App\Core\User\Domain\Notification;

interface NotificationInterface
{
    public function send(string $recipient, string $subject, string $message): void;
}
