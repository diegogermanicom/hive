/*
 @author Diego Martín
 @copyright Hive®
 @version 1.0.1
 @since 1.0.0

 DISCLAIMER:
 Modifying or altering any part of the original code is not recommended,
 as it could compromise the stability, security or operation of the system.
 Any changes made will be the sole responsibility of the person who makes them.
 You can add custom code to add new features.
*/
CREATE TABLE `newsletters` (
  `id_newsletter` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `validated_email` tinyint(4) NOT NULL DEFAULT '0',
  `validation_code` varchar(30) NOT NULL DEFAULT '',
  `language` varchar(5) NOT NULL DEFAULT '',
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id_newsletter`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `newsletters`
  MODIFY `id_newsletter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
