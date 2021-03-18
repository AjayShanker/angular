--
-- Database: `axisappdb`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `mobile` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `company` varchar(256) DEFAULT NULL,
  `designation` varchar(256) DEFAULT NULL,
  `regon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users_login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reg_user_id` bigint(20) UNSIGNED DEFAULT '0',
  `ipaddress` varchar(256) DEFAULT NULL,
  `logon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users_login`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;