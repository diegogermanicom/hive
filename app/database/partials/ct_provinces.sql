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
CREATE TABLE `ct_provinces` (
  `id_province` smallint(5) UNSIGNED NOT NULL,
  `id_country` smallint(5) UNSIGNED NOT NULL,
  `en` varchar(40) NOT NULL,
  `es` varchar(40) NOT NULL,
  `id_state` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ct_provinces` (`id_province`, `id_country`, `en`, `es`, `id_state`) VALUES
(1, 46, 'Álava', 'Álava', 2),
(2, 46, 'Albacete', 'Albacete', 2),
(3, 46, 'Alicante', 'Alicante', 2),
(4, 46, 'Almería', 'Almería', 2),
(5, 46, 'Asturias', 'Asturias', 2),
(6, 46, 'Ávila', 'Ávila', 2),
(7, 46, 'Badajoz', 'Badajoz', 2),
(8, 46, 'Barcelona', 'Barcelona', 2),
(9, 46, 'Burgos', 'Burgos', 2),
(10, 46, 'Cáceres', 'Cáceres', 2),
(11, 46, 'Cadiz', 'Cádiz', 2),
(12, 46, 'Cantabria', 'Cantabria', 2),
(13, 46, 'Castellón', 'Castellón', 2),
(14, 46, 'Ciudad Real', 'Ciudad Real', 2),
(15, 46, 'Córdoba', 'Córdoba', 2),
(16, 46, 'La Coruña', 'La Coruña', 2),
(17, 46, 'Cuenca', 'Cuenca', 2),
(18, 46, 'Gerona', 'Gerona', 2),
(19, 46, 'Granada', 'Granada', 2),
(20, 46, 'Guadalajara', 'Guadalajara', 2),
(21, 46, 'Guipúzcoa', 'Guipúzcoa', 2),
(22, 46, 'Huelva', 'Huelva', 2),
(23, 46, 'Huesca', 'Huesca', 2),
(24, 46, 'The Balearic Islands', 'Islas Baleares', 2),
(25, 46, 'Jaén', 'Jaén', 2),
(26, 46, 'León', 'León', 2),
(27, 46, 'Lérida', 'Lérida', 2),
(28, 46, 'Lugo', 'Lugo', 2),
(29, 46, 'Madrid', 'Madrid', 2),
(30, 46, 'Málaga', 'Málaga', 2),
(31, 46, 'Murcia', 'Murcia', 2),
(32, 46, 'Navarre', 'Navarra', 2),
(33, 46, 'Orense', 'Orense', 2),
(34, 46, 'Palencia', 'Palencia', 2),
(35, 46, 'Las Palmas', 'Las Palmas', 2),
(36, 46, 'Pontevedra', 'Pontevedra', 2),
(37, 46, 'La Rioja', 'La Rioja', 2),
(38, 46, 'Salamanca', 'Salamanca', 2),
(39, 46, 'Segovia', 'Segovia', 2),
(40, 46, 'Seville', 'Sevilla', 2),
(41, 46, 'Soria', 'Soria', 2),
(42, 46, 'Tarragona', 'Tarragona', 2),
(43, 46, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 2),
(44, 46, 'Teruel', 'Teruel', 2),
(45, 46, 'Toledo', 'Toledo', 2),
(46, 46, 'Valencia', 'Valencia', 2),
(47, 46, 'Valladolid', 'Valladolid', 2),
(48, 46, 'Vizcaya', 'Vizcaya', 2),
(49, 46, 'Zamora', 'Zamora', 2),
(50, 46, 'Zaragoza', 'Zaragoza', 2);

ALTER TABLE `ct_provinces`
  ADD PRIMARY KEY (`id_province`);

ALTER TABLE `ct_provinces`
  MODIFY `id_province` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;