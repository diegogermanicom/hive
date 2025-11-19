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
CREATE TABLE `error_log` (
  `id_error_log` int(10) UNSIGNED NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `error_log`
  ADD PRIMARY KEY (`id_error_log`);

ALTER TABLE `error_log`
  MODIFY `id_error_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;