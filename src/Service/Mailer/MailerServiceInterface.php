<?php

namespace App\Service\Mailer;

interface  MailerServiceInterface
{

    public function send(string $from, string $to, string $subject, string $template, array $message): void;

}
