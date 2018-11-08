# Employee table
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `birthdate` date NOT NULL,
  `ssn` varchar(255) NOT NULL DEFAULT '',
  `is_working` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone_no` varchar(255) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `introduction` longtext NOT NULL,
  `working_exprience` longtext NOT NULL,
  `education` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `logs`;

# Employee Logs table
# ------------------------------------------------------------

CREATE TABLE `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) unsigned NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'root',
  `action` enum('create','update') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Employee On Create Trigger
# ------------------------------------------------------------

CREATE TRIGGER `add_new_employees` AFTER INSERT ON `employees` FOR EACH ROW INSERT INTO logs(employee_id, created_by, action, created_at, updated_at) VALUES(NEW.id, 'root', 'create', NOW(), NOW());

# Employee On Update Trigger
# ------------------------------------------------------------

CREATE TRIGGER `update_existing_employees` AFTER UPDATE ON `employees` FOR EACH ROW INSERT INTO logs(employee_id, created_by, action, created_at, updated_at) VALUES(NEW.id, 'root', 'update', NOW(), NOW());

# Insert employee data
# ------------------------------------------------------------

INSERT INTO `employees` (`id`, `name`, `birthdate`, `ssn`, `is_working`, `email`, `phone_no`, `address`, `introduction`, `working_exprience`, `education`, `created_at`, `updated_at`)
VALUES
	(1,'Ahmad Shah Hafizan Hamidin','1987-10-29','420-78-5043',1,'ahmadshahhafiazan@gmail.com','60103667440','AC-3-7, Goodyear Court 10, USJ 10, 47630 Subang Jaya, Selangor, Malaysia','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur','[\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat\",\"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"]','[\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat\",\"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"]', NOW(), NOW());

# Update employee data
# ------------------------------------------------------------

UPDATE `employees` SET name = 'Ahmad Shah' WHERE id = 1;

# Select employee data
# ------------------------------------------------------------

SELECT * FROM `employees` WHERE id = 1;
