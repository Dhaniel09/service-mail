CREATE TABLE smtp_accounts
(
    id SERIAL PRIMARY KEY,

    host VARCHAR(255) NOT NULL,
    port INTEGER NOT NULL,

    username VARCHAR(255) NOT NULL,
    password TEXT NOT NULL,

    from_name VARCHAR(255),

    activa BOOLEAN DEFAULT TRUE,

    limite_envios INTEGER DEFAULT 10,

    envios_actuales INTEGER DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mail_log (
    id SERIAL PRIMARY KEY,

    smtp_account_id INTEGER,
    destinatario VARCHAR(255),
    asunto VARCHAR(255),
    cuerpo TEXT,

    estado VARCHAR(50), -- SENT / ERROR

    error TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
