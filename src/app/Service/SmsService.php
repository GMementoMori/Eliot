<?php
namespace App\Service;

class SmsService
{
    public function sendSms(?string $phoneNumber = null): bool
    {
        $data = [
            'key' => SMS_API_KEY,
            'phone' => $phoneNumber ?? SMS_DEFAULT_PHONE_NUMBER,
            'message' => SMS_MESSAGE,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SMS_URL_SERVICE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response !== false;
    }
}
