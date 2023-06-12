<?php

namespace App\Helpers;

class AppHelper
{
    public function VerifyRecaptcha($response)
    {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://www.google.com/recaptcha/api/siteverify"
        );
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "secret" => env("RECAPTCHA_SECRET_KEY"),
            "response" => $response,
            "remoteip" => $_SERVER["REMOTE_ADDR"],
        ]);

        $resp = json_decode(curl_exec($ch));
        curl_close($ch);
        return $resp->success;
    }
    public static function instance()
    {
        return new AppHelper();
    }
}
