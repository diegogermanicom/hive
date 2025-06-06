CREATE TABLE `error_log` (
  `id_error_log` int(10) UNSIGNED NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `error_log`
  ADD PRIMARY KEY (`id_error_log`);

ALTER TABLE `error_log`
  MODIFY `id_error_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;