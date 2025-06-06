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