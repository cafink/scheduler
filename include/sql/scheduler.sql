CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`name` varchar(255) NOT NULL,
	`role` enum('employee', 'manager') NOT NULL DEFAULT 'employee',
	`email` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `shifts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`manager_id` int(11) NOT NULL,
	`employee_id` int(11) DEFAULT NULL,
	`break` double DEFAULT NULL,
	`start_time` timestamp NOT NULL,
	`end_time` timestamp NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`manager_id`) REFERENCES users(`id`),
	FOREIGN KEY (`employee_id`) REFERENCES users(`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
