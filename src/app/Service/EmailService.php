<?php
namespace App\Service;

class EmailService
{
    public function sendEmail(string $to, string $subject, string $message, string $headers): bool
    {
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
