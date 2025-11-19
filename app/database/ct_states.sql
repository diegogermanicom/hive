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
CREATE TABLE `ct_states` (
  `id_state` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ct_states` (`id_state`, `name`) VALUES
(1, 'Disabled'),
(2, 'Active');

ALTER TABLE `ct_states`
  ADD PRIMARY KEY (`id_state`);

ALTER TABLE `ct_states`
  MODIFY `id_state` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;