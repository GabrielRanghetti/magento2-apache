TYPE=TRIGGERS
triggers='CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_after_insert AFTER INSERT ON catalogrule FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `catalogrule_rule_cl` (`entity_id`) VALUES (NEW.`rule_id`);\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_after_update AFTER UPDATE ON catalogrule FOR EACH ROW\nBEGIN\nIF (NEW.`rule_id` <=> OLD.`rule_id` OR NEW.`name` <=> OLD.`name` OR NEW.`description` <=> OLD.`description` OR NEW.`from_date` <=> OLD.`from_date` OR NEW.`to_date` <=> OLD.`to_date` OR NEW.`is_active` <=> OLD.`is_active` OR NEW.`conditions_serialized` <=> OLD.`conditions_serialized` OR NEW.`actions_serialized` <=> OLD.`actions_serialized` OR NEW.`stop_rules_processing` <=> OLD.`stop_rules_processing` OR NEW.`sort_order` <=> OLD.`sort_order` OR NEW.`simple_action` <=> OLD.`simple_action` OR NEW.`discount_amount` <=> OLD.`discount_amount`) THEN INSERT IGNORE INTO `catalogrule_rule_cl` (`entity_id`) VALUES (NEW.`rule_id`); END IF;\nEND' 'CREATE DEFINER=`magento`@`%` TRIGGER trg_catalogrule_after_delete AFTER DELETE ON catalogrule FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `catalogrule_rule_cl` (`entity_id`) VALUES (OLD.`rule_id`);\nEND'
sql_modes=0 0 0
definers='magento@%' 'magento@%' 'magento@%'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
created=156979736045 156979736062 156979736071
