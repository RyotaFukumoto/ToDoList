#!/bin/sh
cd /opt/lampp/bin
./mysql -uroot -e "drop database todoDB;"
./mysql -uroot -e  "create database todoDB;"
./mysql -uroot todoDB -e "create table ToDoList(id int not null auto_increment primary key,text varchar(255));"
