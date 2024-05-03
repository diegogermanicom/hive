CREATE TABLE `ct_provinces` (
  `id_province` smallint(5) UNSIGNED NOT NULL,
  `id_country` tinyint(5) UNSIGNED NOT NULL,
  `en` varchar(40) NOT NULL,
  `es` varchar(40) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ct_provinces` (`id_province`, `id_country`, `en`, `es`) VALUES
(1, 16, 'Álava', 'Álava'),
(2, 16, 'Albacete', 'Albacete'),
(3, 16, 'Alicante', 'Alicante'),
(4, 16, 'Almería', 'Almería'),
(5, 16, 'Asturias', 'Asturias'),
(6, 16, 'Ávila', 'Ávila'),
(7, 16, 'Badajoz', 'Badajoz'),
(8, 16, 'Barcelona', 'Barcelona'),
(9, 16, 'Burgos', 'Burgos'),
(10, 16, 'Cáceres', 'Cáceres'),
(11, 16, 'Cadiz', 'Cádiz'),
(12, 16, 'Cantabria', 'Cantabria'),
(13, 16, 'Castellón', 'Castellón'),
(14, 16, 'Ciudad Real', 'Ciudad Real'),
(15, 16, 'Córdoba', 'Córdoba'),
(16, 16, 'La Coruña', 'La Coruña'),
(17, 16, 'Cuenca', 'Cuenca'),
(18, 16, 'Gerona', 'Gerona'),
(19, 16, 'Granada', 'Granada'),
(20, 16, 'Guadalajara', 'Guadalajara'),
(21, 16, 'Guipúzcoa', 'Guipúzcoa'),
(22, 16, 'Huelva', 'Huelva'),
(23, 16, 'Huesca', 'Huesca'),
(24, 16, 'The Balearic Islands', 'Islas Baleares'),
(25, 16, 'Jaén', 'Jaén'),
(26, 16, 'León', 'León'),
(27, 16, 'Lérida', 'Lérida'),
(28, 16, 'Lugo', 'Lugo'),
(29, 16, 'Madrid', 'Madrid'),
(30, 16, 'Málaga', 'Málaga'),
(31, 16, 'Murcia', 'Murcia'),
(32, 16, 'Navarre', 'Navarra'),
(33, 16, 'Orense', 'Orense'),
(34, 16, 'Palencia', 'Pal encia'),
(35, 16, 'Las Palmas', 'Las Palmas'),
(36, 16, 'Pontevedra', 'Pontevedra'),
(37, 16, 'La Rioja', 'La Rioja'),
(38, 16, 'Salamanca', 'Salamanca'),
(39, 16, 'Segovia', 'Segovia'),
(40, 16, 'Seville', 'Sevilla'),
(41, 16, 'Soria', 'Soria'),
(42, 16, 'Tarragona', 'Tarragona'),
(43, 16, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife'),
(44, 16, 'Teruel', 'Teruel'),
(45, 16, 'Toledo', 'Toledo'),
(46, 16, 'Valencia', 'Valencia'),
(47, 16, 'Valladolid', 'Valladolid'),
(48, 16, 'Vizcaya', 'Vizcaya'),
(49, 16, 'Zamora', 'Zamora'),
(50, 16, 'Zaragoza', 'Zaragoza');

ALTER TABLE `ct_provinces`
  ADD PRIMARY KEY (`id_province`);

ALTER TABLE `ct_provinces`
  MODIFY `id_province` tinyint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;