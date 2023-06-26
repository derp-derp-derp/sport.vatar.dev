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

CREATE TABLE `sportvatars` (
  `mint_number` int(11) NOT NULL,
  `owner_flow_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `minter_flow_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rarity_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rarity_score_traits` decimal(4,1) NOT NULL,
  `rarity_score_sportbits` decimal(4,1) NOT NULL,
  `rarity_score_total` decimal(5,1) NOT NULL,
  `ability` int(11) NOT NULL,
  `stat_power` int(11) NOT NULL,
  `stat_speed` int(11) NOT NULL,
  `stat_endurance` int(11) NOT NULL,
  `stat_technique` int(11) NOT NULL,
  `stat_mental_strength` int(11) NOT NULL,
  `builder_combination` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `trait_body_id` int(11) NOT NULL,
  `trait_clothing_id` int(11) NOT NULL,
  `trait_nose_id` int(11) NOT NULL,
  `trait_mouth_id` int(11) NOT NULL,
  `trait_facial_hair_id` int(11) NOT NULL,
  `trait_hair_id` int(11) NOT NULL,
  `trait_eyes_id` int(11) NOT NULL,
  `sportbit_accessory_id` int(11) NOT NULL,
  `sportbit_accessory_other_sportvatar_count` int(11) NOT NULL,
  `mint_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_update_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `find_name` varchar(288) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `sportvatars`
  ADD PRIMARY KEY (`mint_number`),
  ADD KEY `owner_flow_address_index` (`owner_flow_address`),
  ADD KEY `minter_flow_address_index` (`minter_flow_address`),
  ADD KEY `rarity_name_index` (`rarity_name`),
  ADD KEY `rarity_score_traits_index` (`rarity_score_traits`),
  ADD KEY `rarity_score_sportbits_index` (`rarity_score_sportbits`),
  ADD KEY `rarity_score_total_index` (`rarity_score_total`),
  ADD KEY `ability_index` (`ability`),
  ADD KEY `stat_power_index` (`stat_power`),
  ADD KEY `stat_speed_index` (`stat_speed`),
  ADD KEY `stat_endurance_index` (`stat_endurance`),
  ADD KEY `stat_technique_index` (`stat_technique`),
  ADD KEY `stat_mental_strength_index` (`stat_mental_strength`),
  ADD KEY `trait_body_id_index` (`trait_body_id`),
  ADD KEY `trait_clothing_id_index` (`trait_clothing_id`),
  ADD KEY `trait_nose_id_index` (`trait_nose_id`),
  ADD KEY `trait_mouth_id_index` (`trait_mouth_id`),
  ADD KEY `trait_facial_hair_id_index` (`trait_facial_hair_id`),
  ADD KEY `trait_hair_id_index` (`trait_hair_id`),
  ADD KEY `trait_eyes_id_index` (`trait_eyes_id`),
  ADD KEY `sportbit_accessory_id_index` (`sportbit_accessory_id`),
  ADD KEY `find_name_index` (`find_name`);
COMMIT;