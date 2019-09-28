TYPE=TRIGGERS
triggers='CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_product_price_after_insert AFTER INSERT ON catalogrule_product_price FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `catalog_product_price_cl` (`entity_id`) VALUES (NEW.`product_id`);\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_product_price_after_update AFTER UPDATE ON catalogrule_product_price FOR EACH ROW\nBEGIN\nIF (NEW.`rule_product_price_id` <=> OLD.`rule_product_price_id` OR NEW.`rule_date` <=> OLD.`rule_date` OR NEW.`customer_group_id` <=> OLD.`customer_group_id` OR NEW.`product_id` <=> OLD.`product_id` OR NEW.`rule_price` <=> OLD.`rule_price` OR NEW.`website_id` <=> OLD.`website_id` OR NEW.`latest_start_date` <=> OLD.`latest_start_date` OR NEW.`earliest_end_date` <=> OLD.`earliest_end_date`) THEN INSERT IGNORE INTO `catalog_product_price_cl` (`entity_id`) VALUES (NEW.`product_id`); END IF;\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_product_price_after_delete AFTER DELETE ON catalogrule_product_price FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `catalog_product_price_cl` (`entity_id`) VALUES (OLD.`product_id`);\nEND'
sql_modes=0 0 0
definers='magento@%' 'magento@%' 'magento@%'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
created=156970112951 156970112963 156970112973
