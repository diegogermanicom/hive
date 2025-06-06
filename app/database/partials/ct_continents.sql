CREATE TABLE `ct_continents` (
  `id_continent` tinyint(5) UNSIGNED NOT NULL,
  `en` varchar(40) NOT NULL,
  `es` varchar(40) NOT NULL,
  `id_state` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ct_continents` (`id_continent`, `en`, `es`, `id_state`) VALUES
(1, 'Europe', 'Europa', 2),
(2, 'America', 'América', 1),
(3, 'Asia', 'Asia', 2),
(4, 'Africa', 'África', 1),
(5, 'Oceanía', 'Oceanía', 1);

ALTER TABLE `ct_continents`
  ADD PRIMARY KEY (`id_continent`);

ALTER TABLE `ct_continents`
  MODIFY `id_continent` tinyint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;