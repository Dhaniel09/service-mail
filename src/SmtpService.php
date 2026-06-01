<?php

require_once __DIR__ . '/Database.php';

class SmtpService
{
    public function getAccount()
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            SELECT *
            FROM smtp_accounts
            WHERE activa = TRUE
            AND envios_actuales < limite_envios
            ORDER BY envios_actuales ASC
            LIMIT 1
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function incrementUsage(int $id)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            UPDATE smtp_accounts
            SET envios_actuales = envios_actuales + 1
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);
    }
}
