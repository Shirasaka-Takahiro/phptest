CREATE TABLE `users` (
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(250),
    `email` VARCHAR(50) UNIQUE NOT NULL,
    `register_token` VARCHAR(80),
    `register_token_sent_at` DATETIME,
    `register_token_verified_at` DATETIME,
    `password` VARCHAR(80),
    `status` ENUM('tentative', 'public') NOT NULL DEFAULT 'tentative',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP
);