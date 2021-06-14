CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(50) NOT NULL,
	`chat_id` int(100) NOT NULL,
	`name` varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `infoBosses_l2warland` (
	`id` int(4) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`level` int(3) NOT NULL,
	`type` varchar(10) NOT NULL,
	`state` int(1) NOT NULL,
	`broadcasted` int(1) NOT NULL,
	`updated` datetime NOT NULL,
	PRIMARY KEY(`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `chatBroadcast_servers` (
	`id` int(100) NOT NULL AUTO_INCREMENT,
	`chat_id` int(100) NOT NULL,
	PRIMARY KEY(`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `chatBroadcast_l2warland` (
	`id` int(100) NOT NULL AUTO_INCREMENT,
	`chat_id` int(100) NOT NULL,
	`boss_id` int(4) NOT NULL,
	`broadcasted` int(1) NOT NULL,
	`updated` datetime NOT NULL,
	PRIMARY KEY(`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `timeRespawn_l2warland` (
	`boss_id` int(4) NOT NULL,
	`last_update` datetime,
	`updated` datetime NOT NULL
) DEFAULT CHARSET=utf8;
