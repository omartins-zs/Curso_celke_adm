CREATE DATABASE celke;

CREATE TABLE `adms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recover_password` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `adms_users` (`id`, `name`, `nickname`, `email`, `user`, `password`, `recover_password`, `image`, `created`, `modified`) VALUES
(1, 'Cesar', NULL, 'cesar@celke.com.br', 'cesar@celke.com.br', '$2y$10$Qw/P8uSd38gMm5JLArXg9esMTIVFxu88Bm/NuRlwdgmnkLpRPDgEO', NULL, NULL, '2020-08-23 00:00:00', NULL);