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
