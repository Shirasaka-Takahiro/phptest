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

CREATE TABLE goods(
  code SERIAL,
  name TEXT,
  price INT,
  comment TEXT,
  user_id int unsigned NOT NULL,
);

ALTER TABLE goods ADD CONSTRAINT fk_goods_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;