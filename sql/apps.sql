CREATE TABLE IF NOT EXISTS `apps` (
  `ID` bigint(12) unsigned NOT NULL AUTO_INCREMENT,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  
  `rank_history` longtext NOT NULL,
  `current_rank` SMALLINT(6) NOT NULL DEFAULT -1,
  `rank_diff` SMALLINT(3) NOT NULL DEFAULT 0,
  `post_title` text NOT NULL,
  `post_content` longtext NOT NULL,  
  PRIMARY KEY (`ID`)
)
