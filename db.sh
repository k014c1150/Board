mysql -uroot -e"create database Board;"
mysql -uroot -e"create table user (id MEDIUMINT NOT NULL AUTO_INCREMENT,name varchar(256) NOT NULL,PRIMARY KEY(id));" Board
mysql -uroot -e"create table thread (id MEDIUMINT NOT NULL AUTO_INCREMENT ,name varchar(256) NOT NULL ,message varchar(256) NOT NULL,uptime datetime NOT NULL,PRIMARY KEY(id));" Board
