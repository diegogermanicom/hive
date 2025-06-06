CREATE TABLE `users_addresses` (
  `id_user_address` mediumint(8) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `lastname` varchar(120) NOT NULL,
  `id_continent` tinyint(3) UNSIGNED NOT NULL,
  `id_country` smallint(5) UNSIGNED NOT NULL,
  `id_province` smallint(5) UNSIGNED NOT NULL,
  `location` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `main_address` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users_addresses`
  ADD PRIMARY KEY (`id_user_address`);

ALTER TABLE `users_addresses`
  MODIFY `id_user_address` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;