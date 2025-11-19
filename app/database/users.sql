/*
 @author Diego Martín
 @copyright Hive®
 @version 1.0.1
 @since 1.0.0
 @see https://github.com/diegogermanicom/hive
 @license MIT

 DISCLAIMER:
 Modifying or altering any part of the original code is not recommended,
 as it could compromise the stability, security or operation of the system.
 Any changes made will be the sole responsibility of the person who makes them.
 You can add custom code to add new features.
*/
CREATE TABLE `users` (
  `id_user` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(90) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `name` varchar(90) NOT NULL DEFAULT '',
  `lastname` varchar(120) NOT NULL DEFAULT '',
  `remember_code` varchar(50) NOT NULL DEFAULT '',
  `validation_code` varchar(50) NOT NULL DEFAULT '',
  `validated_email` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `last_access` datetime DEFAULT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_register` varchar(20) NOT NULL DEFAULT '',
  `ip_last_access` varchar(20) NOT NULL DEFAULT '',
  `id_state` tinyint(3) UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
  MODIFY `id_user` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;