ALTER TABLE `sportvatars` ADD `sportbit_hat_id` INT NOT NULL AFTER `trait_eyes_id`, ADD `sportbit_hat_other_sportvatar_count` INT NOT NULL AFTER `sportbit_hat_id`;

ALTER TABLE `sportvatars` ADD `sportbit_number_id` INT NOT NULL AFTER `sportbit_accessory_other_sportvatar_count`, ADD `sportbit_number_other_sportvatar_count` INT NOT NULL AFTER `sportbit_number_id`;

ALTER TABLE `sportvatars`
  ADD KEY `sportbit_hat_id_index` (`sportbit_hat_id`),
  ADD KEY `sportbit_number_id_index` (`sportbit_number_id`);
COMMIT;