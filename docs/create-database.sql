create database if not exists db_schedule_php;
use db_schedule_php;

create table if not exists tb_events(
	`event_id` int auto_increment not null,
    `event_location` varchar(170) not null,
    `description` varchar(200),
    `date_begin` datetime DEFAULT '0000-00-00 00:00:00',
    `date_end` datetime DEFAULT '0000-00-00 00:00:00',
    `status` enum('Approved', 'Postponed', 'Canceled'),
    primary key(event_id)
);

create table if not exists tb_contacts(
	`contact_id` int auto_increment not null,
    `name` varchar(170) not null,
    `address` varchar(170),
    `cellphone` varchar(25),
    `email` varchar(200),
    `create_at` datetime DEFAULT '0000-00-00 00:00:00',
    primary key(contact_id)
);