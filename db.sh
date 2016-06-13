mysql -uroot "create database thread character set utf8;"
mysql -uroot "use thread"
mysql -uroot "create table thread (
	id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name varchar(256) NOT NULL,
	message varchar(256) NOT NULL,
	uptime datetime NOT NULL,
	PRIMARY KEY(id));"
