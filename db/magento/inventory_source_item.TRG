TYPE=TRIGGERS
triggers='CREATE DEFINER=`magento`@`%` TRIGGER trg_inventory_source_item_after_insert AFTER INSERT ON inventory_source_item FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `inventory_cl` (`entity_id`) VALUES (NEW.`source_item_id`);\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_inventory_source_item_after_update AFTER UPDATE ON inventory_source_item FOR EACH ROW\nBEGIN\nIF (NEW.`source_item_id` <=> OLD.`source_item_id` OR NEW.`source_code` <=> OLD.`source_code` OR NEW.`sku` <=> OLD.`sku` OR NEW.`quantity` <=> OLD.`quantity` OR NEW.`status` <=> OLD.`status`) THEN INSERT IGNORE INTO `inventory_cl` (`entity_id`) VALUES (NEW.`source_item_id`); END IF;\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_inventory_source_item_after_delete AFTER DELETE ON inventory_source_item FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `inventory_cl` (`entity_id`) VALUES (OLD.`source_item_id`);\nEND'
sql_modes=0 0 0
definers='magento@%' 'magento@%' 'magento@%'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
created=156970292240 156970292257 156970292265
