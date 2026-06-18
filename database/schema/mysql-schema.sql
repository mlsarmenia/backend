/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_country_id` int DEFAULT NULL,
  `location_province_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `location_street_id` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `area_total` double(24,1) DEFAULT NULL,
  `old_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  `area_residential` double(24,1) DEFAULT NULL,
  `registered_right_id` int DEFAULT NULL,
  `repairing_type_id` int DEFAULT NULL,
  `room_count` int DEFAULT NULL,
  `building_type_id` int DEFAULT NULL,
  `building_project_type_id` int DEFAULT NULL,
  `conditioner` tinyint(1) DEFAULT NULL,
  `room_count_modified` int DEFAULT NULL,
  `exterior_design_type_id` int DEFAULT NULL,
  `elevator_type_id` int DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  `heating_system_type_id` int DEFAULT NULL,
  `parking_type_id` int DEFAULT NULL,
  `service_fee_type_id` int DEFAULT NULL,
  `service_amount` double DEFAULT NULL,
  `service_amount_currency_id` int DEFAULT NULL,
  `furniture` tinyint(1) DEFAULT NULL,
  `kitchen_furniture` tinyint(1) DEFAULT NULL,
  `gas_heater` tinyint(1) DEFAULT NULL,
  `persistent_water` tinyint(1) DEFAULT NULL,
  `natural_gas` tinyint(1) DEFAULT NULL,
  `gas_possibility` tinyint(1) DEFAULT NULL,
  `internet` tinyint(1) DEFAULT NULL,
  `satellite_tv` tinyint(1) DEFAULT NULL,
  `cable_tv` tinyint(1) DEFAULT NULL,
  `sunny` tinyint(1) DEFAULT NULL,
  `exclusive_design` tinyint(1) DEFAULT NULL,
  `expanding_possible` tinyint(1) DEFAULT NULL,
  `open_balcony` tinyint(1) DEFAULT NULL,
  `oriel` tinyint(1) DEFAULT NULL,
  `new_wiring` tinyint(1) DEFAULT NULL,
  `new_water_tubes` tinyint(1) DEFAULT NULL,
  `heating_ground` tinyint(1) DEFAULT NULL,
  `plastic_windows` tinyint(1) DEFAULT NULL,
  `parquet` tinyint(1) DEFAULT NULL,
  `laminat` tinyint(1) DEFAULT NULL,
  `equipped` tinyint(1) DEFAULT NULL,
  `roof_type_id` int DEFAULT NULL,
  `floor_count_id` int DEFAULT NULL,
  `house_building_type_id` int DEFAULT NULL,
  `roof_repaired` tinyint(1) DEFAULT NULL,
  `roof_material_type_id` int DEFAULT NULL,
  `fence_type_id` int DEFAULT NULL,
  `communication_type_id` int DEFAULT NULL,
  `front_with_street_id` int DEFAULT NULL,
  `road_way_type_id` int DEFAULT NULL,
  `commercial_purpose_type_id` int DEFAULT NULL,
  `communication_id` int DEFAULT NULL,
  `land_structure_type_id` int DEFAULT NULL,
  `land_type_id` int DEFAULT NULL,
  `land_use_type_id` int DEFAULT NULL,
  `front_length` double(24,1) DEFAULT NULL,
  `version` int DEFAULT NULL,
  `address_building` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_apartment` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type_id` int DEFAULT NULL,
  `entrance_door_type_id` int DEFAULT NULL,
  `entrance_door_position_id` int DEFAULT NULL,
  `windows_view_id` int DEFAULT NULL,
  `building_floor_count` int DEFAULT NULL,
  `house_floors_type_id` int DEFAULT NULL,
  `roof_drainage` tinyint(1) DEFAULT NULL,
  `new_doors` tinyint(1) DEFAULT NULL,
  `new_windows` tinyint(1) DEFAULT NULL,
  `new_bathroom` tinyint(1) DEFAULT NULL,
  `new_floor` tinyint(1) DEFAULT NULL,
  `new_roof` tinyint(1) DEFAULT NULL,
  `can_be_used_as_commercial` tinyint(1) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `estate_status_id` int DEFAULT NULL,
  `status_changed_on` date DEFAULT NULL,
  `status_id_before_archive` int DEFAULT NULL,
  `buyer_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `selling_price_init` double DEFAULT NULL,
  `selling_price_final` double DEFAULT NULL,
  `selling_price_final_currency_id` int DEFAULT NULL,
  `selling_price_init_currency_id` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `new_construction` tinyint(1) DEFAULT NULL,
  `floor` int DEFAULT NULL,
  `comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_modified_by` int DEFAULT NULL,
  `additional_info_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_info_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_info_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_info_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `garage` tinyint(1) DEFAULT NULL,
  `cellar` tinyint(1) DEFAULT NULL,
  `land` tinyint(1) DEFAULT NULL,
  `niche` tinyint(1) DEFAULT NULL,
  `pantry` tinyint(1) DEFAULT NULL,
  `jacuzzi` tinyint(1) DEFAULT NULL,
  `possible_extension` tinyint(1) DEFAULT NULL,
  `separate_room` tinyint(1) DEFAULT NULL,
  `exchange` tinyint(1) DEFAULT NULL,
  `has_intercom` tinyint(1) DEFAULT NULL,
  `uninhabited` tinyint(1) DEFAULT NULL,
  `balcony` tinyint(1) DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `computer` tinyint(1) DEFAULT NULL,
  `refrigirator` tinyint(1) DEFAULT NULL,
  `hot_water` tinyint(1) DEFAULT NULL,
  `washer` tinyint(1) DEFAULT NULL,
  `dish_washer` tinyint(1) DEFAULT NULL,
  `property_agent_id` int DEFAULT NULL,
  `code` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_date_start` datetime DEFAULT NULL,
  `appointment_date_end` datetime DEFAULT NULL,
  `appointment_comment_arm` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_comment_eng` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_comment_ru` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_comment_ar` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceiling_height_type_id` int DEFAULT NULL,
  `building_structure_type_id` int DEFAULT NULL,
  `building_floor_type_id` int DEFAULT NULL,
  `vitrage_type_id` int DEFAULT NULL,
  `separate_entrance_type_id` int DEFAULT NULL,
  `intercom` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filled_by` int DEFAULT NULL,
  `filled_on` datetime DEFAULT NULL,
  `verified_by` int DEFAULT NULL,
  `verified_on` datetime DEFAULT NULL,
  `entrance_type_id` int DEFAULT NULL,
  `has_neighbour` tinyint(1) DEFAULT NULL,
  `is_advertised` tinyint(1) DEFAULT NULL,
  `info_source_id` int DEFAULT NULL,
  `price_usd` double DEFAULT NULL,
  `archive_till_date` date DEFAULT NULL,
  `archive_comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `archive_comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `archive_comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `archive_comment_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_rus` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `estate_latitude` double DEFAULT NULL,
  `estate_longitude` double DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT NULL,
  `urgent_start_date` date DEFAULT NULL,
  `is_exchangeable` tinyint(1) DEFAULT NULL,
  `is_first_floor` tinyint(1) DEFAULT NULL,
  `is_last_floor` tinyint(1) DEFAULT NULL,
  `main_image_file_name` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path_thumb` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_mansard_floor` tinyint(1) DEFAULT NULL,
  `is_duplex` tinyint(1) DEFAULT NULL,
  `is_basement` tinyint(1) DEFAULT NULL,
  `visits_count` int DEFAULT NULL,
  `is_from_public` tinyint(1) DEFAULT NULL,
  `is_hot_offer` tinyint(1) DEFAULT NULL,
  `hot_offer_start_date` date DEFAULT NULL,
  `is_on_main_page` tinyint(1) DEFAULT NULL,
  `on_main_page_start_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ANNOUNCEMENT_C_LOCATION_COUNTRY` (`location_country_id`),
  KEY `FK_ANNOUNCEMENT_C_LOCATION_PROVINCE` (`location_province_id`),
  KEY `FK_ANNOUNCEMENT_C_LOCATION_CITY` (`location_city_id`),
  KEY `FK_ANNOUNCEMENT_C_LOCATION_COMMUNITY` (`location_community_id`),
  KEY `FK_ANNOUNCEMENT_C_LOCATION_STREET` (`location_street_id`),
  KEY `FK_ANNOUNCEMENT_C_ESTATE_TYPE` (`estate_type_id`),
  KEY `FK_ANNOUNCEMENT_C_CURRENCY` (`currency_id`),
  KEY `FK_ANNOUNCEMENT_C_CONTACT` (`seller_id`),
  KEY `FK_ANNOUNCEMENT_C_REGISTERED_RIGHTS` (`registered_right_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_REMONT_TYPE` (`repairing_type_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_BUILDING_TYPE` (`building_type_id`),
  KEY `FK_ANNOUNCEMENT_HOUSE_C_EXTERIOR_DESIGN_TYPE` (`exterior_design_type_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_ELEVATOR_TYPE` (`elevator_type_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_YEAR` (`year_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_HEATING_SYSTEM_TYPE` (`heating_system_type_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_PARKING_TYPE` (`parking_type_id`),
  KEY `FK_ANNOUNCEMENT_BUILDING_C_SERVICE_FEE_TYPE` (`service_fee_type_id`),
  KEY `FK_ANNOUNCEMENT_HOUSE_C_ROOF_TYPE` (`roof_type_id`),
  KEY `FK_ANNOUNCEMENT_HOUSE_C_HOUSE_BUILDING_TYPE` (`house_building_type_id`),
  KEY `FK_ANNOUNCEMENT_HOUSE_C_ROOF_MATERIAL_TYPE` (`roof_material_type_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_FENCE_TYPE` (`fence_type_id`),
  KEY `FK_ANNOUNCEMENT_HOUSE_C_COMMUNICATION` (`communication_type_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_FRONT_WITH_STREET` (`front_with_street_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_ROAD_WAY_TYPE` (`road_way_type_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_COMMUNICATION` (`communication_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_LAND_STRUCTURE_TYPE` (`land_structure_type_id`),
  KEY `FK_ANNOUNCEMENT_LAND_C_LAND_TYPE` (`land_type_id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_BUILDING_TYPE` FOREIGN KEY (`building_type_id`) REFERENCES `c_building_types` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_ELEVATOR_TYPE` FOREIGN KEY (`elevator_type_id`) REFERENCES `c_elevator_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_HEATING_SYSTEM_TYPE` FOREIGN KEY (`heating_system_type_id`) REFERENCES `c_heating_system_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_PARKING_TYPE` FOREIGN KEY (`parking_type_id`) REFERENCES `c_parking_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_REMONT_TYPE` FOREIGN KEY (`repairing_type_id`) REFERENCES `c_repairing_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_SERVICE_FEE_TYPE` FOREIGN KEY (`service_fee_type_id`) REFERENCES `c_service_fee_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_BUILDING_C_YEAR` FOREIGN KEY (`year_id`) REFERENCES `c_year` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_CONTACT` FOREIGN KEY (`seller_id`) REFERENCES `contact` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_CURRENCY` FOREIGN KEY (`currency_id`) REFERENCES `c_currency` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_ESTATE_TYPE` FOREIGN KEY (`estate_type_id`) REFERENCES `c_estate_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_LOCATION_CITY` FOREIGN KEY (`location_city_id`) REFERENCES `c_location_city` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_LOCATION_COMMUNITY` FOREIGN KEY (`location_community_id`) REFERENCES `c_location_community` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_LOCATION_COUNTRY` FOREIGN KEY (`location_country_id`) REFERENCES `c_location_country` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_LOCATION_PROVINCE` FOREIGN KEY (`location_province_id`) REFERENCES `c_location_province` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_LOCATION_STREET` FOREIGN KEY (`location_street_id`) REFERENCES `c_location_street` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_C_REGISTERED_RIGHTS` FOREIGN KEY (`registered_right_id`) REFERENCES `c_registered_right` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_COMMUNICATION` FOREIGN KEY (`communication_type_id`) REFERENCES `c_communication_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_EXTERIOR_DESIGN_TYPE` FOREIGN KEY (`exterior_design_type_id`) REFERENCES `c_exterior_design_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_FENCE_TYPE` FOREIGN KEY (`fence_type_id`) REFERENCES `c_fence_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_FRONT_WITH_STREET` FOREIGN KEY (`front_with_street_id`) REFERENCES `c_front_with_street` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_HOUSE_BUILDING_TYPE` FOREIGN KEY (`house_building_type_id`) REFERENCES `c_house_building_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_ROAD_WAY_TYPE` FOREIGN KEY (`road_way_type_id`) REFERENCES `c_road_way_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_ROOF_MATERIAL_TYPE` FOREIGN KEY (`roof_material_type_id`) REFERENCES `c_roof_material_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_HOUSE_C_ROOF_TYPE` FOREIGN KEY (`roof_type_id`) REFERENCES `c_roof_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_COMMUNICATION` FOREIGN KEY (`communication_id`) REFERENCES `c_communication_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_FENCE_TYPE` FOREIGN KEY (`fence_type_id`) REFERENCES `c_fence_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_FRONT_WITH_STREET` FOREIGN KEY (`front_with_street_id`) REFERENCES `c_front_with_street` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_LAND_STRUCTURE_TYPE` FOREIGN KEY (`land_structure_type_id`) REFERENCES `c_land_structure_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_LAND_TYPE` FOREIGN KEY (`land_type_id`) REFERENCES `c_land_type` (`id`),
  CONSTRAINT `FK_ANNOUNCEMENT_LAND_C_ROAD_WAY_TYPE` FOREIGN KEY (`road_way_type_id`) REFERENCES `c_road_way_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `announcement_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `announcement_id` int DEFAULT NULL,
  `requester_id` int DEFAULT NULL,
  `confirm_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcement_idx` (`announcement_id`),
  KEY `requester_idx` (`requester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_type_id` int DEFAULT NULL,
  `title_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_eng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_arm` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_eng` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `main_image_file_name` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path_thumb` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `view_count` int DEFAULT NULL,
  `metatitle_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatitle_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatitle_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metatitle_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_type_id_idx` (`article_type_id`),
  CONSTRAINT `fk_article_type_id` FOREIGN KEY (`article_type_id`) REFERENCES `c_article_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_area_for_building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_area_for_building` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_area_for_land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_area_for_land` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_article_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_article_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_building_floor_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_building_floor_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_building_project_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_building_project_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` int DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_building_structure_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_building_structure_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_building_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_building_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_building_window_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_building_window_count` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_ceiling_height_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_ceiling_height_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_classifier_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_classifier_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbolic_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_commercial_purpose_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_commercial_purpose_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_communication_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_communication_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_contact_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_contact_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_contact_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_contact_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_contract_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_contract_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_courtyard_improvement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_courtyard_improvement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_currency` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_daily_price_in_amd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_daily_price_in_amd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_daily_price_in_rur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_daily_price_in_rur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_daily_price_in_usd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_daily_price_in_usd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_design_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_design_color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_design_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_design_price` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_design_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_design_room` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_design_room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_design_room_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent_id_idx` (`parent_id`),
  CONSTRAINT `fk_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `c_design_room` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_design_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_design_style` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_distance_public_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_distance_public_objects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_elevator_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_elevator_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_entrance_door_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_entrance_door_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_entrance_door_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_entrance_door_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_entrance_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_entrance_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_estate_email_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_estate_email_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_estate_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_estate_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_estate_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_estate_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_balcony_available`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_balcony_available` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_floor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_floor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `evaluation_building_type_id` int DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `evaluation_building_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_arm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_window_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_window_count` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_building_window_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_building_window_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_courtyard_improvement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_courtyard_improvement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `evaluation_location_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_distance_public_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_distance_public_objects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `evaluation_location_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_external_design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_external_design` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_interior_design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_interior_design` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_last_floor_availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_last_floor_availability` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_layout_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_layout_room` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `evaluation_location_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(6,0) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `evaluation_location_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_location_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_location_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_evaluation_sun_orientation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_evaluation_sun_orientation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` decimal(4,2) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_exterior_design_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_exterior_design_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_feedback_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_feedback_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` int DEFAULT NULL,
  `name_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_fence_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_fence_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_floors_quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_floors_quantity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_front_with_street`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_front_with_street` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_heating_system_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_heating_system_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_house_building_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_house_building_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_house_floors_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_house_floors_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_land_structure_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_land_structure_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_land_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_land_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_land_use_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_land_use_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_location_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_location_city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_location_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_location_community` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` int DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_location_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_location_country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_location_province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_location_province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_location_street`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_location_street` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `community_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `parent_is_community` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_message_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_message_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` int DEFAULT NULL,
  `name_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_packet_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_packet_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_arm` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_parking_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_parking_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_party_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_party_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_arm` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_price_per_qwd_meter_arm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_price_per_qwd_meter_arm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_price_per_qwd_meter_rur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_price_per_qwd_meter_rur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_price_per_qwd_meter_usd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_price_per_qwd_meter_usd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_profession_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_profession_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_registered_right`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_registered_right` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_rent_price_in_amd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_rent_price_in_amd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_rent_price_in_rur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_rent_price_in_rur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_rent_price_in_usd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_rent_price_in_usd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_repairing_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_repairing_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_road_way_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_road_way_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `role_key` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_roof_material_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_roof_material_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_roof_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_roof_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_rooms_quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_rooms_quantity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sell_price_in_amd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_sell_price_in_amd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sell_price_in_rur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_sell_price_in_rur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sell_price_in_usd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_sell_price_in_usd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_separate_entrance_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_separate_entrance_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_service_fee_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_service_fee_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_service_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sort_id` int DEFAULT NULL,
  `name_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_structure_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_structure_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_vitrage_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_vitrage_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_windows_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_windows_view` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `c_year` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` date DEFAULT NULL,
  `version` int DEFAULT NULL,
  `sort_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `version` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `estate_contract_type_id` int DEFAULT NULL,
  `location_province_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `location_street_id` int DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `price_from` double(30,3) DEFAULT NULL,
  `price_from_usd` double DEFAULT NULL,
  `price_to` double(30,3) DEFAULT NULL,
  `price_to_usd` double DEFAULT NULL,
  `area_from` double(30,3) DEFAULT NULL,
  `area_to` double(30,3) DEFAULT NULL,
  `room_count_from` int DEFAULT NULL,
  `room_count_to` int DEFAULT NULL,
  `building_type_id` int DEFAULT NULL,
  `repairing_type_id` int DEFAULT NULL,
  `new_construction` tinyint(1) DEFAULT NULL,
  `broker_id` int DEFAULT NULL,
  `info_source_id` int DEFAULT NULL,
  `location_building` varchar(145) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_status_id` int DEFAULT NULL,
  `status_changed_on` datetime DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT NULL,
  `archive_till_date` datetime DEFAULT NULL,
  `archive_comment` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_from_public` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_building_project_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_building_project_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_project_type_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_building_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_building_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_type_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_commercial_purpose_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_commercial_purpose_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_purpose_type_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_community` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `community_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_house_floor_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_house_floor_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_floor_type_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_land_use_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_land_use_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_use_type_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client_repairing_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_repairing_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `repairing_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `version` int DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_type_id` int DEFAULT NULL,
  `phone_mobile_1` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_mobile_2` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_office` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_home` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_modified_by` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seller` tinyint(1) DEFAULT NULL,
  `is_buyer` tinyint(1) DEFAULT NULL,
  `is_rent_owner` tinyint(1) DEFAULT NULL,
  `is_renter` tinyint(1) DEFAULT NULL,
  `is_inner_agent` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `is_from_public` tinyint(1) DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `estate_contract_type_id` int DEFAULT NULL,
  `location_province_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `location_street_id` int DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `price_from` double(30,3) DEFAULT NULL,
  `price_from_usd` double DEFAULT NULL,
  `price_to` double(30,3) DEFAULT NULL,
  `price_to_usd` double DEFAULT NULL,
  `area_from` double(30,3) DEFAULT NULL,
  `area_to` double(30,3) DEFAULT NULL,
  `room_count_from` int DEFAULT NULL,
  `room_count_to` int DEFAULT NULL,
  `building_type_id` int DEFAULT NULL,
  `repairing_type_id` int DEFAULT NULL,
  `new_construction` tinyint(1) DEFAULT NULL,
  `broker_id` int DEFAULT NULL,
  `info_source_id` int DEFAULT NULL,
  `location_building` varchar(145) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_status_id` int DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT NULL,
  `web_site` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_mobile_3` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_mobile_4` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viber` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_type_id` (`contact_type_id`),
  KEY `IS_BUYER_index` (`is_buyer`),
  KEY `IS_RENTER_index` (`is_renter`),
  KEY `contact_status_id` (`contact_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contact_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_visit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `estate_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `design` (
  `id` int NOT NULL AUTO_INCREMENT,
  `design_room_id` int DEFAULT NULL,
  `design_room_type_id` int DEFAULT NULL,
  `design_color_id` int DEFAULT NULL,
  `design_style_id` int DEFAULT NULL,
  `design_price_id` int DEFAULT NULL,
  `title_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_eng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_arm` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_eng` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `main_image_file_name` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path_thumb` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `view_count` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_design_room_id_idx` (`design_room_id`),
  KEY `fk_design_room_type_id_idx` (`design_room_type_id`),
  KEY `fk_design_design_color_id_idx` (`design_color_id`),
  KEY `fk_design_design_style_id_idx` (`design_style_id`),
  KEY `fk_design_design_price_id_idx` (`design_price_id`),
  CONSTRAINT `fk_design_color_id` FOREIGN KEY (`design_color_id`) REFERENCES `c_design_color` (`id`),
  CONSTRAINT `fk_design_price_id` FOREIGN KEY (`design_price_id`) REFERENCES `c_design_price` (`id`),
  CONSTRAINT `fk_design_room_id` FOREIGN KEY (`design_room_id`) REFERENCES `c_design_room` (`id`),
  CONSTRAINT `fk_design_room_type_id` FOREIGN KEY (`design_room_type_id`) REFERENCES `c_design_room_type` (`id`),
  CONSTRAINT `fk_design_style_id` FOREIGN KEY (`design_style_id`) REFERENCES `c_design_style` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_country_id` int DEFAULT NULL,
  `location_province_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `location_street_id` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `area_total` double(24,1) DEFAULT NULL,
  `old_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  `area_residential` double(24,1) DEFAULT NULL,
  `registered_right_id` int DEFAULT NULL,
  `repairing_type_id` int DEFAULT NULL,
  `room_count` int DEFAULT NULL,
  `building_type_id` int DEFAULT NULL,
  `building_project_type_id` int DEFAULT NULL,
  `conditioner` tinyint(1) DEFAULT NULL,
  `room_count_modified` int DEFAULT NULL,
  `exterior_design_type_id` int DEFAULT NULL,
  `elevator_type_id` int DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  `heating_system_type_id` int DEFAULT NULL,
  `parking_type_id` int DEFAULT NULL,
  `service_fee_type_id` int DEFAULT NULL,
  `service_amount` double DEFAULT NULL,
  `service_amount_currency_id` int DEFAULT NULL,
  `furniture` tinyint(1) DEFAULT NULL,
  `kitchen_furniture` tinyint(1) DEFAULT NULL,
  `gas_heater` tinyint(1) DEFAULT NULL,
  `persistent_water` tinyint(1) DEFAULT NULL,
  `natural_gas` tinyint(1) DEFAULT NULL,
  `gas_possibility` tinyint(1) DEFAULT NULL,
  `internet` tinyint(1) DEFAULT NULL,
  `satellite_tv` tinyint(1) DEFAULT NULL,
  `cable_tv` tinyint(1) DEFAULT NULL,
  `sunny` tinyint(1) DEFAULT NULL,
  `exclusive_design` tinyint(1) DEFAULT NULL,
  `expanding_possible` tinyint(1) DEFAULT NULL,
  `open_balcony` tinyint(1) DEFAULT NULL,
  `oriel` tinyint(1) DEFAULT NULL,
  `new_wiring` tinyint(1) DEFAULT NULL,
  `new_water_tubes` tinyint(1) DEFAULT NULL,
  `heating_ground` tinyint(1) DEFAULT NULL,
  `plastic_windows` tinyint(1) DEFAULT NULL,
  `parquet` tinyint(1) DEFAULT NULL,
  `laminat` tinyint(1) DEFAULT NULL,
  `equipped` tinyint(1) DEFAULT NULL,
  `roof_type_id` int DEFAULT NULL,
  `floor_count_id` int DEFAULT NULL,
  `house_building_type_id` int DEFAULT NULL,
  `roof_repaired` tinyint(1) DEFAULT NULL,
  `roof_material_type_id` int DEFAULT NULL,
  `fence_type_id` int DEFAULT NULL,
  `communication_type_id` int DEFAULT NULL,
  `front_with_street_id` int DEFAULT NULL,
  `road_way_type_id` int DEFAULT NULL,
  `commercial_purpose_type_id` int DEFAULT NULL,
  `communication_id` int DEFAULT NULL,
  `land_structure_type_id` int DEFAULT NULL,
  `land_type_id` int DEFAULT NULL,
  `land_use_type_id` int DEFAULT NULL,
  `front_length` double(24,1) DEFAULT NULL,
  `version` int DEFAULT NULL,
  `address_building` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_apartment` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type_id` int DEFAULT NULL,
  `entrance_door_type_id` int DEFAULT NULL,
  `entrance_door_position_id` int DEFAULT NULL,
  `windows_view_id` int DEFAULT NULL,
  `building_floor_count` int DEFAULT NULL,
  `house_floors_type_id` int DEFAULT NULL,
  `roof_drainage` tinyint(1) DEFAULT NULL,
  `new_doors` tinyint(1) DEFAULT NULL,
  `new_windows` tinyint(1) DEFAULT NULL,
  `new_bathroom` tinyint(1) DEFAULT NULL,
  `new_floor` tinyint(1) DEFAULT NULL,
  `new_roof` tinyint(1) DEFAULT NULL,
  `can_be_used_as_commercial` tinyint(1) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `estate_status_id` int DEFAULT NULL,
  `status_changed_on` date DEFAULT NULL,
  `status_id_before_archive` int DEFAULT NULL,
  `buyer_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `selling_price_init` double DEFAULT NULL,
  `selling_price_final` double DEFAULT NULL,
  `selling_price_final_currency_id` int DEFAULT NULL,
  `selling_price_init_currency_id` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `new_construction` tinyint(1) DEFAULT NULL,
  `floor` int DEFAULT NULL,
  `comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_modified_by` int DEFAULT NULL,
  `additional_info_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_info_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_info_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name_ar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selling_comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `garage` tinyint(1) DEFAULT NULL,
  `cellar` tinyint(1) DEFAULT NULL,
  `land` tinyint(1) DEFAULT NULL,
  `niche` tinyint(1) DEFAULT NULL,
  `pantry` tinyint(1) DEFAULT NULL,
  `jacuzzi` tinyint(1) DEFAULT NULL,
  `possible_extension` tinyint(1) DEFAULT NULL,
  `separate_room` tinyint(1) DEFAULT NULL,
  `exchange` tinyint(1) DEFAULT NULL,
  `has_intercom` tinyint(1) DEFAULT NULL,
  `uninhabited` tinyint(1) DEFAULT NULL,
  `balcony` tinyint(1) DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `computer` tinyint(1) DEFAULT NULL,
  `refrigirator` tinyint(1) DEFAULT NULL,
  `hot_water` tinyint(1) DEFAULT NULL,
  `washer` tinyint(1) DEFAULT NULL,
  `dish_washer` tinyint(1) DEFAULT NULL,
  `property_agent_id` int DEFAULT NULL,
  `code` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_date_start` datetime DEFAULT NULL,
  `appointment_date_end` datetime DEFAULT NULL,
  `appointment_comment_arm` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_comment_eng` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_comment_ru` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceiling_height_type_id` int DEFAULT NULL,
  `building_structure_type_id` int DEFAULT NULL,
  `building_floor_type_id` int DEFAULT NULL,
  `vitrage_type_id` int DEFAULT NULL,
  `separate_entrance_type_id` int DEFAULT NULL,
  `intercom` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filled_by` int DEFAULT NULL,
  `filled_on` datetime DEFAULT NULL,
  `verified_by` int DEFAULT NULL,
  `verified_on` datetime DEFAULT NULL,
  `entrance_type_id` int DEFAULT NULL,
  `has_neighbour` tinyint(1) DEFAULT NULL,
  `is_advertised` tinyint(1) DEFAULT NULL,
  `info_source_id` int DEFAULT NULL,
  `price_usd` double DEFAULT NULL,
  `price_amd` int DEFAULT NULL,
  `archive_till_date` date DEFAULT NULL,
  `archive_comment_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `archive_comment_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `archive_comment_ru` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_arm` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_eng` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `public_text_rus` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `estate_latitude` double DEFAULT NULL,
  `estate_longitude` double DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT NULL,
  `urgent_start_date` date DEFAULT NULL,
  `is_exchangeable` tinyint(1) DEFAULT NULL,
  `is_first_floor` tinyint(1) DEFAULT NULL,
  `is_last_floor` tinyint(1) DEFAULT NULL,
  `main_image_file_name` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image_file_path_thumb` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_mansard_floor` tinyint(1) DEFAULT NULL,
  `is_duplex` tinyint(1) DEFAULT NULL,
  `is_basement` tinyint(1) DEFAULT NULL,
  `visits_count` int DEFAULT NULL,
  `is_from_public` tinyint(1) DEFAULT NULL,
  `is_hot_offer` tinyint(1) DEFAULT NULL,
  `hot_offer_start_date` date DEFAULT NULL,
  `is_on_main_page` tinyint(1) DEFAULT NULL,
  `on_main_page_start_date` date DEFAULT NULL,
  `is_separate_building` tinyint(1) DEFAULT NULL,
  `is_estate_commercial_land` tinyint(1) DEFAULT NULL,
  `courtyard_improvement_id` int DEFAULT NULL,
  `distance_public_objects_id` int DEFAULT NULL,
  `building_window_count_id` int DEFAULT NULL,
  `temporary_agent_id` int DEFAULT NULL,
  `temporary_agent_date` date DEFAULT NULL,
  `temporary_visits_count` int DEFAULT NULL,
  `apartment_construction` tinyint(1) DEFAULT NULL,
  `meta_description_eng` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_arm` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_ru` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_down_on` date DEFAULT NULL,
  `is_public_text_generation` tinyint(1) DEFAULT NULL,
  `temporary_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ESTATE_C_LOCATION_COUNTRY` (`location_country_id`),
  KEY `FK_ESTATE_C_LOCATION_PROVINCE` (`location_province_id`),
  KEY `FK_ESTATE_C_LOCATION_CITY` (`location_city_id`),
  KEY `FK_ESTATE_C_LOCATION_COMMUNITY` (`location_community_id`),
  KEY `FK_ESTATE_C_LOCATION_STREET` (`location_street_id`),
  KEY `FK_ESTATE_C_ESTATE_TYPE` (`estate_type_id`),
  KEY `FK_ESTATE_C_CURRENCY` (`currency_id`),
  KEY `FK_ESTATE_C_CONTACT` (`seller_id`),
  KEY `FK_ESTATE_C_REGISTERED_RIGHTS` (`registered_right_id`),
  KEY `FK_ESTATE_BUILDING_C_REMONT_TYPE` (`repairing_type_id`),
  KEY `FK_ESTATE_BUILDING_C_BUILDING_TYPE` (`building_type_id`),
  KEY `FK_ESTATE_HOUSE_C_EXTERIOR_DESIGN_TYPE` (`exterior_design_type_id`),
  KEY `FK_ESTATE_BUILDING_C_ELEVATOR_TYPE` (`elevator_type_id`),
  KEY `FK_ESTATE_BUILDING_C_YEAR` (`year_id`),
  KEY `FK_ESTATE_BUILDING_C_HEATING_SYSTEM_TYPE` (`heating_system_type_id`),
  KEY `FK_ESTATE_BUILDING_C_PARKING_TYPE` (`parking_type_id`),
  KEY `FK_ESTATE_BUILDING_C_SERVICE_FEE_TYPE` (`service_fee_type_id`),
  KEY `FK_ESTATE_HOUSE_C_ROOF_TYPE` (`roof_type_id`),
  KEY `FK_ESTATE_HOUSE_C_HOUSE_BUILDING_TYPE` (`house_building_type_id`),
  KEY `FK_ESTATE_HOUSE_C_ROOF_MATERIAL_TYPE` (`roof_material_type_id`),
  KEY `FK_ESTATE_LAND_C_FENCE_TYPE` (`fence_type_id`),
  KEY `FK_ESTATE_HOUSE_C_COMMUNICATION` (`communication_type_id`),
  KEY `FK_ESTATE_LAND_C_FRONT_WITH_STREET` (`front_with_street_id`),
  KEY `FK_ESTATE_LAND_C_ROAD_WAY_TYPE` (`road_way_type_id`),
  KEY `FK_ESTATE_LAND_C_COMMUNICATION` (`communication_id`),
  KEY `FK_ESTATE_LAND_C_LAND_STRUCTURE_TYPE` (`land_structure_type_id`),
  KEY `FK_ESTATE_LAND_C_LAND_TYPE` (`land_type_id`),
  KEY `estate_status_id` (`estate_status_id`),
  KEY `status_id_before_archive` (`status_id_before_archive`),
  KEY `AGENT_ID` (`agent_id`),
  KEY `last_modified_on` (`last_modified_on`),
  KEY `IS_HOT_OFFER` (`is_hot_offer`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_BUILDING_TYPE` FOREIGN KEY (`building_type_id`) REFERENCES `c_building_types` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_ELEVATOR_TYPE` FOREIGN KEY (`elevator_type_id`) REFERENCES `c_elevator_type` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_HEATING_SYSTEM_TYPE` FOREIGN KEY (`heating_system_type_id`) REFERENCES `c_heating_system_type` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_PARKING_TYPE` FOREIGN KEY (`parking_type_id`) REFERENCES `c_parking_type` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_REMONT_TYPE` FOREIGN KEY (`repairing_type_id`) REFERENCES `c_repairing_type` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_SERVICE_FEE_TYPE` FOREIGN KEY (`service_fee_type_id`) REFERENCES `c_service_fee_type` (`id`),
  CONSTRAINT `FK_ESTATE_BUILDING_C_YEAR` FOREIGN KEY (`year_id`) REFERENCES `c_year` (`id`),
  CONSTRAINT `FK_ESTATE_C_CONTACT` FOREIGN KEY (`seller_id`) REFERENCES `contact` (`id`),
  CONSTRAINT `FK_ESTATE_C_CURRENCY` FOREIGN KEY (`currency_id`) REFERENCES `c_currency` (`id`),
  CONSTRAINT `FK_ESTATE_C_ESTATE_TYPE` FOREIGN KEY (`estate_type_id`) REFERENCES `c_estate_type` (`id`),
  CONSTRAINT `FK_ESTATE_C_LOCATION_CITY` FOREIGN KEY (`location_city_id`) REFERENCES `c_location_city` (`id`),
  CONSTRAINT `FK_ESTATE_C_LOCATION_COMMUNITY` FOREIGN KEY (`location_community_id`) REFERENCES `c_location_community` (`id`),
  CONSTRAINT `FK_ESTATE_C_LOCATION_COUNTRY` FOREIGN KEY (`location_country_id`) REFERENCES `c_location_country` (`id`),
  CONSTRAINT `FK_ESTATE_C_LOCATION_PROVINCE` FOREIGN KEY (`location_province_id`) REFERENCES `c_location_province` (`id`),
  CONSTRAINT `FK_ESTATE_C_LOCATION_STREET` FOREIGN KEY (`location_street_id`) REFERENCES `c_location_street` (`id`),
  CONSTRAINT `FK_ESTATE_C_REGISTERED_RIGHTS` FOREIGN KEY (`registered_right_id`) REFERENCES `c_registered_right` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_COMMUNICATION` FOREIGN KEY (`communication_type_id`) REFERENCES `c_communication_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_EXTERIOR_DESIGN_TYPE` FOREIGN KEY (`exterior_design_type_id`) REFERENCES `c_exterior_design_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_FENCE_TYPE` FOREIGN KEY (`fence_type_id`) REFERENCES `c_fence_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_FRONT_WITH_STREET` FOREIGN KEY (`front_with_street_id`) REFERENCES `c_front_with_street` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_HOUSE_BUILDING_TYPE` FOREIGN KEY (`house_building_type_id`) REFERENCES `c_house_building_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_ROAD_WAY_TYPE` FOREIGN KEY (`road_way_type_id`) REFERENCES `c_road_way_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_ROOF_MATERIAL_TYPE` FOREIGN KEY (`roof_material_type_id`) REFERENCES `c_roof_material_type` (`id`),
  CONSTRAINT `FK_ESTATE_HOUSE_C_ROOF_TYPE` FOREIGN KEY (`roof_type_id`) REFERENCES `c_roof_type` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_COMMUNICATION` FOREIGN KEY (`communication_id`) REFERENCES `c_communication_type` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_FENCE_TYPE` FOREIGN KEY (`fence_type_id`) REFERENCES `c_fence_type` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_FRONT_WITH_STREET` FOREIGN KEY (`front_with_street_id`) REFERENCES `c_front_with_street` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_LAND_STRUCTURE_TYPE` FOREIGN KEY (`land_structure_type_id`) REFERENCES `c_land_structure_type` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_LAND_TYPE` FOREIGN KEY (`land_type_id`) REFERENCES `c_land_type` (`id`),
  CONSTRAINT `FK_ESTATE_LAND_C_ROAD_WAY_TYPE` FOREIGN KEY (`road_way_type_id`) REFERENCES `c_road_way_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_broker_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_broker_statistics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `screened` int DEFAULT NULL,
  `elected` int DEFAULT NULL,
  `changed` int DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_change_in_status_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_change_in_status_statistics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `visit_count` int DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_type_id` int DEFAULT NULL,
  `estate_id` int DEFAULT NULL,
  `path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_thumb` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_document_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_document_download` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `download_date` date DEFAULT NULL,
  `estate_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_email_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_email_key` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `estate_email_type_id` int DEFAULT NULL,
  `security_key` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `estate_id` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_ip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_option_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_option_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estate_type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_price` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `estate_price` double DEFAULT NULL,
  `price_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_profession` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `profession_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_rent_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_rent_contract` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `initial_price` double DEFAULT NULL,
  `initial_price_currency_id` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `renter_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `final_price` double DEFAULT NULL,
  `final_price_currency_id` int DEFAULT NULL,
  `index_col` int DEFAULT NULL,
  `comment_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ESTATE_ID` (`estate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `estate_structure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estate_structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `area` double DEFAULT NULL,
  `structure_type_id` int DEFAULT NULL,
  `comment_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estate_id` int DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `sending_date` datetime DEFAULT NULL,
  `subject` varchar(245) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_to_contact_id` int DEFAULT NULL,
  `mail_to_email_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mail_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail_id` int DEFAULT NULL,
  `document_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipient_id` int DEFAULT NULL,
  `estate_id` int DEFAULT NULL,
  `sender_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_type_id` int DEFAULT NULL,
  `feedback_type_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `overall_rating` int DEFAULT NULL,
  `offering_price` double DEFAULT NULL,
  `offering_currency_id` int DEFAULT NULL,
  `message_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `sent_on` datetime DEFAULT NULL,
  `ip_address` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_and_verified` (`message_type_id`,`is_verified`),
  KEY `RECIPIENT_ID` (`recipient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_arm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_eng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_arm` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_eng` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ru` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `notified_date` datetime DEFAULT NULL,
  `is_viewed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notification_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_location_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_location_city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_location_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_location_community` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_menu_contract_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_menu_contract_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `contract_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_menu_estate_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_menu_estate_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_menu_location_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_menu_location_city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_menu_location_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_menu_location_community` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_permission_menu_calculator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_permission_menu_calculator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `contract_type_id` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `screened_count` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_permission_menu_contract_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_permission_menu_contract_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `contract_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_permission_menu_estate_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_permission_menu_estate_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_permission_menu_location_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_permission_menu_location_city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_city_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_permission_menu_location_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_permission_menu_location_community` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_community_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `professional_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professional_profession` (
  `user_id` int DEFAULT NULL,
  `profession_id` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PROFESSIONAL_USER` (`user_id`),
  KEY `FK_PROFESSIONAL_PROFESSION` (`profession_id`),
  CONSTRAINT `FK_PROFESSIONAL_PROFESSION` FOREIGN KEY (`profession_id`) REFERENCES `c_profession_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estate_type_id` int DEFAULT NULL,
  `project_type_id` int DEFAULT NULL,
  `name_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_photo_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_photo_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_photo_thumb_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `project_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_ar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_type_id` int DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  `path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_thumb` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `realtor_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `realtor_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `profession_type_id` int DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `last_modified_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `is_from_public` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_blocked` tinyint(1) DEFAULT NULL,
  `profile_picture_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` int DEFAULT NULL,
  `party_type_id` int DEFAULT NULL,
  `contact_visits_count` int DEFAULT NULL,
  `screened_count` int DEFAULT NULL,
  `packet_type_id` int DEFAULT NULL,
  `packet_start_date` date DEFAULT NULL,
  `packet_end_date` date DEFAULT NULL,
  `menu_location_province_id` int DEFAULT NULL,
  `meta_title_eng` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_arm` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_ru` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_eng` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_arm` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_ru` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_menu_packet_type_id` int DEFAULT NULL,
  `permission_menu_packet_start_date` date DEFAULT NULL,
  `permission_menu_packet_end_date` date DEFAULT NULL,
  `permission_menu_location_province_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `realtor_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `realtor_user_role` (
  `user_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER_ROLE_USER` (`user_id`),
  KEY `FK_USER_ROLE_ROLE` (`role_id`),
  CONSTRAINT `FK_USER_ROLE_USER` FOREIGN KEY (`user_id`) REFERENCES `realtor_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sysdiagrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sysdiagrams` (
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_id` int DEFAULT NULL,
  `diagram_id` int NOT NULL,
  `version` int DEFAULT NULL,
  `definition` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`diagram_id`),
  UNIQUE KEY `UK_principal_name` (`principal_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries` (
  `sequence` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_entries_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telescope_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (1,'2014_10_12_100000_create_password_resets_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (2,'2019_08_19_000000_create_failed_jobs_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (3,'2019_12_14_000001_create_personal_access_tokens_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (4,'2022_10_24_144152_create_permission_tables',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (5,'2022_11_02_125030_create_announcement_request_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (6,'2022_11_02_125030_create_announcement_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (7,'2022_11_02_125030_create_article_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (8,'2022_11_02_125030_create_c_area_for_building_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (9,'2022_11_02_125030_create_c_area_for_land_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (10,'2022_11_02_125030_create_c_article_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (11,'2022_11_02_125030_create_c_building_floor_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (12,'2022_11_02_125030_create_c_building_project_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (13,'2022_11_02_125030_create_c_building_structure_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (14,'2022_11_02_125030_create_c_building_types_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (15,'2022_11_02_125030_create_c_building_window_count_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (16,'2022_11_02_125030_create_c_ceiling_height_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (17,'2022_11_02_125030_create_c_classifier_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (18,'2022_11_02_125030_create_c_commercial_purpose_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (19,'2022_11_02_125030_create_c_communication_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (20,'2022_11_02_125030_create_c_contact_status_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (21,'2022_11_02_125030_create_c_contact_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (22,'2022_11_02_125030_create_c_contract_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (23,'2022_11_02_125030_create_c_courtyard_improvement_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (24,'2022_11_02_125030_create_c_currency_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (25,'2022_11_02_125030_create_c_daily_price_in_amd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (26,'2022_11_02_125030_create_c_daily_price_in_rur_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (27,'2022_11_02_125030_create_c_daily_price_in_usd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (28,'2022_11_02_125030_create_c_design_color_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (29,'2022_11_02_125030_create_c_design_price_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (30,'2022_11_02_125030_create_c_design_room_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (31,'2022_11_02_125030_create_c_design_room_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (32,'2022_11_02_125030_create_c_design_style_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (33,'2022_11_02_125030_create_c_distance_public_objects_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (34,'2022_11_02_125030_create_c_elevator_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (35,'2022_11_02_125030_create_c_entrance_door_position_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (36,'2022_11_02_125030_create_c_entrance_door_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (37,'2022_11_02_125030_create_c_entrance_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (38,'2022_11_02_125030_create_c_estate_email_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (39,'2022_11_02_125030_create_c_estate_status_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (40,'2022_11_02_125030_create_c_estate_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (41,'2022_11_02_125030_create_c_evaluation_balcony_available_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (42,'2022_11_02_125030_create_c_evaluation_building_area_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (43,'2022_11_02_125030_create_c_evaluation_building_floor_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (44,'2022_11_02_125030_create_c_evaluation_building_project_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (45,'2022_11_02_125030_create_c_evaluation_building_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (46,'2022_11_02_125030_create_c_evaluation_building_window_count_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (47,'2022_11_02_125030_create_c_evaluation_building_window_position_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (48,'2022_11_02_125030_create_c_evaluation_courtyard_improvement_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (49,'2022_11_02_125030_create_c_evaluation_distance_public_objects_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (50,'2022_11_02_125030_create_c_evaluation_external_design_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (51,'2022_11_02_125030_create_c_evaluation_interior_design_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (52,'2022_11_02_125030_create_c_evaluation_last_floor_availability_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (53,'2022_11_02_125030_create_c_evaluation_layout_room_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (54,'2022_11_02_125030_create_c_evaluation_location_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (55,'2022_11_02_125030_create_c_evaluation_location_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (56,'2022_11_02_125030_create_c_evaluation_sun_orientation_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (57,'2022_11_02_125030_create_c_exterior_design_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (58,'2022_11_02_125030_create_c_feedback_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (59,'2022_11_02_125030_create_c_fence_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (60,'2022_11_02_125030_create_c_floors_quantity_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (61,'2022_11_02_125030_create_c_front_with_street_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (62,'2022_11_02_125030_create_c_heating_system_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (63,'2022_11_02_125030_create_c_house_building_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (64,'2022_11_02_125030_create_c_house_floors_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (65,'2022_11_02_125030_create_c_land_structure_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (66,'2022_11_02_125030_create_c_land_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (67,'2022_11_02_125030_create_c_land_use_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (68,'2022_11_02_125030_create_c_location_city_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (69,'2022_11_02_125030_create_c_location_community_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (70,'2022_11_02_125030_create_c_location_country_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (71,'2022_11_02_125030_create_c_location_province_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (72,'2022_11_02_125030_create_c_location_street_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (73,'2022_11_02_125030_create_c_message_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (74,'2022_11_02_125030_create_c_packet_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (75,'2022_11_02_125030_create_c_parking_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (76,'2022_11_02_125030_create_c_party_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (77,'2022_11_02_125030_create_c_price_per_qwd_meter_arm_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (78,'2022_11_02_125030_create_c_price_per_qwd_meter_rur_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (79,'2022_11_02_125030_create_c_price_per_qwd_meter_usd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (80,'2022_11_02_125030_create_c_profession_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (81,'2022_11_02_125030_create_c_registered_right_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (82,'2022_11_02_125030_create_c_rent_price_in_amd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (83,'2022_11_02_125030_create_c_rent_price_in_rur_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (84,'2022_11_02_125030_create_c_rent_price_in_usd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (85,'2022_11_02_125030_create_c_repairing_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (86,'2022_11_02_125030_create_c_road_way_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (87,'2022_11_02_125030_create_c_role_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (88,'2022_11_02_125030_create_c_roof_material_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (89,'2022_11_02_125030_create_c_roof_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (90,'2022_11_02_125030_create_c_rooms_quantity_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (91,'2022_11_02_125030_create_c_sell_price_in_amd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (92,'2022_11_02_125030_create_c_sell_price_in_rur_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (93,'2022_11_02_125030_create_c_sell_price_in_usd_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (94,'2022_11_02_125030_create_c_separate_entrance_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (95,'2022_11_02_125030_create_c_service_fee_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (96,'2022_11_02_125030_create_c_service_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (97,'2022_11_02_125030_create_c_structure_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (98,'2022_11_02_125030_create_c_vitrage_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (99,'2022_11_02_125030_create_c_windows_view_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (100,'2022_11_02_125030_create_c_year_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (101,'2022_11_02_125030_create_client_building_project_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (102,'2022_11_02_125030_create_client_building_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (103,'2022_11_02_125030_create_client_commercial_purpose_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (104,'2022_11_02_125030_create_client_community_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (105,'2022_11_02_125030_create_client_house_floor_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (106,'2022_11_02_125030_create_client_land_use_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (107,'2022_11_02_125030_create_client_repairing_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (108,'2022_11_02_125030_create_client_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (109,'2022_11_02_125030_create_contact_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (110,'2022_11_02_125030_create_contact_visit_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (111,'2022_11_02_125030_create_design_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (112,'2022_11_02_125030_create_estate_broker_statistics_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (113,'2022_11_02_125030_create_estate_change_in_status_statistics_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (114,'2022_11_02_125030_create_estate_document_download_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (115,'2022_11_02_125030_create_estate_document_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (116,'2022_11_02_125030_create_estate_email_key_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (117,'2022_11_02_125030_create_estate_favorites_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (118,'2022_11_02_125030_create_estate_ip_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (119,'2022_11_02_125030_create_estate_price_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (120,'2022_11_02_125030_create_estate_profession_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (121,'2022_11_02_125030_create_estate_rent_contract_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (122,'2022_11_02_125030_create_estate_structure_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (123,'2022_11_02_125030_create_estate_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (124,'2022_11_02_125030_create_mail_documents_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (125,'2022_11_02_125030_create_mail_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (126,'2022_11_02_125030_create_message_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (127,'2022_11_02_125030_create_notification_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (128,'2022_11_02_125030_create_professional_location_city_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (129,'2022_11_02_125030_create_professional_location_community_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (130,'2022_11_02_125030_create_professional_menu_contract_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (131,'2022_11_02_125030_create_professional_menu_estate_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (132,'2022_11_02_125030_create_professional_menu_location_city_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (133,'2022_11_02_125030_create_professional_menu_location_community_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (134,'2022_11_02_125030_create_professional_permission_menu_calculator_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (135,'2022_11_02_125030_create_professional_permission_menu_contract_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (136,'2022_11_02_125030_create_professional_permission_menu_estate_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (137,'2022_11_02_125030_create_professional_permission_menu_location_city_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (138,'2022_11_02_125030_create_professional_permission_menu_location_community_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (139,'2022_11_02_125030_create_professional_profession_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (140,'2022_11_02_125030_create_project_document_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (141,'2022_11_02_125030_create_project_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (142,'2022_11_02_125030_create_realtor_user_role_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (143,'2022_11_02_125030_create_realtor_user_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (144,'2022_11_02_125030_create_sysdiagrams_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (145,'2022_11_02_125030_create_users_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (146,'2022_11_02_125031_add_foreign_keys_to_announcement_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (147,'2022_11_02_125031_add_foreign_keys_to_article_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (148,'2022_11_02_125031_add_foreign_keys_to_c_design_room_type_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (149,'2022_11_02_125031_add_foreign_keys_to_design_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (150,'2022_11_02_125031_add_foreign_keys_to_estate_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (151,'2022_11_02_125031_add_foreign_keys_to_professional_profession_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (152,'2022_11_02_125031_add_foreign_keys_to_realtor_user_role_table',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (153,'2022_11_02_125031_create_rented_estate_by_last_rent_end_date_view',1,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (154,'2018_08_08_100000_create_telescope_entries_table',2,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (155,'2023_02_09_123719_add_estate_option_types_table',3,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (156,'2023_07_16_103016_add_temporary_photos_to_estate_table',4,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (157,'2023_07_16_192817_create_base_migration_timestamps_class',4,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (158,'2023_07_16_193013_copy_created_on_to_created_at_all_tables',4,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (159,'2023_07_16_193124_copy_modified_on_to_updated_at_all_tables',4,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (160,'2020_03_31_114745_remove_backpackuser_model',5,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (161,'2023_09_03_134955_add_price_amd_column_to_table',6,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (162,'2023_11_01_054918_create_activity_log_table',7,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (163,'2023_11_01_054919_add_event_column_to_activity_log_table',7,NULL,NULL);
INSERT INTO `migrations` (`id`, `migration`, `batch`, `created_at`, `updated_at`) VALUES (164,'2023_11_01_054920_add_batch_uuid_column_to_activity_log_table',7,NULL,NULL);
