CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `rarity` varchar(255) NOT NULL,
  `max_mintable` varchar(255) NOT NULL,
  `minted` int(11) NOT NULL,
  `flow_id` int(11) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flow_id_index` (`flow_id`),
  ADD KEY `rarity_index` (`rarity`),
  ADD KEY `category_index` (`category`);
COMMIT;