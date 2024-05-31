<?php

namespace inc\v1\mail;

use inc\v1\environment_variable\EnvironmentVariable;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    public static function send(string $recipient_email, string $subject, string $body, string $alt_body): bool
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $env = EnvironmentVariable::instance();
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->CharSet = $env->get("MAIL_CHARSET");
            $mail->isSMTP();
            $mail->Host = $env->get("MAIL_HOST");
            $mail->SMTPAuth = true;
            $mail->Username = $env->get("MAIL_USERNAME");
            $mail->Password = $env->get("MAIL_PASSWORD");
            $mail->SMTPSecure = $env->get("MAIL_ENCRYPTION");
            $mail->Port = $env->get("MAIL_PORT");

            //Recipients
            $mail->setFrom($env->get("MAIL_FROM_ADDRESS"), $env->get("MAIL_FROM_NAME"));
            $mail->addAddress($recipient_email);               //Name is optional

            //Content
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $alt_body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}