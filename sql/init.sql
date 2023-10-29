CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `users` (`name`, `created_at`)
VALUES
    ('Alice', '2023-10-01 09:00:00'),
    ('Bob', '2023-10-15 12:00:00'),
    ('Carol', '2023-10-31 15:00:00');
