<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/SmtpService.php';
require_once __DIR__ . '/../src/MailerService.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    echo json_encode([
        'error' => 'Método no permitido'
    ]);

    exit;
}

$data = json_decode(
    file_get_contents('php://input'),
    true
);

$mailer = new MailerService();

$result = $mailer->send(
    $data['to'],
    $data['subject'],
    $data['body']
);

echo json_encode($result);
