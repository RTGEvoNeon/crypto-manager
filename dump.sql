-- Create tables
CREATE TABLE coins (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    symbol VARCHAR(50) NOT NULL,
    blockchain VARCHAR(255) NOT NULL,
    contract_address VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE transactions (
    id INT NOT NULL AUTO_INCREMENT,
    amount DECIMAL(20,8) NOT NULL,
    transaction_type VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    price DECIMAL(20,8) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    wallet_id INT NOT NULL,
    coin_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (coin_id) REFERENCES coins(id) ON DELETE CASCADE,
    FOREIGN KEY (wallet_id) REFERENCES wallets(id) ON DELETE CASCADE
);

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE (email)
);

CREATE TABLE wallets (
    id INT NOT NULL AUTO_INCREMENT,
    balance DECIMAL(20,8) DEFAULT 0 NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    coin_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (coin_id) REFERENCES coins(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert data (example)
INSERT INTO coins (id, name, symbol, blockchain, contract_address, created_at, updated_at) VALUES
(1, 'Bitcoin', 'BTC', 'Bitcoin Blockchain', '0x1234...', NOW(), NOW()),
(2, 'Ethereum', 'ETH', 'Ethereum Blockchain', '0x5678...', NOW(), NOW());

-- Repeat for other tables
