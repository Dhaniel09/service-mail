<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/SmtpService.php';

class MailerService
{
    public function send(
        string $to,
        string $subject,
        string $body
    ): array {

        $smtpService = new SmtpService();

        $smtp = $smtpService->getAccount();

        if (!$smtp) {

            return [
                'success' => false,
                'message' => 'No hay cuentas SMTP disponibles'
            ];
        }

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = $smtp['host'];

            $mail->SMTPAuth = true;

            $mail->Username = $smtp['username'];

            $mail->Password = $smtp['password'];

            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = $smtp['port'];

            $mail->setFrom(
                $smtp['username'],
                $smtp['from_name']
            );

            $mail->addAddress($to);

            $mail->isHTML(true);

            $mail->Subject = $subject;

            $mail->Body = $body;

            $mail->send();

            $smtpService->incrementUsage(
                $smtp['id']
            );

            return [
                'success' => true
            ];

        } catch (Exception $e) {

            return [
                'success' => false,
                'message' => $mail->ErrorInfo
            ];
        }
    }
}
